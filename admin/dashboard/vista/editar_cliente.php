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
        <h2 class="icon-users"> Editar cliente</h2>
    </center>
<div class="container-editar">
    <form action="" method="get">
    <?php
    foreach($dato as $key => $value):
        foreach($value as $v):
        ?>
        <label>Nombre</label>
        <input type="text" required="required" maxlength="30" value="<?php echo $v['nombre_cliente'] ?>" name="txtnombrecliente">
        <label>Apellido</label>
        <input type="text" required="required" maxlength="30" value="<?php echo $v['apellido_cliente'] ?>" name="txtapellidocliente">
        <label>Email</label>
        <input type="text" required="required" maxlength="45" value="<?php echo $v['email_cliente'] ?>" name="txtemailcliente">
        <label>Teléfono</label>
        <input type="text" required="required" maxlength="9" value="<?php echo $v['telefono_cliente'] ?>" name="txttelefonocliente">
        <label>Domicilio</label>
        <input type="text" required="required" maxlength="100" value="<?php echo $v['direccion_cliente'] ?>" name="txtdireccioncliente">
        <label>Nick de cliente</label>
        <input type="text" required="required" maxlength="15" value="<?php echo $v['usuario_cliente'] ?>" name="txtnickcliente">
        <label>Contraseña</label>
        <input type="password" required="required" maxlength="15" placeholder="Digite contraseña" name="txtpasscliente">
        <?php if($v['tipo_cliente'] == 1) {
            echo "<label>Tipo de cliente</label>
            <select name=slcttipocliente class=container-select>
                    <option value=".$v['tipo_cliente'].">Socio</option>
                    <option value=2>Cliente normal</option>
            </select>";
        } elseif($v['tipo_cliente'] == 2) {
            echo "<label>Tipo de cliente</label>
            <select name=slcttipocliente class=container-select>
                    <option value=".$v['tipo_cliente'].">Cliente normal</option>
                    <option value=1>Socio</option>
            </select>";
        } ?>
        <?php if($v['estado_cliente'] == 0) {
            echo "<label>Tipo de cliente</label>
            <select name=slctestado class=container-select>
                    <option value=".$v['estado_cliente'].">Deshabilitado</option>
                    <option value=1>Habilitar Cliente</option>
            </select>";
        } elseif($v['estado_cliente'] == 1) {
            echo "<input type=hidden name=slctestado value=1>";
        } ?>
        <input type="hidden" value="<?php echo $v['id_cliente'] ?>" name="txtidcliente">
        <input type="submit" class="container-editar_btn" name="btnEditar" value="Actualizar datos">
        <input type="hidden" name="g" value="actualizar">
        <?php
        endforeach;
    endforeach;
    ?>
    </form>
</div>
<!--FIN del cont principal-->

<?php require_once "includes/parte_inferior.php"?>

<?php } ?>