<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<html>
    <head>
        <title>Inventario - Expertcob</title>
        <meta charset="UTF-8">
        <link type="image/png" rel="shortcut icon" href="../resources/imagenes/favicon.png">
        <link type="text/css" rel="stylesheet" href="../resources/css/index.css">
    </head>
    <body>
        <?php
        session_start(); // inicio la sesión
        if (!isset($_SESSION["usuario"]) && !isset($_SESSION["rol"])) {//valido si no existen las variables usuario y rol en la sesión
            header('location:../login/index.php'); //si no existen redirecciono a la página de login
        } else {//si existen las variables usuasrio y rol
            if ($_SESSION["rol"] != "2") {//valido si el rol no es igual a 2 que es el correspondiente al rol sistemas
                header('location:../login/index.php'); //redirecciono a la página de login
            }
        }
        ?>

        <div class="contenedor">

            <?php include './barra_navegacion_sistemas.html'; ?>

            <div class="cuerpo">              

            </div>
        </div>
    </body>
</html>
