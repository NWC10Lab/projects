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
	$sql = "UPDATE clientes set active = 0 where code = '$id'";
	$result = query($sql);
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
	$sql = "SELECT * 
			FROM clientes 
			WHERE code ='$id'";
	$result = selectQuery($sql);
	return empty($result) ? [] : $result[0];
}

/*LEADS*/

/* * ********************************************************
 * Funcion selectLeads: devuleve un array del cliente
 *                         relacionados con el cliente.
 *                         si se da zona solo de esa zona.
 * parametros: $id_lead
 * return: array( array cliente activo/zona)->para utilizar la selectQuery
 * ******************************************************** */
function selectLead($id_lead) {
	$sql = "SELECT * 
			FROM leads 
			WHERE id = '$id_lead'";
	$result = selectQuery($sql);
	return empty($result) ? [] : $result[0];
}

/* * ********************************************************
 * Funcion selectLeads: devuleve un array de leads 
 *                         relacionados con el cliente.
 *                         si se da zona solo de esa zona.
 * parametros:  $id cliente ,$zona (opcional)
 * return: array( array clientes activos/zona)
 * ******************************************************** */
function selectLeads($id_cliente,$zona=NULL) {
	$sql = "SELECT * 
			FROM leads 
			INNER JOIN clientes_zonas 
			ON zona_id = zona 
			WHERE cliente_id = '$id_cliente'";
	$result = selectQuery($sql);
	return $result;
}

/* * ********************************************************
 * Funcion setLeadFavorito: crea relacion cliente-lead en favoritos
 * parametros: $id_cliente ,$id_lead      
 * return: array( true / false , "" /  tipo de error)
 * ******************************************************** */
function setLeadFavorito($id_cliente,$id_lead) {
	$sql = "SELECT * 
			FROM clientes_favoritos 
			INNER JOIN clientes 
			ON cliente_id = username 
			WHERE cliente_id = '$id_cliente'";
	$result = selectQuery($sql);
	return $result;
}

/* * ********************************************************
 * Funcion selectLeads: devuleve un array de clientes favoritos
 *                         relacionados con el cliente.
 * parametros:  $id cliente
 * return: array( array clientes favoritos)
 * ******************************************************** */
function selectLeadsFavoritos($id_cliente) {

}

/* * ********************************************************
 * Funcion getzonas: devuelve todas las zonas
 * return: array(zonas)
 * ******************************************************** */
function getZonas() {
	$sql = "SELECT * 
			FROM zonas";
	$result = selectQuery($sql);
	return $result;
}

/* * ********************************************************
 * Funcion selectZona: devuelve la zona definida por id_zona
 * parametros:  $id : int
 * return: array(zonas)
 * ******************************************************** */
function selectZona($id) {
	$sql = "SELECT * 
			FROM zonas
			WHERE id_zona = '$id'";
	$result = selectQuery($sql);
	return $result;
}

/* SESIONES
 * ********************************* */
/* * ********************************************************
 * Funcion login: 
 * parametros: 	$username : string
 * 				$password : string
 * return: boolean
 * ******************************************************** */
function login ($username, $password) {
	$password = md5($password);
	$sql = "SELECT username , password
			FROM clientes 
			WHERE username = '$username'";
	$result = selectQuery($sql);
	return empty($result) ? array(false, "") : array(true, $result[0]);
}


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
?>