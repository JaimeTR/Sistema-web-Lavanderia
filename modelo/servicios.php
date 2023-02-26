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

        //Mostrar

        public function mostrar_servicios($tabla, $id_servicio){

            $consul="select * from ".$tabla." where ".$id_servicio.";";

            $resu=$this->db->query($consul);

            while($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)) {

                    $this->datos[]=$filas;

            }

            return $this->datos;

        } 

        //Nuevo

        public function nuevo_servicio($tabla, $data){

            $consulta = "insert into ".$tabla." ".$data;

            $resultado = $this->db->query($consulta);

            if($resultado){

                return true;

            } else {

                return false;

            }

        }

        //Actualizar

        public function actualizar_servicio($tabla, $data, $id_servicio){

            $consulta = "update ".$tabla." set ".$data." where ".$id_servicio.";";

            $resultado = $this->db->query($consulta);

            if ($resultado) {

                return true;

            } else {

                return false;

            }

        }

        //Eliminar

        public function deshabilitar_servicio($tabla, $data, $id_servicio){

            $consulta = "update ".$tabla." set ". $data." where ".$id_servicio.";";

            $resultado = $this->db->query($consulta);

            if($resultado){

                return true;

            } else {

                return false;
                
            }


        }

    }

} else {

    header('Location: ../');

}