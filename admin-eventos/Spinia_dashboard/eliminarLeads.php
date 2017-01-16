<?php

if(isset($_POST['evento'])&&!empty($_POST['evento'])&&isset($_POST['check'])&&!empty($_POST['check'])){
    include './inc/seguridad.php';
    include './inc/eventos.php';
    include './inc/leads.php';
    if(!comprobarSession()){
        header("location:index.php");
        $datosUsuario=datosSession();
        echo $datosUsuario[0]." no hay usuario sesion";
        echo $datosUsuario[1];
    }
    $datosUsuario=datosSession();
    $id_usuario=$datosUsuario[0];
    $result=desactivarLeads($_POST['evento'],$id_usuario,$_POST['check']);
    if($result[0]){
        echo "1";
    }else{
        echo $result[1];
    }
}else{
    echo "datos incorrectos - ";
    var_dump($_POST);
}