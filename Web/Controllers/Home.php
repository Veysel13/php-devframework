<?php

require_once(_root."/BusinessLayer/Manager/DenemeManager.php");

date_default_timezone_set('Europe/Istanbul');
class Home extends MainController
{

    /**
     * @var DenemeManager
     */
    private $dbDeneme;

   /*
    * MainController
    */
    //private $main;

    function __construct() {
        $this->dbDeneme=new DenemeManager();
        //$this->main = new MainController();
    }

    public function Index()
    {
        $deger=$this->dbDeneme->ListQuery();
        $this->View("Index","Home",compact("deger"));
    }

    public function Add()
    {
        $this->View("Add","Home");
    }

    public function Post_Add(){

        $this->dbDeneme->DenemeAdd($_POST);

        $this->RedirectToAction("/");
    }

    public function Deneme()
    {

        $this->View("deneme","Home");

    }

    public function Update($id)
    {


        $this->View("Index","Home",compact("id"));

    }

    public function Delete($id)
    {

        $this->dbDeneme->UserDelete($id);
        $this->RedirectToAction("/");

    }
}
