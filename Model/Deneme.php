<?php

namespace Model;

use DataAccessLayer\General\Repository;
class Deneme extends Repository {

    protected $table = "user";
    protected $fillable = ['Name','Description','Email','Age','Token','CreatedDate'];

}

?>