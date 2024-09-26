<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>webgenerator BautistaSilva</title>
</head>
<body>
	<form action="" method="POST">
		<input type="email" name="mail" required>
		<input type="password" name="pass" required>
		<input type="submit" name="envio" value="Ingresar">
	</form>

	<a href="register.php">Registro</a>
</body>
</html>

<?php 
	session_start();
	if (isset($_SESSION['idUsuario'])) {
		header("Location: panel.php");
	}

	$con = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2024", "webgenerator");
	$aux = 0;
	if (isset($_POST['mail']) && isset($_POST['pass'])) {
		$email = $_POST['mail'];
		$password = $_POST['pass'];
		$ssql = "SELECT * FROM `usuarios` WHERE email = '$email' AND password = '$password'";
		$res = mysqli_query($con,$ssql);

		if ($email == 'admin@server.com' && $password = 'serveradmin') {
			$_SESSION['admin'] = TRUE;
		header("Location: panel.php");
		}else{
			$_SESSION['admin'] = FALSE;
 		}
	}



	
	if ($email="" && $password="") {
		echo "Ingrese los datos correspondientes de su usuario.";
	}

	
	if (isset($res)) {
       	while ($fila = mysqli_fetch_assoc($res)) {
        	$aux = 1;
        	$_SESSION['idUsuario'] = $fila['idUsuario'];	
        	break;
   		}

   		if ($aux == 1) {
			header("Location: panel.php");
			exit();
		}else{
			echo "<br> Los datos ingresados son incorrectos. Por favor intente nuevamente.";
		}
    }
?>