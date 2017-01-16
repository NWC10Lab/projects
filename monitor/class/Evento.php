<?php
include_once 'class/connect.php';
include_once 'class/Db_core.php';

class Evento {
    
    private $id, $nombre, $fecha_alta, $fecha_baja,$fecha, $hora, $lugar,$aforo;
    private $leads=array();
    private $usuario=array();
    private $db;
    function __construct($idEvento,$usuario=NULL) {
        $this->db=new DB_core($host, $user, $password, $database);
        $sql="";
        $evento = $this->db->executeSelectQuery($sql);
        if($evento != NULL){
            $this->id = $evento[0]["id"];
            $this->nombre = $evento[0]["nombre"];
            $this->fecha_alta = $evento[0]["fecha_alta"];
            $this->fecha_baja = $evento[0]["fecha_baja"];
            $this->fecha = $evento[0]["fecha"];
            $this->hora = $evento[0]["hora"];
            $this->lugar = $evento[0]["lugar"];
            $this->aforo = $evento[0]["aforo"];
            
        }
    }
    
    
    
    private function connect(){
        $this->link=mysqli_connect($this->host,$this->user,$this->password,$this->database);
        mysqli_query($this->link, "SET NAMES 'utf8'");
    }
    
    private function disconnect(){
        mysqli_close($this->link);
    }
    
    function executeQuery($sql){
        $this->db->connect();
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


