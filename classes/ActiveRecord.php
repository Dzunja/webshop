<?php
abstract class ActiveRecord
{
    public static function getAll($filter = "")
    {
        $db = Database::getInstance();
        $res = $db->query(" select * from " . static::$table . " " . $filter);
        $res->setFetchMode(PDO::FETCH_CLASS,get_called_class());
        $output =array();
        while($rw = $res->fetch(PDO::FETCH_OBJ)){
            $output[]=$rw;
        }
        return $output;
    }


    public static function get($id){
        $db = Database::getInstance();
        $res=$db->query("select * from ".static::$table . " where ". static::$key ." = " .$id);
        $res->setFetchMode(PDO::FETCH_CLASS,get_called_class());
        return $res->fetch(PDO::FETCH_OBJ);
    }

    public function update(){
        $q = "update " . static::$table . " set ";
        foreach($this as $k=>$v){
            if($k==static::$key) continue;//ignorisemo ga
            $q.=$k."='" .$v."',";
        }
        $q=rtrim($q,",");//brisanje desnog zareza
        $keyField=static::$key;
        $q.=" where " .static::$key." = " .$this->$keyField;
        $conn = Database::getInstance();
        $conn->exec($q);



    }

    public function save()
    {
        $fields = get_object_vars($this);//asocijativi niz sa kljucevima i vrednostima
        $keys = array_keys($fields);
        $values = array_values($fields);
        $q = "insert into " . static::$table . "(";

        $q .= implode(",", $keys);
        $q .= ") values ('";
        $q .= implode("','", $values);
        $q .= "')";
        $conn = Database::getInstance();
       $conn->exec($q);

        //$keyField = static::$key;
       // echo $this->$keyField = mysqli_insert_id($conn);*/
    }

    public static function delete($id){
       $q="delete from " . static::$table . " where " . static::$key . " = " . $id;
       $db = Database::getInstance();
       $db->exec($q);
    }
}












