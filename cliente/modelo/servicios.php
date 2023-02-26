<?php 

	class Modelo{

		private $Modelo;

		private $db;

		private $servicios;

		private $codeDesc;

		public function __construct(){

			$this->Modelo = array();

			$this->db = new PDO('mysql:host=localhost;dbname=lavanderia_princess','root','');

		}

		//Mostrar servicios

		public function mostrarServicios($tabla, $condicion){

			$consulta = "select * from ".$tabla." where ".$condicion;

			$resultado = $this->db->query($consulta);

			while($filas = $resultado->FETCHALL(PDO::FETCH_ASSOC)){

				$this->servicios[]=$filas;

			}

			return $this->servicios;

		}

		//Confirmar código de descuento

		public function confirmarCode($tabla, $codigo){

			$consulta = "select * from ".$tabla." where ".$codigo. " and estado_descuento = 1";

			$resultado = $this->db->query($consulta);

			$filas = $resultado->fetchColumn();

			if($filas > 0){

				return true;

			} else {

				return false;

			}

		}

		public function mostrarCode($tabla, $codigo){

			$consulta = "select d.id_descuento, d.codigo_descuento, d.porcentaje_descuento from ".$tabla." where ".$codigo;

			$resultado = $this->db->query($consulta);

			while($filas = $resultado->FETCHALL(PDO::FETCH_ASSOC)){

				$this->codeDesc[]=$filas;

			}

			return $this->codeDesc;

		}

		public function reservar($tabla, $query){

			foreach($_SESSION['carrito'] as $value_car){

				$consulta = "insert into ".$tabla." ".$query;

				$resultado = $this->db->query($consulta);

				if($resultado){

					return true;

				} else {

					return false;

				}

			}

		}

	}
	
 ?>