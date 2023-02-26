<?php 

if(!empty($_SESSION['cliente_activo'])){

    require_once('../modelo/reservas.php');

    class modeloController{

        private $model;

        public function __construct(){

            $this->model = new Modelo();

        }

        //Mostrar

        static function index(){

            $reservas = new Modelo();

            $id_cliente = $_SESSION['id_cliente'];

            $listaReservas = $reservas->mostrandoReservas('reserva','c.id_cliente='.$id_cliente);

            require_once("../dashboard/vista/reservas.php");

        }

    }

} else {

    header("Location: ../");

} ?>