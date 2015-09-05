<?php session_start(); //inicio de la sesión ?>

<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<?php
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeUsuarios.php';
?>

<html>
    <head>
        <title>Inventario - Expertcob</title>
        <meta charset="UTF-8">
        <link type="image/png" rel="shortcut icon" href="../resources/imagenes/favicon.png">
        <link type="text/css" rel="stylesheet" href="../resources/css/administrador.css">
        <script type="text/javascript" src="../resources/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="../resources/js/jquery.validate.js"></script>
        <script>
            $.validator.setDefaults({
            });

            $().ready(function () {
                // validate signup form on keyup and submit
                $("#signupForm").validate({
                    rules: {
                        txtContrasenaActual: {
                            required: true,
                            minlength: 5
                        },
                        txtContrasenaNueva: {
                            required: true,
                            minlength: 5
                        },
                        txtContrasenaNuevaD: {
                            required: true,
                            minlength: 5,
                            equalTo: "#txtContrasenaNueva"
                        }
                    },
                    messages: {
                        txtContrasenaActual: {
                            required: "Ingrese su contraseña actual",
                            minlength: "Minimo 5 caracteres"
                        },
                        txtContrasenaNueva: {
                            required: "Ingrese su nueva contraseña",
                            minlength: "Minimo 5 caracteres"
                        },
                        txtContrasenaNuevaD: {
                            required: "Repita su nueva contraseña",
                            minlength: "Minimo 5 caracteres",
                            equalTo: "Las contraseña no concide"
                        }
                    }
                });
            });
        </script>
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
        ?>

        <div class="contenedor">

            <?php
            include './barra_navegacion_admin.html';
            ?>

            <div class="cuerpo"> 

                <?php
                $controlador = new ControladorGestionDeUsuarios();

                if (isset($_REQUEST['btnCambiar'])) {
                    if (isset($_REQUEST['txtContrasenaActual']) && isset($_REQUEST['txtContrasenaNueva']) && $_REQUEST['txtContrasenaActual'] != "" && $_REQUEST['txtContrasenaNueva'] != "") {
                        $id = $_SESSION['USUARIO'];
                        $uDto = $controlador->verUsuarioPorContraseña($_REQUEST['txtContrasenaActual'], $id);
                        if ($uDto != null) {
                            echo $controlador->cambiarContraseña($id, $_REQUEST['txtContrasenaNueva']);
                            ?>

                            <script>
                                var segundos = 3;
                                var direccion = 'cambiar_contrasena.php';
                                milisegundos = segundos * 1000;
                                window.setTimeout("window.location.replace(direccion);", milisegundos);
                            </script>

                            <?php
                        } else {
                            ?>

                            <div class="notificacion">
                                <div class="mensaje">
                                    <h2>Inventario Expertcob</h2>
                                    <?php echo "La contraseña antigua es incorrecta"; ?>
                                </div>
                            </div>
                            <script>
                                var segundos = 3;
                                var direccion = 'cambiar_contrasena.php?ca=c';
                                milisegundos = segundos * 1000;
                                window.setTimeout("window.location.replace(direccion);", milisegundos);
                            </script>

                            <?php
                        }
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "cambiar_contrasena.php?ca=c";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['ca']) && $_REQUEST['ca'] == "c") {
                    ?>

                    <form class="formRegistrarUsuario" id="signupForm" action="cambiar_contrasena.php" method="post">
                        <h3 style="color: #6495ED; font-family: 'arial';">Cambio de contraseña</h3>
                        <hr>
                        <table>
                            <tr>
                                <td>
                                    <label for="txtContrasenaActual">Contraseña actual:</label>
                                </td>
                                <td>
                                    <input type="password" id="txtContrasenaActual" name="txtContrasenaActual" maxlength="15">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="txtContrasenaNueva">Contraseña nueva:</label>
                                </td>
                                <td>
                                    <input type="password" id="txtContrasenaNueva" name="txtContrasenaNueva" maxlength="15">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="txtContrasenaNuevaD">Repita la contraseña nueva:</label>
                                </td>
                                <td>
                                    <input type="password" id="txtContrasenaNuevaD" name="txtContrasenaNuevaD" maxlength="15">
                                </td>
                            </tr>
                        </table>
                        <input type="submit" name="btnCambiar" value="Cambiar">
                    </form>

                    <?php
                } else {
                    ?>

                    <script>
                        location.href = "index_admin.php";
                    </script>

                    <?php
                }
                ?>

            </div>
        </div>
    </body>
</html>