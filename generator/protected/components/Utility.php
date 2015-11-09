<?php

class Utility {

    public static function seoName($string) {
        //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
        $string = strtolower($string);
        //Strip any unwanted characters
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
    }

    public static function hasFlash($type = 'error') {
        return Yii::app()->user->hasFlash($type);
    }

    public static function setFlash($message, $type = 'error') {
        $messages = (array) Yii::app()->user->getFlash($type);
        $messages[] = $message;
        Yii::app()->user->setFlash($type, $messages);
    }

    public static function getFlash($type = 'error') {
        $messages = Yii::app()->user->getFlash($type);
        return $messages;
    }

    public static function tableHead($link, $header, $options = array()) {
        $out = '';

        $page = (int) Yii::app()->request->getQuery('page');
        $page = $page > 0 ? $page : 1;
        $sort = Yii::app()->request->getQuery('sort');
        $sort = empty($sort) ? 'asc' : $sort;
        $order = Yii::app()->request->getQuery('order');

        foreach ($header as $field => $title) {
            $th_attrs = array();
            if (is_array($title)) {
                $th_attrs = isset($title[1]) ? $title[1] : array();
                $title = $title[0];
            }

            $params = array(
                'order' => $field,
                'sort' => ($sort == 'asc' ? 'desc' : 'asc')
            );

            if (isset($options['page']) && $options['page']) {
                $params['page'] = $page;
            }

            if (isset($options['query']) && is_array($options['query'])) {
                $params = array_merge($params, $options['query']);
            }
            $out .= '<th' . CHtml::renderAttributes($th_attrs) . '>';
            if (is_string($field)) {
                $out .= '<a href="' . Yii::app()->createUrl($link, $params) . '">';
            }
            $out .= $title;

            if (is_string($field)) {
                if ($order == $field) {
                    $out .= $sort == 'asc' ? ' <i class="icon-chevron-up"></i>' : ' <i class="icon-chevron-down"></i>';
                }
                $out .= '</a>';
            }
            $out .= '</th>';
        }

        return $out;
    }

    public static function beginsWith($str, $search) {
        if (substr($str, 0, strlen($search)) == $search) {
            return true;
        }

        return false;
    }

    public static function isBitlyActive() {
        return SiteVariable::get('BITLY_USE', FALSE) == TRUE;
    }

    public static function getBitlyUrl($url) {
        if (self::isBitlyActive()) {
            $login = SiteVariable::get('BITLY_LOGIN');
            $key = SiteVariable::get('BITLY_API_KEY');
            $out = json_decode(Yii::app()->CURL->run('http://api.bit.ly/shorten?version=2.0.1&longUrl=' . urlencode($url) . '&login=' . $login . '&apiKey=' . $key . '&format=json'));
            if ($out->errorCode == 0) {
                $urls = (array) $out->results;
                return $urls[$url]->shortUrl;
            }
        }

        return '';
    }

    public static function getTagFromID($integer, $base = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $length = strlen($base);
        $out = '';
        while ($integer > $length - 1) {
            $out = $base[(int)fmod($integer, $length)] . $out;
            $integer = floor($integer / $length);
        }
        return $base[(int)$integer] . $out;
    }

    public static function getIDFromTag($string, $base = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ') {
        $length = strlen($base);
        $size = strlen($string) - 1;
        $string = str_split($string);
        $out = strpos($base, array_pop($string));
        foreach ($string as $i => $char) {
            $out += strpos($base, $char) * pow($length, $size - $i);
        }
        return $out;
    }

}
