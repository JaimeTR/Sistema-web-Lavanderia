<?php

if(!empty($_SESSION['active'])){

    require_once("../../modelo/descuentos.php");

    class modeloController{

        private $model;

        public function __construct(){

            $this->model = new Modelo();

        }

        //Mostrar

        static function index(){

            $descuento = new Modelo();

            $dato = $descuento->mostrar_descuentos("descuento","1");

            require_once("../dashboard/vista/descuentos.php");

        }

        //Nuevo

        static function nuevo(){

            require_once("../dashboard/vista/nuevo_descuento.php");

        }

        //Insertar

        static function insertar(){

            $codigo_descuento = $_REQUEST['txtcodigodescuento'];

            $porcentaje_descuento = $_REQUEST['porcentajedescuento'];

            if(empty($codigo_descuento) || empty($porcentaje_descuento)){

                echo "<script>alert('Solicitud vacía');
                window.location.href = './descuentos.php';</script>";

            } else {

                $data = "(id_descuento, codigo_descuento, porcentaje_descuento) values (null, ".$codigo_descuento.", ".$porcentaje_descuento.");";

                $descuento = new Modelo();

                $dato = $descuento->nuevo_descuento("descuento",$data);

                header("location:./descuentos.php");

            }

        }

        //Editar

        static function editar(){

            $id_descuento = $_REQUEST['id_descuento'];

            if(empty($id_descuento)){

                echo "<script>alert('Solicitud vacía');
                window.location.href = './descuentos.php';</script>";

            } else {

            $descuento = new Modelo();

            $dato = $descuento->mostrar_descuentos("descuento","id_descuento=".$id_descuento);

            require_once("../dashboard/vista/editar_descuento.php");

            }

        }

        //Actualizar

        static function actualizar(){

            $id_descuento = $_POST['txtiddescuento'];

            //Validar si vienen datos vacíos

            if(isset($_POST['sltcestadodescuento'])){

                $codigo_descuento = $_POST['txtcodigodescuento'];
            
                $porcentaje_descuento = $_POST['txtporcentajedescuento'];

                $estado_descuento = $_POST['sltcestadodescuento'];

                if(empty($id_descuento) || empty($codigo_descuento) || empty($porcentaje_descuento) || !isset($estado_descuento)){

                    echo "<script>alert('Campos vacíos');
                    window.location.href = './descuentos.php';</script>";

                } else {
                
                    $data = "codigo_descuento='".$codigo_descuento."', porcentaje_descuento=".$porcentaje_descuento.", estado_descuento=".$estado_descuento;
                    
                    $descuento = new Modelo();
                    
                    $dato = $descuento->actualizar_descuento("descuento",$data,"id_descuento=".$id_descuento);
                    
                    echo "<script>alert('Datos actualizados');
                    window.location.href = './descuentos.php';</script>";

                }

            } else {

                $codigo_descuento = $_POST['txtcodigodescuento'];
            
                $porcentaje_descuento = $_POST['txtporcentajedescuento'];

                if(empty($id_descuento) || empty($codigo_descuento) || empty($porcentaje_descuento)){

                    echo "<script>alert('Solicitud vacía');
                    window.location.href = './descuentos.php';</script>";

                } else {
                
                    $data = "codigo_descuento='".$codigo_descuento."', porcentaje_descuento=".$porcentaje_descuento;
                    
                    $descuento = new Modelo();
                    
                    $dato = $descuento->actualizar_descuento("descuento",$data,"id_descuento=".$id_descuento);
                    
                    echo "<script>alert('Datos actualizados');
                    window.location.href = './descuentos.php';</script>";

                }

            }

        }

        //Deshabilitar

        static function deshabilitar(){

            $id_descuento = $_REQUEST['id_descuento'];

            //Validar si los datos vienen vacíos

            if(empty($id_descuento)){

                echo "<script>alert('Solicitud vacía');
                window.location.href = './descuentos.php';</script>";

            } else {

                $data = "estado_descuento=0";

                $descuento = new Modelo();

                $dato = $descuento->deshabilitar_descuento("descuento",$data,"id_descuento=".$id_descuento);

                header("location:./descuentos.php");

            }

        }

    }

}