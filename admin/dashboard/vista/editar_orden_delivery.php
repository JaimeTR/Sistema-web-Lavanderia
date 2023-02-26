<?php 

    if(empty($_SESSION['active'])) {

        header('Location: ../');

    } else {

        require_once "includes/parte_superior.php";

?>
<!--INICIO del cont principal-->
<div class="container">
    <center>
        <h2 class="icon-location">Editar orden de delivery</h2>
    </center>
<div class="container-editar">
	<form action="" method="GET">
    <?php
    foreach($ordenes_delivery as $key => $v_ordenes_delivery):
        foreach($v_ordenes_delivery as $vd):
            if($_SESSION['id_usuario'] == $vd['id_usuario']){ ?>
                    <label>Código de reserva</label>
                    <input type="text" disabled="disabled" value="<?php echo $vd['codigo_reserva'] ?>">
                    <label>Recepcionista</label>
                    <input type="text" disabled="disabled" value="<?php echo $vd['nombre_usuario'] ?>">
                    <label>Fecha de recojo</label>
                    <input type="text" disabled="disabled" value="<?php echo $vd['fecha_recojo'] ?>">
                    <label>Fecha de envío</label>
                    <input type="text" disabled="disabled" value="<?php echo $vd['fecha_envio']; ?>">
                <?php if($vd['estado_delivery'] == 0) { ?>
                    <label>Estado de la orden</label>
                    <select name="estado_delivery" id="estado_delivery" class="container-select" onchange="prendas_recojidas()">
                        <option value="<?php echo $vd['estado_delivery'] ?>">Pendiente de recojo</option>
                        <option value=1>Recojido</option>
                    </select><br>
                    <input type="hidden" value="<?php echo $vd['id_delivery'] ?>" name="id_delivery">
                    <input type="submit" class="container-editar_btn" name="btnEditar" value="Actualizar datos" id="boton_editar">
                    <input type="hidden" name="g" value="actualizar">
                <?php } elseif($vd['estado_delivery'] == 1) { ?>
                    <label>Estado de la orden</label>
                    <select name="estado_delivery" class="container-select">
                        <option value="<?php echo $vd['estado_delivery'] ?>">Recojido y en proceso de lavado</option>
                        <option value=2>Lavado y sin orden de envío</option>
                    </select>
                    <input type="hidden" value="<?php echo $vd['id_delivery'] ?>" name="id_delivery">
                    <input type="hidden" name="txthorarecojido" value="<?php echo $vd['hora_recojido']; ?>">
                    <input type="submit" class="container-editar_btn" name="btnEditar" value="Actualizar datos" id="boton_editar">
                    <input type="hidden" name="g" value="actualizar">
                <?php } elseif($vd['estado_delivery'] == 2) { ?>
                    <label>Estado de la orden</label>
                    <select name="estado_delivery" class="container-select">
                        <option value="<?php echo $vd['estado_delivery'] ?>">Lavado y sin orden de envío</option>
                        <option value=3>Generar orden de envío</option>
                    </select>
                    <input type="hidden" value="<?php echo $vd['id_usuario']; ?>" name="txtidrecepcionista" >
                    <input type="hidden" value="<?php echo $vd['id_delivery'] ?>" name="id_delivery">
                    <input type="hidden" value="<?php echo $vd['hora_recojido']; ?>" name="txthorarecojido">
                    <input type="hidden" value="<?php echo $vd['fecha_envio']; ?>" name="txtfechaenvio">
                    <input type="submit" class="container-editar_btn" name="btnEditar" value="Actualizar datos" id="boton_editar">
                    <input type="hidden" name="g" value="actualizar">        
                <?php }                
            } elseif($_SESSION['rol_usuario'] == 1 || $_SESSION['rol_usuario'] == 3){ ?>
                    <label>Código de reserva</label>
                    <input type="text" disabled="disabled" value="<?php echo $vd['codigo_reserva'] ?>">
                    <label>Recepcionista</label>
                    <input type="text" disabled="disabled" value="<?php echo $vd['nombre_usuario'] ?>">
                    <label>Fecha de recojo</label>
                    <input type="text" disabled="disabled" value="<?php echo $vd['fecha_recojo'] ?>">
                    <label>Fecha de envío</label>
                    <input type="text" disabled="disabled" value="<?php echo $vd['fecha_envio']; ?>">
                <?php if($vd['estado_delivery'] == 0) {
                    echo "</br><center>Este registro no está disponible para este usuario</center></br>";
                ?>                    
                <?php } elseif($vd['estado_delivery'] == 1) { ?>
                    <label>Estado de la orden</label>
                    <select name="estado_delivery" class="container-select">
                        <option value="<?php echo $vd['estado_delivery'] ?>">Recojido y en proceso de lavado</option>
                        <option value=2>Lavado y sin orden de envío</option>
                    </select>
                    <input type="hidden" value="<?php echo $vd['id_delivery'] ?>" name="id_delivery">
                    <input type="hidden" name="txthorarecojido" value="<?php echo $vd['hora_recojido']; ?>">
                    <input type="submit" class="container-editar_btn" name="btnEditar" value="Actualizar datos" id="boton_editar">
                    <input type="hidden" name="g" value="actualizar">
                <?php } elseif($vd['estado_delivery'] == 2) { ?>
                    <label>Estado de la orden</label>
                    <select name="estado_delivery" id="estado_delivery" class="container-select">
                        <option value=3>Generar orden de envío</option>
                    </select>
                    <label>Seleccione recepcionista</label>
                    <select name="slctrecepcionista">
                        <?php foreach($datos_recepcionista as $key => $v_recepcionista):
                        foreach($v_recepcionista as $vr_2): ?>
                            <option value="<?php echo $vr_2['id_usuario']; ?>"><?php echo $vr_2['nombre_usuario']; ?></option>
                            <?php endforeach;
                        endforeach; ?>
                    </select>
                    <input type="hidden" value="<?php echo $vd['id_delivery']; ?>" name="id_delivery">
                    <input type="hidden" name="txthorarecojido" value="<?php echo $vd['hora_recojido']; ?>">
                    <input type="hidden" name="txtfechaenvio" value="<?php echo $vd['fecha_envio']; ?>">
                    <input type="submit" class="container-editar_btn" name="btnEditar" value="Actualizar datos" id="boton_editar">
                    <input type="hidden" name="g" value="actualizar">   
                <?php }           
            } else {
                echo "</br><center>Este registro no está disponible para este usuario</center></br>";
            }
        endforeach;
    endforeach; ?>
	</form>
</div>
<!--FIN del cont principal-->

<?php require_once "includes/parte_inferior.php"?>

<?php } ?>