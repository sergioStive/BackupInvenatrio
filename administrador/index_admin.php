<?php session_start(); // inicio la sesión  ?>
<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<html>
    <head>
        <title>Inventario - Expertcob</title>
        <meta charset="UTF-8">
        <link type="image/png" rel="shortcut icon" href="../resources/imagenes/favicon.png">
        <link type="text/css" rel="stylesheet" href="../resources/css/administrador.css">
    </head>
    <body>

        <?php
        if (!isset($_SESSION["USUARIO"]) && !isset($_SESSION["ROL"])) {//valido si no existen las variables usuario y rol en la sesión
            header('location:../login/index.php'); //si no existen redirecciono a la página de login
        } else {//si existen las variables usuasrio y rol
            if ($_SESSION["ROL"] != "1") {//valido si el rol no es igual a 1 que es el correspondiente al administrador
                header('location:../login/index.php'); //redirecciono a la página de login
            }
        }

        if (isset($_REQUEST['se']) && $_REQUEST['se'] == "closed") {//valido si existe un parametro llamado 'se' y es igual a 'closed' 
            session_unset(); //destruyo los objetos guardados en la sesión
            session_destroy(); //destruyo la sesión
            header("location:../login/index.php"); //redirecciono a la página de logueo
        }
        ?>

        <div class="contenedor">

            <?php include './barra_navegacion_admin.html'; ?>

            <div class="cuerpo">       
                <?php
                echo "Hola Erick";
                ?>
            </div>
        </div>
    </body>
</html>
