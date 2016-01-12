<?php session_start(); //inicio de la sesión   ?>
<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<?php
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeMueblesEnseres.php';
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeSucursales.php';
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
            function closeVentana(link) {
                $(".ventanaEliminar").slideUp("fast");
                location.href = "muebles_enseres.php?of=" + link + "";
            }
        </script>
        <script type="text/javascript">
            jQuery.validator.addMethod("LetrasLatinas", function (value, element) {
                return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ_\s]+$/.test(value);
            });
            $.validator.setDefaults({
            });
            $().ready(function () {
                // validate signup form on keyup and submit
                $("#signupForm").validate({
                    rules: {
                        txtDescripcion: {
                            required: true,
                            minlength: 3
                        },
                        txtCantidad: {
                            required: true,
                            number: true
                        },
                        txtValor: {
                            required: true,
                            number: true,
                            minlength: 4
                        }
                    },
                    messages: {
                        txtDescripcion: {
                            required: "Ingrese la descripción",
                            minlength: "Mínimo 3 caracteres"
                        },
                        txtCantidad: {
                            required: "Ingrese la cantidad",
                            number: "El campo debe tener numeros"
                        },
                        txtValor: {
                            required: "Ingrese el valor",
                            number: "El campo debe tener numeros",
                            minlength: "Mínimo 4 numeros"
                        }
                    }
                });
            });
        </script>
        <script>
            function cargar(link) {
                window.open(link);
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#TablaFiltro').buscador('Filtro');
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

            <?php include './barra_navegacion_admin.html'; ?>

            <div class="cuerpo"> 

                <?php
                $controladorSucursales = new ControladorGestionDeSucursales();
                $controlador = new ControladorGestionDeMueblesEnseres();
                

                if (isset($_REQUEST['btnRegistrar'])) {
                    if ($_REQUEST['txtDescripcion'] != "" && is_numeric($_REQUEST['txtCantidad']) && is_numeric($_REQUEST['txtValor']) && $_REQUEST['txtEstado'] != "" && $_REQUEST['txtOficina'] != "") {
                        echo $controlador->registrarMuebleEnser($_REQUEST['txtDescripcion'], $_REQUEST['txtCantidad'], $_REQUEST['txtValor'], $_REQUEST['txtEstado'], $_REQUEST['txtOficina'])
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
                            location.href = "muebles_enceres.php?mu=r";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['btnModificar'])) {
                    $oficina = "sucursales.php?su=v";
                    if (isset($_SESSION['oficina'])) {
                        $num = $_SESSION['oficina'];
                        $oficina = "muebles_enseres.php?of=$num";
                    }
                    if ($_REQUEST['txtIdMuebleEnser'] != "" && $_REQUEST['txtDescripcion'] != "" && is_numeric($_REQUEST['txtCantidad']) && is_numeric($_REQUEST['txtValor']) && $_REQUEST['txtEstado'] != "" && $_REQUEST['txtOficina'] != "") {
                        echo $controlador->modificarMuebleEnser($_REQUEST['txtIdMuebleEnser'], $_REQUEST['txtDescripcion'], $_REQUEST['txtCantidad'], $_REQUEST['txtValor'], $_REQUEST['txtEstado'], $_REQUEST['txtOficina']);
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = '<?php echo $oficina; ?>';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "<?php echo $oficina; ?>";
                        </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['no']) && is_numeric($_REQUEST['no'])) {
                    ?>

                    <div class="ventanaEliminar">
                        <div class="mensaje">
                            <h2>Inventario Expertcob</h2>
                            <form method="post" action="muebles_enseres.php">
                                <table>
                                    <tr>
                                        <td>¿Esta seguro que desea eliminar el registro?<input type="text" name="num" value="<?php echo $_REQUEST['no']; ?>" readonly="true" hidden="true">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="submit" name="btnEliminar" value="Si">
                                            <input type="button" value="No" onclick="location.href = 'javascript:closeVentana(<?php echo $_SESSION['oficina']; ?>);';">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>

                    <?php
                } else if (isset($_REQUEST['btnEliminar'])) {
                    echo $controlador->eliminarMuebleEnser($_REQUEST['num']);
                    ?>

                    <script>
                        var segundos = 3;
                        var direccion = 'muebles_enseres.php?of=<?php echo $_SESSION['oficina']; ?>';
                        milisegundos = segundos * 1000;
                        window.setTimeout("window.location.replace(direccion);", milisegundos);
                    </script>

                    <?php
                } else if (isset($_REQUEST['mu'])) {
                    switch ($_REQUEST['mu']) {
                        case "r": {
                                ?>

                                <form class="formPuesto" action="muebles_enseres.php" method="post">
                                    <h3 style="color: #6495ED; font-family: 'arial';">Registre un nuevo mueble o encer</h3>
                                    <hr>
                                    <table style="margin-left: 200px;">
                                        <tr>
                                            <td><lable for="sucursal">Sucursal: </lable></td>
                                        <td><select name="sucursal" onchange="submit()">
                                                <option>Seleccionar</option>
                                                <?php
                                                foreach ($sucursales as $sDto) {
                                                    ?>
                                                    <option value = "<?php echo $sDto->getIdSucursal(); ?>" ><?php echo utf8_encode($sDto->getCiudad()); ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        </tr>
                                    </table>
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
                } else if (isset($_REQUEST['sucursal']) && is_numeric($_REQUEST['sucursal'])) {
                    $sDto = $controladorSucursales->verUnaSucursal($_REQUEST['sucursal']);
                    if ($sDto != null) {
                        $oficinas = $controladorSucursales->verOficinasPorSucursal($_REQUEST['sucursal']);
                        $estados = $controlador->verEstados();
                        ?>

                        <form class="formMueble" id="signupForm" action="muebles_enseres.php" method="post">
                            <h3 style="color: #6495ED; font-family: 'arial';">Registre un nuevo mueble o encer</h3>
                            <hr>
                            <table>
                                <tr>
                                    <td><lable for="sucursal">Sucursal: </lable></td>
                                <td><input type="text" id="sucursal" readonly="true" value="<?php echo utf8_encode($sDto->getCiudad()); ?>">
                                    <input name="sucursal" type="text" readonly="true" hidden="true" value="<?php echo $sDto->getIdSucursal(); ?>">
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtDescripcion">Descripción: </lable></td>
                                <td><input name="txtDescripcion" id="txtDescripcion" type="text" maxlength="25">
                                    <label class="obligatorio"> * </label>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtCantidad">Cantidad: </lable></td>
                                <td><input name="txtCantidad" id="txtCantidad" type="text" maxlength="9">
                                    <label class="obligatorio"> * </label>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtValor">Valor: </lable></td>
                                <td><input name="txtValor" id="txtValor" type="text" maxlength="25">
                                    <label class="obligatorio"> * </label>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtEstado">Estado: </lable></td>
                                <td><select name="txtEstado">
                                        <?php
                                        foreach ($estados as $eDto) {
                                            ?>
                                            <option value="<?php echo $eDto->getIdEstado(); ?>"><?php echo utf8_encode($eDto->getDescripcion()); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtOficina">Oficina: </lable></td>
                                <td><select name="txtOficina" style="width: 230px;">
                                        <?php
                                        foreach ($oficinas as $oDto) {
                                            $sDto = $controladorSucursales->verUnaSucursal($oDto->getIdSucursal());
                                            ?>
                                            <option value="<?php echo $oDto->getNumOficina(); ?>"><?php echo utf8_encode($sDto->getCiudad() . " // " . $oDto->getNombreOficina()); ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                            </table>
                            <div class="msjObligatorio">
                                <label>Los campos con * son obligatorios</label>
                            </div>
                            <input type="submit" name="btnRegistrar" value="Registrar">
                        </form>

                        <?php
                    }
                } else if (isset($_REQUEST['of']) && is_numeric($_REQUEST['of'])) {
                    $muebles = $controlador->verMueblesEnseresPorOficina($_REQUEST['of']);
                    $oDto = $controladorSucursales->verUnaOficina($_REQUEST['of']);
                    if (count($muebles) > 0) {
                        ?>    

                        <div class = "list">
                            <h3 style="color: #6495ED; font-family: 'arial';">Listado de muebles y enceres</h3>
                            <div class="buscador">
                                <table>
                                    <tr>
                                        <td><label for="Filtro">Escriba algún indicio del mueble o encer:</label></td>
                                        <td><input id="Filtro" name="Filtro" type="text" placeholder="Ingrese una letra, número, o palabra." maxlength="15"></td>
                                    </tr>
                                </table>
                            </div>
                            <table style="padding-top: 10px; margin: 0 auto; width: 450px;">
                                <tr>
                                    <td style="border: 2px green solid; border-radius: 4px; background-color: #3CB371; height: 30px;">
                                        <a style="color: white; text-decoration: none; font-weight: bold;" href="excel.php?ofm=<?php echo $_REQUEST['of']; ?>">Exportar listado a Excel</a>
                                    </td>
                                    <td style="border: 2px red solid; border-radius: 4px; background-color: #FC7E7E; height: 30px;">
                                        <a  style="color: white; text-decoration: none; font-weight: bold;" href="" onclick="cargar('pdf.php?ofm=<?php echo $_REQUEST['of']; ?>')">Exportar listado a PDF</a>
                                    </td>
                                </tr>
                            </table>
                            <h3>Oficina: <?php echo $oDto->getNombreOficina(); ?> </h3>
                            <div class="tabla">
                                <table id="TablaFiltro" >
                                    <thead>
                                        <tr id="encabezado">
                                            <td>Descripción</td>
                                            <td>Cantidad</td>
                                            <td>Valor</td>
                                            <td>Estado</td>
                                            <td>Oficina</td>
                                            <td>Modificar</td>
                                            <td>Eliminar</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($muebles as $mDto) {
                                            $eDto = $controlador->verEstado($mDto->getIdEstado());
                                            $oDto = $controladorSucursales->verUnaOficina($mDto->getIdOficina());
                                            ?>
                                            <tr>
                                                <td><?php echo utf8_encode($mDto->getDescripcion()); ?></td>
                                                <td><?php echo utf8_encode($mDto->getCantidad()); ?></td>
                                                <td><?php echo utf8_encode($mDto->getValor()); ?></td>
                                                <td><?php echo utf8_encode($eDto->getDescripcion()); ?></td>
                                                <td><?php echo utf8_encode($oDto->getNombreOficina()); ?></td>
                                                <td><a href="muebles_enseres.php?id=<?php echo $mDto->getIdMuebleEnser(); ?>" onclick="<?php $_SESSION['oficina'] = $_REQUEST['of']; ?>"><img alt="Modificar mueble / encer" src="../resources/imagenes/Modificar.png" ></a></td>
                                                <td><a href="muebles_enseres.php?no=<?php echo $mDto->getIdMuebleEnser(); ?>" onclick="<?php $_SESSION['oficina'] = $_REQUEST['of']; ?>"><img alt="Eliminar mueble / encer" src="../resources/imagenes/Eliminar.png" ></a></td>
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
                                    <?php echo "No hay muebles ni enseres registrados en la oficina"; ?>
                                </div>
                            </div>
                            <script>
                                var segundos = 3;
                                var direccion = 'oficinas.php?v=<?php echo $oDto->getIdSucursal(); ?>';
                                milisegundos = segundos * 1000;
                                window.setTimeout("window.location.replace(direccion);", milisegundos);
                            </script> 

                            <?php
                        }
                        ?>

                    </div>

                    <?php
                } else if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id'])) {
                    $mDto = $controlador->verMuebleEnser($_REQUEST['id']);

                    $oficina = "sucursales.php?su=v";
                    if (isset($_SESSION['oficina'])) {
                        $num = $_SESSION['oficina'];
                        $oficina = "muebles_enseres.php?of=$num";
                    }

                    if ($mDto != null) {
                        $esDto = $controlador->verEstado($mDto->getIdEstado());
                        $ofDto = $controladorSucursales->verUnaOficina($mDto->getIdOficina());
                        $suDto = $controladorSucursales->verUnaSucursal($ofDto->getIdSucursal());
                        $estados = $controlador->verEstados();
                        $oficinas = $controladorSucursales->verOficinas();
                        ?>

                        <form class="formMueble" id="signupForm" action="muebles_enseres.php" method="post">
                            <h3 style="color: #6495ED; font-family: 'arial';">Modifique el mueble o encer</h3>
                            <hr>
                            <table>
                                <tr>
                                    <td><input name="txtIdMuebleEnser" id="txtIdMuebleEnser" type="text" maxlength="10" value="<?php echo $mDto->getIdMuebleEnser(); ?>" hidden="true">
                                    </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtDescripcion">Descripción: </lable></td>
                                <td><input name="txtDescripcion" id="txtDescripcion" type="text" maxlength="25" value="<?php echo utf8_encode($mDto->getDescripcion()); ?>">
                                    <label class="obligatorio"> * </label>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtCantidad">Cantidad: </lable></td>
                                <td><input name="txtCantidad" id="txtCantidad" type="text" maxlength="9" value="<?php echo utf8_encode($mDto->getCantidad()); ?>">
                                    <label class="obligatorio"> * </label>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtValor">Valor: </lable></td>
                                <td><input name="txtValor" id="txtValor" type="text" maxlength="25" value="<?php echo utf8_encode($mDto->getValor()); ?>">
                                    <label class="obligatorio"> * </label>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtEstado">Estado: </lable></td>
                                <td><select name="txtEstado">
                                        <option value="<?php echo $esDto->getIdEstado(); ?>"><?php echo utf8_encode($esDto->getDescripcion()); ?></option>
                                        <?php
                                        foreach ($estados as $eDto) {
                                            if ($esDto->getIdEstado() != $eDto->getIdEstado()) {
                                                ?>
                                                <option value="<?php echo $eDto->getIdEstado(); ?>"><?php echo utf8_encode($eDto->getDescripcion()); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                                <tr>
                                    <td><lable for="txtOficina">Oficina: </lable></td>
                                <td><select name="txtOficina" style="width: 230px;">
                                        <option value="<?php echo $ofDto->getNumOficina(); ?>"><?php echo utf8_encode($suDto->getCiudad() . " // " . $ofDto->getNombreOficina()); ?></option>
                                        <?php
                                        foreach ($oficinas as $oDto) {
                                            if ($ofDto->getNumOficina() != $oDto->getNumOficina()) {
                                                $sDto = $controladorSucursales->verUnaSucursal($oDto->getIdSucursal());
                                                ?>
                                                <option value="<?php echo $oDto->getNumOficina(); ?>"><?php echo utf8_encode($sDto->getCiudad() . " // " . $oDto->getNombreOficina()); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </td>
                                </tr>
                            </table>
                            <div class="msjObligatorio">
                                <label>Los campos con * son obligatorios</label>
                            </div>
                            <input type="submit" name="btnModificar" value="Modificar">
                            <input type="button" onclick="location.href = '<?php echo $oficina; ?>'" value="Cancelar">
                        </form>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("No existe mueble o enser con ese id");
                            location.href = '<?php echo $oficina; ?>';
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

