<?php 

    if(!empty($_POST)){

        if(empty($_POST['txtnombrecliente']) || empty($_POST['txtapellidocliente']) || empty($_POST['txtdirecciondomicilio']) || empty($_POST['txttelefonocliente']) || empty($_POST['txtcorreocliente']) || empty($_POST['txtnickcliente']) || empty($_POST['txtpasscliente'])) {

                echo "<script>alert('Error: Complete los campos');</script>";

        } else {

            require_once("conexion.php");

            $nombres = mysqli_real_escape_string($conection, $_POST['txtnombrecliente']);

            $apellidos = mysqli_real_escape_string($conection, $_POST['txtapellidocliente']);

            $direccion = mysqli_real_escape_string($conection, $_POST['txtdirecciondomicilio']);

            $telefono = mysqli_real_escape_string($conection, $_POST['txttelefonocliente']);

            $correo = mysqli_real_escape_string($conection, $_POST['txtcorreocliente']);

            $usuario = mysqli_real_escape_string($conection, $_POST['txtnickcliente']);

            $password = mysqli_real_escape_string($conection, $_POST['txtpasscliente']);

            $query = mysqli_query($conection, "SELECT * FROM cliente WHERE usuario_cliente = '$usuario' AND estado_cliente = 1");

            $respuesta = mysqli_num_rows($query);

            if ($respuesta > 0) {

                echo "<script>alert('Error: Nick de usuario repetido');</script>";

            } else {

                $passwordEncrypted = md5($password);

                $insert = mysqli_query($conection, "INSERT INTO cliente (id_cliente, nombre_cliente, apellido_cliente, telefono_cliente, direccion_cliente, email_cliente, usuario_cliente, password_cliente, tipo_cliente, estado_cliente) VALUES (null, '$nombres','$apellidos','$telefono','$direccion','$correo','$usuario','$passwordEncrypted',1,1)");

                mysqli_close($conection);

                if($insert == true){

                    echo "<script>alert('Cliente registrado');
                    window.location.href='index.php';</script>";

                } else {

                    echo "<script>alert('Error: Fallo en el registro');</script>";

                }

            }

        }

    }

?>
<!doctype html>
<html>
    <head>
        <link rel="shortcut icon" href="#" />
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Sistema de logeo</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">        
        <link rel="stylesheet" type="text/css" href="fuentes/iconic/css/material-design-iconic-font.min.css">
    </head>
    <body>
      <div class="container-login">
        <div class="wrap-login">
            <form class="login-form validate-form" id="formLogin" action="" method="POST">
                <span class="login-form-title">Registro</span>           
                </br>
                <div class="wrap-input100" data-validate = "Usuario incorrecto">
                    <input class="input100" type="text" name="txtnombrecliente" placeholder="Nombres completos">
                    <span class="focus-efecto"></span>
                </div>       
                <div class="wrap-input100" data-validate = "Usuario incorrecto">
                    <input class="input100" type="text" name="txtapellidocliente" placeholder="Apellidos completos">
                    <span class="focus-efecto"></span>
                </div>  
                <div class="wrap-input100" data-validate = "Usuario incorrecto">
                    <input class="input100" type="text" name="txtdirecciondomicilio" placeholder="Dirección de domicilio">
                    <span class="focus-efecto"></span>
                </div>  
                <div class="wrap-input100" data-validate = "Usuario incorrecto">
                    <input class="input100" type="text" name="txttelefonocliente" placeholder="Teléfono">
                    <span class="focus-efecto"></span>
                </div>  
                <div class="wrap-input100" data-validate = "Usuario incorrecto">
                    <input class="input100" type="text" name="txtcorreocliente" placeholder="Correo electrónico">
                    <span class="focus-efecto"></span>
                </div>  
                <div class="wrap-input100" data-validate = "Usuario incorrecto">
                    <input class="input100" type="text" name="txtnickcliente" placeholder="Nick de usuario">
                    <span class="focus-efecto"></span>
                </div>                
                <div class="wrap-input100" data-validate="Password incorrecto">
                    <input class="input100" type="password" name="txtpasscliente" placeholder="Contraseña">
                    <span class="focus-efecto"></span>
                </div>                
                <div class="container-login-form-btn">
                    <div class="wrap-login-form-btn">
                        <div class="login-form-bgbtn"></div>
                        <button type="submit" name="btnconectar" class="login-form-btn">Registrarse</button>
                    </div>
                </div>
            </form>
        </div>
    </div>     
     <script src="jquery/jquery-3.3.1.min.js"></script>    
     <script src="bootstrap/js/bootstrap.min.js"></script>    
     <script src="popper/popper.min.js"></script>    
     <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>    
     <script src="codigo.js"></script>    
    </body>
</html>