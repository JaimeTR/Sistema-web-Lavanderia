<?php

if(!empty($_SESSION['active'])){

    class Modelo{

        private $Modelo;

        private $db;  

        private $datos;

        private $reservas;

        private $recepcionistas;
         
        public function __construct(){

            $this->Modelo = array();

            $this->db = new PDO('mysql:host=localhost;dbname=lavanderia_princess',"root","");

        }

        //Mostrar listado de reservas

        public function mostrar_reservas($tabla, $id_reserva){

            $consul="select r.id_reserva, r.fecha_reserva, r.fecha_recojo, r.fecha_envio, r.id_descuento, r.codigo_reserva, c.nombre_cliente, c.direccion_cliente, s.descripcion_prenda, d.porcentaje_descuento, r.cantidad_prenda, r.total_carrito, r.estado_reserva from ".$tabla." r inner join cliente c on r.id_cliente = c.id_cliente inner join servicio s on r.id_servicio = s.id_servicio inner join descuento d on r.id_descuento = d.id_descuento where ".$id_reserva.";";

            $resu=$this->db->query($consul);        

            while($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)) {

                $this->reservas[]=$filas;

            }

            return $this->reservas;

        } 

        //Mostrar listado de recepcionistas

        public function mostrar_recepcionistas(){

            $consul="select u.id_usuario, u.nombre_usuario from usuario u where rol_usuario = 2";

            $resu=$this->db->query($consul);        

            while($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)) {

                $this->recepcionistas[]=$filas;

            }

            return $this->recepcionistas;

        } 

        //Generar nueva orden de delivery

        public function nuevo_delivery($tabla, $data, $id_reserva){

            $consul="insert into ".$tabla." ".$data." where ".$id_reserva.";";

            $resultado=$this->db->query($consul);

            if ($resultado) {

                return true;

            } else {

                return false;

            }

        }

        //Modificando estado de la reserva

        public function alterar_reserva($tabla, $data, $codigo_reserva){

            $consulta="update ".$tabla." set ".$data." where ".$codigo_reserva.";";

            $resultado=$this->db->query($consulta);

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