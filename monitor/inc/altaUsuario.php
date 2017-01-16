<?php

include_once 'db.php';

function selectSuscriopciones(){
    $link=conexion();
    $sql="select * from suscripciones";
    $result=mysqli_query($link, $sql);
    $numFilas= mysqli_num_rows($result);
    $arrayDatos=array();
    for($i=0;$i<$numFilas;$i++){
        $arrayDatos[]=mysqli_fetch_assoc($result);
    }
    desconexion($link);
    return $arrayDatos;
}
function newUsuario($nombre,$email,$password,$tipo_suscripcion){
    $link=conexion();
    $sql="INSERT INTO usuarios (nombre,email,password,tipo_suscripcion) values ('$nombre','$email','$password','$tipo_suscripcion')";
    $result=mysqli_query($link, $sql);
    desconexion($link);
    if($result){
        return array(true,"Usuario registrado con éxito");
    }else{
        $error= mysqli_error($link);
        return array(false,$error);
    }
}

//comprueba si un evento es de un usuario
function comprobarEventoUsuario($idUsuario, $idEvento){
    $link=conexion();
    $sql="select * from usuarios_eventos where id_usuario = $idUsuario and id_evento = $idEvento";
    $result=mysqli_query($link, $sql);
    $numFilas= mysqli_num_rows($result);
    desconexion($link);
    if ($numFilas>0){
    return true;
    }else{
     return false;   
    }
}


function selectEventosActivos($id){
    $link=conexion();
    $sql="select e.nombre , e.id from eventos as e inner join usuarios_eventos ue on ue.id_evento=e.id inner join usuarios u on u.id=ue.id_usuario where u.id=$id and e.fecha_baja is NULL";
    $result=mysqli_query($link, $sql);
    $numFilas= mysqli_num_rows($result);
    $arrayDatos=array();
    for($i=0;$i<$numFilas;$i++){
        $arrayDatos[]=mysqli_fetch_assoc($result);
    }
    desconexion($link);
    return $arrayDatos;
}

function selectEventosInactivos($id){
    $link=conexion();
    $sql="select e.nombre , e.id from eventos as e inner join usuarios_eventos ue on ue.id_evento=e.id inner join usuarios u on u.id=ue.id_usuario where u.id=$id and e.fecha_baja is not NULL";
    $result=mysqli_query($link, $sql);
    $numFilas= mysqli_num_rows($result);
    $arrayDatos=array();
    for($i=0;$i<$numFilas;$i++){
        $arrayDatos[]=mysqli_fetch_assoc($result);
    }
    desconexion($link);
    return $arrayDatos;
}
function selectEvento($id){
    $link=conexion();
    $sql="select * from eventos where id=$id";
    $result=mysqli_query($link, $sql);
    desconexion($link);
    return mysqli_fetch_assoc($result);
}

function nuevoEvento($idUsuario,$nombreEvento,$lugarEvento,$aforoEvento,$fechaEvento,$horaEvento){
    $link=conexion();
    $sql="INSERT INTO eventos (nombre,lugar,aforo,fecha,hora) values ('$nombreEvento','$lugarEvento','$aforoEvento','$fechaEvento','$horaEvento')";
    if(mysqli_query($link, $sql)){
        $sql="select id from eventos where nombre='$nombreEvento'  order by id DESC limit 1";
        $result=mysqli_query($link, $sql);
        $result=mysqli_fetch_assoc($result);
        if($result['id']!=NULL){
            $id_evento=$result['id'];
            $sql="INSERT INTO usuarios_eventos (id_usuario,id_evento) values ('$idUsuario','$id_evento')";
            if(mysqli_query($link, $sql)){
                return array( true,$id_evento);
            }else{
                return array( false,"Error 3");
            }
        }else{
            return array( false,"Error 2");
        }
    }else{
            return array( false,"Error 1");
        }
    
}
//function selectEventos($id){
//    $activos = selectEventosActivos($id);
//    $inactivos = selectEventosInactivos($id);
//    $response= array(
//        "status"=> 200,
//        "activos"=> $activos,
//        "inactivos"=>$inactivos
//    );
//    echo json_encode($response,true);
//}
//
//if(isset($_POST['id'])&&!empty($_POST['id'])){
//    selectEventos($_POST['id']);
//}
?>