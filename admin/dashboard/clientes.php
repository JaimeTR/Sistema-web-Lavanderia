<?php

session_start();

if(!empty($_SESSION['active'])){

    require_once("../../controlador/clientes.php");

    //Para generar registros mediante "GET"

    if(isset($_GET['g'])):

        if(method_exists("modeloController",$_GET['g'])):

            modeloController::{$_GET['g']}();

        endif;

    else:

        modeloController::index();

    endif;

    //Para guardar, insertar y actualizar registros mediante "POST"

    if(isset($_POST['p'])):

        if(method_exists("modeloController",$_POST['p'])):

            modeloController::{$_POST['p']}();

        endif;    

    endif;

} else {

    header('Location: ../');

}
