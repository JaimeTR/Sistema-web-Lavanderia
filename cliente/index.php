<?php

session_start();

if (!empty($_SESSION['cliente_activo'])) {

    header("Location: dashboard/");
} else {

    if (!empty($_POST)) {

        if (empty($_POST['txtusuario']) || empty($_POST['txtpassword'])) {

            echo "<script>alert('Error: Complete los campos');</script>";
        } else {

            require_once("conexion.php");

            $usuario = mysqli_real_escape_string($conection, $_POST['txtusuario']);

            $password = md5(mysqli_real_escape_string($conection, $_POST['txtpassword']));

            $query = mysqli_query($conection, "SELECT * FROM cliente WHERE usuario_cliente = '$usuario' AND password_cliente = '$password' AND estado_cliente = 1");

            mysqli_close($conection);

            $respuesta = mysqli_num_rows($query);

            if ($respuesta > 0) {

                $datos = mysqli_fetch_array($query);

                $_SESSION['cliente_activo'] = true;

                $_SESSION['id_cliente'] = $datos['id_cliente'];

                $_SESSION['nombre_cliente'] = $datos['nombre_cliente'];

                $_SESSION['apellido_cliente'] = $datos['apellido_cliente'];

                $_SESSION['direccion_cliente'] = $datos['direccion_cliente'];

                $_SESSION['telefono_cliente'] = $datos['telefono_cliente'];

                $_SESSION['email_cliente'] = $datos['email_cliente'];

                $_SESSION['usuario_cliente'] = $datos['usuario_cliente'];

                $_SESSION['password_cliente'] = $datos['password_cliente'];

                $_SESSION['tipo_cliente'] = $datos['tipo_cliente'];

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
                <span class="login-form-title">Login_</span>

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
                    Si no tienes una cuenta puede
                    <a href="registro.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
                        Registrarse
                        <i class="zmdi zmdi-long-arrow-right m-l-5"></i>
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