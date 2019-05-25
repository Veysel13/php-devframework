<?php

define('_rootPath',$_SERVER['DOCUMENT_ROOT']);

class AdminMainControllers
{


   public function View($param,$controller,$vars=false)
    {

        restore_include_path();
        if ($vars!=false){
            extract($vars);
        }

        include_once _rootPath."/DevFramework/Web/Admin/Views/$controller/$param.php";

    }



   public function RedirectToAction($url,$value=false)
    {

        if ($value != false) {
            extract($value);

            //$url ="../"."$controller/$index/$value";
            header("Location:$url");
        } else {

            //$url ="../"."$controller/$index";
            header("Location:$url");
        }

    }

   public function __call($method,$par){
        echo $method."/".$par." class not found sdas";
    }
}
