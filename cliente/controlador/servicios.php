<?php 

if(!empty($_SESSION['cliente_activo'])){

    require_once('../modelo/servicios.php');

    class modeloController{

        private $model;

        public function __construct(){

            $this->model = new Modelo();

        }

        //Mostrar servicios

        static function index(){

            $servicios = new Modelo();

            $listado_servicios = $servicios->mostrarServicios('servicio','1');

            require_once("../dashboard/vista/servicios.php");

        }

        //Detalle servicio

        static function ver_detalle(){

            $id_servicio = $_REQUEST['id_servicio'];

            if(empty($id_servicio)){

                echo "<script>alert('Error: Solicitud vacía');
                history.go(-1);</script>";

            } else {

                $servicios = new Modelo();

                $servicio = $servicios->mostrarServicios('servicio','id_servicio='.$id_servicio);

                require_once("../dashboard/vista/ver_servicio.php");
            
            }

        }

        //Métodos de carrito

        static function carrito(){

            if(empty($_SESSION['carrito'])){

                echo "<script>alert('Error: Tu carrito está vacío, añade un producto');
                window.location.href='./servicios.php';</script>";

            } else {                    

                require_once('../dashboard/vista/carrito.php');

            }

        }

        static function agregar(){ 

            $id_servicio = $_REQUEST['id_servicio'];

            $servicios = new Modelo();

            $obtener_servicio = $servicios->mostrarServicios('servicio','id_servicio='.$id_servicio);

            if(isset($_SESSION['carrito'])){

                $contador = 0;

                foreach($_SESSION['carrito'] as $indice => $elemento){

                    if($elemento['id_servicio'] == $id_servicio){

                        $_SESSION['carrito'][$indice]['cantidad']++;

                        $contador++;

                    }

                }

                header('Location: servicios.php?g=carrito');

            }

            if(!isset($contador) || $contador == 0){

                foreach($obtener_servicio as $key => $value_os){

                    foreach($value_os as $v_os){

                        if(is_object($servicios)){

                            $_SESSION['carrito'][] = array(

                                "id_servicio" => $id_servicio,
                                "descripcion_prenda" => $v_os['descripcion_prenda'],
                                "precio_uni_prenda" => $v_os['precio_uni_prenda'],
                                "cantidad" => 1

                            );

                        }

                    }         

                }

                header('Location: servicios.php?g=carrito');

            }

        }               

        static function up(){

            if(isset($_SESSION['carrito'])){

                $indice = $_GET['indice'];

                $_SESSION['carrito'][$indice]['cantidad']++;

            }

            header('Location: servicios.php?g=carrito');

        }

        static function down(){

            if(isset($_SESSION['carrito'])){

                $indice = $_GET['indice'];

                $_SESSION['carrito'][$indice]['cantidad']--;

                if($_SESSION['carrito'][$indice]['cantidad']==0){

                    unset($_SESSION['carrito'][$indice]);

                    header('Location: servicios.php');

                }

            }

            header('Location: servicios.php?g=carrito');

        }

        static function delete(){

            if(isset($_SESSION['carrito'])){

                $indice = $_GET['indice'];

                unset($_SESSION['carrito'][$indice]);

            }

            header('Location: servicios.php?g=carrito');
            
        }

        static function eliminar_carrito(){

            unset($_SESSION['carrito']);

            header('Location: servicios.php');

        }

        //Reporte de carrito

        static function reporteCarrito(){

            if(isset($_SESSION['carrito'])){

                $fecha_reserva = date('Y-m-d');

                $fecha_recojo = $_REQUEST['fecharecojo'];

                $fecha_envio = $_REQUEST['fechaenvio'];

                if(empty($_REQUEST['code']) || empty($_REQUEST['porrcode'])){

                    if(empty($fecha_recojo) || empty($fecha_envio)){

                    echo "<script>alert('Error: Fechas vacías');
                    window.location.href='./servicios.php?g=carrito';</script>";

                    } else {

                        require_once('../dashboard/vista/reporte_carrito.php');

                    }

                } else {

                    if(empty($fecha_recojo) || empty($fecha_envio)){

                        echo "<script>alert('Error: Fechas vacías');
                        window.location.href='./servicios.php?g=carrito';</script>";

                    } else {

                        require_once('../dashboard/vista/reporte_carrito.php');

                    }

                }                

            } else {

                echo "<script>alert('Error: Tu carrito está vacío, añade un producto');
                window.location.href='./servicios.php';</script>";

            }

        }

        //Formulario para confirmar carrito

        static function confirmar(){

            if(isset($_SESSION['carrito'])){

                //Confirmar si el código de descuento existe

                $code = $_GET['codigodescuento'];

                if(empty($code)){

                    require_once('../dashboard/vista/confirmar_carrito.php');
                    
                } elseif(is_numeric($code)) {

                    $modeloServicio = new Modelo();

                    $confirmarCode = $modeloServicio->confirmarCode('descuento','codigo_descuento='.$code);

                    if($confirmarCode == true){

                        $mostrarCode = $modeloServicio->mostrarCode('descuento d','codigo_descuento='.$code);

                        require_once('../dashboard/vista/confirmar_carrito.php');

                    } else {

                        echo "<script>alert('Error: El código de descuento no existe o está inactivo');
                        window.location.href='./servicios.php?g=carrito';</script>";

                    }

                } else {

                    echo "<script>alert('Error: El código de descuento no es numérico');
                    window.location.href='./servicios.php?g=carrito';</script>";

                }        

            } else {

                echo "<script>alert('Error: Tu carrito está vacío, añade un producto');
                window.location.href='./servicios.php';</script>";

            }

        }

        static function reservar(){

            //Validar si la sesión de carrito existe

            if(isset($_SESSION['carrito'])){

                //Invocando la clase modelo

                $modeloServicio = new Modelo();

                //Confirmar si código de descuento existe

                if(isset($_POST['txtcode'])){

                    $code = $_POST['txtcode'];

                    if(is_numeric($code)){                        

                        //Llamando métodos

                        $confirmarCode = $modeloServicio->confirmarCode('descuento','codigo_descuento='.$code);

                        $mostrarCode = $modeloServicio->mostrarCode('descuento d','codigo_descuento='.$code);

                        if($confirmarCode == true){

                            $id_cliente = $_SESSION['id_cliente'];

                            $fecha_reserva = date('Y-m-d');

                            $fecha_recojo = $_POST['txtfecharecojo'];

                            $fecha_envio = $_POST['txtfechaenvio'];

                            $estado_reserva = 1;

                            if(empty($fecha_recojo) || empty($fecha_envio)){

                                echo "<script>alert('Error: Campos incompletos');</script>";

                            } else {

                                //Generar código de reserva aleatorio

                                $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789!#$';

                                $codigo_reserva = "CR";

                                for($i=0;$i<8;$i++){

                                    $codigo_reserva .= substr($charset, rand(0, 64), 1);

                                }

                                //Generando la query

                                foreach($mostrarCode as $key => $value_mc){

                                    foreach($value_mc as $v_mc){

                                        foreach($_SESSION['carrito'] as $indice => $value_car){

                                            //Calculos

                                            $bruto = $value_car['cantidad'] * $value_car['precio_uni_prenda'];

                                            $descuento = $bruto * (($_POST['txtporccode'] / 100)); 

                                            $neto = $bruto - $descuento;                                        

                                            $query = "(id_reserva, codigo_reserva, fecha_reserva, fecha_recojo, fecha_envio, id_cliente, id_descuento, id_servicio, cantidad_prenda, total_carrito, estado_reserva) values (null, '".$codigo_reserva."', '".$fecha_reserva."','".$fecha_recojo."','".$fecha_envio."',".$id_cliente.",".$v_mc['id_descuento'].",".$value_car['id_servicio'].",".$value_car['cantidad'].",".$neto.",".$estado_reserva.");";    

                                            $generarReserva = $modeloServicio->reservar('reserva',$query);

                                        }

                                    }

                                }

                                if($generarReserva == true){

                                    echo "<script>alert('Aviso: Se registró su reserva');
                                    window.location.href='./reservas.php';</script>";

                                    unset($_SESSION['carrito']);

                                } else {

                                    echo "<script>alert('Error: fallo al grabar');</script>";

                                }                                                                        

                            }

                        } else {

                            echo "<script>alert('Error: El código de descuento está inactivo o no existe');</script>";

                        }

                    } else {

                        echo "<script>alert('Error: El código no es numérico');</script>";

                    }

                } else {

                    $id_cliente = $_SESSION['id_cliente'];

                    $fecha_reserva = date('Y-m-d');

                    $fecha_recojo = $_POST['txtfecharecojo'];

                    $fecha_envio = $_POST['txtfechaenvio'];

                    $estado_reserva = 1;

                    if(empty($fecha_recojo) || empty($fecha_envio)){

                         echo "<script>alert('Error: Campos incompletos');</script>";

                    } else {

                        //Generar código de reserva aleatorio

                        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789!#$';

                        $codigo_reserva = "CR";

                        for($i=0;$i<10;$i++){

                            $codigo_reserva .= substr($charset, rand(0, 64), 1);

                        }

                        //Generando la query

                        foreach($_SESSION['carrito'] as $indice => $value_car){

                            //Calculos

                            $bruto = $value_car['cantidad'] * $value_car['precio_uni_prenda'];

                            $neto = $bruto;                                       

                            $query = "(id_reserva, codigo_reserva, fecha_reserva, fecha_recojo, fecha_envio, id_cliente, id_descuento, id_servicio, cantidad_prenda, total_carrito, estado_reserva) values (null, '".$codigo_reserva."', '".$fecha_reserva."','".$fecha_recojo."','".$fecha_envio."',".$id_cliente.",0,".$value_car['id_servicio'].",".$value_car['cantidad'].",".$neto.",".$estado_reserva.");";    

                            $generarReserva = $modeloServicio->reservar('reserva',$query);

                        }

                        if($generarReserva == true){

                            echo "<script>alert('Aviso: Se registró su reserva');
                                    window.location.href='./reservas.php';</script>";

                            unset($_SESSION['carrito']);

                        } else {

                            echo "<script>alert('Error: fallo al grabar');</script>";

                        } 

                    }
                    
                }

            } else {

                echo "<script>alert('Error: Tu carrito está vacío, añade un producto');
                window.location.href='./servicios.php';</script>";

            }

        }

    }

} else {

    header("Location: ../");

} ?>