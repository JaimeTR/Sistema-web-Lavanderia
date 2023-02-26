<?php

    if(empty($_SESSION['active'])) {

        header('Location: ../');

    } elseif($_SESSION['rol_usuario'] == 2){

        header('Location: reservas.php');

    } else {

        require_once "includes/parte_superior.php";

?>
<!--INICIO del cont principal-->
<div class="container">
    <center>
        <h2 class="icon-briefcase">Nuevo servicio</h2>
    </center>
<div class="container-editar">
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Nombre de prenda</label>
        <input type="text" placeholder="Nombre de la prenda" required="required" maxlength="20" name="txtdescripcionprenda">
        <label>Precio lavado x unidad</label>
        <input type="number" placeholder="Precio del servicio" required="required" min="0" name="precioservicio">
        <label>Imagen del servicio</label>
        <input type="file" name="imgservicio" id="imgservicio">
        <input type="submit" class="container-editar_btn" name="btnEditar" value="Registrar servicio">
        <input type="hidden" name="p" value="insertar">
    </form>
</div>
<!--FIN del cont principal-->

<?php require_once "includes/parte_inferior.php"?>

<?php } ?>