

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bienvenido a tu panel</title>
</head>
<body>
	Generar web de: 
	<form action="" method="POST">
		<input type="text" name="nombre" required>
		<input type="submit" name="enviar" value="Crear web">
	</form>

</body>
</html>


<?php 
	session_start();

	if (!isset($_SESSION['idUsuario'])) {
		header("Location: login.php");
	}

	$idUsuario = $_SESSION['idUsuario'];

	$con = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2024", "webgenerator");

	$fecha = date("Y-m-d");

	if (isset($_POST['nombre'])) {
		$nombrePagina = $_POST['nombre'];
		$msg = $idUsuario.$nombrePagina;
		$ssql = "SELECT * FROM `webs` WHERE dominio = '$msg'";
		$ssql2 = "INSERT INTO `webs`(`idWeb`, `idUsuario`, `dominio`, `fechaCreacion`) VALUES (NULL,'$idUsuario','$msg','$fecha')";
		
		$res = mysqli_query($con,$ssql);

		if (mysqli_num_rows($res) == 0) {
			$res = mysqli_query($con,$ssql2);
	        echo "El dominio ha sido ingresado correctamente en la base de datos. <br>";
	        $retorno = shell_exec("./wix.sh {$msg}");
	        shell_exec("zip -r {$msg} {$msg}");

		}else{
			echo "El dominio ya ha sido encontrado en la base de datos.";
		}
	}

	if ($_SESSION['admin'] == TRUE) {
		if ($_SESSION['admin']) {
			$ssql3 = "SELECT * FROM `webs`";
			$resu = mysqli_query($con, $ssql3);
			if (mysqli_num_rows($resu) >= 1) {
	    		while ($fila = mysqli_fetch_assoc($resu)) {
        			$link = $fila['dominio'];
        			echo "<a href='$link'> $link </a>";
        			echo "<a href='$link.zip'> Descargar web </a>";
     				echo "<a href='panel.php?dominiu={$link}'> Eliminar web </a>";
        			echo "<br>";
   				}
			}
		}
	}elseif($_SESSION['admin'] == FALSE){
		$ssql3 = "SELECT * FROM `webs` WHERE idUsuario = '$idUsuario'";
		$resu = mysqli_query($con, $ssql3);
		if (mysqli_num_rows($resu) >= 1) {
	    	while ($fila = mysqli_fetch_assoc($resu)) {
        		$link = $fila['dominio'];
        		echo "<a href='$link'> $link </a>";
        		echo "<a href='$link.zip'> Descargar web </a>";
     			echo "<a href='panel.php?dominiu={$link}'> Eliminar web </a>";
        		echo "<br>";
   			}
		}
	}
		

	if (isset($_GET['dominiu'])) {
		$dimini = $_GET['dominiu'];
		$deletequery = "DELETE FROM `webs` WHERE dominio = '$dimini' ";
		$resdelete = mysqli_query($con, $deletequery);
		shell_exec("rm -r $dimini");
		shell_exec("rm -r $dimini.zip");
		header("Location: panel.php");
	}


	echo "<br>";
	echo "<a href='logout.php'>Cerrar sesion de {$_SESSION['idUsuario']}</a>";



	
 ?>