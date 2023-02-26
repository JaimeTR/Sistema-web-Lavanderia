<?php

if(!empty($_SESSION['active'])){

    class Modelo{

        private $Modelo;

        private $db;

        private $datos;
         
        public function __construct(){

            $this->Modelo = array();

            $this->db = new PDO('mysql:host=localhost;dbname=lavanderia_princess',"root","");
        
        }

        //Mostrar clientes

        public function mostrar_clientes($tabla, $id_cliente){

            $consul="select * from ".$tabla." where ".$id_cliente.";";

            $resu=$this->db->query($consul);

            while($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)) {

                    $this->datos[]=$filas;

            }

            return $this->datos;

        }

        //Nuevo cliente

        public function nuevo_cliente($tabla, $data){

            $consul="insert into ".$tabla." ".$data;

            $resu=$this->db->query($consul);

            if($resu){

                return true;

            } else {

                return false;

            }
        }

        //Validar si el nick del cliente se repite en la base de datos

        public function cliente_repetido($tabla, $nick_cliente){

            $consul="select * from ".$tabla." where ".$nick_cliente.";";

            $resu=$this->db->query($consul);

            while($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)){

                $this->datos[]=$filas;

            }

            return $this->datos;

        }

        //Actualizar cliente

        public function actualizar_cliente($tabla, $data, $id_cliente){

            $consulta = "update ".$tabla." set ".$data." where ".$id_cliente.";";

            $resultado = $this->db->query($consulta);

            if ($resultado) {

                return true;

            } else {

                return false;
                
            }
        }

        //Eliminar cliente

        public function eliminar_cliente($tabla, $data, $id_cliente){

            $consulta = "update ".$tabla." set ".$data." where ".$id_cliente.";";

            $resultado = $this->db->query($consulta);

            if ($resultado) {

                return true;

            } else {

                return false;
                
            }

        }

    } 

} else {

    header('Location: ../');

}