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

			$pdf->Cell(186,10,"DETALLE DE ORDEN DE DELIVERY",0,1,"C");
			
			$pdf->Cell(10,10,"",0,1);

			//Definición de la cabecera

			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(60,10,utf8_decode("Fecha de Impresión: ").date("d/m/Y"),0,1);

			$pdf->Cell(10,2,"",0,1);

			$pdf->Cell(60,5,utf8_decode("Empresa: Lavandería 'My princess'"));

			//Querys

			$query = mysqli_query($conection, "select r.codigo_reserva, r.fecha_recojo, c.nombre_cliente, s.descripcion_prenda, r.cantidad_prenda from reserva r inner join cliente c on r.id_cliente=c.id_cliente
				inner join servicio s on r.id_servicio = s.id_servicio where codigo_reserva='".$codigo_reserva."';");

			$query_2 = mysqli_query($conection, "select c.direccion_cliente, d.estado_delivery, d.hora_recojido
			from reserva r inner join cliente c on r.id_cliente=c.id_cliente inner join delivery d on d.id_reserva = r.id_reserva where codigo_reserva='".$codigo_reserva."';");

			$resultado_filas = mysqli_num_rows($query);

			$respuesta_arreglo_individual = mysqli_fetch_array($query_2);

			//Validaciones

			if($respuesta_arreglo_individual['estado_delivery'] == 0){

				$pdf->Cell(50,9,"",0,1);

				$pdf->Cell(60,10,"CODIGO                            FECHA DE RECOJO                     CLIENTE                       SERVICIO                          CANTIDAD",0,1);

				//Impresión de los registros de la Tabla reservas

				$pdf->SetFont('Arial','',8);

				while($respuesta_arreglo_multiple = mysqli_fetch_array($query)){

					$pdf->Cell(38,8,$respuesta_arreglo_multiple['codigo_reserva']);
					$pdf->Cell(49,8,$respuesta_arreglo_multiple['fecha_recojo']);
					$pdf->Cell(34,8,utf8_decode($respuesta_arreglo_multiple['nombre_cliente']));
					$pdf->Cell(38,8,utf8_decode($respuesta_arreglo_multiple['descripcion_prenda']));
					$pdf->Cell(30,8,utf8_decode($respuesta_arreglo_multiple['cantidad_prenda']));
					$pdf->Cell(50,8,'',0,1);

				}	

			} elseif($respuesta_arreglo_individual['estado_delivery'] == 1 || $respuesta_arreglo_individual['estado_delivery'] == 2 || $respuesta_arreglo_individual['estado_delivery'] == 3){

				$pdf->Cell(50,9,"",0,1);

				$pdf->Cell(60,10,"CODIGO                            FECHA DE RECOJO                     CLIENTE                       SERVICIO                          CANTIDAD",0,1);

				//Impresión de los registros de la Tabla reservas

				$pdf->SetFont('Arial','',8);

				while($respuesta_arreglo_multiple = mysqli_fetch_array($query)){

					$pdf->Cell(38,8,$respuesta_arreglo_multiple['codigo_reserva']);
					$pdf->Cell(49,8,$respuesta_arreglo_multiple['fecha_recojo']);
					$pdf->Cell(34,8,utf8_decode($respuesta_arreglo_multiple['nombre_cliente']));
					$pdf->Cell(38,8,utf8_decode($respuesta_arreglo_multiple['descripcion_prenda']));
					$pdf->Cell(30,8,utf8_decode($respuesta_arreglo_multiple['cantidad_prenda']));
					$pdf->Cell(50,8,'',0,1);
					
				}

				$pdf->SetFont('Arial','B',9);

				$pdf->Cell(50,7,"",0,1);

				$pdf->Cell(31,9,utf8_decode("HORA DE RECOJO: "));

				$pdf->SetFont('Arial','',9);

				$pdf->Cell(50,9,utf8_decode($respuesta_arreglo_individual['hora_recojido']));

			}
			
			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(50,9,"",0,1);

			$pdf->Cell(42,9,utf8_decode("DIRECCIÓN DEL CLIENTE: "));

			$pdf->SetFont('Arial','',9);

			$pdf->Cell(50,9,utf8_decode($respuesta_arreglo_individual['direccion_cliente']));

			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(50,9,"",0,1);

			$pdf->Cell(58,9,"TOTAL DE SERVICIOS ORDENADOS: ");

			$pdf->SetFont('Arial','',9);

			$pdf->Cell(50,9,$resultado_filas);

			//Ejecutar

			$pdf->Output();

		}

	} else {

		//Validar si el registro le pertenece al usuario activo

		$id_recepcionista = $_SESSION['id_usuario'];

		require_once("../conexion.php");

		$query_coincidir = mysqli_query($conection, "select * from delivery d inner join reserva r on d.id_reserva = r.id_reserva where r.codigo_reserva = '".$codigo_reserva."' and d.id_recepcionista = $id_recepcionista");

		$coincidir = mysqli_num_rows($query_coincidir);

		if($coincidir > 0){

			//Inicio de FPDF

			require_once("pdf/fpdf.php");

			ob_start();

			//Configurando el PDF

			$pdf = new FPDF('p');

			$pdf->AddPage();

			//Textos en el PDF

			$pdf->SetFont('Arial','B',16);

			$pdf->Cell(186,10,"DETALLE DE ORDEN DE DELIVERY",0,1,"C");
			
			$pdf->Cell(10,10,"",0,1);

			//Definición de la cabecera

			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(60,10,utf8_decode("Fecha de Impresión: ").date("d/m/Y"),0,1);

			$pdf->Cell(10,2,"",0,1);

			$pdf->Cell(60,5,utf8_decode("Empresa: Lavandería 'My princess'"));

			//Querys

			$query = mysqli_query($conection, "select r.codigo_reserva, r.fecha_recojo, c.nombre_cliente, s.descripcion_prenda, r.cantidad_prenda from reserva r inner join cliente c on r.id_cliente=c.id_cliente
				inner join servicio s on r.id_servicio = s.id_servicio where codigo_reserva='".$codigo_reserva."';");

			$query_2 = mysqli_query($conection, "select c.direccion_cliente, d.estado_delivery, d.hora_recojido
			from reserva r inner join cliente c on r.id_cliente=c.id_cliente inner join delivery d on d.id_reserva = r.id_reserva where codigo_reserva='".$codigo_reserva."';");

			$resultado_filas = mysqli_num_rows($query);

			$respuesta_arreglo_individual = mysqli_fetch_array($query_2);

			//Validaciones

			if($respuesta_arreglo_individual['estado_delivery'] == 0){

				$pdf->Cell(50,9,"",0,1);

				$pdf->Cell(60,10,"CODIGO                            FECHA DE RECOJO                     CLIENTE                       SERVICIO                          CANTIDAD",0,1);

				//Impresión de los registros de la Tabla reservas

				$pdf->SetFont('Arial','',8);

				while($respuesta_arreglo_multiple = mysqli_fetch_array($query)){

					$pdf->Cell(38,8,$respuesta_arreglo_multiple['codigo_reserva']);
					$pdf->Cell(49,8,$respuesta_arreglo_multiple['fecha_recojo']);
					$pdf->Cell(34,8,utf8_decode($respuesta_arreglo_multiple['nombre_cliente']));
					$pdf->Cell(38,8,utf8_decode($respuesta_arreglo_multiple['descripcion_prenda']));
					$pdf->Cell(30,8,utf8_decode($respuesta_arreglo_multiple['cantidad_prenda']));
					$pdf->Cell(50,8,'',0,1);

				}	

			} elseif($respuesta_arreglo_individual['estado_delivery'] == 1 || $respuesta_arreglo_individual['estado_delivery'] == 2 || $respuesta_arreglo_individual['estado_delivery'] == 3){

				$pdf->Cell(50,9,"",0,1);

				$pdf->Cell(60,10,"CODIGO                            FECHA DE RECOJO                     CLIENTE                       SERVICIO                          CANTIDAD",0,1);

				//Impresión de los registros de la Tabla reservas

				$pdf->SetFont('Arial','',8);

				while($respuesta_arreglo_multiple = mysqli_fetch_array($query)){

					$pdf->Cell(38,8,$respuesta_arreglo_multiple['codigo_reserva']);
					$pdf->Cell(49,8,$respuesta_arreglo_multiple['fecha_recojo']);
					$pdf->Cell(34,8,utf8_decode($respuesta_arreglo_multiple['nombre_cliente']));
					$pdf->Cell(38,8,utf8_decode($respuesta_arreglo_multiple['descripcion_prenda']));
					$pdf->Cell(30,8,utf8_decode($respuesta_arreglo_multiple['cantidad_prenda']));
					$pdf->Cell(50,8,'',0,1);

				}

				$pdf->SetFont('Arial','B',9);

				$pdf->Cell(50,7,"",0,1);

				$pdf->Cell(31,9,utf8_decode("HORA DE RECOJO: "));

				$pdf->SetFont('Arial','',9);

				$pdf->Cell(50,9,utf8_decode($respuesta_arreglo_individual['hora_recojido']));

			}
			
			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(50,9,"",0,1);

			$pdf->Cell(42,9,utf8_decode("DIRECCIÓN DEL CLIENTE: "));

			$pdf->SetFont('Arial','',9);

			$pdf->Cell(50,9,utf8_decode($respuesta_arreglo_individual['direccion_cliente']));

			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(50,9,"",0,1);

			$pdf->Cell(58,9,"TOTAL DE SERVICIOS ORDENADOS: ");

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