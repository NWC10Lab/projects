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
        $sql="select leads.nombre,leads.apellidos,leads.email.... from leads as l inner join leads_eventos le on le.id_lead=l.id where le.id_evento=$id_evento and le.fecha_baja is NULL order by le.fecha_alta asc";
        /////
        $sql="select * from leads as l inner join leads_eventos le on le.id_lead=l.id where le.id_evento=$id_evento and le.fecha_baja is NULL order by le.fecha_alta asc";
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

function selectLeadsAsistentes($id_evento,$id_usuario){
 
    if(comprobarEventoUsuario($id_usuario, $id_evento)){
        $link=conexion();   
        //habria que pedir relacion entre eventos y campos para saber cuales quiere y concatenarlos  pedir= 
        /////
        $sql="select * from leads as l inner join leads_eventos le on le.id_lead=l.id where le.fecha_asistencia is not NULL and le.id_evento=$id_evento and le.fecha_baja is NULL order by le.fecha_alta asc";
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
function desactivarLeads($id_evento,$id_usuario,$id_leads){
    if(comprobarEventoUsuario($id_usuario, $id_evento)){
        $link=conexion();   
        //crear string leads
        $result= array();
        $sql="update leads_eventos set fecha_baja=NOW() where id_evento=$id_evento and id_lead in ($id_leads)";
        if(mysqli_query($link, $sql)){
            $result= array(true,1);
        }else{
            $result=array(false,mysqli_error($link));
        }
        
    }else{
        $result=array(false,"El evento no corresponde con el usuario");
    }    
    desconexion($link);
    return $result;
}

function datosGraficaLeads($id_evento){
    $link=conexion();
    $sql="select UNIX_TIMESTAMP(fecha_alta) as fecha,count(fecha_alta) as cantidad from leads_eventos where id_evento=$id_evento group by date(fecha_alta)";
    $sql="select fecha_alta as fecha,count(fecha_alta) as cantidad from leads_eventos where id_evento=$id_evento and fecha_baja is NULL group by date(fecha_alta)";
    $result=mysqli_query($link, $sql);
    $numFilas= mysqli_num_rows($result);
    $arrayDatos=array();
    for($i=0;$i<$numFilas;$i++){
        $arrayDatos[]=mysqli_fetch_assoc($result);
    }
    desconexion($link);
    return $arrayDatos;
    
}
//if(isset($_POST['id'])&&!empty($_POST['id'])){
//    muestraLeads($_POST['id']);
//}
?>
