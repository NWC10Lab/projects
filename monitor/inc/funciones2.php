<?php


//FUNCIONES SQL BASIC//
function conexion() {
	include './inc/conect.php';
	$link = mysqli_connect($host, $user, $pass, $db_name);
	mysqli_set_charset($link, 'utf8');
	return $link;
}

function desconexion($link) {
	mysqli_close($link);
}
/* * ********************************************************
 * Funcion query: devuelve array con el estado de ejecucion de la query y el error en caso que haya
 * parametros: $sql-> la sentencia sql que se desea realizar (no una sentencia select)
 * return: array (boolean ,  string error )
 * ******************************************************** */
function query($sql) {
	$link = conexion();
	if (mysqli_query($link, $sql)) {
		$result = array(true, "");
	} else {
		$error = mysqli_error($link);
		$result = array(false, $error);
	}
	desconexion($link);
	return $result;
}
/* * ********************************************************
 * Funcion selectQuery: devuelve un array multidimensional segun la sql introducida como parámetro
 * parametros: $sql-> la sentencia select sql que se desea realizar
 * return: array ( )
 * ******************************************************** */
function selectQuery($sql) {
	$link = conexion();
	$result = mysqli_query($link, $sql) or die('Unable to execute query. ' . mysqli_error($link));
	desconexion($link);
	$num = mysqli_num_rows($result);
	$datos = array();
	for ($i = 0; $i < $num; $i++) {
		$datos[$i] = mysqli_fetch_assoc($result);
	}
	return $datos;
}


/*******************************************************************/
/*******************************************************************/

//FUNCIONES SQL//

/*CLIENTES*/
/* * ********************************************************
 * Funcion crearCliente: crea un nuevo cliente en la bbdd y 
 *                       crea relacion de las zonas especificadas
 * parametros: 	$username : string
 *				$password : md5 string
 *             	$zonas	  : array(CPs)
 * return: array( true / false , "" /  tipo de error)
 * ******************************************************** */
function crearCliente($username,$password,$zonas) {
	$error = false;
	$password = md5($password);
	$sql="INSERT into clientes (username, password) values('$username','$password')";
	$result=query($sql);
	if ($result[0]){
		$cliente_id = selectClienteUsername($username)['code'];
                echo $cliente_id;
		foreach ($zonas as $zona_id) {
			$sql="INSERT into clientes_zonas (cliente_id, zona_id) values ('$cliente_id', '$zona_id')";
                        echo $sql."<br>";
			$result = query($sql);
			$error |= $result[0];
			$error_msg = $error ? $result[1] : "";
		}
	}
	return $result;
}

/* * ********************************************************
 * Funcion desactivarCliente: pone el estado active = 0
 * parametros: $id_cliente : int    
 * return: array( true / false , "" /  tipo de error)
 * ******************************************************** */
function desactivarCliente($id) {
	$sql="UPDATE clientes set active = 0 where code = $id";
	$result=query($sql);
	return $result;
}

/* * ********************************************************
 * Funcion selectClientes: devuleve un array de clientes activos
 * parametros: $username: string     
 * return: array( array clientes activos)
 * ******************************************************** */
function selectClienteUsername($username) {
	$sql = "SELECT * FROM clientes where username = '$username'";
        echo $sql."<br>";
	$result = selectQuery($sql);
	return empty($result) ? [] : $result[0];
}

/* * ********************************************************
 * Funcion selectClientes: devuleve un array de clientes activos
 * parametros: $id cliente : int
 * return: array( array clientes activos)
 * ******************************************************** */
function selectClienteId($id) {
	$sql = "SELECT * FROM clientes where code =";
	$result = selectQuery($sql);
	return empty($result) ? [] : $result[0];
}

/*LEADS*/

/* * ********************************************************
 * Funcion selectLeads: devuleve un array del cliente
 *                         relacionados con el cliente.
 *                         si se da zona solo de esa zona.
 * parametros:  $id cliente ,$id_lead
 * return: array( array cliente activo/zona)->para utilizar la selectQuery
 * ******************************************************** */
function selectLead($id_cliente,$id_lead) {

}

/* * ********************************************************
 * Funcion selectLeads: devuleve un array de clientes 
 *                         relacionados con el cliente.
 *                         si se da zona solo de esa zona.
 * parametros:  $id cliente ,$zona (opcional)
 * return: array( array clientes activos/zona)
 * ******************************************************** */
function selectLeads($id_cliente,$zona=NULL) {

}

/* * ********************************************************
 * Funcion setLeadFavorito: crea relacion cliente-lead en favoritos
 * parametros: $id_cliente ,$id_lead      
 * return: array( true / false , "" /  tipo de error)
 * ******************************************************** */
function setLeadFavorito($id_cliente,$id_lead) {

}

/* * ********************************************************
 * Funcion selectLeads: devuleve un array de clientes favoritos
 *                         relacionados con el cliente.
 * parametros:  $id cliente
 * return: array( array clientes favoritos)
 * ******************************************************** */
function selectLeadsFavoritos($id_cliente) {

}

/* SESIONES
 * ********************************* */
