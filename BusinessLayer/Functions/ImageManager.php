<?php

class ImageManager
{

    /*function __construct(argument)
    {

    }*/


    function ImageAdd($image){

        $refimgyol="";
        if ($image["name"]!=null)
        {
            $uploads_dir='../../Media';

            @$tmp_name=$image["tmp_name"];
            @$name=$image["name"];

            $benzersizsayi1=rand(20000,32000);
            $benzersizsayi2=rand(20000,32000);
            $refimgyol=$benzersizsayi1.$benzersizsayi2.$name;

            @move_uploaded_file($tmp_name,"$uploads_dir/$benzersizsayi1$benzersizsayi2$name");
        }

        return $refimgyol;

    }


    function ThumpImageAdd($image){

        $refimgyol="";
        if ($image["name"]!=null)
        {
            $uploads_dir='../../Media';

            @$tmp_name=$image["tmp_name"];
            @$name=$image["name"];

            $benzersizsayi1=rand(20000,32000);
            $benzersizsayi2=rand(20000,32000);
            $refimgyol=$benzersizsayi1.$benzersizsayi2.$name;

            @move_uploaded_file($tmp_name,"$uploads_dir/$benzersizsayi1$benzersizsayi2$name");
        }

        return $refimgyol;

    }






}



?>