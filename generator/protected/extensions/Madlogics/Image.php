<?php

namespace Madlogics;

class Image {

    protected $im = null;
    protected $width = 10;
    protected $height = 10;
    protected $backgroundColor = array(255, 255, 255, 127);
    protected $tmp_path = '';
    public static $convert_path = '/usr/local/bin/convert';

    public function __construct() {
        
    }

    public function setWidth($width) {
        $this->width = $width;
        return $this;
    }

    public function getWidth() {
        return $this->width;
    }

    public function setHeight($height) {
        $this->height = $height;
        return $this;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setIm($im) {
        $this->im = $im;
        $this->width = imagesx($this->im);
        $this->height = imagesy($this->im);
        return $this;
    }

    public function &getIm() {
        if ($this->im === null) {
            $this->im = imagecreatetruecolor($this->getWidth(), $this->getHeight());
            imagesavealpha($this->im, true);
            $this->applyBackgroundColor();
        }

        return $this->im;
    }

    public function getBackground() {
        return $this->backgroundColor;
    }

    public function setBackground(array $rgba) {
        $this->backgroundColor = $rgba;
        return $this;
    }

    protected function getBackgroundImColor() {
        if (is_array($this->backgroundColor)) {
            $count = count($this->backgroundColor);
            if ($count == 3) {
                return imagecolorallocate($this->getIm(), $this->backgroundColor[0], $this->backgroundColor[1], $this->backgroundColor[2]);
            } else if ($count == 4) {
                return imagecolorallocatealpha($this->getIm(), $this->backgroundColor[0], $this->backgroundColor[1], $this->backgroundColor[2], $this->backgroundColor[3]);
            }
        }

        return false;
    }

    public function loadFromPath($path) {
        $this->im = ImageUtil::getImFromPath($path);
        ImageUtil::addAlphaSave($this->im);
        $this->setWidth(imagesx($this->im));
        $this->setHeight(imagesy($this->im));
        return $this;
    }

    public function applyBackgroundColor() {
        $im = $this->getIm();
        $bg = $this->getBackgroundImColor();

        if ($bg) {
            imagefill($im, 0, 0, $bg);
        }

        return $this;
    }

    public function applyAlpha($percent) {
        $percent = 100 - floatval($percent);
        $path = $this->getTmpPath();
        $tmp_file = uniqid() . '.png';
        $file_path = $path . DIRECTORY_SEPARATOR . $tmp_file;
        imagepng($this->im, $file_path);
        shell_exec(self::$convert_path . " $file_path -alpha set -channel A -evaluate set $percent% $file_path");
        $this->loadFromPath($file_path);
        @unlink($file_path);
        return $this;
    }

    public function copyTo($im, $x, $y, $w = 0, $h = 0) {
        if ($im instanceof self) {
            $im = $im->getIm();
        }

        $w = $w <= 0 ? imagesx($im) : $w;
        $h = $h <= 0 ? imagesy($im) : $h;

        imagecopy($this->getIm(), $im, $x, $y, 0, 0, $w, $h);
        return $this;
    }

    public function rotate($deg) {
        $this->im = imagerotate($this->im, $deg, -1);
        return $this;
    }

    public function resize($w, $h) {
        $im = imagecreatetruecolor($w, $h);
        imagealphablending($im, false);
        imagesavealpha($im, true);

        // imagefill($im, 0, 0, imagecolorallocatealpha(255,255,255,127));
//        imagecopyresized($im, $this->im, 0, 0, 0, 0, $w, $h, $this->width, $this->height);
        imagecopyresampled($im, $this->im, 0,0, 0,0, $w, $h, $this->width, $this->height);

        imagedestroy($this->im);
        $this->setWidth($w)->setHeight($h);
        $this->im = &$im;

        return $this;
    }

    public function resizeCanvas($w, $h) {
        
        if($w < $this->width || $h < $this->height) {
            throw new Exception('Width and Height must be greater than the orignal');
        }
        
        $im = imagecreatetruecolor($w, $h);
        imagealphablending($im, false);
        imagesavealpha($im, true);
        imagefill($im, 0, 0, imagecolorallocatealpha($im, 255, 255, 255, 127));

        $x = (($w-$this->width)/2);
        $y = (($h-$this->height)/2);
        
        imagecopy($im, $this->im, $x, $y, 0, 0, $this->width, $this->height);

        imagedestroy($this->im);
        $this->setWidth($w)->setHeight($h);
        $this->im = &$im;

        return $this;
    }

    public function getTmpPath() {
        if (empty($this->tmp_path)) {
            return sys_get_temp_dir();
        }
        return $this->tmp_path;
    }

    public function __clone() {
        $org = $this->im;
        $new = imagecreatetruecolor($this->width, $this->height);
        imagefill($new, 0, 0, imagecolorallocatealpha($new, 255, 255, 255, 127));
        imagecopy($new, $org, 0, 0, 0, 0, $this->width, $this->height);
        $this->im = $new;
    }
}