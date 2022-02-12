<?php  
	session_start();
	include_once 'includes/functions.php';
	$title = "Usuarios";
	include_once'includes/navbar.php';
	if (!isset($_SESSION['usuario'])) {
		header("Location:index.php");
		die();
	}
?>
	<!--DataTables CSS-->
	<link rel="stylesheet" type="text/css" href="assets\plugins\DataTables\DataTables-1.11.3\css\dataTables.bootstrap5.min.css">
	<link rel="stylesheet" type="text/css" href="assets\plugins\DataTables\Responsive-2.2.9\css\responsive.dataTables.min.css">
	<!-- HOME CSS-->
	<link rel="stylesheet" type="text/css" href="assets\css\home.css">
	<link rel="stylesheet" type="text/css" href="assets\css\styleModals.css">

	<div class="contenedor">
		<h1 class="bienvenido">Gestor de Usuarios</h1>
	</div>

	
	<div class="contenedor">
		<div class="btn-box"><button type="button" class="btn btn-success" id="add"><i class="fas fa-plus"></i> Agregar Usuario</button></div>
		<table id="list_users" class="table table-bordered  display nowrap" cellspacing="0" width="100%">
				<thead>
					<tr>
						<td>ID</td>
						<td>Nombre</td>
						<td>Apellido</td>
						<td>Usuario</td>
						<td>Clave</td>
						<td>Tipo de Cuenta</td>
						<td>Acciones</td>
					</tr>	
				</thead>	
			<tbody>
			</tbody>
		</table>
	</div>

	<!-- DataTables JS -->
	<script type="text/javascript" src="assets\plugins\DataTables\datatables.min.js"></script>
	<script type="text/javascript" src="assets\plugins\DataTables\DataTables-1.11.3\js\dataTables.bootstrap5.min.js"></script>
	<script type="text/javascript" src="assets\plugins\DataTables\Responsive-2.2.9\js\dataTables.responsive.js">
	</script>
	<!-- HOME JS -->
	<script type="text/javascript" src="assets\js/user.js"></script>

	<?php include_once 'includes/modalUser.php'; ?>
	
</body>
</html>