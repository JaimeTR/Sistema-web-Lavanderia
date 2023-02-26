<?php 

    if(empty($_SESSION['active'])) {

        header('Location: ../');

    } elseif($_SESSION['rol_usuario'] == 2){

        header('Location: reservas.php');

    } elseif($_SESSION['rol_usuario'] == 3){

        header('Location: ordenes_delivery.php');

    } else {

        require_once "includes/parte_superior.php";

?>
<!--INICIO del cont principal-->
<div class="container">
    <center>
        <h2 class="icon-basket">Editar servicio</h2>
    </center>
<div class="container-editar">
    <form method="POST" enctype="multipart/form-data">
    <?php
    foreach($dato as $key => $value):
        foreach($value as $v):
        ?>
        <label>Nombre de prenda</label>
        <input type="text" required="required" maxlength="20" value="<?php echo $v['descripcion_prenda'] ?>" name="txtdescripcionprenda">
        <label>Precio lavado x unidad</label>
        <input type="number" required="required" min="0" value="<?php echo $v['precio_uni_prenda'] ?>" name="txtpreciouniprenda">
        <input type="hidden" value="<?php echo $_GET['id_servicio']; ?>" name="txtidservicio">
        <?php if($v['estado_servicio'] == 0){ ?>
            <label>Estado del servicio</label>
            <select name="sltcestadoservicio">
                <option value="1">Habilitar servicio</option>
            </select>
        <?php } ?>
        <label>Imagen del servicio</label>
        <input type="file" name="imgservicio" id="imgservicio">
        <div class="container-editar_imagenServicio">
            <img src="../dashboard/img/servicio/<?php echo $v['imagen_servicio']; ?>">
        </div>
        <input type="submit" class="container-editar_btn" name="btnEditar" value="Actualizar datos">
        <input type="hidden" name="p" value="actualizar">
        <?php
        endforeach;
    endforeach;
    ?>
    </form>
</div>
<!--FIN del cont principal-->

<?php require_once "includes/parte_inferior.php"?>

<?php } ?>