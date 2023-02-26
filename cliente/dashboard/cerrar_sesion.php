<?php 

	session_start();

	if(!empty($_SESSION['cliente_activo'])){

		unset($_SESSION['cliente_activo']);

		unset($_SESSION['id_cliente']);

        unset($_SESSION['usuario_cliente']);

        unset($_SESSION['nombre_cliente']);

        unset($_SESSION['password_cliente']);

        unset($_SESSION['tipo_cliente']);

        unset($_SESSION['carrito']);

		header('Location: ../');

	} else {

		header('Location: ../');

	}

 ?>