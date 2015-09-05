<?php session_start(); //inicio de sesión         ?>

<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<?php
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeDispositivos.php';
?>

<html>
    <head>
        <title>Inventario - Expertcob</title>
        <meta charset="UTF-8">
        <link type="image/png" rel="shortcut icon" href="../resources/imagenes/favicon.png">
        <link type="text/css" rel="stylesheet" href="../resources/css/administrador.css">
        <script type="text/javascript" src="../resources/js/jquery-1.10.2.js"></script>
        <script type="text/javascript" src="../resources/js/jquery-ui.js"></script>
        <script>
            $(function () {
                $("#desplegable").accordion({
                    collapsible: true
                });
            });
        </script>    
        <script>
            function cargar(link) {
                window.open(link);
            }
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

            <?php include './barra_navegacion_admin.html'; ?>

            <div class="cuerpo"> 

                <?php
                $controladorDispositivos = new ControladorGestionDeDispositivos();

                if (isset($_REQUEST['btnRegistrar'])) {
                    if (isset($_REQUEST['txtMantenimiento']) && isset($_REQUEST['txtDispositivo']) && $_REQUEST['txtMantenimiento'] != "" && $_REQUEST['txtDispositivo'] != "") {
                        echo $controladorDispositivos->registrarRevision($_REQUEST['txtMantenimiento'], $_REQUEST['txtObservacion'], $_REQUEST['txtDispositivo']);
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = 'revisiones.php?di=<?php echo $_REQUEST['txtDispositivo']; ?>';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "revisiones.php?di=<?php echo $_REQUEST['txtDispositivo']; ?>";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['di']) && is_numeric($_REQUEST['di'])) {
                    $oficina = "sucursales.php?su=v";
                    if (isset($_SESSION['oficina'])) {
                        $num = $_SESSION['oficina'];
                        $oficina = "dispositivos.php?of=$num";
                    }
                    $dispositivo = $controladorDispositivos->verDispositivo($_REQUEST['di']);
                    if ($dispositivo != null) {
                        $revisiones = $controladorDispositivos->verRevisionesPorDispositivo($_REQUEST['di']);
                        ?>

                        <form class="formRevision" action="revisiones.php" method="post">
                            <h3 style="color: #6495ED; font-family: 'arial';">Registre una nueva revisión</h3>
                            <hr>
                            <table>
                                <tr>
                                    <td><input type="text" name="txtDispositivo" value="<?php echo $_REQUEST['di']; ?>" readonly="true" hidden="true"></td>
                                </tr>
                                <tr>
                                    <td><lable for="txtMantenimiento">Tipo de mantenimiento: </lable></td>
                                <td>
                                    <select name="txtMantenimiento" id="txtMantenimiento">
                                        <option>Preventivo</option>
                                        <option>Correctivo</option>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtObservacion">Observación: </lable></td>
                                <td>
                                    <textarea style="width: 230px;" id="txtObservacion" name="txtObservacion" maxlength="100"></textarea>
                                </td>
                                </tr>
                            </table>
                            <input type="submit" name="btnRegistrar" value="Registrar">
                            <input type="button" value="Atrás" onclick="location.href = '<?php echo $oficina; ?>'">
                        </form>

                        <?php
                        if (count($revisiones) > 0) {
                            ?>

                            <table style="padding-top: 10px; padding-bottom: 20px; margin: 0 auto; width: 245px;">
                                <tr>
                                    <td style="border: 2px red solid; border-radius: 4px; background-color: #FC7E7E; height: 30px;">
                                        <a  style="color: white; text-decoration: none; font-weight: bold;" href="" onclick="cargar('pdf.php?di=<?php echo $_REQUEST['di']; ?>')">Hoja de vida del dispositivo</a>
                                    </td>
                                </tr>
                            </table>
                        
                            <div class = "list">
                                <h3 style="color: #6495ED; font-family: 'arial';">Listado de revisiones del dispositivo</h3>
                                <div class="desplegable" id="desplegable">
                                    <?php foreach ($revisiones as $revision) { ?>
                                        <h3> Revisión de la fecha: <?php echo $revision->getFecha(); ?></h3>
                                        <table>
                                            <thead>
                                                <tr style="color: #6495ED; background-color: aliceblue; font-weight: bold;">
                                                    <td>
                                                        Tipo de mantenimiento:
                                                    </td>
                                                    <td>
                                                        Observación:
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="contenido">
                                                    <td>
                                                        <?php echo utf8_encode($revision->getMantenimiento()); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo utf8_encode($revision->getObservacion()); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        ?>

                        <script>
                            location.href = "<?php echo $oficina; ?>";
                        </script> 

                        <?php
                    }
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



