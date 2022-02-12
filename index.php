<?php  
	session_start();
	include_once 'includes/functions.php';
	if (isset($_SESSION['usuario'])) {
		header("Location:home.php");
		die();
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SIAA: Pagina de Inicio</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets\css\style-index.css">
    <link rel="stylesheet" href="assets\css\login.css">
    <!-- CSS -->
  </head>
  <body>
    <div class="transparencia">
      <div class="contenedor">
        <section class="bienvenido">
          <h1> SIAA </h1>
           <h2> Sistema para la Administracion de Actividades </h2>
          <div class="boton">
            <a class="inicio" href="login.php">Iniciar sesión</a>
          </div>
        </section>
  </body>
</html>