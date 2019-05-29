<?php
/**
 * Created by PhpStorm.
 * User: burak
 * Date: 7.04.2019
 * Time: 21:27
 */
namespace System\Libraries\Language;

class Config
{

    public static function options()
    {
        $option = new Option();
        $option->setDirectory(ROOT_DIR.'system/resources/lang/');

        return $option;
    }

}