<?php

include_once 'db.php';

//LOGIN
function comprobarUser($email,$password){
    $link=conexion();
    //habrá que encriptar la pass
    $sql="select * from usuarios where email='$email' and password='$password'";
    $result=mysqli_query($link, $sql);
    desconexion($link);
    $numFilas= mysqli_num_rows($result);
    if ($numFilas>0){
        $usuario = mysqli_fetch_assoc($result);
        return array(true,$usuario);
    }else{
        return array(false,"");   
    }  
}

//SESIONES-COOKIES


function crearSession($nombreUsuario,$idUsuario){
    session_start();
    $_SESSION['usuario'] = array($idUsuario,$nombreUsuario);
}
function comprobarSession(){
    session_start();
    if(isset($_SESSION['usuario'])){
        return true;
    }else{
        return false;
    }
}
function datosSession(){
    return $_SESSION['usuario'];
}
function cerrarSession(){
    session_start();
    session_destroy();
    header("location:index.php");
}

?>