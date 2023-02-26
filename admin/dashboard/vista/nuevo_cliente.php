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
        <h2 class="icon-users"> Nuevo cliente</h2>
    </center>
<div class="container-editar">
    <form action="" method="get">
        <label>Nombre</label>
        <input type="text" placeholder="Nombre" required="required" maxlength="30" name="txtnombrecliente">
        <label>Apellido</label>
        <input type="text" placeholder="Apellido" required="required" maxlength="30" name="txtapellidocliente">
        <label>Teléfono</label>
        <input type="text" placeholder="Teléfono" required="required" maxlength="9" name="txttelefonocliente">
        <label>Domicilio</label>
        <input type="text" placeholder="Dirección de domicilio" required="required" maxlength="100" name="txtdireccioncliente">
        <label>Email</label>
        <input type="text" placeholder="Email" required="required" maxlength="45" name="txtemailcliente">
        <label>Nick de usuario</label>
        <input type="text" placeholder="Nick de cliente" required="required" maxlength="15" name="txtnickcliente">
        <label>Contraseña</label>
        <input type="password" placeholder="Contraseña" required="required" maxlength="15" name="txtpasscliente">
        <label>Tipo de cliente</label>
        <select name="sltctipocliente" class="container-select">
            <option value="2">Cliente normal</option>
            <option value="1">Socio</option>
        </select>
        <input type="submit" class="container-editar_btn" name="btnEditar" value="Registrar cliente">
        <input type="hidden" name="g" value="nuevo_cliente">
    </form>
</div>
<!--FIN del cont principal-->

<?php require_once "includes/parte_inferior.php"?>

<?php } ?>