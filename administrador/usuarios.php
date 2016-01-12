<?php session_start(); //inicio de sesión  ?>
<!DOCTYPE html>
<!--
    Author     : Erick Guzmán
-->

<?PHP
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeUsuarios.php';
require '../controlador/com.inventario_expertcob.controladores/ControladorGestionDeSucursales.php';
?>
<html>
    <head>
        <title>Inventario - Expertcob</title>
        <meta charset="UTF-8" >
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
                location.href = "usuarios.php?us=v";
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
                        txtNombre: {
                            required: true,
                            minlength: 3,
                            LetrasLatinas: true
                        },
                        txtIdentificacion: {
                            required: true,
                            number: true,
                            minlength: 7
                        }
                    },
                    messages: {
                        txtNombre: {
                            required: "Por favor ingrese el nombre",
                            minlength: "Mínimo 3 caracteres",
                            LetrasLatinas: "Solo letras"
                        },
                        txtIdentificacion: {
                            required: "Ingrese el número de documento",
                            number: "El campo debe tener números",
                            minlength: "Mínimo 7 numeros"
                        }
                    }
                });
            });
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
                $controlador = new ControladorGestionDeUsuarios();
                $controladorSucursales = new ControladorGestionDeSucursales();

                if (isset($_REQUEST['btnRegistrar'])) {
                    if ($_REQUEST['txtIdentificacion'] != "" && $_REQUEST['txtNombre'] != "" && isset($_REQUEST['txtRol']) && isset($_REQUEST['txtSucuarsal'])) {
                        echo $controlador->registrarUsuario($_REQUEST['txtIdentificacion'], $_REQUEST['txtNombre'], $_REQUEST['txtApellidos'], $_REQUEST['txtSucuarsal'], $_REQUEST['txtRol']);
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
                            location.href = "usuarios.php?us=r";
                        </script>

                        <?php
                    }
                } else if (isset($_REQUEST['btnModificar'])) {
                    if ($_REQUEST['txtIdentificacion'] != "" && $_REQUEST['txtNombre'] != "" && isset($_REQUEST['txtRol']) && isset($_REQUEST['txtSucuarsal'])) {
                        echo $controlador->modificarUsuario($_REQUEST['txtIdentificacion'], $_REQUEST['txtNombre'], $_REQUEST['txtApellidos'], $_REQUEST['txtSucuarsal'], $_REQUEST['txtRol']);
                        ?>

                        <script>
                            var segundos = 3;
                            var direccion = 'usuarios.php?us=v';
                            milisegundos = segundos * 1000;
                            window.setTimeout("window.location.replace(direccion);", milisegundos);
                        </script> 

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("Debe llenar los campos obligatorios del formulario");
                            location.href = "usuarios.php?us=v";
                        </script>

                        <?php
                    }
                } else if (isset($_POST['btnEliminar'])) {
                    echo $controlador->eliminarUsuario($_REQUEST['num']);
                    ?>

                    <script>
                        var segundos = 3;
                        var direccion = 'usuarios.php?us=v';
                        milisegundos = segundos * 1000;
                        window.setTimeout("window.location.replace(direccion);", milisegundos);
                    </script>

                    <?php
                } else if (isset($_REQUEST['no']) && is_numeric($_REQUEST['no']) && $_REQUEST['no'] != 830121569) {
                    ?>

                    <div class="ventanaEliminar">
                        <div class="mensaje">
                            <h2>Inventario Expertcob</h2>
                            <form method="post" action="usuarios.php">
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
                } else if (isset($_REQUEST['us'])) {
                    switch ($_REQUEST['us']) {
                        case "r": {
                                $roles = $controlador->verRoles();
//Sucursales ya no se va a utilizar                            
//    $sucursales = $controladorSucursales->verSucursales();
                                ?>

                                <form class="formRegistrarUsuario" id="signupForm" action="usuarios.php" method="post">
                                    <h3 style="color: #6495ED; font-family: 'arial';">Registre un nuevo usuario</h3>
                                    <hr>

                                    <table>
                                        <tr>
                                            <td><label for="txtIdentificacion">Número de documento: </label></td>
                                            <td><input name="txtIdentificacion" id="txtIdentificacion" type="text">
                                                <label class="obligatorio"> * </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="txtNombre">Nombres: </label></td>
                                            <td><input name="txtNombre" id="txtNombre" type="text" maxlength="20">
                                                <label class="obligatorio"> * </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><label for="txtApellidos">Apellidos: </label></td>
                                            <td><input name="txtApellidos" id="txtApellidos" type="text" maxlength="20"></td>
                                        </tr>
                                        <tr>
                                            <td><label for="txtRol">Rol de usuario: </label></td>
                                            <td><select name="txtRol" id="txtRol">
                                                    <?php
                                                    foreach ($roles as $rDto) {
                                                        ?>
                                                        <option value = "<?php echo $rDto->getIdRol(); ?>"><?php echo utf8_encode($rDto->getNombreRol()); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select></td>
                                        </tr>
                                        <tr>
                                            <td><label for="txtSucursal">Sucursal: </label></td>
                                            <td><select name="txtSucuarsal" id="txtSucursal">
                                                    <?php
                                                    foreach ($sucursales as $sDto) {
                                                        ?>
                                                        <option value = "<?php echo $sDto->getIdSucursal(); ?>"><?php echo utf8_encode($sDto->getCiudad()); ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select></td>
                                        </tr>
                                    </table>
                                    <div class="msjObligatorio">
                                        <label>Los campos con * son obligatorios</label>
                                    </div>
                                    <input type="submit" name="btnRegistrar" value="Registrar">
                                </form>

                                <?php
                            }break;
                        case "v": {
                                $usuarios = $controlador->verUsuarios();
                                if (count($usuarios) > 0) {
                                    $usuario = $_SESSION['USUARIO'];
                                    ?>    

                                    <div class = "list">
                                        <h3 style="color: #6495ED; font-family: 'arial';">Listado de usuarios</h3>
                                        <div class="buscador">
                                            <table>
                                                <tr>
                                                    <td><label for="Filtro">Escriba algún indicio del usuario:</label></td>
                                                    <td><input id="Filtro" name="Filtro" type="text" placeholder="Ingrese una letra, número, o palabra." maxlength="15"></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="tabla">
                                            <table id="TablaFiltro" >
                                                <thead>
                                                    <tr id="encabezado">
                                                        <td>Número de documento</td>
                                                        <td>Nombres</td>
                                                        <td>Apellidos</td>
                                                        <td>Rol</td>
                                                        <td>Sucursal</td>
                                                        <td>Modificar</td>
                                                        <td>Eliminar</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($usuarios as $uDto) {
                                                        $rDto = $controlador->verUnRol($uDto->getIdRol());
                                                        $sDto = $controladorSucursales->verUnaSucursal($uDto->getIdSucursal());
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $uDto->getNumeroDocumento(); ?></td>
                                                            <td><?php echo utf8_encode($uDto->getNombre()); ?></td>
                                                            <td><?php echo utf8_encode($uDto->getApellido()); ?></td>
                                                            <td><?php echo utf8_encode($rDto->getNombreRol()); ?></td>
                                                            <td><?php echo utf8_encode($sDto->getCiudad()); ?></td>
                                                            <td><a href="usuarios.php?id=<?php echo $uDto->getNumeroDocumento(); ?>"><img alt="Modificar usuario" src="../resources/imagenes/Modificar.png" ></a></td>

                                                            <?php
                                                            if ($uDto->getNumeroDocumento() != $usuario) {
                                                                ?>
                                                                <td><a href="usuarios.php?no=<?php echo $uDto->getNumeroDocumento(); ?>"><img alt="Eliminar usuario" src="../resources/imagenes/Eliminar.png" ></a></td>
                                                                <?php
                                                            }
                                                            ?>

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
                                                <?php echo "No hay usuarios registrados"; ?>
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
                                    ?>

                                </div>

                                <?php
                            }break;
                        default :
                            ?>

                            <script>
                                location.href = "index_admin.php";
                            </script> 

                        <?php
                    }
                } else if (isset($_REQUEST['id']) && is_numeric($_REQUEST['id']) && $_REQUEST['id'] != 830121569) {
                    $uDto = $controlador->verUnUsuario($_REQUEST['id']);
                    $roles = $controlador->verRoles();
                    $sucursales = $controladorSucursales->verSucursales();
                    if ($uDto != null) {
                        $suDto = $controladorSucursales->verUnaSucursal($uDto->getIdSucursal());
                        $roDto = $controlador->verUnRol($uDto->getIdRol())
                        ?>

                        <form class = "formRegistrarUsuario" id = "signupForm" action = "usuarios.php" method = "post">
                            <h3 style="color: #6495ED; font-family: 'arial';">Modifique el usuario</h3>
                            <hr>

                            <table>
                                <tr>
                                    <td><label for = "txtIdentificacion">Número de documento: </label></td>
                                    <td><input name = "txtIdentificacion" id = "txtIdentificacion" type = "text" value="<?php echo $uDto->getNumeroDocumento(); ?>" readonly="true">
                                        <label class = "obligatorio"> * </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for = "txtNombre">Nombres: </label></td>
                                    <td><input name = "txtNombre" id = "txtNombre" type = "text" value="<?php echo utf8_encode($uDto->getNombre()); ?>" maxlength="20">
                                        <label class = "obligatorio"> * </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for = "txtApellidos">Apellidos: </label></td>
                                    <td><input name = "txtApellidos" id = "txtApellidos" type = "text" value="<?php echo utf8_encode($uDto->getApellido()); ?>" maxlength="20"> 
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for = "txtRol">Rol de usuario: </label></td>
                                    <td><select name = "txtRol" id = "txtRol">
                                            <option value = "<?php echo $uDto->getIdRol(); ?>"><?php echo utf8_encode($roDto->getNombreRol()); ?></option>
                                            <?php
                                            foreach ($roles as $rDto) {
                                                ?>
                                                <option value = "<?php echo $rDto->getIdRol(); ?>"><?php echo utf8_encode($rDto->getNombreRol()); ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td><label for = "txtSucursal">Sucursal: </label></td>
                                    <td><select name = "txtSucuarsal" id = "txtSucursal">
                                            <option value = "<?php echo $uDto->getIdSucursal(); ?>"><?php echo utf8_encode($suDto->getCiudad()); ?></option>
                                            <?php
                                            foreach ($sucursales as $sDto) {
                                                if ($sDto->getIdSucursal() != $uDto->getIdSucursal()) {
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
                            <input type = "submit" name = "btnModificar" value = "Modificar">
                            <input type="button" name="btnCancelar" value="Cancelar" onclick="location.href = 'usuarios.php?us=v'">
                        </form>

                        <?php
                    } else {
                        ?>

                        <script>
                            alert("No existe un usuario con ese número de documento");
                            location.href = "usuarios.php?us=v";
                        </script>

                        <?php
                    }
                } else {
                    ?>

                    <script>location.href = "index_admin.php";</script>

                    <?php
                }
                ?>

            </div>
        </div>
    </body>
</html>
