<?php 

	class Modelo{

		private $Modelo;

		private $db;

		private $reservas;

		public function __construct(){

			$this->Modelo = array();

			$this->db = new PDO('mysql:host=localhost;dbname=lavanderia_princess','root','');

		}

		//Mostrar reservas

		public function mostrandoReservas($tabla, $condicion){

			$consulta = "select r.id_reserva, r.fecha_reserva, r.fecha_recojo, r.fecha_envio, r.id_descuento, r.codigo_reserva, c.nombre_cliente, c.direccion_cliente, s.descripcion_prenda, d.porcentaje_descuento, r.cantidad_prenda, r.total_carrito, r.estado_reserva from ".$tabla." r inner join cliente c on r.id_cliente = c.id_cliente inner join servicio s on r.id_servicio = s.id_servicio inner join descuento d on r.id_descuento = d.id_descuento where ".$condicion.";";

			$resultado = $this->db->query($consulta);

			while($filas = $resultado->FETCHALL(PDO::FETCH_ASSOC)){

				$this->reservas[]=$filas;

			}

			return $this->reservas;

		}

	}
	
 ?>