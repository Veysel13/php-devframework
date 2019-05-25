<?php

 class MainController
{
     public function RedirectToAction($url,$value=false)
     {
         $url=_rooturl.$url;
         restore_include_path();
         if ($value != false) {
             extract($value);
             header("Location:$url");
         } else {
             header("Location:$url");
         }
     }

     public function View($param,$controller,$vars=false)
     {
         restore_include_path();
         if ($vars!=false){
             extract($vars);
         }
         include_once _root."/Web/Views/$controller/$param.php";
     }

    function __call($method,$par){
        echo $method."/".$par." class not found sdas";
    }
}
