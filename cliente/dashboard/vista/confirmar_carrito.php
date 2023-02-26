<?php 

    if(empty($_SESSION['cliente_activo'])) {

        header('Location: ../');

    } else {

        require_once "includes/parte_superior.php";

?>
<!--INICIO del cont principal-->
<div class="container">
    <center>
        <h2 class="icon-basket">Confirmar datos de cliente</h2>
    </center>
<div class="container-editar">
		<form method="POST">
			<label>Nombres y apellidos</label>
			<input type="text" value="<?php echo $_SESSION['nombre_cliente'],' '.$_SESSION['apellido_cliente']; ?>" disabled="disabled">
			<label>Dirección de domicilio</label>
			<input type="text" value="<?php echo $_SESSION['direccion_cliente']; ?>" disabled="disabled">
			<label>Teléfono</label>
			<input type="text" value="<?php echo $_SESSION['telefono_cliente']; ?>" disabled="disabled">
			<label>Correo electrónico</label>
			<input type="text" value="<?php echo $_SESSION['email_cliente']; ?>" disabled="disabled">
			<?php if(!empty($mostrarCode)){
				foreach($mostrarCode as $key => $value_mc){ 
					foreach($value_mc as $v_mc){ ?>
						<label>Código de descuento</label>
						<input type="text" value="<?php echo $v_mc['codigo_descuento']; ?>" disabled="disabled">
						<label>Porcentaje de descuento</label>
						<input type="text" value="<?php echo $v_mc['porcentaje_descuento'].' %'; ?>" disabled="disabled">
						<input type="hidden" value="<?php echo $_GET['codigodescuento'] ?>" id="code" name="txtcode">
						<input type="hidden" value="<?php echo $v_mc['porcentaje_descuento']; ?>" id="porccode" name="txtporccode">
			<?php   }
			    }
			} ?>
			<label>Fecha de recojo</label>
			<input type="date" min="<?php echo date('Y-m-d'); ?>" required="required" id="fecharecojo" name="txtfecharecojo">
			<label>Fecha de envío</label>
			<input type="date" min="<?php echo date('Y-m-d'); ?>" required="required" id="fechaenvio" name="txtfechaenvio">
			<div class="container-confimarCarrito">
			    <input type="submit" class="container-btnconfimarCarrito_item" value="Reservar">
			    <input type="hidden" name="p" value="reservar">
			    <a href="#" onclick="reporteCarrito()">Reporte de carrito</a>
			</div>
			<input type="hidden" value="" id="code">
			<input type="hidden" value="" id="porccode">
		</form>
</div>
<!--FIN del cont principal-->

<?php require_once "includes/parte_inferior.php"; ?>

<?php } ?>