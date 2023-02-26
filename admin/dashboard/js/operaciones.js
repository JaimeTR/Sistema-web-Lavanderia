//Inhabilitar usuario

function confirmareliminarUsuario(id_usuario){

    var cuadro;

    cuadro = confirm("¿Desea eliminar el usuario?");

    if(cuadro == true){

		window.location.href = "usuarios.php?g=eliminar&id_usuario="+id_usuario;

	} else {

		alert("Se ha cancelado la operación");

	}     

}

//Inhabilitar cliente

function confirmareliminarCliente(id_cliente){

    var cuadro;

    cuadro = confirm("¿Desea elminar el cliente?");

    if(cuadro == true){

		window.location.href = "clientes.php?g=eliminar&id_cliente="+id_cliente;

	} else {

		alert("Se ha cancelado la operación");

	}     

}

//Inhabilitar servicio

function confirmardeshabilitarServicio(id_servicio){

    var cuadro;

    cuadro = confirm("¿Desea deshabilitar el servicio?");

    if(cuadro == true){

		window.location.href = "servicios.php?g=deshabilitar&id_servicio="+id_servicio;

	} else {

		alert("Se ha cancelado la operación");

	}     

}

//Inhabilitar descuento

function confirmardeshabilitarDescuento(id_descuento){

    var cuadro;

    cuadro = confirm("¿Desea deshabilitar el descuento?");

    if(cuadro == true){

		window.location.href = "descuentos.php?g=deshabilitar&id_descuento="+id_descuento;

	} else {

		alert("Se ha cancelado la operación");

	}     

}

//Formulario editar orden de delivery

function prendas_recojidas(){

	var prendas;

	prendas = document.getElementById("estado_delivery").value;

	if(prendas == 1){

		var campo_hora;

		var parentDiv;

		var boton_editar;

		campo_hora = document.createElement('input');

		campo_hora.setAttribute("type","time");

		campo_hora.setAttribute("name","txthorarecojido");

		campo_hora.setAttribute("id","hora");

		campo_hora.setAttribute("required","required");

		boton_editar = document.getElementById("boton_editar");

		parentDiv = boton_editar.parentNode;

		parentDiv.insertBefore(campo_hora, boton_editar);

	} else if(prendas == 0){

		document.getElementById("hora").remove();

	}

}

//Formulario editar orden de envio

function prendas_enviadas(){

	var prendas;

	prendas = document.getElementById("estado_envio").value;

	if(prendas == 1){

		var campo_hora;

		var parentDiv;

		var boton_editar;

		campo_hora = document.createElement('input');

		campo_hora.setAttribute("type","time");

		campo_hora.setAttribute("name","txthoraenviado");

		campo_hora.setAttribute("id","hora");

		campo_hora.setAttribute("required","required");

		boton_editar = document.getElementById("boton_editar");

		parentDiv = boton_editar.parentNode;

		parentDiv.insertBefore(campo_hora, boton_editar);

	} else if(prendas == 0){

		document.getElementById("hora").remove();

	}

}