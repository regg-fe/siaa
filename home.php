<?php  
	session_start();
	include_once 'includes/functions.php';
	$title = "Panel Principal";
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
		<h1 class="bienvenido">Bienvenido, <?php echo $_SESSION['name'] ?> <?php echo $_SESSION['surname'] ?></h1>
	</div>

	
	<div class="contenedor">
		<div class="btn-box"><button type="button" class="btn btn-success" id="add"><i class="fas fa-plus"></i> Agregar Actividad</button></div>
		<table id="list_product" class="table table-bordered  display nowrap" cellspacing="0" width="100%">
			
			<?php if ($_SESSION['admin'] == 1): ?>
				<thead>
					<tr>
						<td>ID</td>
						<td>Registro</td>
						<td>Actividad</td>
						<td>Descripcion</td>
						<td>Inicio</td>
						<td>Fin</td>
						<td>Estatus</td>
						<td>Diseñador</td>
						<td>Acciones</td>
					</tr>	
				</thead>
			<?php else: ?>
			<thead>
				<tr>
					<td>ID</td>
					<td>Registro</td>
					<td>Actividad</td>
					<td>Descripcion</td>
					<td>Inicio</td>
					<td>Fin</td>
					<td>Diseñador</td>
					<td>Acciones</td>
				</tr>	
			</thead>
			<?php endif ?>
			
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
	<script type="text/javascript" src="assets\js/home.js"></script>

	<?php include_once 'includes/modal.php'; ?>
	
</body>
</html>