<?php


class Db_core {
    
    private $host, $user, $password, $database;
    private $link;
    
    function __construct($host, $user, $password, $database) {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->database = $database;
    }
    
    private function connect(){
        $this->link=mysqli_connect($this->host,$this->user,$this->password,$this->database);
        mysqli_query($this->link, "SET NAMES 'utf8'");
    }
    
    private function disconnect(){
        mysqli_close($this->link);
    }
    
    function executeQuery($sql){
        $this->connect();
        $result=mysqli_query($this->link, $sql);
        $this->disconnect();
        
        return $result;
    }
    function executeSelectQuery($sql){
        $this->connect();
        $result=mysqli_query($this->link, $sql);
        $nfilas=  mysqli_num_rows($result);
        
        $saco=array();
        for($i=0; $i<$nfilas ;$i++){
            $saco []= mysqli_fetch_assoc($result);
        }
        
        $this->disconnect();
        return $saco; //retorna un array de array/s
    }
    
    
}


