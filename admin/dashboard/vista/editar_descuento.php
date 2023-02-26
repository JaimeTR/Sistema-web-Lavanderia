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
        <h2 class="icon-sort-number-down">Editar cupón de descuento</h2>
    </center>
<div class="container-editar">
    <form method="POST">
    <?php
    foreach($dato as $key => $value):
        foreach($value as $v):
        ?>
        <?php if($v['estado_descuento'] > 0){ ?>
        <label>Código de descuento</label>
        <input type="text" required="required" maxlength="9" value="<?php echo $v['codigo_descuento'] ?>" name="txtcodigodescuento">
        <label>Porcentaje de descuento</label>
        <input type="number" required="required" min="0" max="50" value="<?php echo $v['porcentaje_descuento'] ?>" name="txtporcentajedescuento">
        <input type="hidden" value="<?php echo $_GET['id_descuento']; ?>" name="txtiddescuento">
        <?php } elseif($v['estado_descuento'] == 0){ ?>
            <label>Código de descuento</label>
            <input type="text" name="txtcodigodescuento" required="required" value="<?php echo $v['codigo_descuento'] ?>">
            <label>Porcentaje de descuento</label>
            <input type="number" name="txtporcentajedescuento" required="required" min="0" max="50" value="<?php echo $v['porcentaje_descuento'] ?>">
            <label>Estado del descuento</label>
            <select name="sltcestadodescuento">
                <option value="1">Habilitar descuento</option>
            </select>
            <input type="hidden" value="<?php echo $_GET['id_descuento']; ?>" name="txtiddescuento">
        <?php }
        endforeach;
    endforeach;
    ?>
        <input type="submit" class="container-editar_btn" name="btnEditar" value="Actualizar datos">
        <input type="hidden" name="p" value="actualizar">
    </form>
</div>
<!--FIN del cont principal-->

<?php require_once "includes/parte_inferior.php"?>

<?php } ?>