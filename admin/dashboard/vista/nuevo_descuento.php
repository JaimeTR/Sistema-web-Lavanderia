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
        <h2 class="icon-sort-numeric">Nuevo descuento</h2>
    </center>
<div class="container-editar">
    <form action="" method="get">
        <label>Código de descuento</label>
        <input type="text" placeholder="Código de descuento" required="required" maxlength="9" name="txtcodigodescuento">
        <label>Porcentaje de descuento</label>
        <input type="number" placeholder="Porcentaje de descuento" required="required" min="0" name="porcentajedescuento">
        <input type="submit" class="container-editar_btn" name="btnEditar" value="Registrar descuento">
        <input type="hidden" name="g" value="insertar">
    </form>
</div>
<!--FIN del cont principal-->

<?php require_once "includes/parte_inferior.php"?>

<?php } ?>