<?php

function DegreeComponent($degree)
{

    $html=" ";
    $k = $degree % 2;
    $c = 10 - $degree - 1;
    for ($i = 1; $i < $degree; $i += 2)
    {
        $html.='<i class="fa fa-star"></i>';
    }
    if ($k == 1)
    {
        $html.='<i class="fa fa-star-half-empty"></i>';
    }
    for ($i = 0; $i < $c; $i += 2)
    {
        $html.='<i class="fa fa-star-half-empty" style="opacity: 0;"></i>';
    }

    return $html;
}


function TextInputComponent($name, $label, $value = "", $placeHolder = "")
{
    $html='<div class="form-group">
        <label for="'.$name.'">'.$label.'</label>
        <input type="text" class="form-control" id="'.$name.'" name="'.$name.'" placeholder="'.$placeHolder.'" value="'.$value.'">
    </div>';

    return $html;
}

function HiddenInputComponent($name, $value)
{
    $html='<input type="hidden" class="form-control" id="'.$name.'" name="'.$name.'"  value="'.$value.'">
    ';

    return $html;
}
function NumberInputComponent($name, $label, $value = "", $placeHolder = "")
{
    $html='<div class="form-group">
        <label for="'.$name.'">'.$label.'</label>
        <input type="number" class="form-control" id="'.$name.'" name="'.$name.'" placeholder="'.$placeHolder.'" value="'.$value.'">
    </div>';

    return $html;
}

function FileInputComponent($name, $label, $value = "", $placeHolder = "")
{
    $html='<div class="form-group">
        <label for="'.$name.'">'.$label.'</label>
        <input type="file" class="file" id="file-0" name="'.$name.'" >
    </div>';

    return $html;
}

function TextAreaInputComponent($name, $label, $value = "", $placeHolder = "")
{
    $html='<div class="form-group">
        <label for="'.$name.'">'.$label.'</label>
        <textarea  class="form-control" rows="10" cols="40" id="'.$name.'"  name="'.$name.'" >'.$value.'</textarea>
    </div>';

    return $html;
}


function SubmitComponent($text,$name)
{
    return '<button type="submit" class="btn btn-info" name="'.$name.'">'.$text.'</button>';
}

function BackButtonComponent($url)
{
    return '<a href="'.$url.'" class="btn btn-default"><i class="fa fa-arrow-left"></i> Geri Dön</a>';
}
function EditButtonComponent($url)
{
    return '<a href="'.$url.'" class="btn btn-warning"><i class="fa fa-edit"></i></a>';
}

function DetailButtonComponent($url)
{
    return '<a href="'.$url.'" class="btn btn-primary"><i class="fa fa-search"></i></a>';
}
function DeleteButtonComponent($url,$id,$getdegeri="")
{
    return '<a href="'.$url."?dataId=".$id.'&'.$getdegeri.'" class="btn btn-danger"><i class="fa fa-remove"></i></a>';
}
function NewAddButtonComponent($url)
{
    return '<a href="'.$url.'" class="btn btn-success btn-lg btn-block">Yeni Ekle</a>';
}
?>