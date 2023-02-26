<?php

if(!empty($_SESSION['active'])){

    require_once("../../modelo/usuarios.php");

    class modeloController{

        private $model;

        public function __construct(){

            $this->model = new Modelo();

        }

        //Mostrar

        static function index(){

            $usuario = new Modelo();

            $dato = $usuario->mostrar_usuarios("usuario","1");

            require_once("../dashboard/vista/usuarios.php");

        }

        //Nuevo usuario

        static function nuevo(){

            require_once("../dashboard/vista/nuevo_usuario.php");

        }

        //Registrar usuario

        static function nuevo_usuario(){

            $nombre_usuario = $_REQUEST['txtnombreusuario'];

            $apellido_usuario = $_REQUEST['txtapellidousuario'];

            $email_usuario = $_REQUEST['txtemailusuario'];

            $telefono_usuario = $_REQUEST['txttelefonousuario'];

            $direccion_usuario = $_REQUEST['txtdireccionusuario'];

            $nick_usuario = $_REQUEST['txtnickusuario'];

            $pass_usuario = md5($_REQUEST['txtpassusuario']);

            $tipo_usuario = $_REQUEST['sltctipousuario'];

            $estado_usuario = 1;

            if(empty($nombre_usuario) || empty($apellido_usuario) || empty($telefono_usuario) || empty($direccion_usuario) || empty($nick_usuario) || empty($pass_usuario) || empty($tipo_usuario)){

                echo "<script>alert('Error: Campos incompletos');
                history.go(-1);</script>";

            } else {

                $usuario = new Modelo();

                $repetido = $usuario->usuario_repetido("usuario","nick_usuario='".$nick_usuario."'");

                if($repetido == true){

                    echo "<script>alert('Error: Usuario repetido');
                                history.go(-1);</script>";

                } else {

                    $data = "(id_usuario, nombre_usuario, apellido_usuario, email_usuario, telefono_usuario, direccion_usuario, nick_usuario, password_usuario, rol_usuario, estado_usuario) values (null, '".$nombre_usuario."', '".$apellido_usuario."', '".$email_usuario."', '".$telefono_usuario."', '".$direccion_usuario."', '".$nick_usuario."', '".$pass_usuario."', ".$tipo_usuario.", ".$estado_usuario.")";

                    $dato = $usuario->nuevo_usuario("usuario",$data);

                    header("location: ./usuarios.php");

                }

            }

        }

        //Editar

        static function editar(){

            if(empty($_REQUEST['id_usuario']) || $_REQUEST['id_usuario'] == "'"){

                echo "<script>alert('Error, solicitud errónea');
                window.location.href='usuarios.php';</script>";

            } else {

                $id_usuario = $_REQUEST['id_usuario'];

                $usuario = new Modelo();

                $dato = $usuario->mostrar_usuarios("usuario","id_usuario=".$id_usuario);

                require_once("../dashboard/vista/editar_usuario.php");

            }
            
        }

        //Actualizar

        static function actualizar(){

            $id_usuario = $_REQUEST['txtidusuario'];

            $nombre_usuario = $_REQUEST['txtnombre'];

            $apellido_usuario = $_REQUEST['txtapellido'];

            $email_usuario = $_REQUEST['txtemail'];

            $telefono_usuario = $_REQUEST['txttelefono'];

            $direccion_usuario = $_REQUEST['txtdireccion'];

            $nick_usuario = $_REQUEST['txtnickusuario'];

            $pass_usuario = $_REQUEST['txtpassusuario'];

            $rol_usuario = $_REQUEST['slctrol'];

            $estado_usuario = $_REQUEST['slctestado'];

            if(empty($id_usuario) || empty($nombre_usuario) || empty($apellido_usuario) || empty($email_usuario) || empty($telefono_usuario) || empty($direccion_usuario) || empty($nick_usuario) || empty($pass_usuario) || empty($estado_usuario)){

                echo "<script>alert('Error: Campos incompletos');
                history.go(-1);</script>";

            } else {

                $pass_usuarioEncrypted = md5($pass_usuario); 

                if($_SESSION['id_usuario'] != $id_usuario) {

                    $usuario = new Modelo();

                    $repetido = $usuario->usuario_repetido("usuario","nick_usuario='".$nick_usuario."'");

                    if($repetido == true){

                        $data = "nombre_usuario='".$nombre_usuario."', apellido_usuario='".$apellido_usuario."', email_usuario='".$email_usuario."',
                        telefono_usuario='".$telefono_usuario."', direccion_usuario='".$direccion_usuario."', password_usuario='".$pass_usuarioEncrypted."', rol_usuario=".$rol_usuario.", estado_usuario='".$estado_usuario."'";
                            
                        $dato = $usuario->actualizar_usuario("usuario",$data,"id_usuario=".$id_usuario);

                        header("location:./usuarios.php");

                    } else {

                        $data = "nombre_usuario='".$nombre_usuario."', apellido_usuario='".$apellido_usuario."', email_usuario='".$email_usuario."', telefono_usuario='".$telefono_usuario."', direccion_usuario='".$direccion_usuario."', nick_usuario='".$nick_usuario."', password_usuario='".$pass_usuarioEncrypted."', rol_usuario=".$rol_usuario.", estado_usuario='".$estado_usuario."'";
                            
                        $dato = $usuario->actualizar_usuario("usuario",$data,"id_usuario=".$id_usuario);
                           
                        header("location:./usuarios.php");

                    }

                } elseif($id_usuario == $_SESSION['id_usuario']) {

                    $usuario = new Modelo();

                    $repetido = $usuario->usuario_repetido("usuario","nick_usuario='".$nick_usuario."'");

                    if($_SESSION['rol_usuario'] == 2 || $_SESSION['rol_usuario'] == 3){

                        if($repetido == true){

                            $data = "nombre_usuario='".$nombre_usuario."', apellido_usuario='".$apellido_usuario."', email_usuario='".$email_usuario."', telefono_usuario='".$telefono_usuario."', direccion_usuario='".$direccion_usuario."', password_usuario='".$pass_usuarioEncrypted."', estado_usuario='".$estado_usuario."'";
                                
                            $dato = $usuario->actualizar_usuario("usuario",$data,"id_usuario=".$id_usuario);

                            header("location: ../");

                            unset($_SESSION['active']);

                        } else {

                            $data = "nombre_usuario='".$nombre_usuario."', apellido_usuario='".$apellido_usuario."', email_usuario='".$email_usuario."', telefono_usuario='".$telefono_usuario."', direccion_usuario='".$direccion_usuario."', nick_usuario='".$nick_usuario."', password_usuario='".$pass_usuarioEncrypted."', estado_usuario='".$estado_usuario."'";
                                
                            $dato = $usuario->actualizar_usuario("usuario",$data,"id_usuario=".$id_usuario);

                            header("location: ../");
                                
                            unset($_SESSION['active']);

                        }

                    } elseif($_SESSION['rol_usuario'] == 1){

                        if($repetido == true){

                            $data = "nombre_usuario='".$nombre_usuario."', apellido_usuario='".$apellido_usuario."', email_usuario='".$email_usuario."', telefono_usuario='".$telefono_usuario."', direccion_usuario='".$direccion_usuario."', password_usuario='".$pass_usuarioEncrypted."', rol_usuario=".$rol_usuario.", estado_usuario='".$estado_usuario."'";
                                
                            $dato = $usuario->actualizar_usuario("usuario",$data,"id_usuario=".$id_usuario);

                            header("location: ../");

                            unset($_SESSION['active']);

                        } else {

                            $data = "nombre_usuario='".$nombre_usuario."', apellido_usuario='".$apellido_usuario."', email_usuario='".$email_usuario."', telefono_usuario='".$telefono_usuario."', direccion_usuario='".$direccion_usuario."', nick_usuario='".$nick_usuario."', password_usuario='".$pass_usuarioEncrypted."', rol_usuario=".$rol_usuario.", estado_usuario='".$estado_usuario."'";
                                
                            $dato = $usuario->actualizar_usuario("usuario",$data,"id_usuario=".$id_usuario);

                            header("location: ../");
                                
                            unset($_SESSION['active']);

                        }

                    }

                }

            }

        }

        //Eliminar 

        static function eliminar(){

            $id_usuario = $_REQUEST['id_usuario'];

            if(empty($id_usuario)){

                echo "<script>alert('Error: Campos incompletos');
                history.go(-1);</script>";

            } else {

            $usuario = new Modelo();

            $data = "estado_usuario = 0";

            $dato = $usuario->eliminar_usuario("usuario", $data, "id_usuario=".$id_usuario);

            header("location:./usuarios.php");

            }

        }

    }

} else {

    header("../");

}