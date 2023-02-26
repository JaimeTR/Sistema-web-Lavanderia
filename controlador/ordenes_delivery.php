<?php

if(!empty($_SESSION['active'])){

    require_once("../../modelo/ordenes_delivery.php");

    class modeloController{

        private $model;

        public function __construct(){

            $this->model = new Modelo();

        }

        //Mostrar

        static function index(){

            $delivery = new Modelo();

            $ordenes_delivery = $delivery->ordenes_delivery("delivery","1");

            require_once("../dashboard/vista/ordenes_delivery.php");

        }

        //Editar

        static function editar(){
            
            $id_delivery = $_REQUEST['id_delivery'];

            if(empty($id_delivery)){

                echo "<script>alert('Solicitud vacía');
                window.location.href = './ordenes_delivery.php';</script>";

            } else {
                
                $delivery = new Modelo();
                
                $ordenes_delivery = $delivery->ordenes_delivery("delivery","id_delivery=".$id_delivery); 

                $datos_recepcionista = $delivery->mostrar_recepcionistas("usuario","rol_usuario=2");

                require_once("../dashboard/vista/editar_orden_delivery.php");

            }
            
        }

        //Actualizar

        static function actualizar(){

            //Validar si las solicitudes vienen vacía o no

            $id_delivery = $_REQUEST['id_delivery'];

            $estado_delivery = $_REQUEST['estado_delivery'];

            $hora_recojido = $_REQUEST['txthorarecojido'];

            $estado_envio = 0;

            if(empty($id_delivery) || !isset($estado_delivery) || !isset($hora_recojido)){

                echo "<script>alert('Error: datos incompletos');
                window.location.href = './ordenes_delivery.php';</script>";

            } else {

                $delivery = new Modelo();

                if($estado_delivery == 0){

                    header("Location: ./ordenes_delivery.php");

                } elseif($estado_delivery == 1 || $estado_delivery == 2) {

                    $data = "estado_delivery=".$estado_delivery.", hora_recojido='".$hora_recojido."'";

                    $actualizar_delivery = $delivery->actualizar_delivery("delivery",$data,"id_delivery=".$id_delivery);

                    header("Location: ./ordenes_delivery.php");

                } elseif($estado_delivery == 3){

                    $data = "estado_delivery=".$estado_delivery.", hora_recojido='".$hora_recojido."'";

                    $actualizar_delivery = $delivery->actualizar_delivery("delivery",$data,"id_delivery=".$id_delivery);

                    if($_SESSION['id_usuario'] != $_REQUEST['txtidrecepcionista']){

                        $id_recepcionista = $_REQUEST['slctrecepcionista']; 

                        $fecha_envio = $_REQUEST['txtfechaenvio'];           

                        $data_2 = "(id_envio, id_delivery, fecha_envio, id_recepcionista, estado_envio) values (null, ".$id_delivery.", '".$fecha_envio."',".$id_recepcionista.",".$estado_envio.")";       

                        //Generando orden de envío

                        $generar_orden_envio = $delivery->generar_envio("envio",$data_2);

                        header("Location: ./ordenes_envio.php");

                    } else {

                        $id_recepcionista = $_SESSION['id_usuario'];

                        $data_2 = "(id_envio, id_delivery, fecha_envio, id_recepcionista, estado_envio) values (null, ".$id_delivery.", '".$fecha_envio."',".$id_recepcionista.",".$estado_envio.")";

                        //Generando orden de envío  

                        $generar_orden_envio = $delivery->generar_envio("envio",$data_2);

                        header("Location: ./ordenes_envio.php");
                    }

                }

            }

        }

        //Detalle de orden de delivery

        static function detalle_orden_delivery(){

            //Verificar si la solicitud viene vacía

            if(empty($_REQUEST['codigo_reserva'])){

                echo "<script>alert('Solicitud vacía');
                window.location.href = './ordenes_delivery.php';</script>";

            } else {

                $codigo_reserva = $_REQUEST['codigo_reserva'];

                require_once("../dashboard/vista/detalle_orden_delivery.php");

            }

        }

    }

} else {

    header("Location: ../");

}