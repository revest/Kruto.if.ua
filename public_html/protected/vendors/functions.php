<?php
//Get Array of  user Language Priorities
function getLangPriorArr() {
    $LPA; //$lang_prior_arr
    $LPA = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']);
    foreach ($LPA as &$l)
        $l = strtolower(substr($l, 0, 2));

    return $LPA;
}

//get lang witch is in Site and most good for user
function getUserPriorLang($LangSiteArr, $LangPriorArr, $default_lang=null) {
    if (!$default_lang)
        $default_lang = $LangSiteArr[0];
    //если находит в списке языков приоритетный то встаналиваем его
    foreach ($LangPriorArr as $lp) {
        if (in_array($lp, $LangSiteArr))
            return $lp;
    }
    return $default_lang;
}

//convert string date to seconds  
function explodedate($string) {
    $arr1 = explode(" ", $string);
    $arrdate1 = explode("-", $arr1[0]);
    $arrtime1 = explode(":", $arr1[1]);
    return mktime($arrtime1[0], $arrtime1[1], $arrtime1[2], $arrdate1[1], $arrdate1[0], $arrdate1[2]);
}

function parseDate($string) {
    $arr1 = explode(" ", $string);
    $arrdate1 = explode("-", $arr1[0]);
    $arrtime1 = explode(":", $arr1[1]);

    $R['sec'] = $arrtime1[2];
    $R['min'] = $arrtime1[1];
    $R['hour'] = $arrtime1[0];
    $R['day'] = $arrdate1[0];
    $R['month'] = $arrdate1[1];
    $R['year'] = $arrdate1[2];
    return $R;
}

//return difference bettween $event and curr in secundes
function timediff($event, $curent=null) {
    if ($curent == null)
        $curent = time();
    return explodedate($event) - $curent;
}

//Class for  object 
Class Structure {
    
}

function printArray($a) {

    static $count;
    $count = (isset($count)) ? ++$count : 0;
    $colors = array('#FFCB72', '#FFB072', '#FFE972', '#F1FF72', '#92FF69', '#6EF6DA', '#72D9FE', '#77FFFF', '#FF77FF');
    if ($count > count($colors)) {
        $count--;
        return;
    }

    if (!is_array($a)) {
        $a = (array) $a;
        return;
    }

    echo "<table border=1 cellpadding=0 cellspacing=0 bgcolor=$colors[$count]>";

    while (list($k, $v) = each($a)) {
        echo "<tr><td style='padding:1em'>$k</td><td style='padding:1em'>$v</td></tr>\n";
        if (is_array($v)) {
            echo "<tr><td> </td><td>";
            self::printArray($v);
            echo "</td></tr>\n";
        }
    }
    echo "</table>";
    $count--;
}

//translate from main
function tm($string) {
    return Yii::t('main', $string);
}

function tu($string) {
    return Yii::t('user', $string);
}

///////////////////////////////// LANGUAGE
$lang = "";
if (isset($_GET['lang']) && ($_GET['lang'] == "uk" || $_GET['lang'] == "en" || $_GET['lang'] == "ru")) {
    $lang = $_GET['lang'];
    setcookie('lang', $lang, time() + 24 * 60 * 7);
} 

if (!isset($_COOKIE['lang'])) {
    $lang = getUserPriorLang(Yii::app()->params['langArray'], getLangPriorArr(), 'ru');
    setcookie('lang', $lang, time() + 24 * 60 * 7);
}
//setcookie('lang', $lang, time() + 24 * 60 * 7);
Yii::app()->language = (empty($lang))? $_COOKIE['lang'] : $lang;
//var_dump($_COOKIE);
