<?php
require_once '../../modelo/val-admin.php';
include_once '../../modelo/datos-registro_medicamentos.php';
include_once '../../modelo/datos-almacen.php';
include_once '../../modelo/datos-galpon2.php';
include_once '../../modelo/datos-galpon1.php';
include_once '../../modelo/datos-procesar.php';
include_once '../../modelo/datos-usuarios.php';

$mis_usuarios = new misUsuarios();
$res_usuarios = $mis_usuarios->viewUsuarios();
$rol_id = null;

if (is_array($res_usuarios)) {
    if (isset($res_usuarios['rol_id'])) {
        $rol_id = $res_usuarios['rol_id'];
    } elseif (isset($res_usuarios[0]['rol_id'])) {
        $rol_id = $res_usuarios[0]['rol_id'];
    }
} elseif ($res_usuarios instanceof mysqli_result) {
    $fila = mysqli_fetch_assoc($res_usuarios);
    if ($fila && isset($fila['rol_id'])) {
        $rol_id = $fila['rol_id'];
    } else {
        echo "No se encontró el campo rol_id";
    }
} else {
    echo "viewUsuarios() no está retornando datos válidos.";
}

$rol_user = $rol_id;

// Validamos el usuario
if ($rol_user != 1 && $rol_user != 2) {
    echo '<script language="javascript">
    alert("Debe seleccionar un centro de formación.");
    self.location="../index.php";
    </script>';
} else {
    // Instancias
    $mis_almacen = new misAlmacenes();
    $mis_galpon2 = new misGalpon2();
    $mis_galpon1 = new misGalpon1();
    $obj         = new misProcesos();
    $mis_medicamentos = new misMedicamentos();

    // Consultas al almacén utilizando la nueva variable res_usuarios para evitar sobreescritura
    $res2 = $mis_galpon2->viewGalpones2();
    $res1 = $mis_galpon1->viewGalpones1();

    $codigoUnico = (is_array($res_usuarios) ? ($res_usuarios[0]['codigo_orions_almacen'] ?? null) : ($fila['codigo_orions_almacen'] ?? null));
    $total = $obj->totalNetoPorCodigo($codigoUnico);

    $res_almacen = $mis_almacen->viewAlmacenes($codigoUnico);
}
?>
<div class="col-sm-12">
    <!-- Inicio titulos de la pagina-->
    <div class="page-head">
        <div class="page-head-modern">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>REGISTRO DE USO DE MEDICAMENTOS VETERINARIOS</h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>

        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="breadcrumb breadcrumb-modern">
            <li>
                <a href="index.php">Inicio</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span class="active">Uso de Medicamentos</span>
            </li>
        </ul>
        <!-- BREADCRUMB 2 -->
        <ul class="breadcrumb breadcrumb-modern">
            <li>
                <a href="almacen.php">Almacén</a>
            </li>
            <li>
                <a href="control_alimento.php">Control de Alimentos</a>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->

        <br />
        <!-- INICIO DEL CONTENIDO -->
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>
                            <div class="text-center">Codigo</div>
                        </th>
                        <th>
                            <div class="text-center">código cosecha</div>
                        </th>
                        <th>
                            <div class="text-center">Fecha</div>
                        </th>
                        <th>
                            <div class="text-center">Nombre del Producto</div>
                        </th>
                        <th>
                            <div class="text-center">Causa</div>
                        </th>
                        <th>
                            <div class="text-center">Laboratorio</div>
                        </th>
                        <th>
                            <div class="text-center">Registro ICA</div>
                        </th>
                        <th>
                            <div class="text-center">Dosis</div>
                        </th>
                        <th>
                            <div class="text-center">Lote del Producto</div>
                        </th>
                        <th>
                            <div class="text-center">Vencimiento</div>
                        </th>
                        <th>
                            <div class="text-center">Administración</div>
                        </th>
                        <th>
                            <div class="text-center">Animales</div>
                        </th>
                        <th>
                            <div class="text-center">Galpón Tratado</div>
                        </th>
                        <th>
                            <div class="text-center">Editar</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res_control_regist_medic = $mis_medicamentos->viewMedicamentos();
                    // Consultas generales necesarias para las búsquedas internas
                    $res2 = $mis_galpon2->viewGalpones2();
                    $res1 = $mis_galpon1->viewGalpones1();

                    if (is_array($res_control_regist_medic) || $res_control_regist_medic instanceof Traversable) {
                        foreach ($res_control_regist_medic as $data) {

                            // 1. Identificamos el código clave de la fila actual
                            // Añadimos 'codigo' o 'codigo_cosecha' como fallback en caso de que use otro nombre en la BD
                            $id_buscar_regist_medic = $data['codigo_orions_almacen'] ?? $data['codigo_orions'] ?? $data['codigo_cosecha'] ?? null;

                            // =======================================
                            // IDENTIFICAR A QUÉ GALPÓN PERTENECE
                            // =======================================

                            $cant_galpon1_r = 0;
                            $cant_galpon2_r = 0;

                            if (!empty($id_buscar_regist_medic)) {
                                $cant_galpon1_r = (int)$mis_galpon1->countGalponir1($id_buscar_regist_medic);
                                $cant_galpon2_r = (int)$mis_galpon2->countAlmacenMateriales($id_buscar_regist_medic);
                            }

                            $codigo_g1_r = null;
                            $codigo_g2_r = null;

                            // PRIORIDAD GALPÓN SUR
                            if ($cant_galpon2_r > 0) {
                                $codigo_g2_r = $id_buscar_regist_medic;
                            } elseif ($cant_galpon1_r > 0) {
                                $codigo_g1_r = $id_buscar_regist_medic;
                            }

                            // Si vienen directamente desde la consulta
                            if (!empty($data['codigo_orions_g2'])) {
                                $codigo_g2_r = $data['codigo_orions_g2'];
                                $codigo_g1_r = null;
                            } elseif (!empty($data['codigo_orions_g1'])) {
                                $codigo_g1_r = $data['codigo_orions_g1'];
                                $codigo_g2_r = null;
                            }

                            // =======================================
                            // URL DESTINO
                            // =======================================

                            $url = "#";

                            if (!empty($codigo_g1_r)) {
                                $url = "galpon1.php?codigo_orions=" . $codigo_g1_r;
                            }

                            if (!empty($codigo_g2_r)) {
                                $url = "galpon2.php?codigo_orions=" . $codigo_g2_r;
                            }
                            // NOTA: Asegúrate de que en tu archivo JS/HTML que renderiza la tabla, 
                            // la columna "Código" pinte el SEGUNDO parámetro (id_buscar_regist_medic) y no el primero.
                            $datos = ($data['codigo'] ?? $data['id'] ?? '') . "||" .
                                ($id_buscar_regist_medic ?? 'S/C') . "||" .
                                ($data['fecha'] ?? '') . "||" .
                                ($data['nombre_producto']  ?? '') . "||" .
                                ($data['causa'] ?? '') . "||" .
                                ($data['laboratorio'] ?? '') . "||" .
                                ($data['registro_ica'] ?? '') . "||" .
                                ($data['dosis'] ?? '') . "||" .
                                ($data['lote_producto'] ?? '') . "||" .
                                ($data['vencimiento'] ?? '') . "||" .
                                ($data['administracion'] ?? '') . "||" .
                                ($data['animales'] ?? '') . "||" .
                                ($data['galpon_tratado'] ?? '');

                    ?>
                            <tr>

                                <td>
                                    <div class="text-center"><?php echo $data['codigo']; ?></div>
                                </td>
                                <td class="text-center" style="padding:10px;" title="IR AL GALPON">
                                    <a href="<?php echo $url; ?>" title="Ir al galpon" style="display:block; width:100%; height:100%; text-decoration:none; color:inherit;">
                                        <div>
                                            <!-- Si pertenece al Galpón 1 -->
                                            <?php if ($codigo_g1_r !== null && $codigo_g2_r === null) { ?>
                                                <span style="
                                        display:inline-block;
                                        background:#28a745;
                                        color:white;
                                        padding:4px 12px;
                                        border-radius:20px;
                                        font-size:12px;
                                        font-weight:bold;
                                        box-shadow:0px 1px 4px rgba(0,0,0,0.2);">
                                                    GALPÓN AVÍCOLA NORTE MACHOS
                                                </span>
                                                <div style="margin-top:5px; font-size:15px; font-weight:bold; color:#007bff;">
                                                    <?php echo $codigo_g1_r; ?>
                                                </div>
                                                <div style="margin-top:7px; background:#f0f6ff; border:1px solid #d0d7e1; border-radius:10px; padding:8px 10px; font-size:12px; color:#333; box-shadow:0 2px 5px rgba(0,0,0,0.1); line-height:18px;">
                                                    <?php
                                                    if (!empty($data['fecha_inicio_g1'])) {
                                                        $inicio_g1 = date_create($data['fecha_inicio_g1']);
                                                        $fin_g1 = date_create($data['fecha_fin_g1'] ?? 'now');
                                                    ?>
                                                        <div style="margin-bottom: 6px;">
                                                            <b>Fecha Inicio:</b> <?php echo date_format($inicio_g1, 'Y-m-d'); ?><br>
                                                            <b>Hora Inicio:</b> <?php echo date_format($inicio_g1, 'H:i:s'); ?>
                                                        </div>
                                                        <hr style="border: 0; border-top: 1px solid #d0d7e1; margin: 6px 0;">
                                                        <div>
                                                            <b>Fecha Fin:</b> <?php echo date_format($fin_g1, 'Y-m-d'); ?><br>
                                                            <b>Hora Fin:</b> <?php echo date_format($fin_g1, 'H:i:s'); ?>
                                                        </div>
                                                    <?php } //else {
                                                        //echo "Sin fechas registradas";
                                                    //} ?>
                                                </div>
                                            <?php } ?>

                                            <!-- Si pertenece al Galpón 2 -->
                                            <?php if ($codigo_g2_r !== null) { ?>
                                                <span style="
                                        display:inline-block;
                                        background:#007bff;
                                        color:white;
                                        padding:4px 12px;
                                        border-radius:20px;
                                        font-size:12px;
                                        font-weight:bold;
                                        box-shadow:0px 1px 4px rgba(0,0,0,0.2); ">
                                                    GALPÓN AVÍCOLA SUR HEMBRAS
                                                </span>
                                                <div style="margin-top:5px; font-size:15px; font-weight:bold; color:#007bff;">
                                                    <?php echo $codigo_g2_r; ?>
                                                </div>
                                                <div style="margin-top:7px; background:#eef5ff; border:1px solid #c6d4e6; border-radius:10px; padding:8px 10px; font-size:12px; color:#333; box-shadow:0 2px 5px rgba(0,0,0,0.1); line-height:18px;">
                                                    <?php
                                                    if (!empty($data['fecha_inicio_g2'])) {
                                                        $inicio_g2 = date_create($data['fecha_inicio_g2']);
                                                        $fin_g2 = date_create($data['fecha_fin_g2'] ?? 'now');
                                                    ?>
                                                        <div style="margin-bottom: 6px;">
                                                            <b>Fecha Inicio:</b> <?php echo date_format($inicio_g2, 'Y-m-d'); ?><br>
                                                            <b>Hora Inicio:</b> <?php echo date_format($inicio_g2, 'H:i:s'); ?>
                                                        </div>
                                                        <hr style="border: 0; border-top: 1px solid #c6d4e6; margin: 6px 0;">
                                                        <div>
                                                            <b>Fecha Fin:</b> <?php echo date_format($fin_g2, 'Y-m-d'); ?><br>
                                                            <b>Hora Fin:</b> <?php echo date_format($fin_g2, 'H:i:s'); ?>
                                                        </div>
                                                    <?php } //else {
                                                        //echo "Sin fechas registradas";
                                                   // } ?>
                                                </div>
                                            <?php } ?>

                                            <!-- Si no pertenece a ninguno -->
                                            <?php if ($codigo_g1_r === null && $codigo_g2_r === null) { ?>
                                                <span class="text-muted">No asignado</span>
                                            <?php } ?>
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['fecha'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['nombre_producto'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['causa'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['laboratorio'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['registro_ica'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['dosis'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['lote_producto'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['vencimiento'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['administracion'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['animales'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['galpon_tratado'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <button class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicionRegistroMedicamentos" onclick="agregarformRegistroMedicamentos('<?php echo $datos; ?>')"></button>
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
    </div>
    <br />
    <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalNuevoRegistroMedicamentos">Crear nuevo registro</button> -->
    <br />
    <br />
</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>