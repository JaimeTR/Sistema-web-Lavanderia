<?php

if(!empty($_SESSION['active'])){

    require_once("../../modelo/reservas.php");

    class modeloController{

        private $model;

        public function __construct(){

            $this->model = new Modelo();

        }

        //Mostrar reservas

        static function index(){

            $reserva = new Modelo();

            $dato = $reserva->mostrar_reservas("reserva","1");

            require_once("../dashboard/vista/reservas.php");

        }

        //Editar reserva

        static function editar(){

            $id_reserva = $_REQUEST['id_reserva'];

            if(empty($id_reserva)){

                echo "<script>alert('Solicitud vacía');
                window.location.href = './reservas.php';</script>";

            } else {

                //Llamada a la clase modelo

                $reserva = new Modelo();

                //Invocamos a los métodos

                $reservas = $reserva->mostrar_reservas("reserva","id_reserva=".$id_reserva);

                $recepcionistas = $reserva->mostrar_recepcionistas("usuario");

                require_once("../dashboard/vista/editar_reserva.php");

            }

        }

        //Actualizar reserva

        static function actualizar(){

            $id_reserva = $_REQUEST['txtidreserva'];

            $codigo_reserva = $_REQUEST['txtcodigoreserva'];

            $estado_delivery = $_REQUEST['slctestadodelivery'];

            $fecha_recojo = $_REQUEST['txtfecharecojo'];

            $fecha_envio = $_REQUEST['txtfechaenvio'];

            $estado_reserva = 2;

            if(isset($_REQUEST['slctrecepcionista'])){

                $id_recepcionista = $_REQUEST['slctrecepcionista'];

                if(empty($id_reserva) || empty($id_recepcionista) || !isset($estado_delivery) || empty($codigo_reserva) || !isset($fecha_recojo) || !isset($fecha_envio)){

                    echo "<script>alert('Error: datos incompletos');
                    window.location.href = './reservas.php';</script>";

                } else {

                    $query = "(id_delivery, id_reserva, id_recepcionista, estado_delivery, fecha_recojo, fecha_envio) 
                    select null, ".$id_reserva.", ".$id_recepcionista.", ".$estado_delivery.", '".$fecha_recojo."','".$fecha_envio."' from reserva";

                    $query_2 = "estado_reserva=".$estado_reserva;

                    $delivery = new Modelo();

                    $generarDelivery = $delivery->nuevo_delivery("delivery",$query,"id_reserva=".$id_reserva);

                    $alterarReserva = $delivery->alterar_reserva("reserva",$query_2,"codigo_reserva='".$codigo_reserva."'");
                        
                    header("location:./ordenes_delivery.php");          

                }

            } elseif(isset($_SESSION['id_usuario'])){

                $id_recepcionista = $_SESSION['id_usuario'];

                if(empty($id_reserva) || empty($id_recepcionista) || !isset($estado_delivery) || empty($codigo_reserva) || !isset($fecha_recojo) || !isset($fecha_envio)){

                    echo "<script>alert('Error: datos incompletos');
                    window.location.href = './reservas.php';</script>";

                } else {

                    $query = "(id_delivery, id_reserva, id_recepcionista, estado_delivery, fecha_recojo, fecha_envio) 
                    select null, ".$id_reserva.", ".$id_recepcionista.", ".$estado_delivery.", '".$fecha_recojo."','".$fecha_envio."' from reserva";

                    $query_2 = "estado_reserva=".$estado_reserva;

                    $delivery = new Modelo();

                    $generarDelivery = $delivery->nuevo_delivery("delivery",$query,"id_reserva=".$id_reserva);

                    $alterarReserva = $delivery->alterar_reserva("reserva",$query_2,"codigo_reserva='".$codigo_reserva."'");
                        
                    header("location:./ordenes_delivery.php");

                }

            }

        }

    }
    
}