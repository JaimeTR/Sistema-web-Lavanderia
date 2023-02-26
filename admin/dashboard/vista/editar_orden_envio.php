<?php 

    if(empty($_SESSION['active'])) {

        header('Location: ../');

    } else {

        require_once "includes/parte_superior.php";

?>
<!--INICIO del cont principal-->
<div class="container">
    <center>
        <h2 class="icon-location">Editar orden de envío</h2>
    </center>
<div class="container-editar">
	<form action="" method="POST">
        <?php if(!empty($orden_envio)){
                foreach($orden_envio as $key => $v_orden_envio){
                    foreach($v_orden_envio as $v_od){ ?>
                        <?php if($_SESSION['rol_usuario'] == 1 || $_SESSION['id_usuario'] == $v_od['id_usuario']){ ?>
            <label>Código de reserva</label>
            <input type="text" disabled="disabled" value="<?php echo $v_od['codigo_reserva']; ?>">
            <label>Nombres cliente</label>
            <input type="text" disabled="disabled" value="<?php echo $v_od['nombre_cliente']; ?>">
            <label>Apellidos cliente</label>
            <input type="text" disabled="disabled" value="<?php echo $v_od['apellido_cliente']; ?>">
            <label>Fecha de envío</label>
            <input type="text" disabled="disabled" value="<?php echo $v_od['fecha_envio']; ?>">
            <label>Dirección</label>
            <input type="text" disabled="disabled" value="<?php echo $v_od['direccion_cliente']; ?>">
            <?php if($v_od['estado_envio'] == 0){ ?>
            <label>Estado</label>
            <select name="sltcestadoenvio" id="estado_envio" onchange="prendas_enviadas()">
                <option value="0">Pendiente de envío</option>
                <option value="1">Prendas enviadas</option>
            </select></br>
            <input type="hidden" name="p" value="actualizar">
            <input type="hidden" value="<?php echo $v_od['id_envio']; ?>" name="txtidenvio">
            <input type="hidden" value="<?php echo $v_od['codigo_reserva']; ?>" name="txtcodigoreserva">
            <input type="submit" id="boton_editar" name="btnactualizar" value="Actualizar orden">
            <?php } else {
                echo "</br><center>Proceso completo</center></br>"; ?>
            <?php }
                    } else {
                        echo "</br><center>Este registro no pertenece a este usuario</center></br>";
                    }
                } 
            }
        } ?>
	</form>
</div>
<!--FIN del cont principal-->

<?php require_once "includes/parte_inferior.php"?>

<?php } ?>