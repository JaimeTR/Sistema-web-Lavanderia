<?php  

    if(empty($_SESSION['active'])) {

        header('Location: ../');

    } elseif($_SESSION['rol_usuario'] == 2 && $_SESSION['id_usuario'] != $id_usuario){

        header('Location: reservas.php');

    } elseif($_SESSION['rol_usuario'] == 3 && $_SESSION['id_usuario'] != $id_usuario){

        header('Location: ordenes_delivery.php');

    } else {

        require_once "includes/parte_superior.php";

?>
<div class="container">
    <center>
        <h2 class="icon-user">Editar usuario</h2>
    </center>
<div class="container-editar">
	<form action="" method="get">
    <?php
    foreach($dato as $key => $value):
        foreach($value as $v):
        ?>
        <label>Nombre</label>
        <input type="text" required="required" maxlength="30" value="<?php echo $v['nombre_usuario'] ?>" name="txtnombre">
        <label>Apellido</label>
        <input type="text" required="required" maxlength="30" value="<?php echo $v['apellido_usuario'] ?>" name="txtapellido">
        <label>Email</label>
        <input type="text" required="required" maxlength="45" value="<?php echo $v['email_usuario'] ?>" name="txtemail">
        <label>Teléfono</label>
        <input type="text" required="required" maxlength="9" value="<?php echo $v['telefono_usuario'] ?>" name="txttelefono">
        <label>Domicilio</label>
        <input type="text" required="required" maxlength="100" value="<?php echo $v['direccion_usuario'] ?>" name="txtdireccion">
        <label>Nick de usuario</label>
        <input type="text" required="required" maxlength="15" value="<?php echo $v['nick_usuario'] ?>" name="txtnickusuario">
        <label>Contraseña</label>
        <input type="password" required="required" maxlength="15" placeholder="Digite contraseña" name="txtpassusuario">
        <?php if($_SESSION['rol_usuario'] == 2){
            echo "";
        } elseif($v['rol_usuario'] == 1) {
            echo "<label>Rol</label>
            <select name=slctrol>
                    <option value=".$v['rol_usuario'].">Administrador</option>
                    <option value=2>Recepcionista</option>
                    <option value=3>Lavandero</option>
            </select>";
        } elseif($v['rol_usuario'] == 2) {
            echo "<label>Rol</label>
            <select name=slctrol>
                    <option value=".$v['rol_usuario'].">Recepcionista</option>
                    <option value=3>Lavandero</option>
                    <option value=1>Administrador</option>
            </select>";
        } elseif($v['rol_usuario'] == 3) {
            echo "<label>Rol</label>
            <select name=slctrol>
                    <option value=".$v['rol_usuario'].">Lavandero</option>
                    <option value=2>Recepcionista</option>
                    <option value=1>Administrador</option>
            </select>";
        } ?>
        <?php if($v['estado_usuario'] == 0) {
            echo "<label>Rol</label>
            <select name=slctestado>
                    <option value=".$v['estado_usuario'].">Deshabilitado</option>
                    <option value=1>Habilitar usuario</option>
            </select>";
        } elseif($v['estado_usuario'] == 1) {
            echo "<input type=hidden name=slctestado value=1>";
        } ?>
        <input type="hidden" value="<?php echo $v['id_usuario'] ?>" name="txtidusuario">
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