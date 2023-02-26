//Reporte de carrito

function reporteCarrito(){

	var fechaRecojo;

	var fechaEnvio;

	var code;

	var porccode;

	fechaRecojo = document.getElementById('fecharecojo').value;

	fechaEnvio = document.getElementById('fechaenvio').value;

	code = document.getElementById('code').value;

	porccode = document.getElementById('porccode').value;

	if(code == '' || fechaEnvio == ''){

		if(fechaRecojo == null || fechaRecojo == ''  || fechaEnvio == null || fechaEnvio == ''){

			alert('Fechas vacías');

		} else {

			window.location.href='servicios.php?g=reporteCarrito&fecharecojo='+fechaRecojo+'&fechaenvio='+fechaEnvio;

		}

	} else {

		if(fechaRecojo == null || fechaRecojo == ''  || fechaEnvio == null || fechaEnvio == ''){

			alert('Error: fechas vacías');

		} else {

			window.location.href='servicios.php?g=reporteCarrito&fecharecojo='
			+fechaRecojo+'&fechaenvio='+fechaEnvio+'&code='+code+'&porccode='+porccode;

		}

	}

}