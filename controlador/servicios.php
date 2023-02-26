<?php

if(!empty($_SESSION['active'])){

    require_once("../../modelo/servicios.php");

    class modeloController{

        private $model;

        public function __construct(){

            $this->model = new Modelo();

        }

        //Mostrar

        static function index(){

            $servicio = new Modelo();

            $dato = $servicio->mostrar_servicios("servicio","1");

            require_once("../dashboard/vista/servicios.php");

        }

        //Nuevo

        static function nuevo(){

            require_once("../dashboard/vista/nuevo_servicio.php");
                
        }

        //Insertar

        static function insertar(){

            $descripcion_prenda = $_REQUEST['txtdescripcionprenda'];

            $precio_uni_prenda = $_REQUEST['precioservicio'];

            $imagen_servicio = $_FILES['imgservicio'];

            //Atributos imagen

            $tipo_imagen = $imagen_servicio['type'];

            $nombre_imagen = $imagen_servicio['name'];

            if(!empty($descripcion_prenda) || !empty($precio_uni_prenda) || $tipo_imagen == 'image/jpg' || $tipo_imagen == 'image/jpeg' || $tipo_imagen == 'image/png' || $tipo_imagen == 'image/gif'){

                if(!is_dir('../dashboard/img/servicio/')){

                    mkdir('../dashboard/img/servicio', 0777, true);

                }

                $servicio = new Modelo();

                $data = "(id_servicio, descripcion_prenda, precio_uni_prenda, imagen_servicio, estado_servicio) values (null, '".$descripcion_prenda."', ".$precio_uni_prenda.", '".$nombre_imagen."', '1');";

                $dato = $servicio->nuevo_servicio("servicio",$data);

                move_uploaded_file($imagen_servicio['tmp_name'], '../dashboard/img/servicio/'.$nombre_imagen);

                echo "<script>alert('Servicio registrado');
                window.location.href = './servicios.php';</script>";

            } else {

                echo "<script>alert('Datos incompletos');
                history.go(-1);</script>";

            }

        }

        //Editar

        static function editar(){

            $id_servicio = $_REQUEST['id_servicio'];

            if(empty($id_servicio)){

                echo "<script>alert('Error: Solicitud vacía');
                window.location.href='servicios.php';</script>";

            } else {

                $servicio = new Modelo();

                $dato = $servicio->mostrar_servicios("servicio","id_servicio=".$id_servicio);

                require_once("../dashboard/vista/editar_servicio.php");

            }

        }

        //Actualizar

        static function actualizar(){

            $id_servicio = $_POST['txtidservicio'];
            
            $descripcion_prenda = $_POST['txtdescripcionprenda'];
            
            $precio_uni_prenda = $_POST['txtpreciouniprenda'];

            $imagen_servicio = $_FILES['imgservicio'];

            //Atributos de imagen

            $tipo_imagen = $imagen_servicio['type'];

            $nombre_imagen = $imagen_servicio['name'];

            //Validar si viene variable 

            if(isset($_POST['sltcestadoservicio'])){

                $estado_servicio = $_POST['sltcestadoservicio'];

                if(isset($descripcion_prenda) || isset($precio_uni_prenda) || is_numeric($precio_uni_prenda)){

                    if(!empty($nombre_imagen) && $tipo_imagen == 'image/jpg' || $tipo_imagen == 'image/jpeg' || $tipo_imagen == 'image/png' || $tipo_imagen == 'image/gif'){

                        if(!is_dir('../dashboard/img/servicio/')){

                            mkdir('../dashboard/img/servicio', 0777, true);

                        } else {

                            $servicio = new Modelo();

                            $data = "descripcion_prenda='".$descripcion_prenda."', precio_uni_prenda=".$precio_uni_prenda.", imagen_servicio='".$nombre_imagen."', estado_servicio=".$estado_servicio;
                                
                            $dato = $servicio->actualizar_servicio("servicio",$data,"id_servicio=".$id_servicio);

                            move_uploaded_file($imagen_servicio['tmp_name'], '../dashboard/img/servicio/'.$nombre_imagen);
                                
                            echo "<script>alert('Datos actualizados');
                            window.location.href = './servicios.php';</script>";

                        }

                    } else {

                        $servicio = new Modelo();

                        $data = "descripcion_prenda='".$descripcion_prenda."', precio_uni_prenda=".$precio_uni_prenda.", estado_servicio=".$estado_servicio;

                        $dato = $servicio->actualizar_servicio("servicio",$data,"id_servicio=".$id_servicio);

                        echo "<script>alert('Datos actualizados');
                        window.location.href = './servicios.php';</script>";

                    }

                } else {

                    echo "<script>alert('Datos incompletos');
                    history.go(-1);</script>";

                }

            } else {

                if(isset($descripcion_prenda) || isset($precio_uni_prenda) || is_numeric($precio_uni_prenda)){

                    if(!empty($nombre_imagen) && $tipo_imagen == 'image/jpg' || $tipo_imagen == 'image/jpeg' || $tipo_imagen == 'image/png' || $tipo_imagen == 'image/gif'){

                        if(!is_dir('../dashboard/img/servicio/')){

                            mkdir('../dashboard/img/servicio', 0777, true);

                        } else {

                            $servicio = new Modelo();

                            $data = "descripcion_prenda='".$descripcion_prenda."', precio_uni_prenda=".$precio_uni_prenda.", imagen_servicio='".$nombre_imagen."'";
                                
                            $dato = $servicio->actualizar_servicio("servicio",$data,"id_servicio=".$id_servicio);

                            move_uploaded_file($imagen_servicio['tmp_name'], '../dashboard/img/servicio/'.$nombre_imagen);
                                
                            echo "<script>alert('Datos actualizados');
                            window.location.href = './servicios.php';</script>";
                            
                        }

                    } else {

                        $servicio = new Modelo();

                        $data = "descripcion_prenda='".$descripcion_prenda."', precio_uni_prenda=".$precio_uni_prenda;

                        $dato = $servicio->actualizar_servicio("servicio",$data,"id_servicio=".$id_servicio);

                        echo "<script>alert('Datos actualizados');
                        window.location.href = './servicios.php';</script>";

                    }

                } else {

                    echo "<script>alert('Datos incompletos');
                    history.go(-1);</script>";

                }

            }

        }

        //Eliminar

        static function deshabilitar(){

            $id_servicio = $_REQUEST['id_servicio'];

            if(empty($id_servicio)){

                echo "<script>alert('Error: Solicitud vacía');
                window.location.href='servicios.php';</script>";

            } else {

                $data = "estado_servicio=0";

                $servicio = new Modelo();

                $dato = $servicio->deshabilitar_servicio("servicio",$data, "id_servicio=".$id_servicio);

                header("Location:./servicios.php");

            }

        }

    }

} else {

    header('Location: ../index.php');

}