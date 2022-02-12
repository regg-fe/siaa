<?php
	include_once 'includes/functions.php';
	session_start();
	if (isset($_SESSION['usuario'])) {
		header("Location:home.php");
		die();
	}
	
	if (isset($_POST['btn'])) {
		$conn = conexion();
		$user =  $conn->real_escape_string($_POST['user']);
		$pass =  $conn->real_escape_string($_POST['password']);
		
		if (!empty($user) && !empty($pass)) {
			$sql = "SELECT * FROM usuario WHERE USUARIO = '$user'";
			$res = $conn->query($sql);
			if ($res->num_rows > 0) {
				while ($row = $res->fetch_assoc()) {
					$pass2 = $row['CLAVE'];
					$user2 = $row['USUARIO'];
					if ($pass == $pass2) {
						session_start();
						$_SESSION['usuario'] = $user;
						$_SESSION['id'] = $row['ID'];
						$_SESSION['name'] = $row['NOMBRE'];
						$_SESSION['surname'] = $row['APELLIDO'];
						$_SESSION['admin'] = $row['ID_ADMIN'];
						header("location:home.php");
					} else {
						$message = "¡Contraseña incorrecta!";
					}
				}
			} else {
				$message = "¡Usuario no encontrado!";
			}
			if (!$res) {
				$message = "¡Error 404: Intente Nuevamente!";
			}
		} else {
			$message = "¡Campos Vacios!";
		}
		desconexion($conn);
	}
?>
<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets\plugins\Bootstrap-CSS\bootstrap.min.css">
		<!-- Bootstrap CSS -->
		<!-- CSS -->
    	<link rel="stylesheet" href="assets\css\login.css">
		<!-- CSS -->
		<title>SIAA: Login</title>
	</head>
	<body>
	<div class="login-box">
		<img class="avatar" src="img/undraw_profile_pic_ic5t.svg" alt="avatar-image">
		<h1>Iniciar sesión</h1>
		<?php if (isset($message)): ?> <div class="error"> <?php echo $message; ?> </div> <?php endif; ?>
		<form action="login.php" name="formulario" method="post">
			<!--Nombre de usuario-->
			<label for="username">Nombre de usuario</label>
			<input type="text" name="user" id="username" placeholder="Ingresar nombre de usuario">
			<!--Contraseña-->
			<label for="password">Contraseña</label>
			<input type="password" name="password" id="password" placeholder="Ingresar contraseña">
			<input type="submit" name = "btn" value="Iniciar sesión" id="submit">
			<a class="inicio" href="index.php">Volver</a>
		</form>
	</div>
	<!-- JS -->
	<script src="assets\js\login.js"></script>
	<!-- JS -->
	</body>
</html>