<?php

session_start();

if (!empty($_SESSION['active'])) {

    header("Location: dashboard/");
} else {

    if (!empty($_POST)) {

        if (empty($_POST['txtusuario']) || empty($_POST['txtpassword'])) {

            echo "<script>alert('Error: Complete los campos');</script>";
        } else {

            require_once("conexion.php");

            $usuario = mysqli_real_escape_string($conection, $_POST['txtusuario']);

            $password = md5(mysqli_real_escape_string($conection, $_POST['txtpassword']));

            $query = mysqli_query($conection, "SELECT * FROM usuario WHERE nick_usuario = '$usuario' AND password_usuario = '$password' AND estado_usuario = 1");

            mysqli_close($conection);

            $respuesta = mysqli_num_rows($query);

            if ($respuesta > 0) {

                $datos = mysqli_fetch_array($query);

                $_SESSION['active'] = true;

                $_SESSION['id_usuario'] = $datos['id_usuario'];

                $_SESSION['nick_usuario'] = $datos['nick_usuario'];

                $_SESSION['nombre_usuario'] = $datos['nombre_usuario'];

                $_SESSION['password_usuario'] = $datos['password_usuario'];

                $_SESSION['rol_usuario'] = $datos['rol_usuario'];

                header('Location: dashboard/ ');
            } else {

                echo "<script>alert('Error: Usuario incorrecto o inexistente');</script>";

                session_destroy();
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
                <span class="login-form-title">Login_Admin</span>

                <div class="wrap-input100" data-validate="Usuario incorrecto">
                    <input class="input100" type="text" name="txtusuario" placeholder="Usuario">
                    <span class="focus-efecto"></span>
                </div>

                <div class="wrap-input100" data-validate="Password incorrecto">
                    <input class="input100" type="password" name="txtpassword" placeholder="Password">
                    <span class="focus-efecto"></span>
                </div>

                <div class="container-login-form-btn">
                    <div class="wrap-login-form-btn">
                        <div class="login-form-bgbtn"></div>
                        <button type="submit" name="btnconectar" class="login-form-btn">CONECTARSE</button>
                    </div>
                    Si no tienes una cuenta <a href="registroadmin.php"> Registrate</a>

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