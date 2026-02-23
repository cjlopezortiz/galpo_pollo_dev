<?php
require_once '../../modelo/val-admin.php';
require_once '../../modelo/datos-usuarios.php';
require_once '../../modelo/datos-rol.php';
////require_once '../../modelo/datos-centroFormacion.php';
////include_once '../../modelo/datos-regional.php';
/// Validamos el usuario
if ($rol_user != 1 && $rol_user != 2) {
    echo '<script language = javascript>
    alert ("Debe seleccionar un centro de formación.") 
    self.location="../index.php"
    </script>';
} else {
    // Instancias
    $mis_usuarios = new misUsuarios();
    $mis_roles = new misRoles();
    // Coonsulta todos los documentos
    $res = $mis_usuarios->viewUsuarios();
}
?>
<div class="col-sm-12">
    <!-- Inicio titulos de la pagina-->
    <div class="page-head">
        <style>
            /* Contenedor principal */
            .page-head-modern {
                background: linear-gradient(135deg, #0000ff, #ffffff);
                padding: 25px 30px;
                border-radius: 12px;
                color: #fff;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                margin-bottom: 20px;
            }

            /* Título */
            .page-head-modern h1 {
                font-size: 32px;
                font-weight: 700;
                margin: 0;
            }

            /* Subtítulo */
            .page-head-modern small {
                font-size: 16px;
                opacity: 0.9;
            }

            /* Breadcrumb */
            .breadcrumb-modern {
                background: #ffffff;
                padding: 12px 18px;
                border-radius: 10px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                margin-bottom: 10px;
            }

            .breadcrumb-modern li a {
                color: #0d6efd;
                font-weight: 500;
                text-decoration: none;
            }

            .breadcrumb-modern li a:hover {
                text-decoration: underline;
            }
        </style>
        <div class="page-head-modern">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Usuarios
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
                <span class="active">Lista de usuarios</span>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <!-- BEGIN DASHBOARD STATS 1-->
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
                        <div class="text-center">Telefono</div>
                    </th>
                    <th>
                        <div class="text-center">Correo<br />electronico</div>
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
                    $res = $mis_usuarios->viewUsuarios();
                    foreach ($res as $data) {
                        // Rol del usuario
                        $cant_usuarios = 1;
                        // $rol = $mis_roles->viewRol($data['rol_id']);
                        // Datos
                        if ($data['estado'] == 1) {
                            $estado = "Activo";
                        } else {
                            $estado = "Inactivo";
                        }
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
                                <div class="text-center">
                                    <?php echo $data['codigo']; ?></div>
        </div>
        </td>
        <td>
            <div class="text-center">
                <?php echo $data['numero_documento']; ?>
            </div>
        </td>
        <td>
            <div class="text-center">
                <?php echo $data['nombre']; ?>
            </div>
        </td>
        <td>
            <div class="text-center">
                <?php echo $data['telefono']; ?>
            </div>
        </td>
        <td>
            <div class="text-center">
                <?php echo $data['email']; ?>
            </div>
        </td>

        <td class="text-center">
            <?php echo $estado; ?>
        </td>
        <td>
            <div class="text-center">
                <button class="btn btn-primary glyphicon glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicionUsuario" onclick="agregarformUsuario('<?php echo  $datos ?>')"></button>
            </div>
        </td>
        </tr>
    <?php
                    }
    ?>
    </tbody>
    </table>
    </div>
    <br />
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalNuevoUsuario">Crear usuario</button>
    <br />
    <br />
</div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>