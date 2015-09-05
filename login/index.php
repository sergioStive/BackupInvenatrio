<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<?PHP
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeUsuarios.php';
?>
<html>
    <head>
        <title>Inventario - Expertcob</title>
        <meta charset="UTF-8">
        <link type="image/png" rel="shortcut icon" href="../resources/imagenes/favicon.png">
        <link type="text/css" rel="stylesheet" href="../resources/css/index.css">
        <script type="text/javascript" src="../resources/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="../resources/js/jquery.validate.js"></script>
        <script type="text/javascript">
            $.validator.setDefaults({
            });
            $().ready(function () {
                // validate signup form on keyup and submit
                $("#signupForm").validate({
                    rules: {
                        txtDocumento: {
                            required: true,
                            number: true,
                            minlength: 7
                        },
                        txtContra: {
                            required: true,
                            minlength: 5
                        }
                    },
                    messages: {
                        txtDocumento: {
                            required: "Ingrese el número de documento",
                            number: "El campo debe tener números",
                            minlength: "Mínimo 7 numeros"
                        },
                        txtContra: {
                            required: "Por favor ingrese la contraseña",
                            minlength: "Mínimo 5 caracteres"
                        }
                    }
                });
            });
        </script>
    </head>
    <body>
        <?php
        $uDto = null;
        $mensaje = "";
        if (isset($_REQUEST['btnIngresar'])) {
            if ($_REQUEST['txtDocumento'] != "" && $_REQUEST['txtContra'] != "" && is_numeric($_REQUEST['txtDocumento'])) {
                $controlador = new ControladorGestionDeUsuarios();
                $uDto = $controlador->login($_REQUEST['txtDocumento'], $_REQUEST['txtContra']);
                if ($uDto != null) {
                    switch ($uDto->getIdRol()) {
                        case 1: {
                                session_start();
                                $_SESSION["USUARIO"] = $uDto->getNumeroDocumento();
                                $_SESSION["ROL"] = $uDto->getIdRol();
                                header('location:../administrador/index_admin.php');
                            }
                            break;
                        case 2: {
                                session_start();
                                $_SESSION["USUARIO"] = $uDto->getNumeroDocumento();
                                $_SESSION["ROL"] = $uDto->getIdRol();
                                header('location:../sistemas/index_sistem.php');
                            }
                            break;
                        case 3: {
                                session_start();
                                $_SESSION["USUARIO"] = $uDto->getNumeroDocumento();
                                $_SESSION["ROL"] = $uDto->getIdRol();
                                header('location:../consulta/index_consulta.php');
                            }
                            break;
                    }
                } else {
                    $mensaje = "Alguno de los datos es incorrecto";
                }
            }
        }
        ?>
        <div class="contenedor">
            <div class="logo"></div>
            <form class="formLogin" id="signupForm" action="index.php" method="post">
                <h3>Inicio de sesión</h3>
                <div id="msjIncorrecto">
                    <?php if ($mensaje != "") { ?>
                        <label>
                            <?php
                            echo $mensaje;
                            ?>
                        </label>
                        <?php
                    }
                    ?>
                </div>
                <table>
                    <tr>
                        <td>
                            <label for="txtDocumento">Número de documento: </label>
                        </td>
                        <td>
                            <input type="text" name="txtDocumento" id="txtDocumento" maxlength="12">
                            <label class="astx"> * </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="txtContra">Contraseña: </label>
                        </td>
                        <td>
                            <input type="password" name="txtContra" id="txtContra" maxlength="12">
                            <label class="astx"> * </label>
                        </td>
                    </tr>
                </table>
                <input type="submit" id="btnIngresar" name="btnIngresar" value="Entrar">
            </form>
        </div>


    </body>
</html>
