<?php 

	session_start();

	if(empty($_SESSION['active'])){

		header("location: ../index.php");

	} elseif($_SESSION['rol_usuario'] == 1) {

		header("Location: usuarios.php");

	} elseif($_SESSION['rol_usuario'] == 2) {

		header("Location: reservas.php");

	} elseif($_SESSION['rol_usuario'] == 3) {

		header("Location: ordenes_delivery.php");

	}

 ?>