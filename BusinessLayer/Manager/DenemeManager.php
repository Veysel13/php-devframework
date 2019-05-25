<?php

require_once(_root."/Entity/Deneme.php");


class DenemeManager extends Deneme
{

    public function ListQuery(){
        return $this->get();

    }

    public function GetById($id){


        return $this->find($id);

    }

    public function UserDelete($id)
    {

        return $this->where(["Id"=>$id])->delete();
    }

    public function DenemeAdd($model){


        return $this->add($model);

    }

}


?>