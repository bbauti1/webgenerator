<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registrarse es simple.</title>
</head>
<body>

	<form action="" method="POST">
		<input type="email" name="mail" required>
		<input type="password" name="pass1" required>
		<input type="password" name="pass2" required>
		<input type="submit" name="envio" value="Registrarse">
	</form>

</body>
</html>

<?php 
	session_start();

	if (isset($_SESSION['idUsuario'])) {
		header("Location: panel.php");
	}

	$fecha = date("Y-m-d");
	$cont = 0;

	$con = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2024", "webgenerator");

	if (isset($_POST['mail']) && isset($_POST['pass1']) && isset($_POST['pass2']) ) {
		$email = $_POST['mail'];
		$pass1 = $_POST['pass1']; 
		$pass2 = $_POST['pass1']; 
		$ssql = "SELECT * FROM `usuarios` WHERE email = '$email'";
		$ssql2 = "INSERT INTO `usuarios`(`idUsuario`, `email`, `password`, `fechaRegistro`) VALUES (NULL,'$email','$pass1','$fecha')";
		$res = mysqli_query($con,$ssql);
	}	
	
	if (isset($res)) {
		while ($fila = mysqli_fetch_assoc($res)) {
        	$cont = 1;
        	$res = mysqli_query($con,$ssql2);
        	break;
   		}

   		if ($pass1 != $pass2) {
		echo "Las contraseñas no coinciden.";
		}else{
			if ($cont == 1) {
				echo "El email fue encontrado en la tabla usuarios.";
			}else{
				echo "Registro exitoso.";
				$res = mysqli_query($con, $ssql2);
				header("Location: login.php");
			}
		}
	}
?>