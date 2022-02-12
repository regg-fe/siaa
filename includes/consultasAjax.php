<?php  
	include_once 'functions.php';
	session_start();

	switch ($_REQUEST['op']) {
		case '0':
			// CONSULTA GENERAL PARA DATATABLES
			$data = listarActividades();
			$list = array();

			if ($data != NULL) {
				if ($_SESSION['admin'] == 1) {
					for ($i=0;$i<count($data);$i++) {
					$list[] = array(
						"0" =>$data[$i]['ID'],
						"1" =>$data[$i]['FECHA_CRE'],
						"2" =>$data[$i]['ACTIVIDAD'],
						"3" =>$data[$i]['DESCRIPCION'],
						"4" =>$data[$i]['FECHA_IN'],
						"5" =>$data[$i]['FECHA_FI'],
						"6" =>$data[$i]['TIPO'],
						"7" =>$data[$i]['USUARIO'],
						"8" =>'<center><button class="btn btn-sm btn-warning" onclick="ObtenerProductoPorId('.$data[$i]['ID'].')"><i class="fas fa-edit"></i></button> <button class="btn btn-sm btn-danger" onclick="ActualizarEstatusPorID('.$data[$i]['ID'].')"><i class="fas fa-trash-alt"></i></button> <button class="btn btn-sm btn-dark" onclick="EliminarPorID('.$data[$i]['ID'].')"><i class="fas fa-backspace"></i></button></center>'
						);
					}
				} else {
						for ($i=0;$i<count($data);$i++) { 
						if ($data[$i]['ID_ESTATUS'] == 2) {
							continue;
						}
						$list[] = array(
							"0" =>$data[$i]['ID'],
							"1" =>$data[$i]['FECHA_CRE'],
							"2" =>$data[$i]['ACTIVIDAD'],
							"3" =>$data[$i]['DESCRIPCION'],
							"4" =>$data[$i]['FECHA_IN'],
							"5" =>$data[$i]['FECHA_FI'],
							"6" =>$data[$i]['USUARIO'],
							"7" =>'<center><button class="btn btn-sm btn-warning" onclick="ObtenerProductoPorId('.$data[$i]['ID'].')"><i class="fas fa-edit"></i></button> <button class="btn btn-sm btn-danger" onclick="ActualizarEstatusPorID('.$data[$i]['ID'].')"><i class="fas fa-trash-alt"></i></button></center>'
						);
						}
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

			// AGREGAR ACTIVIDADES A LA BASE DE DATOS
			$conn = conexion();
			if (!empty($conn->real_escape_string($_POST['nombre'])) && !empty($conn->real_escape_string($_POST['descripcion'])) && !empty($conn->real_escape_string($_POST['inicio'])) && !empty($conn->real_escape_string($_POST['fin']))) {
			
				$creacion = date('y-m-d');
				$actividad = $conn->real_escape_string($_POST['nombre']);
				$descripcion = $conn->real_escape_string($_POST['descripcion']);
				$inicio = $conn->real_escape_string($_POST['inicio']);
				$fin = $conn->real_escape_string($_POST['fin']);
				$id_user = $conn->real_escape_string($_SESSION['id']);

				$sentencia = "INSERT INTO actividad (FECHA_CRE, ACTIVIDAD, DESCRIPCION, FECHA_IN, FECHA_FI, ID_ESTATUS, ID_USER) VALUES ('$creacion', '$actividad', '$descripcion', '$inicio', '$fin', '1', '$id_user')";
			
				$res = $conn->query($sentencia);
			
				if (!$res) {
					desconexion($conn);
					echo '0';
				} else {
					echo '1';
					desconexion($conn);
				}
			} else {
				echo '0';
				desconexion($conn);
			}
			
		break;

		case '2':
			// CONSULTAR ACTIVIDADS CON LA BASE DE DATOS POR IDENTIFICADOR
			if (isset($_POST['id_actividad'])) {
				$actividad = obtenerActivdadPorID($_POST['id_actividad']);

				$data[] = array(
					"ID_ACTIVIDAD" =>$actividad[0]['ID'],
					"CRE" =>$actividad[0]['FECHA_CRE'],
					"ACTIVIDAD" =>$actividad[0]['ACTIVIDAD'],
					"DESCRIPCION" =>$actividad[0]['DESCRIPCION'],
					"INI" =>$actividad[0]['FECHA_IN'],
					"FIN" =>$actividad[0]['FECHA_FI'],
					"ESTATUS" =>$actividad[0]['ID_ESTATUS'],
					"USUARIO" =>$actividad[0]['ID_USER'],
					"NEW_USUARIO" =>$_SESSION['id']
				);
				echo json_encode($data);
			}

		break;

		case '3':

		// EDITAR INFORMACION DE LAS ACTIVIDADES
			$conn = conexion();
			if (!empty($conn->real_escape_string($_POST['nombre'])) && !empty($conn->real_escape_string($_POST['descripcion'])) && !empty($conn->real_escape_string($_POST['inicio'])) && !empty($conn->real_escape_string($_POST['fin']))) {

				$creacion = date('y-m-d');
				$id = $conn->real_escape_string($_POST['id']);
				$actividad = $conn->real_escape_string($_POST['nombre']);
				$descripcion = $conn->real_escape_string($_POST['descripcion']);
				$inicio = $conn->real_escape_string($_POST['inicio']);
				$fin = $conn->real_escape_string($_POST['fin']);
				$id_user = $conn->real_escape_string($_SESSION['id']);

				$sentencia = "UPDATE actividad SET FECHA_CRE = '$creacion', ACTIVIDAD = '$actividad', DESCRIPCION = '$descripcion', FECHA_IN = '$inicio', FECHA_FI = '$fin', ID_ESTATUS = '1', ID_USER = '$id_user' WHERE ID = '$id'";
				
				$res = $conn->query($sentencia);

				
				if (!$res) {
					desconexion($conn);
					echo '0';
				} else {
					echo '1';
					desconexion($conn);
				}
			} else {
				echo '0';
				desconexion($conn);
			}
		break;

		case '4':
			// MODIFICAR ESTATUS
			$conn = conexion();
			$id = $conn->real_escape_string($_POST['id']);
			$estatus = $conn->real_escape_string($_POST['estatus']);
			$id_user = $conn->real_escape_string($_SESSION['id']);

			if ($_SESSION['admin'] == 1) {
				if ($estatus == 1) {
					$sentencia = "UPDATE actividad SET ID_ESTATUS = '2', ID_USER = '$id_user' WHERE ID = '$id'";
				} else {
					$sentencia = "UPDATE actividad SET ID_ESTATUS = '1', ID_USER = '$id_user' WHERE ID = '$id'";
				}
			} else {
				$sentencia = "UPDATE actividad SET ID_ESTATUS = '2', ID_USER = '$id_user' WHERE ID = '$id'";
			}				

			$res = $conn->query($sentencia);

			if (!$res) {
				desconexion($conn);
				echo '0';
			} else {
				echo '1';
				desconexion($conn);
			}
		break;

		case '5':
			// ELIMINAR POR COMPLETO DE LA BD
			$conn = conexion();
			$id = $conn->real_escape_string($_POST['id']);
			
			$sentencia = "DELETE FROM actividad WHERE ID = '$id'";
			
			$res = $conn->query($sentencia);

				if (!$res) {
					desconexion($conn);
					echo '0';
				} else {
					echo '1';
					desconexion($conn);
				}
		break;

		default:
			$resultados = NULL;
			echo json_encode($resultados);
		break;
	}
?>