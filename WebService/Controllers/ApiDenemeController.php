<?php
/**
 * Created by PhpStorm.
 * User: veysel
 * Date: 25.05.2019
 * Time: 16:34
 */



use BusinessLayer\Manager\DenemeManager;

class ApiDenemeController
{
    private $deneme_model;
    public function __construct()
    {
        $this->deneme_model=new DenemeManager();
    }

    public function list()
    {

        $result=$this->deneme_model->ListQuery();
        print_r(json_encode($result));
    }

}