<?php

//include_once 'db.php';
include_once 'inc/db.php';

//no lo uso
function muestraLeads($id){
    $leads = selectLeads($id);
    $response= array(
        "status"=> 200,
        "leads"=> $leads,
    );
    echo json_encode($response,true);
}
//no lo uso
function selectLead($id){
    $link=conexion();
    $sql="select * from leads where id=$id ";
    $result=mysqli_query($link, $sql);
    $arrayDatos=mysqli_fetch_assoc($result);    
    desconexion($link);
    return $arrayDatos;    
}

function selectLeads($id_evento,$id_usuario){
 
    if(comprobarEventoUsuario($id_usuario, $id_evento)){
        $link=conexion();   
        //habria que pedir relacion entre eventos y campos para saber cuales quiere y concatenarlos  pedir= 
        $sql="select leads.nombre,leads.apellidos,leads.email.... from leads as l inner join leads_eventos le on le.id_lead=l.id where le.id_evento=$id_evento and le.fecha_baja is NULL order by le.fecha_alta desc";
        /////
        $sql="select * from leads as l inner join leads_eventos le on le.id_lead=l.id where le.id_evento=$id_evento and le.fecha_baja is NULL order by le.fecha_alta desc";
        $result=mysqli_query($link, $sql);
        $numFilas= mysqli_num_rows($result);
        $arrayDatos=array();
        for($i=0;$i<$numFilas;$i++){
            $arrayDatos[]=mysqli_fetch_assoc($result);
        }
    }else{
        $result=array();
    }    
    desconexion($link);
    return $arrayDatos;
}

function selectAsistentes(){
    $link=conexion();
    $sql="select * from leads where activo=1 and asistencia=1";
    $result=mysqli_query($link, $sql);
    $numFilas= mysqli_num_rows($result);
    $arrayDatos=array();
    for($i=0;$i<$numFilas;$i++){
        $arrayDatos[]=mysqli_fetch_assoc($result);
    }
    desconexion($link);
    return $arrayDatos;
    
}
function desactivarLead($id){
    $link=conexion();
    $sql="update leads set activo=0 where id=$id";
    $result=mysqli_query($link, $sql);
    desconexion($link);
    return $result;
}



//if(isset($_POST['id'])&&!empty($_POST['id'])){
//    muestraLeads($_POST['id']);
//}
?>