<?php
require_once '../../modelo/val-admin.php';
include_once '../../modelo/datos-documento.php';
/// Validamos el usuario
if ($rol_user != 1 && $rol_user != 2) {
    echo '<script language = javascript>
    alert ("Debe seleccionar un centro de formación.") 
    self.location="../index.php"
    </script>';
} else {
    // Instancias
    $mis_documentos = new misDocumentos();
     // Coonsulta todos los documentos
     $res = $mis_documentos->viewDocumentos();
}
?>
<div class="col-sm-12">
    <!-- Inicio titulos de la pagina-->
    <div class="page-head">
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>Documentos
                    <small>Servicio Nacional de Aprendizaje - SENA</small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="index.php">Inicio</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span class="active">- Servicio Nacional de Aprendizaje - SENA</span>
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
                        <div class="text-center">Sigla</div>
                    </th>
                    <th>
                        <div class="text-center">Nombre</div>
                    </th>
                    <th>
                        <div class="text-center">Editar</div>
                    </th>
                </thead>
                <tbody>
                    <?php
                    // $res = $mis_documentos->viewDocumentos();
                    foreach ($res as $data) {
                        // Cantidad de materiales
                        //  $cant_materiales = $mismateriales->countAlmacenMateriales($data['codigo_orions']);
                        // Datos
                        $datos = $data['id_tipo_documento'] . "||" .
                            $data['nombre'] . "||" .
                            $data['sigla'];
                    ?>
                        <tr>
                            <td>
                                <div class="text-center"><?php echo $data['id_tipo_documento']; ?></div>
                            </td>
                            <td>
                                <div class="text-center"><?php echo $data['sigla']; ?></div>
                            </td>
                            <td>
                                <div class="text-center"><?php echo $data['nombre']; ?></div>
                            </td>
                            <td>
                               <div class="text-center"><button class="btn btn-primary glyphicon glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicionDocumentos" onclick="agregarFormDocumentos('<?php echo  $datos ?>')"></button></div>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br />
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalNuevoDocumento">Crear un documento</button>
        <br />
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>