<?php
require_once '../../modelo/val-admin.php';
include_once '../../modelo/datos-control_alimento.php';
include_once '../../modelo/datos-almacen.php';
include_once '../../modelo/datos-galpon2.php';
include_once '../../modelo/datos-galpon1.php';
include_once '../../modelo/datos-procesar.php';
include_once '../../modelo/datos-usuarios.php';
$mis_usuarios = new misUsuarios();
$res = $mis_usuarios->viewUsuarios();
if (is_array($res)) {
    // Si es un arreglo con la clave rol_id
    if (isset($res['rol_id'])) {
        $rol_id = $res['rol_id'];
    }
    // Si es un arreglo de registros
    elseif (isset($res[0]['rol_id'])) {
        $rol_id = $res[0]['rol_id'];
    } else {
        $rol_id = null;
    }
    //var_dump($rol_id);
} elseif ($res instanceof mysqli_result) {
    $fila = mysqli_fetch_assoc($res);
    if ($fila && isset($fila['rol_id'])) {
        $rol_id = $fila['rol_id'];
        // var_dump($rol_id);
    } else {
        echo "No se encontró el campo rol_id";
    }
} else {
    echo "viewUsuarios() no está retornando datos válidos.";
}
$rol_user = $rol_id;
// Validamos el usuario
if ($rol_user != 1 && $rol_user != 2) {
    echo '<script language = javascript>
    alert ("Debe seleccionar un centro de formación.") 
    self.location="../index.php"
    </script>';
} else {
    // Instancias
    $mis_almacen = new misAlmacenes();
    $mis_galpon2 = new misGalpon2();
    $mis_galpon1 = new misGalpon1();
    $obj         = new misProcesos();
    $mis_control_aliment = new misAlimentos();

    // Coonsulta todos al almacen
  // session_start();

$usuario_codigo = $_SESSION['codigo'];

if (isset($_GET['codigo_orions']) && !empty($_GET['codigo_orions'])) {

    $codigo_orions = $_GET['codigo_orions'];

    $res_control = $mis_control_aliment->viewControlAlimentos($usuario_codigo);

} else {

    $res_control = $mis_control_aliment->viewControlAlimentos($usuario_codigo);
}
    //$res = $mis_almacen->viewAlmacenes();
    $codigoUnico = $res[0]['codigo_orions_almacen'] ?? null;
    $total = $obj->totalNetoPorCodigo($codigoUnico);
    $codigo = $res[0]['codigo_orions_almacen'] ?? null;
    $res = $mis_almacen->viewAlmacenes($codigo);
}
?>
<div class="col-sm-12">
    <!-- Inicio titulos de la pagina-->
    <div class="page-head">
        <link rel="stylesheet" href=".././css/stylos.css">
        <div class="page-head-modern">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>CONTROL DE ALIMENTO
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
                <span class="active">Listado de control de alimentos</span>
            </li>
        </ul>
        <!-- BREADCRUMB 2 -->
        <ul class="breadcrumb breadcrumb-modern">
            <li>
                <a target="_blank" href="almacen.php">Almacén</a>
            </li>
            <li>
                <a target="_blank" href="registro_medicamentos.php">REGISTRO DE USO DE MEDICAMENTOS VETERINARIOS</a>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->

        <!-- BEGIN PAGE BASE CONTENT -->
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
                            <div class="text-center">Entradas</div>
                        </th>
                        <th>
                            <div class="text-center">Salidas</div>
                        </th>
                        <th>
                            <div class="text-center">Consumo Tabla</div>
                        </th>
                        <th>
                            <div class="text-center">Consumo Real</div>
                        </th>
                        <th>
                            <div class="text-center">Acumulado Tabla</div>
                        </th>
                        <th>
                            <div class="text-center">Acumulado Real</div>
                        </th>
                        <th>
                            <div class="text-center">Saldo Real</div>
                        </th>
                        <th>
                            <div class="text-center">Programación de Alimento</div>
                        </th>
                        <th>
                            <div class="text-center">Observaciones</div>
                        </th>
                        <th>
                            <div class="text-center">Editar</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $res_control = $mis_control_aliment->viewControlAlimentos($usuario_codigo);
                    // Consultas generales necesarias para las búsquedas internas
                    $res2 = $mis_galpon2->viewGalpones2();
                    $res1 = $mis_galpon1->viewGalpones1();
          
                    if (is_array($res_control) || $res_control instanceof Traversable) {
                        foreach ($res_control as $data) {

                            // 1. Identificamos el código clave de la fila actual
                            // Cambia 'codigo_orions_almacen' o 'codigo_orions' según cómo se llame en tu tabla control_alimento
                            $id_buscar = $data['codigo_orions_almacen'] ?? $data['codigo_orions'] ?? null;

                            // =======================================
                            // IDENTIFICAR A QUÉ GALPÓN PERTENECE
                            // =======================================

                            $cant_galpon1 = 0;
                            $cant_galpon2 = 0;

                            if (!empty($id_buscar)) {
                                $cant_galpon1 = (int)$mis_galpon1->countGalponir1($id_buscar);
                                $cant_galpon2 = (int)$mis_galpon2->countAlmacenMateriales($id_buscar);
                            }

                            $codigo_g1 = null;
                            $codigo_g2 = null;

                            // PRIORIDAD GALPÓN SUR
                            if ($cant_galpon2 > 0) {

                                $codigo_g2 = $id_buscar;
                            } elseif ($cant_galpon1 > 0) {

                                $codigo_g1 = $id_buscar;
                            }

                            // Si vienen directamente desde la consulta
                            if (!empty($data['codigo_orions_g2'])) {

                                $codigo_g2 = $data['codigo_orions_g2'];
                                $codigo_g1 = null;
                            } elseif (!empty($data['codigo_orions_g1'])) {

                                $codigo_g1 = $data['codigo_orions_g1'];
                                $codigo_g2 = null;
                            }

                            // =======================================
                            // URL DESTINO
                            // =======================================

                            $url = "#";

                            if (!empty($codigo_g1)) {
                                $url = "galpon1.php?codigo_orions=" . $codigo_g1;
                            }

                            if (!empty($codigo_g2)) {
                                $url = "galpon2.php?codigo_orions=" . $codigo_g2;
                            }

                            // Preparamos la cadena de datos para el JS del modal
                            $datos = ($data['codigo'] ?? '') . "||" .
                                ($id_buscar ?? '') . "||" .
                                ($data['fecha_control_aliment'] ?? '') . "||" .
                                ($data['entradas'] ?? '') . "||" .
                                ($data['salidas'] ?? '') . "||" .
                                ($data['consumo_tabla'] ?? '') . "||" .
                                ($data['consumo_real'] ?? '') . "||" .
                                ($data['acumulado_tabla'] ?? '') . "||" .
                                ($data['acumulado_real'] ?? '') . "||" .
                                ($data['saldo_real'] ?? '') . "||" .
                                ($data['programacion'] ?? '') . "||" .
                                ($data['observaciones'] ?? '');
                    ?>
                            <tr>
                                <td>
                                    <div class="text-center"><?php echo $data['codigo'] ?? ''; ?></div>
                                </td>
                                <td
                                    class="text-center" style="padding:10px;" title="IR AL GALPON">
                                    <a href="<?php echo $url; ?>" title="Ir al galpon" style="display:block; width:100%; height:100%; text-decoration:none; color:inherit;">
                                        <div>
                                            <!-- Si pertenece al Galpón 1 -->
                                            <?php if (!empty($codigo_g1) && empty($codigo_g2)) { ?>
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
                                                    <?php echo $codigo_g1; ?>
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
                                                    // echo "Sin fechas registradas";
                                                    //} 
                                                    ?>
                                                </div>
                                            <?php } ?>

                                            <!-- Si pertenece al Galpón 2 -->
                                            <?php if (!empty($codigo_g2)) { ?>
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
                                                    <?php echo $codigo_g2; ?>
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
                                                    // echo "";
                                                    //} 
                                                    ?>
                                                </div>
                                            <?php } ?>

                                            <!-- Si no pertenece a ninguno -->
                                            <?php if (empty($codigo_g1) && empty($codigo_g2)) { ?>
                                                <span class="text-muted">No asignado</span>
                                            <?php } ?>
                                        </div>
                                    </a>

                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['fecha_control_aliment'] ?? ''; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['entradas'] ?? ''; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['salidas'] ?? ''; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['consumo_tabla'] ?? ''; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['consumo_real'] ?? ''; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['acumulado_tabla'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['acumulado_real'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['saldo_real'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['programacion'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center"><?php echo $data['observaciones'] ?? 'N/A'; ?></div>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <button class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicionControlAlimento" onclick="agregarFormControlAlimento('<?php echo $datos; ?>')"></button>
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
    <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalNuevoControAlimento">Crear nuevo control</button> -->
    <br />
    <br />
</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>