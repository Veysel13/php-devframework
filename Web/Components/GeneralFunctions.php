
<?php
if(!function_exists('Url'))
{
    function Url($url)
    {
        return _rooturl . '/' . trim($url,'/');
    }
}

if(!function_exists('my_errors'))
{
    function my_errors($error)
    {
        $html="";
        if (isset($error))
        {
            $errors=explode('/',$error);
            $html.="<ul>";
            foreach ($errors as $item)
            {
                $html.="<li>".$item."</li>";
            }
            $html.="</ul>";
        }
        return $html;
    }
}

