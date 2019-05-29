<?php

use BusinessLayer\Manager\DenemeManager;

class First extends MainController
{

    public function Index()
    {
        $id=1;
        $this->RedirectToAction("/");
    }

     public function Add()
    {
         $db=new DenemeManager();
         $value=$db->ListQuery();

        $this->View("Ekle","First",compact("value"));
    }

    public function Guncelle()
    {

        $this->View("Guncelle","First",compact("value"));

    }
}
