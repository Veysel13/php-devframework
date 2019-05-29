<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

use \BusinessLayer\Manager\DenemeManager;
class AdminHome extends AdminMainControllers
{
    /**
     * @var DenemeManager
     */
    private $dbDeneme;

    function __construct() {
        $this->dbDeneme=new DenemeManager();
    }
    public function Index()
    {
        $deger=$this->dbDeneme->ListQuery()["data"];

        $this->View("Index","Home",compact("deger"));
    }

    public function Add()
    {
        $this->View("Add","Home");
    }

    public function Post_Add()
    {
        $result= $this->dbDeneme->DenemeAdd($_POST);
        if ($result["success"]==1){
            $this->RedirectToAction("/admin/home");
        }else{
            $eror_message=$result["message"];
            $this->View("Add","Home",compact("eror_message"));
        }
    }

    public function Delete($id)
    {
        $this->dbDeneme->UserDelete($id);
        $this->RedirectToAction("/admin/home");
    }
}
