<?php

if (!empty($_POST)) {

    if (empty($_POST['txtnombreusuario']) || empty($_POST['txtapellidousuario'])  || empty($_POST['txttelefonousuario']) || empty($_POST['txtcorreousuario']) || empty($_POST['txtdireccionusuario']) || empty($_POST['txtnickusuario']) || empty($_POST['txtpassusuario'])) {

        echo "<script>alert('Error: Complete los campos');</script>";
    } else {

        require_once("conexion.php");

        $nombres = mysqli_real_escape_string($conection, $_POST['txtnombreusuario']);

        $apellidos = mysqli_real_escape_string($conection, $_POST['txtapellidousuario']);

        $correo = mysqli_real_escape_string($conection, $_POST['txtcorreousuario']);

        $telefono = mysqli_real_escape_string($conection, $_POST['txttelefonousuario']);

        $direccion = mysqli_real_escape_string($conection, $_POST['txtdireccionusuario']);

        $usuario = mysqli_real_escape_string($conection, $_POST['txtnickusuario']);

        $password = mysqli_real_escape_string($conection, $_POST['txtpassusuario']);

        $query = mysqli_query($conection, "SELECT * FROM usuario WHERE nick_usuario = '$usuario' AND estado_usuario = 1");

        $respuesta = mysqli_num_rows($query);

        if ($respuesta > 0) {

            echo "<script>alert('Error: Nick de usuario repetido');</script>";
        } else {

            $passwordEncrypted = md5($password);

            $insert = mysqli_query($conection, "INSERT INTO usuario (id_usuario, nombre_usuario, apellido_usuario, email_usuario, telefono_usuario, direccion_usuario, nick_usuario, password_usuario, rol_usuario, estado_usuario) VALUES (null, '$nombres','$apellidos','$telefono','$correo', '$direccion','$usuario','$passwordEncrypted',1,1)");

            mysqli_close($conection);

            if ($insert == true) {

                echo "<script>alert('usuario registrado');
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
                <span class="login-form-title">Registro_Admin</span>
                </br>
                <div class="wrap-input100" data-validate="Usuario incorrecto">
                    <input class="input100" type="text" name="txtnombreusuario" placeholder="Nombres completos">
                    <span class="focus-efecto"></span>
                </div>
                <div class="wrap-input100" data-validate="Usuario incorrecto">
                    <input class="input100" type="text" name="txtapellidousuario" placeholder="Apellidos completos">
                    <span class="focus-efecto"></span>
                </div>
                <div class="wrap-input100" data-validate="Usuario incorrecto">
                    <input class="input100" type="text" name="txttelefonousuario" placeholder="Teléfono">
                    <span class="focus-efecto"></span>
                </div>
                <div class="wrap-input100" data-validate="Usuario incorrecto">
                    <input class="input100" type="text" name="txtcorreousuario" placeholder="Correo electrónico">
                    <span class="focus-efecto"></span>
                </div>
                <div class="wrap-input100" data-validate="Usuario incorrecto">
                    <input class="input100" type="text" name="txtdireccionusuario" placeholder="Direccion">
                    <span class="focus-efecto"></span>
                </div>
                <div class="wrap-input100" data-validate="Usuario incorrecto">
                    <input class="input100" type="text" name="txtnickusuario" placeholder="Nick de usuario">
                    <span class="focus-efecto"></span>
                </div>
                <div class="wrap-input100" data-validate="Password incorrecto">
                    <input class="input100" type="password" name="txtpassusuario" placeholder="Contraseña">
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