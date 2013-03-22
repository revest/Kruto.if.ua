<?php

class SHTML {

    public $player_file;

    public function __construct() {
        $this->player_file = self::getPlayerFile();
    }

    public static function getPlayerFile() {
        return Yii::app()->baseURl . "/flash/player.swf";
    }

    public static function playerFlash($link, $width=250) {
        $vol = 80;
        $player_file = Yii::app()->baseURl . "/flash/player.swf";
        $preview = $link;

        return '<embed allowscriptaccess="always" src="' . $player_file . '" flashvars="file=' . $preview . '&amp;frontcolor=0x36E8F1&amp;backcolor=0x222222&amp;lightcolor=0xffffff&amp;autostart=false" width="' . $width . '" height="20" bgcolor="#ffffff">';
    }

    public static function playerPromo($number, $width=250) {
        return '<iframe src="http://promodj.com/embed/' . $number . '/small" width="' . $width . 'px" height="25" style="min-width: ' . $width . 'px; max-width: 700px" frameborder="0" allowfullscreen></iframe>';
    }

    public static function player($link, $width=250) {
        ///http://www41.zippyshare.com/v/63331791/file.html
        //http://promodj.com/Tank1st/remixes/2964482/BEP_Sergio_Mendes_Mas_que_Nada_Dj_Tank1st_remix
        $regexp_zippy = '/^(http:\/\/)?www([0-9]{0,3}).zippyshare.com(\/v\/([0-9]*?)\/file.html|view.jsp?.*?&key=([0-9]*?))$/';
        $regexp_promo = '/^(http:\/\/)?(www.)?(promodj.com)\/.*?\/(\d+)\/.*?$/';
        $regexp_vk = '/^(http:\/\/)?cs(\d)+.userapi.com\/.(\d*)\/audio\/(.*)?.mp3$/';
        //If zippyshare.com
        if (preg_match($regexp_zippy, $link, $res)) {
            $preview = 'http://www' . $res[2] . '.zippyshare.com/downloadMusic%3Fkey%3D' . $res[4] . '%26time%3D1346787349.flv';
            return self::playerFlash($preview);
        }//if promo.dj
        elseif (preg_match($regexp_promo, $link, $res)) {
            return self::playerPromo($res[4]);
        }//if vk.com
        elseif (preg_match($regexp_vk, $link, $res)) {
            return self::playerFlash($link);
        }
        else
            return self::playerFlash($link);
    }

    public static function getZippyPreview($link) {
        $regexp_zippy = '/^(http:\/\/)?www([0-9]{0,3}).zippyshare.com(\/v\/([0-9]*?)\/file.html|view.jsp?.*?&key=([0-9]*?))$/';
        if (preg_match($regexp_zippy, $link, $res)) {
           // return 'http://www' . $res[2] . '.zippyshare.com/downloadMusic?key=' . $res[4] . 'xx';
            return 'http://www'.$res[2].'.zippyshare.com/downloadMusic%3Fkey%3D'.$res[4].'%26time%3D1347283101.flv';
        }
        else
            return false;
    }

        public static function getZippyPreview2($link) {
        $regexp_zippy = '/^(http:\/\/)?www([0-9]{0,3}).zippyshare.com(\/v\/([0-9]*?)\/file.html|view.jsp?.*?&key=([0-9]*?))$/';
        if (preg_match($regexp_zippy, $link, $res)) {
           // return 'http://www' . $res[2] . '.zippyshare.com/downloadMusic?key=' . $res[4] . 'xx';
            return 'http://www'.$res[2].'.zippyshare.com/downloadMusic?key='.$res[4].'xx';
        }
        else
            return $link;
    }
}

?>
