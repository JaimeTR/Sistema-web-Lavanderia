<?php

if(!empty($_SESSION['active'])){

    class Modelo{

        private $Modelo;

        private $db;

        private $datos;    

        private $recepcionista;

        private $ordenes_delivery;
         
        public function __construct(){

            $this->Modelo = array();

            $this->db = new PDO('mysql:host=localhost;dbname=lavanderia_princess',"root","");

        }

        //Mostrar ordenes de delivery

        public function ordenes_delivery($tabla, $id_delivery){
            
            $consul="select d.id_delivery, s.descripcion_prenda, r.codigo_reserva, u.id_usuario, u.nombre_usuario, u.rol_usuario, d.fecha_recojo, d.fecha_envio, d.estado_delivery, d.hora_recojido from ".$tabla." d
            inner join reserva r on d.id_reserva = r.id_reserva
            inner join usuario u on d.id_recepcionista=u.id_usuario
            inner join servicio s on r.id_servicio = s.id_servicio where ".$id_delivery.";";
            
            $resu=$this->db->query($consul); 
                   
            while($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)) {
                
                    $this->ordenes_delivery[]=$filas;
                    
            }
            
            return $this->ordenes_delivery;

        }

        //Mostrar recepcionistas para generar orden de envío

        public function mostrar_recepcionistas($tabla, $condicion){

            $consul = "select * from ".$tabla." where ".$condicion;

            $resu=$this->db->query($consul); 
                   
            while($filas = $resu->FETCHALL(PDO::FETCH_ASSOC)) {
                
                    $this->recepcionista[]=$filas;
                    
            }
            
            return $this->recepcionista;

        }

        //Actualizar orden de delivery

        public function actualizar_delivery($tabla, $data, $id_delivery){

            $consul = "update ".$tabla." set ".$data." where ".$id_delivery;

            $resu=$this->db->query($consul);
                   
            if($resu){

                return true;

            } else {

                return false;

            }

        }

        //Generar orden de envío

        public function generar_envio($tabla, $data){

            $consul = "insert into ".$tabla." ".$data;

            $resu = $this->db->query($consul);

            if($resu){

                return true;

            } else {

                return false;

            }

        }

    }

} else {

    header('Location: ../');

}