<?php
require_once '../../modelo/val-admin.php';
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

    // Coonsulta todos al almacen
    $res2 = $mis_galpon2->viewGalpones2();
    $res1 = $mis_galpon1->viewGalpones1();
    //$res = $mis_almacen->viewAlmacenes();
    $codigoUnico = $res[0]['codigo_orions_almacen'] ?? null;
    $total = $obj->totalNetoPorCodigo($codigoUnico);
    $codigo = $res[0]['codigo_orions_almacen'] ?? null;
    $res = $mis_almacen->viewAlmacenes($codigo);


    //   var_dump($total);
    //   die();

}
?>

<div class="col-sm-12">
    <div class="page-head">
        <link rel="stylesheet" href=".././css/stylos.css">
        <div class="page-head">
            <div class="page-head-modern">
                <h1>ALMACÉN DE GALPONES
                    <small>Almacén de Insumos Avícolas medicamentos y materiales de manejo necesarios para la crianza:</small>
                </h1>
            </div>
        </div>
        <ul class="breadcrumb breadcrumb-modern">
            <li>
                <a href="index.php">Inicio</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span class="active">Almacén de Insumos Avícolas - medicamentos y materiales de manejo necesarios para la crianza:</span>
            </li>
        </ul>
        <!-- BREADCRUMB 2 -->
        <ul class="breadcrumb breadcrumb-modern">
            <li>
                <a target="_blank" href="control_alimento.php">Control de Alimentos</a>
            </li>
            <li>
                <a target="_blank" href="registro_medicamentos.php">REGISTRO DE USO DE MEDICAMENTOS VETERINARIOS</a>
            </li>
        </ul>
        <br />
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <th>
                        <div class="text-center">Item</div>
                    </th>
                    <th>
                        <div class="text-center">Codigo <br />cosecha</div>
                    </th>
                    <th>
                        <div class="text-center">gastos<br />cosecha</div>
                    </th>

                    <th>
                        <div class="text-center">Reporte<br />Cosecha</div>
                    </th>
                    <th>
                        <div class="text-center">Sacar<br />Cálculo / Kg.</div>
                    </th>
                    <th>
                        <div class="text-center">Observaciones</div>
                    </th>
                    <th>
                        <div class="text-center">Editar</div>
                    </th>

                </thead>
                <tbody>
                    <?php
                    foreach ($res as $data) {
                        // Verificar si pertenece al galpón 1 o 2
                        $cant_galpon2 = $mis_galpon2->countAlmacenMateriales($data['codigo_orions_almacen']);
                        $cant_galpon1 = $mis_galpon1->countGalponir1($data['codigo_orions_almacen']);
                        // $cant_codigoAl = $mis_galpon1->countAlmacenCodigoGalpones1($data['codigo_orions']);

                        // URL destino según el galpón
                        $url_destino = "#";

                        if ($cant_galpon2 > 0) {
                            $url_destino = "galpon2.php";
                        } elseif ($cant_galpon1 > 0) {
                            $url_destino = "galpon1.php";
                        }

                        // Preparar datos para editar
                        $datos =  $data['codigo'] . "||" .
                            $data['codigo_orions_almacen'] . "||" .
                            $data['descripcion_material'] . "||" .
                            $data['cantidad_total'] . "||" .
                            $data['precio_kilo'] . "||" .
                            $data['cloro'] . "||" .
                            $data['vinagre'] . "||" .
                            $data['hacido_hacetico'] . "||" .
                            $data['vitaminas'] . "||" .
                            $data['precio_cloro'] . "||" .
                            $data['precio_vinagre'] . "||" .
                            $data['yodo'] . "||" .
                            $data['precio_yodo'] . "||" .
                            $data['precio_hacido'] . "||" .
                            $data['precio_vitamina'] . "||" .
                            $data['anores'] . "||" .
                            $data['precio_anores'] . "||" .
                            $data['vacunas'] . "||" .
                            $data['precio_vacunas'] . "||" .
                            $data['respiros'] . "||" .
                            $data['precio_respiros'] . "||" .
                            $data['tamo'] . "||" .
                            $data['precio_tamo'] . "||" .
                            $data['cal'] . "||" .
                            $data['precio_cal'] . "||" .
                            $data['antibiotico'] . "||" .
                            $data['precio_antibiotico'] . "||" .
                            $data['abc'] . "||" .
                            $data['precio_abc'] . "||" .
                            $data['vicarbonato'] . "||" .
                            $data['precio_vicarbonato'] . "||" .
                            $data['melasa'] . "||" .
                            $data['precio_melasa'] . "||" .
                            $data['agua_potable'] . "||" .
                            $data['precio_agua']  . "||" .
                            $data['luz'] . "||" .
                            $data['precio_luz']  . "||" .
                            $data['arriendo'] . "||" .
                            $data['precio_arriendo']  . "||" .
                            $data['gastos_varios'] . "||" .
                            $data['precio_gastos_varios']  . "||" .
                            $data['gas']  . "||" .
                            $data['precio_gas']  . "||" .
                            $data['alimento_itacol']  . "||" .
                            $data['precio_itacol'];
                    ?>
                        <tr>

                            <!-- CÓDIGO -->
                            <td>
                                <div class="text-center"><?php echo $data['codigo']; ?></div>
                            </td>
                            <!-- CÓDIGO ORIONS + GALPÓN -->
                            <td class="text-center" style="padding:10px;" title="IR AL GALPON">
                                <?php
                                if (!empty($data['codigo_orions_g1'])) {
                                    $url = "galpon1.php?codigo_orions=" . $data['codigo_orions_g1'];
                                } elseif (!empty($data['codigo_orions_g2'])) {
                                    $url = "galpon2.php?codigo_orions=" . $data['codigo_orions_g2'];
                                } else {
                                    $url = "#";
                                }
                                ?>
                                <a href="<?php echo $url; ?>" title="Ir al galpon" style="display:block; width:100%; height:100%; text-decoration:none; color:inherit;">
                                    <div>
                                        <?php if (!empty($data['codigo_orions_g1'])) { ?>
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
                                                <?php echo $data['codigo_orions_g1']; ?>
                                            </div>
                                            <div style="
                                                            margin-top:7px;
                                                            background:#f0f6ff;
                                                            border:1px solid #d0d7e1;
                                                            border-radius:10px;
                                                            padding:8px 10px;
                                                            font-size:12px;
                                                            color:#333;
                                                            box-shadow:0 2px 5px rgba(0,0,0,0.1);
                                                            line-height:18px;">

                                                <?php
                                                // Separar Fecha y Hora para Galpón 1
                                                $inicio_g1 = date_create($data['fecha_inicio_g1']);
                                                $fin_g1 = date_create($data['fecha_fin_g1']);
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
                                            </div>
                                        <?php } ?>

                                        <?php if (!empty($data['codigo_orions_g2'])) { ?>
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
                                                <?php echo $data['codigo_orions_g2']; ?>
                                            </div>
                                            <div style="
                                                        margin-top:7px;
                                                        background:#eef5ff;
                                                        border:1px solid #c6d4e6;
                                                        border-radius:10px;
                                                        padding:8px 10px;
                                                        font-size:12px;
                                                        color:#333;
                                                        box-shadow:0 2px 5px rgba(0,0,0,0.1);
                                                        line-height:18px;">

                                                <?php
                                                // Separar Fecha y Hora para Galpón 2
                                                $inicio_g2 = date_create($data['fecha_inicio_g2']);
                                                $fin_g2 = date_create($data['fecha_fin_g2']);
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
                                            </div>
                                        <?php } ?>
                                    </div>
                                </a>
                            </td>
                            <!-- BOTÓN VER GASTOS -->
                            <td class="text-center">
                                <a href="ver_gastos.php?codigo_orions=<?php echo $data['codigo_orions_almacen']; ?>" title="VER TODOS LOS GASTOS DE LA COSECHA"
                                    target="_blank"
                                    class="btn btn-info btn-sm">
                                    VER TODOS LOS GASTOS
                                </a>
                            </td>
                    
                           
                            <?php
            
                            ?>
                            <td style="cursor:pointer;" title="VER EL REPORTE DE LA COSECHA"
                                onclick="window.open('../fpdf-pago/pagos.php?codigo_orions_almacen=<?php echo $data['codigo_orions_almacen']; ?>', '_blank');">
                                <div class="text-center" style="text-decoration:none;">
                                    <div class="galpon-card" style="pointer-events:none;"> <!-- permite que el td reciba el clic -->
                                        <a href="../fpdf-pago/pagos.php?codigo_orions_almacen=<?php echo $data['codigo_orions_almacen']; ?>"
                                            target="_blank"
                                            style="pointer-events:none;">
                                            <img src="../imagenes/logo-pdf.png" style="text-decoration:none;">
                                            <div class="almacen-box">Ver</div>

                                        </a>
                                    </div>
                                </div>
                            </td>
                            <!-- Calculo -->
                            <!-- BOTÓN CALCULAR PESO -->
                            <td class="text-center" title="CALCULAR PESO NETO DE LA COSECHA">
                                <a href="procesar.php?codigo_orions=<?php echo $data['codigo_orions_almacen']; ?>"
                                    target="_blank"
                                    class="btn btn-info btn-sm">
                                    CALCULAR PESO NETO
                                </a>
                            </td>
                            <td>
                                <div class="text-center"><?php echo !empty($data['descripcion_material']) ? $data['descripcion_material'] : 'N/A'; ?></div>
                            </td>
                            <!-- BOTÓN EDITAR -->
                            <td>
                                <div class="text-center">
                                    <button class="btn btn-primary"
                                        data-toggle="modal"
                                        data-target="#modalEdicionAmacen"
                                        onclick="agregarFormAlmacen('<?php echo $datos ?>')">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </button>
                                </div>
                            </td>


                        </tr>

                    <?php } ?>

                </tbody>

            </table>
        </div>
        <!-- <div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalNuevoAlmacen">Crear un almacen para la cosecha</button>
            <br />
        </div> -->
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>