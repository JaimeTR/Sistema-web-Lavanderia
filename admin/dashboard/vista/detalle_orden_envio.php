<?php 
	
	if($_SESSION['rol_usuario'] == 1){

		if(empty($codigo_reserva)){

			header("Location: ./");

		} else {

			require_once("../conexion.php");

			require_once("pdf/fpdf.php");

			ob_start();

			//Configurando el PDF

			$pdf = new FPDF('p');

			$pdf->AddPage();

			//Textos en el PDF

			$pdf->SetFont('Arial','B',16);

			$pdf->Cell(186,10,utf8_decode("DETALLE DE ORDEN DE ENVÍO"),0,1,"C");
			
			$pdf->Cell(10,10,"",0,1);

			//Definición de la cabecera

			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(60,10,utf8_decode("Fecha de Impresión: ").date("d/m/Y"),0,1);

			$pdf->Cell(10,2,"",0,1);

			$pdf->Cell(60,5,utf8_decode("Empresa: Lavandería 'My princess'"));

			//Querys

			$query = mysqli_query($conection, "select r.codigo_reserva, r.fecha_envio, c.nombre_cliente, s.descripcion_prenda, r.cantidad_prenda  from reserva r
				INNER JOIN cliente c on r.id_cliente = c.id_cliente
				INNER JOIN servicio s on r.id_servicio = s.id_servicio
				where codigo_reserva = '".$codigo_reserva."';");

			$query_2 = mysqli_query($conection, "select e.estado_envio, e.hora_envio, c.direccion_cliente FROM envio e
				INNER JOIN delivery d on e.id_delivery = d.id_delivery
				INNER JOIN reserva r on d.id_reserva = r.id_reserva
				INNER JOIN cliente c on r.id_cliente = c.id_cliente
				where r.codigo_reserva = '".$codigo_reserva."'");

			$resultado_filas = mysqli_num_rows($query);

			$respuesta_arreglo_individual = mysqli_fetch_array($query_2);

			//Validaciones

			if($respuesta_arreglo_individual['estado_envio'] == 0){

				$pdf->Cell(50,9,"",0,1);

				$pdf->Cell(60,10,"CODIGO                              FECHA DE ENVIO                     CLIENTE                              SERVICIO                            CANTIDAD",0,1);

				//Impresión de los registros de la Tabla reservas

				$pdf->SetFont('Arial','',8);

				while($respuesta_arreglo_multiple = mysqli_fetch_array($query)){

					$pdf->Cell(40,8,$respuesta_arreglo_multiple['codigo_reserva']);
					$pdf->Cell(45,8,$respuesta_arreglo_multiple['fecha_envio']);
					$pdf->Cell(40,8,utf8_decode($respuesta_arreglo_multiple['nombre_cliente']));
					$pdf->Cell(40,8,utf8_decode($respuesta_arreglo_multiple['descripcion_prenda']));
					$pdf->Cell(30,8,utf8_decode($respuesta_arreglo_multiple['cantidad_prenda']));
					$pdf->Cell(50,8,'',0,1);

				}	

			} elseif($respuesta_arreglo_individual['estado_envio'] == 1){

				$pdf->Cell(50,9,"",0,1);

				$pdf->Cell(60,10,"CODIGO                              FECHA DE ENVIO                     CLIENTE                              SERVICIO                            CANTIDAD",0,1);

				//Impresión de los registros de la Tabla reservas

				$pdf->SetFont('Arial','',8);

				while($respuesta_arreglo_multiple = mysqli_fetch_array($query)){

					$pdf->Cell(40,8,$respuesta_arreglo_multiple['codigo_reserva']);
					$pdf->Cell(45,8,$respuesta_arreglo_multiple['fecha_envio']);
					$pdf->Cell(40,8,utf8_decode($respuesta_arreglo_multiple['nombre_cliente']));
					$pdf->Cell(40,8,utf8_decode($respuesta_arreglo_multiple['descripcion_prenda']));
					$pdf->Cell(30,8,utf8_decode($respuesta_arreglo_multiple['cantidad_prenda']));
					$pdf->Cell(50,8,'',0,1);

				}

				$pdf->SetFont('Arial','B',9);

				$pdf->Cell(50,7,"",0,1);

				$pdf->Cell(27,9,utf8_decode("HORA DE ENVÍO: "));

				$pdf->SetFont('Arial','',9);

				$pdf->Cell(50,9,utf8_decode($respuesta_arreglo_individual['hora_envio']));

			}
			
			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(50,9,"",0,1);

			$pdf->Cell(42,9,utf8_decode("DIRECCIÓN DEL CLIENTE: "));

			$pdf->SetFont('Arial','',9);

			$pdf->Cell(50,9,utf8_decode($respuesta_arreglo_individual['direccion_cliente']));

			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(50,9,"",0,1);

			$pdf->Cell(38,9,"TOTAL DE REGISTROS: ");

			$pdf->SetFont('Arial','',9);

			$pdf->Cell(50,9,$resultado_filas);

			//Ejecutar

			$pdf->Output();

		}

	} else {

		//Validar si el registro le pertenece al usuario activo

		$id_recepcionista = $_SESSION['id_usuario'];

		require_once("../conexion.php");

		$query_coincidir = mysqli_query($conection, "select * from envio e INNER JOIN delivery d on e.id_delivery = d.id_delivery
		INNER JOIN reserva r on d.id_reserva = r.id_reserva where r.codigo_reserva = '".$codigo_reserva."'
		AND e.id_recepcionista = $id_recepcionista");

		$coincidir = mysqli_num_rows($query_coincidir);

		if($coincidir > 0){

			require_once("../conexion.php");

			require_once("pdf/fpdf.php");

			ob_start();

			//Configurando el PDF

			$pdf = new FPDF('p');

			$pdf->AddPage();

			//Textos en el PDF

			$pdf->SetFont('Arial','B',16);

			$pdf->Cell(186,10,utf8_decode("DETALLE DE ORDEN DE ENVÍO"),0,1,"C");
			
			$pdf->Cell(10,10,"",0,1);

			//Definición de la cabecera

			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(60,10,utf8_decode("Fecha de Impresión: ").date("d/m/Y"),0,1);

			$pdf->Cell(10,2,"",0,1);

			$pdf->Cell(60,5,utf8_decode("Empresa: Lavandería 'My princess'"));

			//Querys

			$query = mysqli_query($conection, "select r.codigo_reserva, r.fecha_envio, c.nombre_cliente, s.descripcion_prenda, r.cantidad_prenda  from reserva r
				INNER JOIN cliente c on r.id_cliente = c.id_cliente
				INNER JOIN servicio s on r.id_servicio = s.id_servicio
				where codigo_reserva = '".$codigo_reserva."';");

			$query_2 = mysqli_query($conection, "select e.estado_envio, e.hora_envio, c.direccion_cliente FROM envio e
				INNER JOIN delivery d on e.id_delivery = d.id_delivery
				INNER JOIN reserva r on d.id_reserva = r.id_reserva
				INNER JOIN cliente c on r.id_cliente = c.id_cliente
				where r.codigo_reserva = '".$codigo_reserva."'");

			$resultado_filas = mysqli_num_rows($query);

			$respuesta_arreglo_individual = mysqli_fetch_array($query_2);

			//Validaciones

			if($respuesta_arreglo_individual['estado_envio'] == 0){

				$pdf->Cell(50,9,"",0,1);

				$pdf->Cell(60,10,"CODIGO                              FECHA DE ENVIO                     CLIENTE                              SERVICIO                            CANTIDAD",0,1);

				//Impresión de los registros de la Tabla reservas

				$pdf->SetFont('Arial','',8);

				while($respuesta_arreglo_multiple = mysqli_fetch_array($query)){

					$pdf->Cell(40,8,$respuesta_arreglo_multiple['codigo_reserva']);
					$pdf->Cell(45,8,$respuesta_arreglo_multiple['fecha_envio']);
					$pdf->Cell(40,8,utf8_decode($respuesta_arreglo_multiple['nombre_cliente']));
					$pdf->Cell(40,8,utf8_decode($respuesta_arreglo_multiple['descripcion_prenda']));
					$pdf->Cell(30,8,utf8_decode($respuesta_arreglo_multiple['cantidad_prenda']));
					$pdf->Cell(50,8,'',0,1);

				}	

			} elseif($respuesta_arreglo_individual['estado_envio'] == 1){

				$pdf->Cell(50,9,"",0,1);

				$pdf->Cell(60,10,"CODIGO                              FECHA DE ENVIO                     CLIENTE                              SERVICIO                            CANTIDAD",0,1);

				//Impresión de los registros de la Tabla reservas

				$pdf->SetFont('Arial','',8);

				while($respuesta_arreglo_multiple = mysqli_fetch_array($query)){

					$pdf->Cell(40,8,$respuesta_arreglo_multiple['codigo_reserva']);
					$pdf->Cell(45,8,$respuesta_arreglo_multiple['fecha_envio']);
					$pdf->Cell(40,8,utf8_decode($respuesta_arreglo_multiple['nombre_cliente']));
					$pdf->Cell(40,8,utf8_decode($respuesta_arreglo_multiple['descripcion_prenda']));
					$pdf->Cell(30,8,utf8_decode($respuesta_arreglo_multiple['cantidad_prenda']));
					$pdf->Cell(50,8,'',0,1);

				}

				$pdf->SetFont('Arial','B',9);

				$pdf->Cell(50,7,"",0,1);

				$pdf->Cell(27,9,utf8_decode("HORA DE ENVÍO: "));

				$pdf->SetFont('Arial','',9);

				$pdf->Cell(50,9,utf8_decode($respuesta_arreglo_individual['hora_envio']));

			}
			
			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(50,9,"",0,1);

			$pdf->Cell(42,9,utf8_decode("DIRECCIÓN DEL CLIENTE: "));

			$pdf->SetFont('Arial','',9);

			$pdf->Cell(50,9,utf8_decode($respuesta_arreglo_individual['direccion_cliente']));

			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(50,9,"",0,1);

			$pdf->Cell(38,9,"TOTAL DE REGISTROS: ");

			$pdf->SetFont('Arial','',9);

			$pdf->Cell(50,9,$resultado_filas);

			//Ejecutar

			$pdf->Output();

		} else {

			echo "<script>alert('Error: Este registro no está habilitado para este usuario');
			history.go(-1);</script>";

		}

	}

?>