<?php
/**
 * Created by PhpStorm.
 * User: burak
 * Date: 7.04.2019
 * Time: 21:27
 */
namespace System\Libraries\Language;

class Option
{

    private $directory;

    public function setDirectory($directory)
    {
        $this->directory = $directory;
    }

    public function getDirectory()
    {
        return $this->directory;
    }

}