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

        public function ordenes_envio($tabla, $id_envio){

            $consul="select e.id_envio, r.codigo_reserva, u.nombre_usuario, u.id_usuario, r.fecha_envio, c.nombre_cliente, c.apellido_cliente, c.direccion_cliente, e.estado_envio from ".$tabla." e 
                inner join usuario u on e.id_recepcionista = u.id_usuario
                inner join delivery d on e.id_delivery = d.id_delivery
                inner join reserva r on d.id_reserva = r.id_reserva
                inner join cliente c on r.id_cliente = c.id_cliente where ".$id_envio."";

            $resu=$this->db->query($consul);

            while($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)) {

                    $this->datos[]=$filas;

            }

            return $this->datos;

        }

        public function actualizar($tabla, $query, $condicion){

            $consul = "update ".$tabla." set ".$query." where ".$condicion;

            $resu = $this->db->query($consul);

            if($resu == true){

                return true;

            } else {

                return false;

            }

        }

        public function alterar_reserva($tabla, $query, $condicion){

            $consul = "update ".$tabla." set ".$query." where ".$condicion;

            $resu = $this->db->query($consul);

            if($resu == true){

                return true;

            } else {

                return false;

            }

        }

    }

} else {

    header('Location: ../');

}