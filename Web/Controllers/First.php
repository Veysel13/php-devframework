<?php
require_once(_root."/BusinessLayer/Manager/DenemeManager.php");
class First extends MainController
{

    public function Index()
    {
        $id=1;
        return RedirectToAction("Direct","AdminHome",$id);

    }

     public function Add()
    {
         $db=new DenemeManager();
         $value=$db->ListQuery();

        return View("Ekle","First",compact("value"));

    }


    public function Guncelle()
    {

        return View("Guncelle","First",compact("value"));

    }
}
