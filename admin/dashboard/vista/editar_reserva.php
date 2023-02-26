<?php

    if(empty($_SESSION['active'])) {

        header('Location: ../');

    } elseif($_SESSION['rol_usuario'] == 3){

        header('Location: ordenes_delivery.php');

    } else {

        require_once "includes/parte_superior.php";

?>
<!--INICIO del cont principal-->
<div class="container">
    <center>
        <h2 class="icon-pencil-squared">Editar reserva</h2>
    </center> 
<div class="container-editar">
	<form action="" method="get">
    <?php
    foreach($reservas as $key => $v_reservas):
        foreach($v_reservas as $v_r): ?>
        <?php if($v_r['estado_reserva'] == 2) { echo ""; ?>
            <label>Fecha de reserva</label>
            <input type="date" disabled="disabled" value="<?php echo $v_r['fecha_reserva'] ?>">
            <label>Código de reserva</label>                
            <input type="text" disabled="disabled" value="<?php echo $v_r['codigo_reserva'] ?>">
            <label>Nombre de cliente</label>
            <input type="text" disabled="disabled" value="<?php echo $v_r['nombre_cliente'] ?>">
            </br>
            <center>Operación terminada</center>
            </br>
        <?php } elseif($v_r['estado_reserva'] == 1) { ?>
            <label>Fecha de registro</label>
            <input type="date" name="txtfecharegistro" disabled="disabled" value="<?php echo $v_r['fecha_reserva'] ?>">
            <label>Fecha de Recojo</label>
            <input type="date" disabled="disabled" value="<?php echo $v_r['fecha_recojo'] ?>">
            <label>Fecha de envío</label>
            <input type="date" disabled="disabled" value="<?php echo $v_r['fecha_envio'] ?>">
            <label>Código de reserva</label>
            <input type="text" disabled="disabled" value="<?php echo $v_r['codigo_reserva'] ?>">
            <label>Cliente</label>
            <input type="text" disabled="disabled" value="<?php echo $v_r['nombre_cliente'] ?>">
            <?php if($_SESSION['rol_usuario'] == 2){
                    if($v_r['estado_reserva'] == 1) {
                    echo "<label>Acción</label>
                    <select name=slctestadodelivery class=container-select>
                            <option value=0>Tomar orden</option>
                    </select>";
                    }
                } elseif($_SESSION['rol_usuario'] == 1){ ?>
                    <label>Acción</label>
                    <select name=slctestadodelivery class=container-select>
                            <option value=0>Tomar orden</option>
                    </select>
                    <label>Seleccione recepcionista encargado</label>
                    <select name="slctrecepcionista">
                    <?php foreach($recepcionistas as $key => $v_recepcionistas){
                        foreach($v_recepcionistas as $v_rec){ ?>
                            <option value="<?php echo $v_rec['id_usuario']; ?>"><?php echo $v_rec['nombre_usuario']; ?></option>
                    <?php }
                    }
                } ?></select>             
            <input type="hidden" value="<?php echo $v_r['codigo_reserva'] ?>" name="txtcodigoreserva">
            <input type="hidden" value="<?php echo $v_r['id_reserva'] ?>" name="txtidreserva">
            <input type="hidden" name="txtfecharecojo" value="<?php echo $v_r['fecha_recojo']; ?>">
            <input type="hidden" name="txtfechaenvio" value="<?php echo $v_r['fecha_envio']; ?>">
            <input type="submit" class="container-editar_btn" name="btnEditar" value="Generar orden de delivery">
            <input type="hidden" name="g" value="actualizar">
    <?php }
        endforeach;
    endforeach; ?>
	</form>
</div>
<!--FIN del cont principal-->

<?php require_once "includes/parte_inferior.php"?>

<?php } ?>