<?php 

	session_start();

	if(empty($_SESSION['cliente_activo'])){

		header('Location: ../');

	} elseif($_SESSION['tipo_cliente'] == 1 || $_SESSION['tipo_cliente'] == 2){

		header('Location: reservas.php');

	}

 ?>