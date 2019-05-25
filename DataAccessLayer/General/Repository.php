<?php 

include "config.php";
class craud {

    //singletion için
   // private static $instance;
    private $result,$columnString,$valueString,$STH ;

    private $conf,$where,$join,$connect,$array,$col,$query,$b,$bwhere,$order,$asc,$limit;
    
    function __construct(){

        $this->conf=(new config())->settings();
        $this->connect=new \PDO("mysql:host=".$this->conf["host"].";dbname=".$this->conf["dbname"].";charset=utf8",$this->conf["user"],$this->conf["password"]);

    }


    /*static function singletion(){
        if (!self::$instance){
            self::$instance=new self();
        }
        return self::$instance;
    }*/


    function __set($name, $value)
    {
        $this->col[$name]=$value;

    }

    public function join(array $join){

        $this->join=implode(",",$join);

        return $this;

    }
    public function limit($start, $finish = false)
    {

        if (is_integer($finish)) {

            $this->limit = " limit  $start,$finish  ";
        } else {

            echo $start;
            echo $finish;
            $this->limit = " limit  $start ";
        }

        return $this;
    }
    public function order($strings)
    {
        $this->order = " order by " . $strings;
        return $this;
    }

    public function orderbydescanding($strings)
    {
        $this->order = " order by " . $strings. " desc";
        return $this;
    }
    public function where($where){

        foreach($where as $item=>$value){


            $this->bwhere.=$item."=".$value." and ";
        }

        $this->bwhere=substr($this->bwhere,0,-5);
        $this->where=" where $this->bwhere";

        return $this;
    }

    public function find($id){

        $this->result=$this->connect->prepare("select * from ".$this->table." where Id=:id ");
        $this->result->bindParam("id",$id);
        $this->result->execute();
        $this->result=$this->result->fetch(\PDO::FETCH_ASSOC);

        return $this->result;

    }

    public function get(){

        $this->result=$this->connect->query("select * from ".$this->table.$this->join.$this->where.$this->order.$this->limit);

        while($a=$this->result->fetch(PDO::FETCH_ASSOC)){


            $this->array[]=$a;
        }

        return $this->array;

    }



    public function delete(){

        return $this->connect->exec("delete  from ".$this->table.$this->where);

    }


    public function update(array $updt){

        foreach ($updt as $item => $value) {
            $this->b .= $item . "=" . "'" . $value . "'" . ",";
        }
        $this->b = substr($this->b, 0, -1);
        $this->STH = $this->connect->prepare("UPDATE " . "`" . $this->table . "`" . " SET " . $this->b . $this->where);
        return $this->STH->execute(array_values($updt));

    }

    public function add(array $insert){

        $this->columnString = implode(',', array_keys($insert));
        $this->valueString = implode(',', array_fill(0, count($insert), '?'));
        $this->STH = $this->connect->prepare("INSERT INTO ".$this->table." ($this->columnString) VALUES ($this->valueString)");
        return  $this->STH->execute(array_values($insert));

    }
}

//singletan kullanımı
/*$db=craud::singletion();
$db->get();*/


 ?>