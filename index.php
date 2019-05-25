<?php

define('_root',$_SERVER['DOCUMENT_ROOT']."DevFramework");
define('_rooturl',"/DevFramework");

//hata değeri için
error_reporting(E_ALL);
ini_set("display_errors", 1);
//hata değeri için

include_once "system/autoload.php";

try {
    include_once "system/error/settings.php";
    include_once "system/router/Router.php";

     if(!isset($_GET["url"])){
         $_GET["url"]="home";
     }
    new Router($_GET["url"]);

    include_once "system/router/web.php";
    Router::submit();
}
catch (Exception $a) {
    echo $a->getMessage();
}
?>