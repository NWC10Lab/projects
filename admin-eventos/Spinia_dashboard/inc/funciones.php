<?php



function conexion() {
    include './inc/conect.php';
    $link = mysqli_connect($host, $user, $pass, $db_name);
    mysqli_set_charset($link, 'utf8');
    return $link;
}

function desconexion($link) {
    mysqli_close($link);
}


function newLead($nombre,$apellidos,$email,$empresa,$dni,$idioma){
    $link=conexion();
    
    $sql="INSERT into leads (nombre,apellidos,email,empresa,dni,idioma,activo) values('$nombre','$apellidos','$email','$empresa','$dni','$idioma','1')";
    $result=mysqli_query($link, $sql);
    mysql_close();
    desconexion($link);
    return $result;   
}


function selectLead($id){
    $link=conexion();
    $sql="select * from leads where id=$id ";
    $result=mysqli_query($link, $sql);
    
    $arrayDatos=mysqli_fetch_assoc($result);
    
    desconexion($link);
    return $arrayDatos;    
}
function selectLeads(){
    $link=conexion();
    $sql="select * from leads where activo=1";
    $result=mysqli_query($link, $sql);
    $numFilas= mysqli_num_rows($result);
    $arrayDatos=array();
    for($i=0;$i<$numFilas;$i++){
        $arrayDatos[]=mysqli_fetch_assoc($result);
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


function hacerExcel() {
    
}

function enviarEmail($email, $asunto, $mensaje,$autor,$correo, $nombre = NULL) {

    $headers = "To: $nombre <$email>" . "\r\n";
    $headers .= "From: $autor <$correo>" . "\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    //nuevo lo de abajo
    $headers .= 'Bcc: escorial.juanmiguel@gmail.com' . "\r\n";
    
    return mail($email, $asunto, $mensaje, $headers);
}

$_
?>