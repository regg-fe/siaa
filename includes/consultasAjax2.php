<?php
	include_once 'functions.php';
	session_start();
	// USUARIOS

	switch ($_REQUEST['opi']) {
		case '0':
			// CONSULTA GENERAL PARA DATATABLES
			$data = consultaUsuarios();
			$list = array();

			if ($data != NULL) {
				for ($i=0;$i<count($data);$i++) {
					if ($data[$i]['ID_ADMIN'] == 1) {
						continue;
					}
					$list[] = array(
						"0" =>$data[$i]['ID'],
						"1" =>$data[$i]['NOMBRE'],
						"2" =>$data[$i]['APELLIDO'],
						"3" =>$data[$i]['USUARIO'],
						"4" =>$data[$i]['CLAVE'],
						"5" =>$data[$i]['TIPO'],
						"6" =>'<center><button class="btn btn-sm btn-warning" onclick="ObtenerUsuarioPorId('.$data[$i]['ID'].')"><i class="fas fa-edit"></i></button> <button class="btn btn-sm btn-danger" onclick="EliminarUsuarioPorID('.$data[$i]['ID'].')"><i class="fas fa-trash-alt"></i></button></center>'
					);
				}

			// EMPAQUETAMIENTO DE RESULTADOS
			$resultados = array(
				"sEcho" => 1,
				"iTotalRecords" => count($list),
				"iTotalDisplayRecords" =>($list),
				"aaData" => $list
			);

			echo json_encode($resultados);
		} else {
			$resultados = NULL;
			echo json_encode($resultados);
		}

		break;

		case '1':
			// AGREGAR USUARIOS
			$conn = conexion();
			if (!empty($_POST['usuario']) && !empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['contrasena']) && !empty($_POST['contrasena2'])) {
				$usuario = $conn->real_escape_string($_POST['usuario']);
				$nombre = $conn->real_escape_string($_POST['nombre']);
				$apellido = $conn->real_escape_string($_POST['apellido']);
				$contra = $conn->real_escape_string($_POST['contrasena']);
				$contravali = $conn->real_escape_string($_POST['contrasena2']);

				if ($contra == $contravali) {
					$resultado = $conn->query("SELECT * FROM usuario WHERE USUARIO = '$usuario'"); 
					$row_count = $resultado->num_rows;
					if ($row_count != 0) {
						echo '2';
					} else {
						$sql = "INSERT INTO usuario (NOMBRE, APELLIDO, USUARIO, CLAVE, ID_ADMIN) VALUES ('$nombre','$apellido','$usuario','$contra','2')";
						$res = $conn->query($sql);
						
						if (!$res) {
							echo '0';
						} else {
							echo '1';
						}
					}
				} else {
					echo '3';
				}
			} else {
				echo '4';
			}
			desconexion($conn);
		break;
		
		case '2':
			// CONSULTAR USUARIOS CON LA BASE DE DATOS POR IDENTIFICADOR
			if (isset($_POST['id_usuario'])) {
				$usuario = obtenerUsuarioPorID($_POST['id_usuario']);

				$data[] = array(
					"ID_USUARIO" =>$usuario[0]['ID'],
					"NOMBRE" =>$usuario[0]['NOMBRE'],
					"APELLIDO" =>$usuario[0]['APELLIDO'],
					"USUARIO" =>$usuario[0]['USUARIO'],
					"CLAVE" =>$usuario[0]['CLAVE']
				);
				echo json_encode($data);
			}

		break;

		case '3':
			// MODIFICADOR DE USUARIOS POR IDENTIFICADOR
			$conn = conexion();
			if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['contrasena']) && !empty($_POST['contrasena2'])) {
				$id = $conn->real_escape_string($_POST['id']);
				$nombre = $conn->real_escape_string($_POST['nombre']);
				$apellido = $conn->real_escape_string($_POST['apellido']);
				$contra = $conn->real_escape_string($_POST['contrasena']);
				$contravali = $conn->real_escape_string($_POST['contrasena2']);

				if ($contra == $contravali) {
					$sql = "UPDATE usuario SET NOMBRE = '$nombre', APELLIDO = '$apellido', CLAVE = '$contra' WHERE ID = '$id'";
					$res = $conn->query($sql);
					if (!$res) {
						echo '0';
					} else {
						echo '1';
					}
				} else {
					echo '2';
				}
			} else {
				echo '3';
			}
			desconexion($conn);
		break;

		case '4':
			$conn = conexion();
			$id = $conn->real_escape_string($_POST['id']);

			$sql = "DELETE FROM usuario WHERE ID = '$id'";
			$res = $conn->query($sql);

			if (!$res) {
				echo '0';
			} else {
				echo '1';
			}
			desconexion($conn);
		break;

		default:
			$resultados = NULL;
			echo json_encode($resultados);
		break;
	}

?>