<?php
/**
 * Created by PhpStorm.
 * User: burak
 * Date: 7.04.2019
 * Time: 21:27
 */
namespace System\Libraries\Language;

class Lang
{

    public static function get($key, $locale, $args = [])
    {

        return Translator::initialize()->trans($key, $locale, $args);
    }

}