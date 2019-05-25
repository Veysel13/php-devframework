<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

class AdminHome extends AdminMainControllers
{
    public function Index()
    {
        $this->View("Index","Home");
    }

    public function Ekle($id)
    {
        $this->RedirectToAction("home",compact("id"));
    }
}
