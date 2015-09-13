<?php session_start(); // inicio la sesión   ?>
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
                $controlador = new ControladorGestionDeDispositivos();

                if (isset($_REQUEST['btnRegistrar'])) {
                    if ($_REQUEST['txtMarca'] != "") {
                        echo $controlador->registrarMarca($_REQUEST['txtMarca']);
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = 'index_admin.php';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script> 

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "marcas?ma=r";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['btnModificar'])) {
                    if ($_REQUEST['txtMarca'] != "" && is_numeric($_REQUEST['txtNumero'])) {
                        echo $controlador->modificarMarca($_REQUEST['txtNumero'], $_REQUEST['txtMarca']);
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = 'marcas.php?ma=v';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "marcas.php?ma=v";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['no']) && is_numeric($_REQUEST['no'])) {
                    ?>

                    <div class="ventanaEliminar">
                        <div class="mensaje">
                            <h2>Inventario Expertcob</h2>
                            <form method="post" action="marcas.php">
                                <table>
                                    <tr>
                                        <td>¿Esta seguro que desea eliminar el registro?<input type="text" name="num" value="<?php echo $_REQUEST['no']; ?>" readonly="true" hidden="true"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" name="btnEliminar" value="Si">
                                            <input type="button" value="No" onclick="location.href = 'javascript:closeVentana();';">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>

                    <?php
                } else if (isset($_REQUEST['btnEliminar'])) {
                    echo $controlador->eliminarMarca($_REQUEST['num']);
                    ?>

                    <script>
                        var segundos = 3;
                        var direccion = 'marcas.php?ma=v';
                        milisegundos = segundos * 1000;
                        window.setTimeout("window.location.replace(direccion);", milisegundos);
                    </script>

                    <?php
                } else if (isset($_REQUEST['ma'])) {
                    switch ($_REQUEST['ma']) {
                        case "r": {
                                ?>

                                <form class="formMarca" id="signupForm" action="marcas.php" method="post">
                                    <h3 style="color: #6495ED; font-family: 'arial';">Registre una marca</h3>
                                    <hr>
                                    <table>
                                        <tr>
                                            <td><label for="txtMarca">Marca:</label></td>
                                            <td><input type="text" name="txtMarca" id="txtMarca" maxlength="20">
                                                <label class="obligatorio"> *</label></td>
                                        </tr>
                                    </table>
                                    <div class="msjObligatorio">
                                        <label>Los campos con * son obligatorios</label>
                                    </div>
                                    <input type="submit" value="Registrar" name="btnRegistrar">
                                </form>

                                <?php
                            }break;
                        case "v": {
                                $marcas = $controlador->verMarcas();
                                if (count($marcas) > 0) {
                                    ?>

                                    <div class = "list">
                                        <h3 style="color: #6495ED; font-family: 'arial';">Listado de marcas</h3>
                                        <div class="buscador">
                                            <table>
                                                <tr>
                                                    <td><label for="Filtro">Escriba algún indicio de la marca:</label></td>
                                                    <td><input id="Filtro" name="Filtro" type="text" placeholder="Ingrese una letra, número, o palabra." maxlength="15"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="tabla">
                                            <table id="TablaFiltro" >
                                                <thead>
                                                    <tr id="encabezado">
                                                        <td>Marca</td>
                                                        <td>Modificar</td>
                                                        <td>Eliminar</td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    foreach ($marcas as $mDto) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo utf8_encode($mDto->getNombreMarca()); ?></td>
                                                            <td><a href="marcas.php?id=<?php echo $mDto->getIdMarca(); ?>"><img alt="Modificar marca" src="../resources/imagenes/Modificar.png" ></a></td>
                                                            <td><a href="marcas.php?no=<?php echo $mDto->getIdMarca(); ?>"><img alt="Eliminar marca" src="../resources/imagenes/Eliminar.png" ></a></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                            <div id="pageNavPosition"></div>
                                            <script type="text/javascript">
                                                var pager = new Pager("TablaFiltro", 10);
                                                pager.init();
                                                pager.showPageNav("pager", "pageNavPosition");
                                                pager.showPage(1);
                                            </script>
                                        </div>
                                    </div>

                                    <?php
                                } else {
                                    ?>

                                    <div class="notificacion">
                                        <div class="mensaje">
                                            <h2>Inventario Expertcob</h2>
                                            <?php echo "No existen marcas registradas"; ?>
                                        </div>
                                    </div>
                                    <script>
                                        var segundos = 3;
                                        var direccion = 'index_admin.php';
                                        milisegundos = segundos * 1000;
                                        window.setTimeout("window.location.replace(direccion);", milisegundos);
                                    </script>

                                    <?php
                                }
                            }break;
                        default :
                            ?>

                            <script>
                                location.href = "index_admin.php";
                            </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
                    $mDto = $controlador->verMarca($_REQUEST['id']);
                    if ($mDto != null) {
                        ?>

                        <form class="formMarca" id="signupForm" action="marcas.php" method="post">
                            <h3 style="color: #6495ED; font-family: 'arial';">Modifique la marca</h3>
                            <hr>
                            <table>
                                <tr>
                                    <td></td>
                                    <td><input type="text" name="txtNumero" id="txtNumero" hidden="true" value="<?php echo $mDto->getIdMarca(); ?>"></td>
                                </tr>
                                <tr>
                                    <td><label for="txtMarca">Marca:</label></td>
                                    <td><input type="text" name="txtMarca" id="txtMarca" maxlength="20" value="<?php echo utf8_encode($mDto->getNombreMarca()); ?>">
                                        <label class="obligatorio"> *</label></td>
                                </tr>
                            </table>
                            <div class="msjObligatorio">
                                <label>Los campos con * son obligatorios</label>
                            </div>
                            <input type="submit" value="Modificar" name="btnModificar">
                            <input type="button" value="Cancelar" onclick="location.href = 'marcas.php?ma=v'">
                        </form>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("No existe una marca con ese id");
                            location.href = "marcas.php?ma=v";
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
