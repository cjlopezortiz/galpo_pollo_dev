<?php
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

require_once '../../modelo/val-admin.php';
require_once '../../modelo/datos-usuarios.php';
require_once '../../modelo/datos-rol.php';

$mis_usuarios = new misUsuarios();
$mis_roles = new misRoles();

// Identificar al usuario logueado desde la sesión
$id_usuario_sesion = isset($_SESSION['codigo']) ? $_SESSION['codigo'] : (isset($_SESSION['usuario_codigo']) ? $_SESSION['usuario_codigo'] : null);

// Si es administrador (rol_id == 1), ve todos; si no, ve únicamente sus datos
if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 1) {
    $res = $mis_usuarios->viewUsuarioSesion($id_usuario_sesion);
} else {
    $res = $mis_usuarios->viewUsuarioSesion($id_usuario_sesion);
}

$rol_user = isset($_SESSION['rol_id']) ? $_SESSION['rol_id'] : null;

/// Validamos el usuario
if ($rol_user != 1 && $rol_user != 2) {
    echo '<script language = javascript>
    alert ("Debe seleccionar un centro de formación.") 
    self.location="../index.php"
    </script>';
}
?>
<div class="col-sm-12">
    <!-- Inicio títulos de la página-->
    <div class="page-head">
        <div class="page-head-modern">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>MIS DATOS / USUARIOS
                    <small></small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="breadcrumb breadcrumb-modern">
            <li>
                <a href="index.php">Inicio</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span class="active">Mis registros</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <br />
        <!-- INICIO DEL CONTENIDO -->
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <th>
                        <div class="text-center">Item</div>
                    </th>
                    <th>
                        <div class="text-center">Identificación</div>
                    </th>
                    <th>
                        <div class="text-center">Nombre</div>
                    </th>
                    <th>
                        <div class="text-center">Teléfono</div>
                    </th>
                    <th>
                        <div class="text-center">Correo<br />electrónico</div>
                    </th>
                    <th>
                        <div class="text-center">Estado</div>
                    </th>
                    <th>
                        <div class="text-center">Editar</div>
                    </th>
                </thead>
                <tbody>
                    <?php
                    if (!empty($res)) {
                        foreach ($res as $data) {
                            $estado = ($data['estado'] == 1) ? "Activo" : "Inactivo";

                            $datos = $data['codigo'] . "||" .
                                $data['tipo_documento'] . "||" .
                                $data['numero_documento'] . "||" .
                                $data['nombre'] . "||" .
                                $data['usuario'] . "||" .
                                $data['contrasena'] . "||" .
                                $data['email'] . "||" .
                                $data['telefono'] . "||" .
                                $data['estado'] . "||" .
                                $data['rol_id'];
                    ?>
                            <tr>
                                <td>
                                    <div class="text-center"><?php echo $data['codigo']; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['numero_documento']; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['nombre']; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['telefono']; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['email']; ?></div>
                                </td>
                                <td class="text-center">
                                    <?php echo $estado; ?>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <button class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicionUsuario" onclick="agregarformUsuario('<?php echo $datos; ?>')"></button>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br />
        <?php if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 1): ?>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalNuevoUsuario">Crear usuario</button>
        <?php endif; ?>
        <br />
        <br />
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>