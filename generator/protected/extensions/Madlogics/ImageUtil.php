<?php
namespace Madlogics;

class ImageUtil {

    public static function percentToAlpha($percent) {
        if ($percent <= 0) {
            return 0;
        }

        return ($percent / 100) * 127;
    }

    // @todo: check for valid extension
    public static function getImFromPath($path) {
        $im = imagecreatefromstring(file_get_contents($path));

        return $im;
    }

    /**
     * @param string $color
     * @return array
     */
    public static function hex2dec($color) {
        $color = str_replace('#', '', $color);
        $color = str_pad($color, 6, '0');
        return array(hexdec(substr($color, 0, 2)), hexdec(substr($color, 2, 2)), hexdec(substr($color, 4, 2)));
    }

    public static function addAlphaSave(&$im) {
        imagesavealpha($im, true);
    }

}