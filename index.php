<?php

if (substr ( $_SERVER ['DOCUMENT_ROOT'], - 1 ) != '/') {
	$_SERVER ['DOCUMENT_ROOT'] = $_SERVER ['DOCUMENT_ROOT'] . '/';
}

function getIP()
{
    static $realip;
    if (isset($_SERVER)){
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")){
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }
 
    return $realip;
}

$ary_ip= array('218.246.102.131','110.75.102.62','112.65.138.202','114.94.240.19','114.241.216.95');
$ip = getIp();

if(!in_array($ip,$ary_ip)){
echo file_get_contents("index.html");
die;
}

require_once $_SERVER ['DOCUMENT_ROOT'] . 'protected/config/constants.php';

$yii = LIBRARY_PATH . 'yii/yii.php';

error_reporting ( E_ALL );

defined ( 'YII_DEBUG' ) or define ( 'YII_DEBUG', true );

defined ( 'YII_TRACE_LEVEL' ) or define ( 'YII_TRACE_LEVEL', 5 );

date_default_timezone_set ( 'Asia/Shanghai' );

require_once ($yii);
require_once (LIBRARY_PATH . 'functions/debug_functions.php');
require_once (LIBRARY_PATH . 'functions/php_5_3_functions.php');


#$session = new CHttpSession ();
#$session->open ();


if(in_array( $_SERVER ['REMOTE_ADDR'], array('::1','127.0.0.1'))){
	$config = 'development';
}else{
	$config = 'production';
}

$config = PROTECTED_PATH . '/config/' . $config . '.php';
Yii::createWebApplication ( $config )->run ();

