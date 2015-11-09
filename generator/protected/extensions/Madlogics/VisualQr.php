<?php

namespace Madlogics;

class VisualQr extends Qr {

    const BLACK_DARK = 20;
    const BLACK_LIGHT = 90;
    const WHITE_DARK = 20;
    const WHITE_LIGHT = 90;

    protected $bgIm;
    protected $x = 0;
    protected $y = 0;

    public function __construct($im) {

        if (!is_resource($im) || strtolower(get_resource_type($im)) != 'gd') {
            throw new \Exception('$im should be valid PHP GD resource type.');
        }

        $this->bgIm = new Image();
        $this->bgIm->setIm($im);

        $this->moduleRenderPre = function ($p) {
                    $x = $p->x;
                    $y = $p->y;
                    $qr = $p->qr;

                    if ($qr->isPixelEye($x, $y) || $qr->isAlignmentPattern($x, $y)) {
                        return FALSE;
                    }

                    return $qr->isModuleBlack($x, $y) ? $p->black : $p->white;
                };


        $this->qrRenderPost = function($qr) {

                    $qr->expandCanvas();
                    $qr->renderAlignmentPatterns();
                    $qr->renderEyes();
                    $qr->resizeToOriginal();
                };
    }

    public function setX($x) {
        if ($x < 0) {
            throw new Exception('$x must be >= 0');
        }

        $this->x = $x;
        return $this;
    }

    public function setY($y) {
        if ($y < 0) {
            throw new Exception('$y must be >= 0');
        }

        $this->y = $y;
        return $this;
    }
    
    public function alignMiddle() {
        $this->setX($this->bgIm->getWidth()/2 - $this->originalSize / 2);
        $this->setY($this->bgIm->getHeight()/2 - $this->originalSize / 2);
        return $this;
    }

    public function renderEyes() {
        $eyeWhite = imagecreatetruecolor($this->moduleSize * 9, $this->moduleSize * 9);
        imagefill($eyeWhite, 0, 0, imagecolorallocatealpha($eyeWhite, 255, 255, 255, ImageUtil::percentToAlpha(self::WHITE_DARK)));

        $eye = new Image();
        $eye->setIm($eyeWhite);

        $black = imagecreatetruecolor($this->moduleSize, $this->moduleSize);
        imagealphablending($black, false);
        imagesavealpha($black, true);
        imagefill($black, 0, 0, imagecolorallocatealpha($black, 0, 0, 0, ImageUtil::percentToAlpha(self::BLACK_DARK)));

        // render eyes
        for ($x = 1; $x <= 7; $x++) {
            for ($y = 1; $y <= 7; $y++) {
                if (
                        ($x == 2 && $y != 1 && $y != 7) ||
                        ($x == 6 && $y != 1 && $y != 7) ||
                        ($y == 2 && $x != 1 && $x != 7) ||
                        ($y == 6 && $x != 1 && $x != 7)
                ) {
                    continue;
                }
                $eye->copyTo($black, $x * $this->moduleSize, $y * $this->moduleSize);
            }
        }
        $this->copyTo($eye, 0, 0);
        $this->copyTo($eye, $this->width - $this->moduleSize * 9, 0);
        $this->copyTo($eye, 0, $this->height - $this->moduleSize * 9);
        unset($eye);
        imagedestroy($black);
        imagedestroy($eyeWhite);
    }

    public function renderAlignmentPatterns() {
        if ($this->alignmentPatterns) {
            $black = $this->createIm($this->moduleSize, $this->moduleSize, 0, 0, 0, self::BLACK_DARK);
            $white = $this->createIm($this->moduleSize, $this->moduleSize, 255, 255, 255, self::WHITE_DARK);
            foreach ($this->alignmentPatterns as $patterns) {
                foreach ($patterns as $i => $xys) {
                    foreach ($xys as $xy) {
                        $this->copyTo(($i == 1 ? $white : $black), $xy[0] * $this->moduleSize + $this->moduleSize, $xy[1] * $this->moduleSize + $this->moduleSize);
                    }
                }
            }
            unset($black);
            unset($white);
        }
    }

    public function expandCanvas() {
        // resize canvas
        $newIm = $this->createIm($this->width + $this->moduleSize * 2, $this->height + $this->moduleSize * 2, 255, 255, 255, 100);
        $canvas = new Image();
        $canvas->setIm($newIm);
        // copy qr code on cavas
        $canvas->copyTo($this, $this->moduleSize, $this->moduleSize);

        // reset qr code image resource with new one
        $this->setIm($canvas->getIm());
        unset($newIm);
        unset($canvas);
    }

    public function &getBlackModule() {
        $black = $this->createIm($this->moduleSize, $this->moduleSize, 0, 0, 0, self::BLACK_LIGHT);
        $im = new Image();
        $im->setIm($black);

        $im2 = clone $im;
        $im2->setBackground(array(0, 0, 0, ImageUtil::percentToAlpha(self::BLACK_DARK)));
        $im2->applyBackgroundColor();
        $im2->resize($this->moduleSize / 2, $this->moduleSize / 2);
        $im->copyTo($im2, $this->moduleSize / 4, $this->moduleSize / 4);

        unset($im2);
        return $im->getIm();
    }

    public function &getWhiteModule() {
        $white = $this->createIm($this->moduleSize, $this->moduleSize, 255, 255, 255, self::WHITE_LIGHT);
        $im = new Image();
        $im->setIm($white);

        $im2 = clone $im;
        $im2->setBackground(array(255, 255, 255, ImageUtil::percentToAlpha(self::WHITE_DARK)));
        $im2->applyBackgroundColor();
        $im2->resize($this->moduleSize / 2, $this->moduleSize / 2);
        $im->copyTo($im2, $this->moduleSize / 4, $this->moduleSize / 4);

        unset($im2);
        return $im->getIm();
    }

    public function &createIm($w, $h, $r, $g, $b, $a) {
        $im = imagecreatetruecolor($w, $h);
        imagealphablending($im, false);
        imagesavealpha($im, true);
        imagefill($im, 0, 0, imagecolorallocatealpha($im, $r, $g, $b, ImageUtil::percentToAlpha($a)));

        return $im;
    }

    public function setData(array $data) {
        parent::setData($data);
        $this->setSize(min(array($this->bgIm->getWidth(), $this->bgIm->getHeight())));
        return $this;
    }

    public function getImageQrIm() {
        $this->resizeToOriginal();
        $this->bgIm->copyTo($this, $this->x, $this->y);
        return $this->bgIm->getIm();
    }

}
