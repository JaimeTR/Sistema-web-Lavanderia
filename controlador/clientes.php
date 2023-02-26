<?php

if(!empty($_SESSION['active'])){

    require_once("../../modelo/clientes.php");

    class modeloController{

        private $model;

        public function __construct(){

            $this->model = new Modelo();

        }

        //Mostrar listado de clientes registrados

        static function index(){

            $cliente = new Modelo();

            $dato = $cliente->mostrar_clientes("cliente","1");

            require_once("../dashboard/vista/clientes.php");

        }

        //Formulario nuevo cliente

        static function nuevo(){

            require_once("../dashboard/vista/nuevo_cliente.php");

        }

        //Registrar nuevo cliente

        static function nuevo_cliente(){

            //Declarando variables

            $nombre_cliente = $_REQUEST['txtnombrecliente'];

            $apellido_cliente = $_REQUEST['txtapellidocliente'];

            $telefono_cliente = $_REQUEST['txttelefonocliente'];

            $direccion_cliente = $_REQUEST['txtdireccioncliente'];

            $email_cliente = $_REQUEST['txtemailcliente'];

            $usuario_cliente = $_REQUEST['txtnickcliente'];

            $pass_cliente = $_REQUEST['txtpasscliente'];

            $tipo_cliente = $_REQUEST['sltctipocliente'];

            $estado_cliente = 1;

            //Validar los datos provenientes del formulario

            if(empty($nombre_cliente) || empty($apellido_cliente) || empty($telefono_cliente) || empty($direccion_cliente) || empty($email_cliente) || empty($usuario_cliente) || empty($pass_cliente)){

                echo "<script>alert('Error: Datos incompletos');
                history.go(-1);</script>";

            } else {

                //Encriptando contraseña 

                $pass_clienteEncrypted = md5($pass_cliente);

                //Invocando a la clase modelo

                $cliente = new Modelo();

                //Llamando al método 'cliente_repetido'

                $repetido = $cliente->cliente_repetido("cliente","usuario_cliente='".$usuario_cliente."'");

                //Validando si el nick es repetido

                if($repetido == true){

                    echo "<script>alert('ERROR: CLIENTE REPETIDO');
                    history.go(-1);</script>";

                } else {

                    //Insertando datos provenientes del formulario

                    $data = "(id_cliente, nombre_cliente, apellido_cliente, telefono_cliente, direccion_cliente, email_cliente, usuario_cliente, password_cliente, tipo_cliente, estado_cliente) values (null, '".$nombre_cliente."', '".$apellido_cliente."', '".$telefono_cliente."', '".$direccion_cliente."', '".$email_cliente."', '".$usuario_cliente."', '".$pass_clienteEncrypted."', ".$tipo_cliente.", ".$estado_cliente.")";

                    $dato = $cliente->nuevo_cliente("cliente",$data);

                    //Redireccionando a la página clientes

                    header("location: ./clientes.php");


                }

            }

        }

        //Editar cliente

        static function editar(){    

            //Validar que 'id_cliente' no venga vacío

            $id_cliente = $_REQUEST['id_cliente'];

            if(empty($id_cliente)){

                echo "<script>alert('Error: Solicitud vacía');
                window.location.href='clientes.php';</script>";

            } else {

                //Invocando a la clase modelo

                $cliente = new Modelo();

                //Llamando al método 'mostrar_clientes'

                $dato = $cliente->mostrar_clientes("cliente","id_cliente=".$id_cliente);

                require_once("../dashboard/vista/editar_cliente.php");
            }

        }

        //Actualizar

        static function actualizar(){

            //Declarando variables

            $id_cliente = $_REQUEST['txtidcliente'];

            $nombre_cliente = $_REQUEST['txtnombrecliente'];

            $apellido_cliente = $_REQUEST['txtapellidocliente'];

            $email_cliente = $_REQUEST['txtemailcliente'];

            $telefono_cliente = $_REQUEST['txttelefonocliente'];

            $direccion_cliente = $_REQUEST['txtdireccioncliente'];

            $usuario_cliente = $_REQUEST['txtnickcliente'];

            $pass_cliente = $_REQUEST['txtpasscliente'];

            $tipo_cliente = $_REQUEST['slcttipocliente'];

            $estado_cliente = $_REQUEST['slctestado'];

            //Validando que ningún dato venga vacío

            if(empty($nombre_cliente) || empty($apellido_cliente) || empty($telefono_cliente) || empty($direccion_cliente) || empty($email_cliente) || empty($usuario_cliente) || empty($pass_cliente)){

                echo "<script>alert('Error: Datos incompletos');
                window.location.href='clientes.php';</script>";

            } else {

                //Encriptando contraseña 

                $pass_clienteEncrypted = md5($pass_cliente);

                //Invocando a la clase modelo

                $cliente = new Modelo();

                //Llamando al método 'cliente_repetido'

                $repetido = $cliente->cliente_repetido("cliente","usuario_cliente='".$usuario_cliente."'");

                //Validando si el nick es repetido

                if($repetido == true){

                    //Insertando los datos provenientes del formulario

                    $data = "nombre_cliente='".$nombre_cliente."', apellido_cliente='".$apellido_cliente."', telefono_cliente='".$telefono_cliente."', direccion_cliente='".$direccion_cliente."', email_cliente='".$email_cliente."', password_cliente='".$pass_clienteEncrypted."', tipo_cliente='".$tipo_cliente."', estado_cliente='".$estado_cliente."'";

                    $dato = $cliente->actualizar_cliente("cliente",$data,"id_cliente=".$id_cliente);

                    header("location:./clientes.php");

                } else {

                    //Insertando los datos provenientes del formulario

                    $data = "nombre_cliente='".$nombre_cliente."', apellido_cliente='".$apellido_cliente."', telefono_cliente='".$telefono_cliente."', direccion_cliente='".$direccion_cliente."', email_cliente='".$email_cliente."', usuario_cliente='".$usuario_cliente."', password_cliente='".$pass_clienteEncrypted."', tipo_cliente='".$tipo_cliente."', estado_cliente='".$estado_cliente."'";

                    $dato = $cliente->actualizar_cliente("cliente",$data,"id_cliente=".$id_cliente);

                    //Redireccionando a la página clientes

                    header("location:./clientes.php");

                }

            }

        }

        static function eliminar(){

            $id_cliente = $_REQUEST['id_cliente'];

            if(empty($id_cliente)){

                echo "<script>alert('Error: Solicitud vacía');
                window.location.href='clientes.php';</script>";

            } else {

                //Invocando a la clase modelo

                $cliente = new Modelo();

                $data = "estado_cliente = 0";

                $dato = $cliente->eliminar_cliente("cliente", $data ,"id_cliente=".$id_cliente);

                //Redireccionando a la página clientes

                header("location:./clientes.php");

            }

        }

    }

}