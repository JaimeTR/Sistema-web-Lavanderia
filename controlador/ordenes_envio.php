<?php

if(!empty($_SESSION['active'])){

    require_once("../../modelo/ordenes_envio.php");

    class modeloController{

        private $model;

        public function __construct(){

            $this->model = new Modelo();

        }

        //Mostrar

        static function index(){

            $envio = new Modelo();

            $dato = $envio->ordenes_envio('envio','1');

            require_once("../dashboard/vista/ordenes_envio.php");

        }

        //Formulario para editar orden de envío

        static function editar(){

            //Verificar si la solicitud no viene vacía

            $id_envio = $_REQUEST['id_envio'];

            if(empty($id_envio)){

                echo "<script>alert('Error: solicitud vacía');
                window.location.href='ordenes_envio.php';</script>";

            }

            //Llamando a la clase modelo

            $envio = new Modelo();

            //Invocando método

            $orden_envio = $envio->ordenes_envio('envio','id_envio='.$id_envio);

            require_once("../dashboard/vista/editar_orden_envio.php");

        }

        //Actualizar orden de envío

        static function actualizar(){

            $id_envio = $_POST['txtidenvio'];

            $estado_envio = $_POST['sltcestadoenvio'];

            if($estado_envio == 0){

                if(empty($id_envio) || !isset($estado_envio)){

                    echo "Nada";

                } else {

                    echo $id_envio, ' ',$estado_envio;

                }

            } elseif($estado_envio == 1){

                $hora_enviado = $_POST['txthoraenviado'];

                if(empty($id_envio) || empty($estado_envio) || $hora_enviado == ''){

                    echo '<script>alert("Error: campos vacíos");</script>';

                } else {

                    $envio = new Modelo();

                    //Query para actualizar orden de envío

                    $query_e = "hora_envio='".$hora_enviado."', estado_envio=".$estado_envio."";

                    $actualizar = $envio->actualizar('envio',$query_e,'id_envio='.$id_envio);

                    //Query para alterar estado de reserva

                    $codigo_reserva = $_POST['txtcodigoreserva'];

                    $query_r = "estado_reserva=3";

                    $actualizarReserva = $envio->alterar_reserva("reserva",$query_r,"codigo_reserva='".$codigo_reserva."'");

                    echo '<script>alert("Orden actualizada");
                    alert("Operación terminada");
                    window.location.href="ordenes_envio.php";</script>';

                }

            }            

        }

        static function detalle_envio(){

        //Verificar si la solicitud viene vacía

            if(empty($_REQUEST['codigo_reserva'])){

                echo "<script>alert('Solicitud vacía');
                window.location.href = './ordenes_envio.php';</script>";

            } else {

                $codigo_reserva = $_REQUEST['codigo_reserva'];

                require_once("../dashboard/vista/detalle_orden_envio.php");

            }

        }

    }
    
}