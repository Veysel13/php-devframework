<?php



require_once(_root."/DataAccessLayer/General/Repository.php");
class Deneme extends craud {

    protected $table = "user";
    protected $fillable = ['Name','Description','CreatedDate'];

}


?>