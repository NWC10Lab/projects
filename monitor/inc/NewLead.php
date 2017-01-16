<?php

//include_once 'db.php';
include_once 'db.php';
include_once 'eventos.php';


class NewLead{
    private $camposObligatorios,$camposDatos;
    private $id_evento;
    private $eventoActivo;
    
    function NewLead($id_evento){
        $datosEvento=selectEvento($id_evento);
        $this->id_evento=$datosEvento["id"];
        $this->eventoActivo=$datosEvento["fecha_baja"];
        $campos=$datosEvento["campos_suscriptores"];
        $this->camposObligatorios= explode("-",$campos);
    }
    //comprueba que haya un array con las claves asociadas y que no esten vacíos
    private function validarDatos($arrayPost){
        foreach($this->camposObligatorios as $campo){
            if(!isset($arrayPost["$campo"])&&empty($arrayPost["$campo"])){
                return false;
            }
        }
        $this->camposDatos=$arrayPost;
        return true;
    }
    //guarda el lead en la base de datos y lo relaciona con el evento en cuestion
    function guardarDatos($arrayPost){
        if($this->eventoActivo==NULL){
            if($this->validarDatos($arrayPost)){
                $stringCampos="";
                $stringValores="";
                foreach ($this->camposObligatorios as $campo) {
                    $stringCampos.=$campo.",";
                    $dato=$this->camposDatos["$campo"];
                    $stringValores.="'".$dato."',";
                }
                $stringCampos= trim($stringCampos, ',');
                $stringValores= trim($stringValores, ',');
                $link=conexion();
                $sql="insert into leads ($stringCampos)values($stringValores)";
                if(mysqli_query($link, $sql)){
                    $sql="SELECT id FROM leads WHERE ($stringCampos)=($stringValores)";
                    $id_lead=mysqli_query($link,$sql);
                    $id_lead= mysqli_fetch_assoc($id_lead);
                    if($id_lead!=NULL){
                        $id_lead=$id_lead['id'];
                        $sql="insert into leads_eventos (id_lead,id_evento) values ($id_lead,$this->id_evento)";
                        if(mysqli_query($link, $sql)){
                            $result= array(true,"bieen");
                        }else{
                            $result=array(false,mysqli_error());
                        }
                    }else{
                        $result=array(false,mysqli_error());
                    }
                }else{
                    $result=array (false,mysqli_error());
                }
                desconexion($link);
                return $result;  
            }else{
                return array(false,"Datos incompletos");
            }
        }else{
            return array(false,"Evento Inactivo");
        }
    }
}
        
?>