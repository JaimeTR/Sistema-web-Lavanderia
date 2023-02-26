<?php 

if(isset($_SESSION['cliente_activo'])){

	if(isset($_SESSION['carrito'])){

		require_once("../conexion.php");

		require_once("pdf/fpdf.php");

		ob_start();

		//Configurando el PDF

		$pdf = new FPDF('p');

		$pdf->AddPage();

		//Textos en el PDF

		$pdf->SetFont('Arial','B',16);
					
		$pdf->Cell(186,10,"DETALLE DE RESERVA",0,1,"C");
					
		$pdf->Cell(10,10,"",0,1);

		//Definición de la cabecera

		$pdf->SetFont('Arial','B',9);

		$pdf->Cell(60,10,utf8_decode("Fecha de Impresión: ").date("d/m/Y"),0,1);

		$pdf->Cell(10,2,"",0,1);

		$pdf->Cell(60,5,utf8_decode("Empresa: Lavandería 'My princess'"));

		$pdf->Cell(50,9,"",0,1);

		$pdf->Cell(60,10,"FECHA DE RECOJO             FECHA DE ENVIO                SERVICIO                      PRECIO               CANTIDAD                  TOTAL",0,1);

		//Impresión de los registros de la reserva

		$pdf->SetFont('Arial','',8);

		foreach($_SESSION['carrito'] as $indice => $value_car){

			if(isset($_REQUEST['code']) || isset($_REQUEST['porccode'])){

				//Operaciones

				$bruto = $value_car['precio_uni_prenda'] * $value_car['cantidad'];
				$descuento = $bruto * ($_REQUEST['porccode'] / 100);
				$neto = $bruto - $descuento;

				//Mostrando registros

				$pdf->Cell(42,8,$fecha_recojo);
				$pdf->Cell(42,8,$fecha_envio);
				$pdf->Cell(34,8,utf8_decode($value_car['descripcion_prenda']));
				$pdf->Cell(26,8,"S/. ".utf8_decode($value_car['precio_uni_prenda']));
				$pdf->Cell(32,8,utf8_decode($value_car['cantidad']));
				$pdf->Cell(32,8,utf8_decode("S/. ".$neto));
				$pdf->Cell(50,8,'',0,1);

			} else {

				//Operaciones

				$neto = $value_car['precio_uni_prenda'] * $value_car['cantidad'];

				//Mostrando registros

				$pdf->Cell(42,8,$fecha_recojo);
				$pdf->Cell(42,8,$fecha_envio);
				$pdf->Cell(34,8,utf8_decode($value_car['descripcion_prenda']));
				$pdf->Cell(26,8,"S/. ".utf8_decode($value_car['precio_uni_prenda']));
				$pdf->Cell(32,8,utf8_decode($value_car['cantidad']));
				$pdf->Cell(32,8,utf8_decode("S/. ".$neto.".00"));
				$pdf->Cell(50,8,'',0,1);

			}

		}

		//Utilidades

		$stats = array(

        'total' => 0

    	);

    	if(isset($_REQUEST['code']) || isset($_REQUEST['porccode'])){

	        foreach($_SESSION['carrito'] as $value_car){

	        $stats['total'] += ($value_car['precio_uni_prenda'] * $value_car['cantidad']) - (($value_car['precio_uni_prenda'] * $value_car['cantidad']) * ($_REQUEST['porccode'])/100);

	    	}

	    	$pdf->SetFont('Arial','B',9);

			$pdf->Cell(50,5,"",0,1);

			$pdf->Cell(34,9,utf8_decode("TOTAL DE CARRITO: "));

			$pdf->SetFont('Arial','',9);

			$pdf->Cell(50,9,utf8_decode("S/. ".$stats['total']));

        } else {

        	foreach($_SESSION['carrito'] as $value_car){

	        $stats['total'] += ($value_car['precio_uni_prenda'] * $value_car['cantidad']);

	    	}

	    	$pdf->SetFont('Arial','B',9);

			$pdf->Cell(50,5,"",0,1);

			$pdf->Cell(34,9,utf8_decode("TOTAL DE CARRITO: "));

			$pdf->SetFont('Arial','',9);

			$pdf->Cell(50,9,utf8_decode("S/. ".$stats['total']).".00");

        }

		$pdf->SetFont('Arial','B',9);

		$pdf->Cell(50,9,"",0,1);

		$pdf->Cell(35,9,utf8_decode("FECHA DE RESERVA: "));

		$pdf->SetFont('Arial','',9);

		$pdf->Cell(50,9,utf8_decode($fecha_reserva));

		//Validar

		if(isset($_REQUEST['code']) || isset($_REQUEST['porccode'])){

			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(50,9,"",0,1);

			$pdf->Cell(41,9,utf8_decode("CÓDIGO DE DESCUENTO: "));

			$pdf->SetFont('Arial','',9);

			$pdf->Cell(50,9,utf8_decode($_REQUEST['code']));

			$pdf->SetFont('Arial','B',9);

			$pdf->Cell(50,9,"",0,1);

			$pdf->Cell(50,9,utf8_decode("PORCENTAJE DE DESCUENTO: "));

			$pdf->SetFont('Arial','',9);

			$pdf->Cell(50,9,utf8_decode($_REQUEST['porccode'])." %");

		}

		//FIN

		$pdf->SetFont('Arial','B',9);

		$pdf->Cell(50,9,"",0,1);

		$pdf->Cell(63,9,utf8_decode("NOMBRES Y APELLIDOS DEL CLIENTE: "));

		$pdf->SetFont('Arial','',9);

		$pdf->Cell(50,9,utf8_decode($_SESSION['nombre_cliente'].' '.$_SESSION['apellido_cliente']));

		$pdf->SetFont('Arial','B',9);

		$pdf->Cell(50,9,"",0,1);

		$pdf->Cell(42,9,utf8_decode("DIRECCIÓN DEL CLIENTE: "));

		$pdf->SetFont('Arial','',9);

		$pdf->Cell(50,9,utf8_decode($_SESSION['direccion_cliente']));

		$pdf->SetFont('Arial','B',9);

		$pdf->Cell(50,9,"",0,1);

		$pdf->Cell(34,9,utf8_decode("EMAIL DEL CLIENTE: "));

		$pdf->SetFont('Arial','',9);

		$pdf->Cell(50,9,utf8_decode($_SESSION['email_cliente']));

		$pdf->SetFont('Arial','B',9);

		$pdf->Cell(50,9,"",0,1);

		$pdf->Cell(41,9,utf8_decode("TELÉFONO DEL CLIENTE: "));

		$pdf->SetFont('Arial','',9);

		$pdf->Cell(50,9,utf8_decode($_SESSION['telefono_cliente']));

		$pdf->SetFont('Arial','B',9);

		$pdf->Cell(50,9,"",0,1);

		$pdf->Output();

	} else {

		echo "<script>alert('Error: Tu carrito está vacío, añade un producto');
		window.location.href='./servicios.php';</script>";

	}

} else {

	header("Location: ../");

}

?>