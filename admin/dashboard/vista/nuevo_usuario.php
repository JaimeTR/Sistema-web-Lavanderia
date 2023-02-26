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
        <h2 class="icon-user">Nuevo usuario</h2>
    </center>
<div class="container-editar">
    <form action="" method="get">
        <label>Nombre</label>
        <input type="text" placeholder="Nombre" maxlength="30" required="required" name="txtnombreusuario">
        <label>Apellido</label>
        <input type="text" placeholder="Apellido" maxlength="30" required="required" name="txtapellidousuario">
        <label>Email</label>
        <input type="text" placeholder="Email" maxlength="45" required="required" name="txtemailusuario">
        <label>Teléfono</label>
        <input type="text" placeholder="Teléfono" maxlength="9" required="required" name="txttelefonousuario">
        <label>Domicilio</label>
        <input type="text" placeholder="Dirección de domicilio" maxlength="100" required="required" name="txtdireccionusuario">
        <label>Nick de usuario</label>
        <input type="text" placeholder="Nick de usuario" maxlength="15" required="required" name="txtnickusuario">
        <label>Contraseña</label>
        <input type="password" placeholder="Contraseña" maxlength="15" required="required" name="txtpassusuario">
        <label>Tipo de usuario</label>
        <select name="sltctipousuario" class="container-select">
            <option value="1">Administrador</option>
            <option value="2">Recepcionista</option>
            <option value="3">Lavandero</option>
        </select>
        <input type="submit" class="container-editar_btn" name="btnEditar" value="Registrar usuario">
        <input type="hidden" name="g" value="nuevo_usuario">
    </form>
</div>
<!--FIN del cont principal-->

<?php require_once "includes/parte_inferior.php"?>

<?php } ?>