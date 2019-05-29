<?php

//hata değeri için
error_reporting(E_ALL);
ini_set("display_errors", 1);
//hata değeri için


define('_root',$_SERVER['DOCUMENT_ROOT']."php-devframework");
define('_rooturl',"/php-devframework");
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
try {
    include_once "system/error/settings.php";
    include_once "system/router/Router.php";
    include_once "BusinessLayer/Functions/helpers/Functions.php";
    include_once "Web/Components/GeneralFunctions.php";


     if(!isset($_GET["url"])){
         $_GET["url"]="/";
     }
    new Router($_GET["url"]);

    include_once "system/router/web.php";
    Router::submit();
}
catch (Exception $a) {
    echo $a->getMessage();
}
?>