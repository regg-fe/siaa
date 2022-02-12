<?php

	##				##
	##	CONEXION	##
	##				##

	/*
	function conexion(){
		#Cambiar estos valores según haga falta
		$servername = "sql300.epizy.com";
		$username = "epiz_30784148";
		$password = "Z0OECiquicq9v9I";
		$dbname = "epiz_30784148_siaa";
		$conection = new mysqli($servername, $username, $password, $dbname);
		if ($conection->connect_error)	die("Connection failed: " . $conection->connect_error);
		$conection->set_charset("utf8");
		return $conection;
	}
	*/
	
	function conexion(){
		#Cambiar estos valores según haga falta
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "siaadb";
		$conection = new mysqli($servername, $username, $password, $dbname);
		if ($conection->connect_error)	die("Connection failed: " . $conection->connect_error);
		$conection->set_charset("utf8");
		return $conection;
	}
	

	function desconexion($conn) {
		mysqli_close($conn);
	}

	##				##
	##	CONSULTAS	##
	##				##

	function ejecutarConsulta($consulta) {
		$conn = conexion();
		$rpt = $conn->query($consulta);
			if ($rpt->num_rows > 0) {
				while ($row = $rpt->fetch_assoc()) {
					$datos[] = $row;
				}
			}
			$registros = isset($datos) ? $datos:NULL;
			if ($registros) {
				return $registros;
			}

		}

	## Tabla USUARIO ##

	function validarUsuario($user, $pass){
		$conn = conexion();
		$sql = "SELECT USUARIO, CLAVE FROM usuario WHERE USUARIO = '$user'";
		$result = $conn->query($sql);

		$aux;
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			if ($pass == $row['CLAVE'])	$aux = 2;
			else	$aux = 1;
		}
		else	$aux = 0;
		$conn->close();
		return $aux;
	}

	function consultaUsuarios() {
		$conn = conexion();
		$sentencia = "SELECT usuario.*, administracion.*, usuario.ID FROM usuario JOIN administracion ON (usuario.ID_ADMIN = administracion.ID)";
		$data = ejecutarConsulta($sentencia);

		if ($data) {
			return $data;
		} else {
			$data = NULL;
			return $data;
		}
	}

	function obtenerUsuarioPorID($id_usuario) {
		$conn = conexion();
		$sentencia = "SELECT * FROM usuario WHERE ID = '$id_usuario'";
		$data = ejecutarConsulta($sentencia);
		
		if ($data) {
			return $data;
		} else {
			$data = NULL;
			echo "0";
		}
		desconexion($conn);
	}


	## TABLA ACTIVIDADES ##

	function listarActividades() {
		$sentencia = "SELECT actividad.*, usuario.*, estatus.*, actividad.ID FROM actividad JOIN usuario ON (actividad.ID_USER = usuario.ID) JOIN estatus ON (actividad.ID_ESTATUS = estatus.ID)";
		$data = ejecutarConsulta($sentencia);
		
		if ($data) {
			return $data;
		} else {
			$data = NULL;
			return $data;
		}
	}

	function obtenerActivdadPorID($id_actividad) {
		$conn = conexion();
		$sentencia = "SELECT * FROM actividad WHERE ID = '$id_actividad'";
		$data = ejecutarConsulta($sentencia);
		
		if ($data) {
			return $data;
		} else {
			$data = NULL;
			echo "0";
		}
		desconexion($conn);
	}

?>