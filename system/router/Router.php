<?php
/**
 * Created by PhpStorm.
 * User: veysel
 * Date: 23.05.2019
 * Time: 12:39
 */

class Router
{
    private static   $sayi=0;
    private static   $explode;
    private static   $joker;
    protected static $url;
    public static    $dynUrl=[];
    public static    $urlstatus=0;


   public function __construct($url){
       self::$url=trim($url,"/");

    }


    public static function view($index,$value=false)
    {
        restore_include_path();
        if ($value!=false){
            extract($value);
        }
        include_once _root."/Web/$index.php";
    }

   public static function RedirectToAction($url,$value=false)
    {
        if ($value != false)
        {
            extract($value);
            header("Location:$url");
        }
        else
            {
            header("Location:$url");
        }
    }

   public static function  say($a){
        echo    "hello ".$a;
    }

    //main router
    protected static  function mainRouter($url,$callback){
        self::$sayi++;
        $kontrol = gettype($callback);
        if ($kontrol == "object") {
            call_user_func($callback);
        } else {
            $controlname = explode("@", $callback)[0];
            $methodname = explode("@", $callback)[1];
            if(class_exists($controlname)){
                return call_user_func_array(array(new $controlname(),$methodname),explode("/",self::$url));
            }
        }
    }
    //main router


    //main router
    protected static  function valueMainRouter($url,$callback){

        self::$sayi++;
        $kontrol = gettype($callback);
        if ($kontrol == "object") {
            call_user_func($callback);
        } else {
            self::$explode = explode("/", $url);
            self::$joker = end(self::$explode);

            $controlname = explode("@", $callback)[0];
            $methodname = explode("@", $callback)[1];
            if(class_exists($controlname)){
               // $c=new $controlname();
                //$c->$methodname(self::$joker);

                // var_export(call_user_func_array(array(new $controlname(),$methodname),explode("/",self::$joker)));

                return call_user_func_array(array(new $controlname(),$methodname),explode("/",self::$joker));
            }
        }
    }
    //main router

//specific route

public static function specificroute($url){
    //route calıstırılan
    $url=trim($url,'/');
    //benım urle yazdıgım
    self::$url=trim(self::$url,'/');

    //değişken dinamik url varmı bakılıyor
    if (strpos($url, '*') !== false){
        $routings=explode("/",$url);
        $myurl=explode("/",self::$url);
        if (count($routings)===count($myurl)){
            $countUrl=count($routings)-1;
            for ($i=0;$i<$countUrl;$i++){
                if ($routings[$i]===$myurl[$i]){
                    self::$urlstatus=1;
                }else{
                    self::$urlstatus=0;
                }
            }
        }
    }
}
//specific route

    //get start
    public static function get($url,$callback){
        if ($_SERVER["REQUEST_METHOD"]==="GET"){

            Router::specificroute($url);
              if(self::$urlstatus===1){
                  self::$dynUrl = explode("/", self::$url);
                  Router::valueMainRouter(self::$url, $callback);
              }else{
                  if(self::$url==$url){
                      if(array_filter(explode("/",self::$url)) == array_filter(explode("/",$url))){
                          self::$dynUrl=explode("/",self::$url);

                          Router::mainRouter($url, $callback);
                      }
                      else {
                          self::$explode = explode("/", $url);
                          self::$joker = end(self::$explode);
                          if (self::$joker == "*" && explode("/", $url)[0] == explode("/", self::$url)[0]) {
                              self::$dynUrl = explode("/", self::$url);
                              Router::mainRouter($url, $callback);
                          }
                      }
                  }
              }


        }
    }
//get end


//post start
    public static function post($url,$callback){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //$url=ltrim($url,"/");

            Router::specificroute($url);

            if(self::$urlstatus===1){
                self::$dynUrl = explode("/", self::$url);
                Router::valueMainRouter(self::$url, $callback);
            }else{

            if (array_filter(explode("/", self::$url)) == array_filter(explode("/", $url))) {

                self::$dynUrl = explode("/", self::$url);
                Router::mainRouter($url, $callback);
            } else {
                self::$explode = explode("/", $url);
                self::$joker = end(self::$explode);
                if (self::$joker == "*" && explode("/", $url)[0] == explode("/", self::$url)[0]) {
                    self::$dynUrl = explode("/", self::$url);
                    Router::mainRouter($url, $callback);
                }
            }


        }
        }
    }
//post end
//put start
    public static function put($url,$callback){
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            //$url=ltrim($url,"/");

            Router::specificroute($url);
            if(self::$urlstatus===1){
                self::$dynUrl = explode("/", self::$url);
                Router::valueMainRouter(self::$url, $callback);
            }else{
            if (array_filter(explode("/", self::$url)) == array_filter(explode("/", $url))) {
                self::$dynUrl = explode("/", self::$url);
                Router::mainRouter($url, $callback);
            } else {
                self::$explode = explode("/", $url);
                self::$joker = end(self::$explode);
                if (self::$joker == "*" && explode("/", $url)[0] == explode("/", self::$url)[0]) {
                    self::$dynUrl = explode("/", self::$url);
                    Router::mainRouter($url, $callback);
                }
            }
        }
        }
    }
//put end
//delete start
    public static function delete($url,$callback){
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
           // $url=ltrim($url,"/");

            Router::specificroute($url);
            if(self::$urlstatus===1){
                self::$dynUrl = explode("/", self::$url);
                Router::valueMainRouter(self::$url, $callback);
            }else {
                if (array_filter(explode("/", self::$url)) == array_filter(explode("/", $url))) {
                    self::$dynUrl = explode("/", self::$url);
                    Router::mainRouter($url, $callback);
                } else {
                    self::$explode = explode("/", $url);
                    self::$joker = end(self::$explode);
                    if (self::$joker == "*" && explode("/", $url)[0] == explode("/", self::$url)[0]) {
                        self::$dynUrl = explode("/", self::$url);
                        Router::mainRouter($url, $callback);
                    }
                }
            }
        }
    }
//delete end
//any start
    public static function any($url,$callback)
    {

        // $url=ltrim($url,"/");
        Router::specificroute($url);
        if(self::$urlstatus===1){
            self::$dynUrl = explode("/", self::$url);
            Router::valueMainRouter(self::$url, $callback);
        }else{
        if (array_filter(explode("/", self::$url)) == array_filter(explode("/", $url))) {
            self::$dynUrl = explode("/", self::$url);
            Router::mainRouter($url, $callback);
        } else {
            self::$explode = explode("/", $url);
            self::$joker = end(self::$explode);
            if (self::$joker == "*" && explode("/", $url)[0] == explode("/", self::$url)[0]) {
                self::$dynUrl = explode("/", self::$url);
                Router::mainRouter($url, $callback);
            }
        }
    }

    }
//any end

    // submit start
    public static function submit(){
        if(self::$sayi==0){
            global $page_404;
            Router::view($page_404);
        }
    }
    //submit end


    public static function __callStatic($method, $args)
    {
        if ($method == 'namespace') {
            self::namespacer($args[0]);
            return new self;
        }
    }

}