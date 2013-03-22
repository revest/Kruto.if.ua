<?php

//если локальный
if (isset($_SERVER['HTTP_HOST']))
    $HTTP_HOST = $_SERVER['HTTP_HOST'];

if ($HTTP_HOST == 'localhost' || $HTTP_HOST == '127.0.0.1' || preg_match('/^192\.168\.0\.[0-9]+$/', $HTTP_HOST)) {
// change the following paths if necessary
    $yii = dirname(__FILE__) . '/../../../FrameWork/yii/yii.php';
    $config = dirname(__FILE__) . '/protected/config/test.php';
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    // specify how many levels of call stack should be shown in each log message
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
} else {
    $include_dir = "/home/u569030126/";
// change the following paths if necessary
    $yii = $include_dir . '/yii/yii.php';
    $config = $include_dir . '/public_html/protected/config/main.php';    
}


$STYLES = array(0 => "Unknown");
 function str_makeAlias($string){
          return strtolower(str_replace(" ", "_", preg_replace('/\[\][{\}\!\@\#\$%\^\*\.\,\<\>\-\=]/', '', $string)));           
    }
// remove the following lines when in production mode
require_once($yii);
$app = Yii::createWebApplication($config);
require_once dirname(__FILE__) . '/protected/vendors/functions.php';
$app->run();

