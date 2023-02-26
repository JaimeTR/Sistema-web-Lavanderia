<?php 

    if(empty($_SESSION['cliente_activo'])) {

        header('Location: ../');

    } else {

        require_once "includes/parte_superior.php";

?>
<!--INICIO del cont principal-->
<div class="container">
    <center>
        <h2 class="icon-basket">Detalle de servicio</h2>
    </center>
<div class="container-editar">
	<?php if(!empty($servicio)){
		foreach($servicio as $key => $value_servicio){
			foreach($value_servicio as $v_s){ ?>
				<label>Nombre de prenda</label>
			    <input type="text" value="<?php echo $v_s['descripcion_prenda']; ?>" disabled="disabled" name="txtdescripcionprenda">
			    <label>Precio lavado x unidad</label>
			    <input type="text" value="<?php echo $v_s['precio_uni_prenda']; ?>" disabled="disabled" name="txtpreciouniprenda">
			    <input type="hidden" value="" name="txtidservicio">
			    <label>Imagen del servicio</label>
			    <div class="container-editar_imagenServicio">
			    	<img src="../dashboard/img/servicio/<?php echo $v_s['imagen_servicio']; ?>">
			    </div>
			    <div class="container-detalleCarrito">
			    	<a href="servicios.php?g=agregar&id_servicio=<?php echo $v_s['id_servicio']; ?>">Agregar a carrito</a>
			    </div>
	<?php 	}
		}
	} ?>
</div>
<!--FIN del cont principal-->

<?php require_once "includes/parte_inferior.php"?>

<?php } ?>