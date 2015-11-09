<?php

namespace Madlogics;

class Qr extends Image {

    protected $originalSize = 0;
    protected $data = array();
    protected $cols = 0;
    protected $rows = 0;
    protected $moduleSize = 0;
    protected $moduleRenderPre = null;
    protected $qrRenderPost = null;
    protected $alignmentPatterns = array();
    protected $alignmentPatternsFlat = array();
    
    public function __construct() {
        $this->qrRenderPost = function($qr){$qr->resizeToOriginal();};
    }

    public function setData(Array $data) {
        $this->data = $data;
        $this->cols = count($data[0]);
        $this->rows = count($data);
        return $this;
    }

    public function getData() {
        return $this->data;
    }

    public function extractAlignmentPatterns() {
        $patternBoth = array(
            array(-1, -1),
            array(1, 1),
            array(1, -1),
            array(-1, 1),
            array(0, -1),
            array(0, 1),
            array(-1, 0),
            array(1, 0),
        );

        for ($x = 0; $x < $this->rows; $x++) {
            for ($y = 0; $y < $this->cols; $y++) {
                $white = $this->hasBorder($x, $y);
                $black = $this->hasBorder($x, $y, 2, 1);

                if ($black && $white) {
                    
                    $this->alignmentPatterns[] = array(
                        $black,
                        $white,
                        array(array($x, $y)),
                        
                    );
                    $this->alignmentPatternsFlat = array_merge($this->alignmentPatternsFlat, $black);
                    $this->alignmentPatternsFlat = array_merge($this->alignmentPatternsFlat, $white);
                    $this->alignmentPatternsFlat = array_merge($this->alignmentPatternsFlat, array(array($x, $y)));
                }
            }
        }
    }

    public function isAlignmentPattern($x, $y) {
        return in_array(array($x, $y), $this->alignmentPatternsFlat);
    }

    public function hasBorder($x, $y, $offset = 1, $data = 0) {
        $points = array();
        // horizontals
        for ($px = $x - $offset; $px <= $x + $offset; $px++) {
            if ($this->getDataAt($px, $y - $offset) == $data && $this->getDataAt($px, $y + $offset) == $data) {
                $points[] = array($px, $y - $offset);
                $points[] = array($px, $y + $offset);
            } else {
                return false;
            }
        }

        // verticals
        for ($py = $y - $offset + 1; $py <= $y + $offset - 1; $py++) {
            if ($this->getDataAt($x - $offset, $py) == $data && $this->getDataAt($x + $offset, $py) == $data) {
                $points[] = array($x - $offset, $py);
                $points[] = array($x + $offset, $py);
            } else {
                return false;
            }
        }

        return $points;
    }

    public function getDataAt($x, $y) {
        return isset($this->data[$x][$y]) ? $this->data[$x][$y] : false;
    }

    public function getBlackModule() {
        $black = imagecreatetruecolor($this->moduleSize, $this->moduleSize);
        imagefill($black, 0, 0, imagecolorallocatealpha($black, 0, 0, 0, 0));
        return $black;
    }

    public function getWhiteModule() {
        $white = imagecreatetruecolor($this->moduleSize, $this->moduleSize);
        imagefill($white, 0, 0, imagecolorallocatealpha($white, 255, 255, 255, 0));
        return $white;
    }

    public function render() {
        $this->extractAlignmentPatterns();
        $cols = $this->cols;
        $rows = $this->rows;

        $module_size = ceil($this->getSize() / $cols);

        $tmp = new Image;
        $black = $tmp->setIm($this->getBlackModule());
        $tmp = new Image;
        $white = $tmp->setIm($this->getWhiteModule());

        $modulePackage = new ModulePackage();
        $modulePackage->qr = $this;
        $modulePackage->black = $black;
        $modulePackage->white = $white;

        for ($x = 0; $x < $rows; $x++) {
            for ($y = 0; $y < $cols; $y++) {

                $mBlack = clone $black;
                $mWhite = clone $white;
                $module = $this->isModuleBlack($x, $y) ? $mBlack : $mWhite;

                $modulePackage->black = $mBlack;
                $modulePackage->white = $mWhite;
                $modulePackage->x = $x;
                $modulePackage->y = $y;
                $modulePackage->plotX = $x * $module_size;
                $modulePackage->plotY = $y * $module_size;
                $modulePackage->w = $module_size;
                $modulePackage->h = $module_size;

                $renderModule = $module;
                if (is_callable($this->moduleRenderPre)) {
                    $renderModule = call_user_func($this->moduleRenderPre, $modulePackage);
                }

                if ($renderModule instanceof Image)
                    $this->copyTo($renderModule->getIm(), $modulePackage->plotY, $modulePackage->plotX);

                unset($module);
                unset($renderModule);
                unset($mBlack);
                unset($mWhite);
            }
        }

        if (is_object($this->qrRenderPost) && $this->qrRenderPost instanceof \Madlogics\Providers\QrRenderPost) {
            $this->qrRenderPost->qrRenderPost($this);
        } else if (is_callable($this->qrRenderPost)) {
            call_user_func($this->qrRenderPost, $this);
        }

        return $this;
    }

    public function setSize($size) {
        if (empty($this->data)) {
            throw new \Exception('Data must be set first');
        }
        $this->originalSize = $size;
        $this->moduleSize = ceil($this->originalSize / $this->cols);
        $size = $this->moduleSize * $this->cols;

        parent::setWidth($size);
        parent::setHeight($size);
        return $this;
    }

    public function getSize() {
        return $this->getWidth();
    }

    public function setWidth($width) {
        return $this->setSize($width);
    }

    public function setHeight($height) {
        return $this->setSize($height);
    }
    
    public function getCols() {
        return $this->cols;
    }
    
    public function getRows() {
        return $this->rows;
    }

    public function isModuleBlack($x, $y) {
        return $this->data[$x][$y] == 1;
    }

    public function isPixelEye($x, $y) {
        if (
                (($x >= 0 && $x <= 7) && ($y >= 0 && $y <= 7)) ||
                (($x >= $this->cols - 8 && $x <= $this->cols - 1) && ($y >= 0 && $y <= 7)) ||
                (($x >= 0 && $x <= 7) && ($y >= $this->cols - 8 && $y <= $this->cols - 1))
        ) {
            return true;
        }
    }

    public function setModuleRenderPre($func) {
        $this->moduleRenderPre = $func;
    }

    public function setQrRenderPost($func) {
        $this->qrRenderPost = $func;
    }

    public function resizeToOriginal() {
        $this->resize($this->originalSize, $this->originalSize);
        $this->width = $this->originalSize;
        $this->height = $this->originalSize;
    }
}