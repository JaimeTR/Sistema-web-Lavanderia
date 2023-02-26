<?php 

	session_start();

	if(!empty($_SESSION['active'])){

		unset($_SESSION['active']);

		unset($_SESSION['id_usuario']);

	    unset($_SESSION['nick_usuario']);

	    unset($_SESSION['nombre_usuario']);

	    unset($_SESSION['password_usuario']);

	    unset($_SESSION['rol_usuario']);

		header('Location: ../');

	} else {

		header('Location: ../');

	}

 ?>