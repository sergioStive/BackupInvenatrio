<?php session_start(); //inicio de la sesión  ?>
<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<?php
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeSucursales.php';
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeUsuarios.php';
?>
<html>
    <head>
        <title>Inventario - Expertcob</title>
        <meta charset="UTF-8">
        <link type="image/png" rel="shortcut icon" href="../resources/imagenes/favicon.png">
        <link type="text/css" rel="stylesheet" href="../resources/css/administrador.css">
        <script type="text/javascript" src="../resources/js/jqueryVM.js"></script>
        <script type="text/javascript" src="../resources/js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="../resources/js/jquery.validate.js"></script>
        <script type="text/javascript" src="../resources/js/jquery_table.buscador.js"></script>
        <script type="text/javascript" src="../resources/js/paging.js"></script>
        <script type="text/javascript">
            function openVentana() {
                $(".ventanaEliminar").slideDown("slow");
            }
            function closeVentana() {
                $(".ventanaEliminar").slideUp("fast");
                location.href = "sucursales.php?su=v";
            }
        </script>
        <script type="text/javascript">
            $.validator.setDefaults({
            });
            $().ready(function () {
                // validate signup form on keyup and submit
                $("#signupForm").validate({
                    rules: {
                        txtNombre: {
                            required: true,
                            minlength: 3
                        }
                    },
                    messages: {
                        txtNombre: {
                            required: "Por favor ingrese el nombre",
                            minlength: "Mínimo 3 caracteres"
                        }
                    }
                });
            });</script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#TablaFiltro').buscador('Filtro');
            });</script>
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
                $controladorSucursales = new ControladorGestionDeSucursales();
                $controladorUsuarios = new ControladorGestionDeUsuarios();
                
                $responsables = $controladorUsuarios->verResponsables();


                if (isset($_REQUEST['btnRegistrar'])) {
                    if ($_REQUEST['txtNombre'] != "" && $_REQUEST['txtSucuarsal'] != "") {
                        echo $controladorSucursales->registrarOficina($_REQUEST['txtNombre'], $_REQUEST['txtSucuarsal']);
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
                            alert("Debe llenar los campos obliogatorios del formulario");
                            location.href = "oficinas.php?of=r";
                        </script>

                        <?php
                    }
                } else if (isset($_REQUEST['btnModificar'])) {
                    if ($_REQUEST['txtNumero'] != "" && $_REQUEST['txtNombre'] != "" && $_REQUEST['txtSucuarsal'] != "") {
                        echo $controladorSucursales->modificarOficina($_REQUEST['txtNumero'], $_REQUEST['txtNombre'], $_REQUEST['txtSucuarsal']);
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = "oficinas.php?v=<?php echo $_REQUEST['txtSucuarsal']; ?>";
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obliogatorios del formulario");
                            location.href = "oficinas.php?v=<?php echo $_REQUEST['txtSucuarsal']; ?>";
                        </script>

                        <?php
                    }
                } else if (isset($_REQUEST['no']) && is_numeric($_REQUEST['no'])) {
                    $puestos = $controladorSucursales->verPuestosPorNumeroDeOficina($_REQUEST['no']);
                    if (count($puestos) > 0) {
                        ?>

                        <div class="notificacion">
                            <div class="mensaje">
                                <h2>Inventario Expertcob</h2>
                                <?php echo "No se puede eliminar la oficina porque hay puestos de trabajo"; ?>
                            </div>
                        </div>
                        <script>
                            var segundos = 3;
                            var direccion = 'sucursales.php?su=v';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script>

                        <?php
                    } else {
                        ?>

                        <div class="ventanaEliminar">
                            <div class="mensaje">
                                <h2>Inventario Expertcob</h2>
                                <form method="post" action="oficinas.php">
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
                    }
                } else if (isset($_REQUEST['btnEliminar'])) {
                    echo $controladorSucursales->eliminarOficina($_REQUEST['num']);
                    ?>

                    <script>
                        var segundos = 3;
                        var direccion = 'sucursales.php?su=v';
                        milisegundos = segundos * 1000;
                        window.setTimeout("window.location.replace(direccion);", milisegundos);
                    </script>

                    <?php
                } else if (isset($_REQUEST['of'])) {
                    switch ($_REQUEST['of']) {
                        case "r": {
                                ?>
                                <form class="formOficina" id="signupForm" action="oficinas.php" method="post">
                                    <h3 style="color: #6495ED; font-family: 'arial';">Registre una nueva oficina</h3>
                                    <hr>

                                    <table>
                                        <tr>
                                            <td><label for="txtNombre">Nombre: </label></td>
                                            <td><input name="txtNombre" id="txtNombre" type="text" maxlength="20">
                                                <label class="obligatorio"> * </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="txtSucursal">Sucursal: </label></td>
                                            <td><select name="txtSucuarsal" id="txtSucursal">
                                                    <?php
                                                    foreach ($sucursales as $sDto) {
                                                        ?>
                                                        <option value = "<?php echo $sDto->getIdSucursal(); ?>" ><?php echo utf8_encode($sDto->getCiudad()); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select></td>
                                        </tr>
                                    </table>
                                    <div class = "msjObligatorio">
                                        <label>Los campos con * son obligatorios</label>
                                    </div>
                                    <input type="submit" name="btnRegistrar" value="Registrar">
                                </form>
                                <?php
                            }break;
                        default :
                            ?>

                            <script>
                                location.href = "index_admin.php";
                            </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['v']) && is_numeric($_REQUEST['v'])) {
                    $listado = $controladorSucursales->verOficinasPorSucursal($_REQUEST['v']);
                    if (count($listado) > 0) {
                        ?>    

                        <div class = "list">
                            <h3 style="color: #6495ED; font-family: 'arial';">Listado de oficinas</h3>
                            <div class="buscador">
                                <table>
                                    <tr>
                                        <td><label for="Filtro">Escriba algún indicio de la oficina:</label></td>
                                        <td><input id="Filtro" name="Filtro" type="text" placeholder="Ingrese una letra, número, o palabra." maxlength="15"></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="tabla">
                                <table id="TablaFiltro" >
                                    <thead>
                                        <tr id="encabezado">
                                            <td>Sucursal</td>
                                            <td>Nombre oficina</td>
                                            <td>Puestos</td>
                                            <td>Muebles/enseres</td>
                                            <td>Dispositivos</td>
                                            <td>Modificar</td>
                                            <td>Eliminar</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($listado as $oDto) {
                                            $sDto = $controladorSucursales->verUnaSucursal($oDto->getIdSucursal());
                                            ?>
                                            <tr>
                                                <td><?php echo utf8_encode($sDto->getCiudad()); ?></td>
                                                <td><?php echo utf8_encode($oDto->getNombreOficina()); ?></td>
                                                <td><a href="puestos.php?of=<?php echo $oDto->getNumOficina(); ?>"><img alt="Ver puestos" src="../resources/imagenes/Puesto.png" ></a></td>
                                                <td><a href="muebles_enseres.php?of=<?php echo $oDto->getNumOficina(); ?>"><img alt="Ver muebles o enceres" src="../resources/imagenes/Mueble.png" ></a></td>
                                                <td><a href="dispositivos.php?of=<?php echo $oDto->getNumOficina(); ?>"><img alt="Ver dispositivos" src="../resources/imagenes/Dispositivo.png" ></a></td>
                                                <td><a href="oficinas.php?id=<?php echo $oDto->getNumOficina(); ?>"><img alt="Modificar oficina" src="../resources/imagenes/Modificar.png" ></a></td>
                                                <td><a href="oficinas.php?no=<?php echo $oDto->getNumOficina(); ?>"><img alt="Eliminar oficina" src="../resources/imagenes/Eliminar.png" ></a></td>
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

                            <?php
                        } else {
                            ?>

                            <div class="notificacion">
                                <div class="mensaje">
                                    <h2>Inventario Expertcob</h2>
                                    <?php echo "No hay oficinas registradas"; ?>
                                </div>
                            </div>
                            <script>
                                var segundos = 3;
                                var direccion = 'sucursales.php?su=v';
                                milisegundos = segundos * 1000;
                                window.setTimeout("window.location.replace(direccion);", milisegundos);
                            </script> 

                            <?php
                        }
                        ?>

                    </div>

                    <?php
                } else if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
                    $oDto = $controladorSucursales->verUnaOficina($_REQUEST['id']);
                    if ($oDto != null) {
                        $suDto = $controladorSucursales->verUnaSucursal($oDto->getIdSucursal());
                        ?>
                        <form class="formOficina" id="signupForm" action="oficinas.php" method="post">
                            <h3 style="color: #6495ED; font-family: 'arial';">Modifique la oficina</h3>
                            <hr>

                            <table>
                                <tr>
                                    <td><label for="txtNumero">Número: </label></td>
                                    <td><input name="txtNumero" id="txtNumero" type="text" value="<?php echo $oDto->getNumOficina(); ?>" readonly="true">
                                        <label class="obligatorio"> * </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="txtNombre">Nombre: </label></td>
                                    <td><input name="txtNombre" id="txtNombre" type="text" value="<?php echo utf8_encode($oDto->getNombreOficina()); ?>" maxlength="20">
                                        <label class="obligatorio"> * </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="txtSucursal">Sucursal: </label></td>
                                    <td><select name="txtSucuarsal" id="txtSucursal">
                                            <option value = "<?php echo $oDto->getIdSucursal(); ?>"><?php echo utf8_encode($suDto->getCiudad()); ?></option>
                                            <?php
                                            foreach ($sucursales as $sDto) {
                                                if ($oDto->getIdSucursal() != $sDto->getIdSucursal()) {
                                                    ?>
                                                    <option value = "<?php echo $sDto->getIdSucursal(); ?>"><?php echo utf8_encode($sDto->getCiudad()); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select></td>
                                </tr>
                            </table>
                            <div class = "msjObligatorio">
                                <label>Los campos con * son obligatorios</label>
                            </div>
                            <input type="submit" name="btnModificar" value="Modificar">
                            <input type="button" name="btnCancelar" value="Cancelar" onclick="location.href = 'oficinas.php?v=<?php echo $_REQUEST['id']; ?>'">
                        </form>
                        <?php
                    } else {
                        ?>

                        <script>
                            alert("No existe una oficina con ese número");
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