/* * ********************************************************
 * Funcion activarUsuario: 
 * parametros: $zonas-> array (codigo postal
 * return: 
 * ******************************************************** */
function crearSesion($usuario,$zonas) {
	session_start();
	/*jm ver q mas necesitamos*/
	$sesion = array($usuario['id'], $usuario['nombre'],$zonas);
	$_SESSION['Monitor'] = $sesion;
}

/* * ********************************************************
 * Funcion activarUsuario: 
 * parametros: 
 * return: 
 * ******************************************************** */

function comprobarSesion() {
	session_start();
	if (isset($_SESSION['Monitor'])) {
		return true;
	} else {
		return false;
	}
}

/* * ********************************************************
 * Funcion activarUsuario: 
 * parametros: 
 * return: 
 * ******************************************************** */

function salir() {
	return session_destroy();
}



/*******************************************************************************/

/*funciones q te pueden servir antiguas*/
/*******************************************************************************/
//function newLead($nombre,$apellidos,$email,$empresa,$dni,$idioma){
//    $link=conexion();
//    
//    $sql="INSERT into leads (nombre,apellidos,email,empresa,dni,idioma,activo) values('$nombre','$apellidos','$email','$empresa','$dni','$idioma','1')";
//    $result=mysqli_query($link, $sql);
//    mysql_close();
//    desconexion($link);
//    return $result;   
//}
//
//function newAnuncio($anuncio,$prop,$tel,$empresa,$dni,$idioma){
//    $link=conexion();
//    
//    $sql="INSERT INTO leads( 'anuncio', 'prop', 'tel', 'precio', 'metros', 'dorm', 'aseos', 'foto', 'enlace', 'id_directorio', 'fecha') VALUES ('$anuncio',[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])";
//    $result=mysqli_query($link, $sql);
//    mysql_close();
//    desconexion($link);
//    return $result;   
//}
//
//function selectEventosActivos($id){
//    $link=conexion();
//    $sql="select e.nombre , e.id from eventos as e inner join clientes_eventos ue on ue.id_evento=e.id inner join clientes u on u.id=ue.id_cliente where u.id=$id and e.fecha_baja is NULL";
//    $result=mysqli_query($link, $sql);
//    $numFilas= mysqli_num_rows($result);
//    $arrayDatos=array();
//    for($i=0;$i<$numFilas;$i++){
//        $arrayDatos[]=mysqli_fetch_assoc($result);
//    }
//    desconexion($link);
//    return $arrayDatos;
//}
//
//function selectEventosInactivos($id){
//    $link=conexion();
//    $sql="select e.nombre , e.id from eventos as e inner join clientes_eventos ue on ue.id_evento=e.id inner join clientes u on u.id=ue.id_cliente where u.id=$id and e.fecha_baja is not NULL";
//    $result=mysqli_query($link, $sql);
//    $numFilas= mysqli_num_rows($result);
//    $arrayDatos=array();
//    for($i=0;$i<$numFilas;$i++){
//        $arrayDatos[]=mysqli_fetch_assoc($result);
//    }
//    desconexion($link);
//    return $arrayDatos;
//}
//
//function selectLead($id){
//    $link=conexion();
//    $sql="select * from leads where id=$id ";
//    $result=mysqli_query($link, $sql);
//    
//    $arrayDatos=mysqli_fetch_assoc($result);
//    
//    desconexion($link);
//    return $arrayDatos;    
//}
//function selectLeadsd($id){
//    $link=conexion();
//    $sql="select * from leads as l inner join leads_eventos le on le.id_lead=l.id where le.id_evento=$id and le.fecha_baja is NULL order by le.fecha_alta desc";
//    $result=mysqli_query($link, $sql);
//    $numFilas= mysqli_num_rows($result);
//    $arrayDatos=array();
//    for($i=0;$i<$numFilas;$i++){
//        $arrayDatos[]=mysqli_fetch_assoc($result);
//    }
//    desconexion($link);
//    return $arrayDatos;
//}
//function selectAsistentes(){
//    $link=conexion();
//    $sql="select * from leads where activo=1 and asistencia=1";
//    $result=mysqli_query($link, $sql);
//    $numFilas= mysqli_num_rows($result);
//    $arrayDatos=array();
//    for($i=0;$i<$numFilas;$i++){
//        $arrayDatos[]=mysqli_fetch_assoc($result);
//    }
//    desconexion($link);
//    return $arrayDatos;
//    
//}
//function desactivarLead($id){
//    $link=conexion();
//    $sql="update leads set activo=0 where id=$id";
//    $result=mysqli_query($link, $sql);
//    desconexion($link);
//    return $result;
//}
//
//
//function hacerExcel() {
//    
//}
//
//function enviarEmail($email, $asunto, $mensaje,$autor,$correo, $nombre = NULL) {
//
//    $headers = "To: $nombre <$email>" . "\r\n";
//    $headers .= "From: $autor <$correo>" . "\r\n";
//    $headers .= 'MIME-Version: 1.0' . "\r\n";
//    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//    //nuevo lo de abajo
//    $headers .= 'Bcc: escorial.juanmiguel@gmail.com' . "\r\n";
//    
//    return mail($email, $asunto, $mensaje, $headers);
//}
//
//$_
?>