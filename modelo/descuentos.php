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

        //Mostrar descuentos

        public function mostrar_descuentos($tabla, $id_descuento){

            $consul = "select * from ".$tabla." where ".$id_descuento.";";

            $resu = $this->db->query($consul);

            while($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)) {

                    $this->datos[]=$filas;

            }

            return $this->datos;

        } 

        //Nuevo descuento

        public function nuevo_descuento($tabla, $data){

            $consul = "insert into ".$tabla." ".$data;

            $resultado = $this->db->query($consul);

            if($resultado){

                return true;

            } else {

                return false;

            }

        }

        //Actualizar descuento
        
        public function actualizar_descuento($tabla, $data, $id_descuento){

            $consulta = "update ".$tabla." set ".$data." where ".$id_descuento.";";

            $resultado = $this->db->query($consulta);

            if ($resultado) {

                return true;
     
            } else {

                return false;

            }

        }

        //Deshabilitar descuento

        public function deshabilitar_descuento($tabla, $data, $id_descuento){

            $consulta = "update ".$tabla." set ".$data." where ".$id_descuento.";";

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