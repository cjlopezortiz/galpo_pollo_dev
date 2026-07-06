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
    if (isset($res['rol_id'])) {
        $rol_id = $res['rol_id'];
    } elseif (isset($res[0]['rol_id'])) {
        $rol_id = $res[0]['rol_id'];
    } else {
        $rol_id = null;
    }
} elseif ($res instanceof mysqli_result) {
    $fila = mysqli_fetch_assoc($res);
    if ($fila && isset($fila['rol_id'])) {
        $rol_id = $fila['rol_id'];
    } else {
        echo "No se encontró el campo rol_id";
    }
} else {
    echo "viewUsuarios() no está retornando datos válidos.";
}
$rol_user = $rol_id;

if ($rol_user != 1 && $rol_user != 2) {
    echo '<script language = javascript>
    alert ("Debe seleccionar un centro de formación.") 
    self.location="../index.php"
    </script>';
} else {
    $mis_almacen = new misAlmacenes();
    $mis_galpon2 = new misGalpon2();
    $mis_galpon1 = new misGalpon1();
    $obj         = new misProcesos();

    $res2 = $mis_galpon2->viewGalpones2();
    $res1 = $mis_galpon1->viewGalpones1();
    $codigo = $res[0]['codigo_orions_almacen'] ?? null;
    $res = $mis_almacen->viewAlmacenes($codigo);

    $codigoUnico = $res[0]['codigo_orions_almacen'] ?? null;
    $total = $obj->totalNetoPorCodigo($codigoUnico);
}

$codigo_filtro = isset($_GET['codigo_orions']) ? $_GET['codigo_orions'] : '0';
?>

<!-- ENCABEZADO -->
<div class="page-title text-center" style="margin-bottom: 30px;">
         <link rel="stylesheet" href=".././css/stylos.css">
    <h1 style="font-weight: 700; color: #333;"><i class="fa fa-calculator" style="color: #312699;"></i> Ver todos los gastos de la cosecha</h1>
    <p style="font-size: 16px; color: #666;">Código de la cosecha: <strong style="color: #312699; font-size: 18px;"><?php echo $codigo_filtro; ?></strong></p>
    <div style="margin-top: 15px;">
        <a href="almacen.php" class="btn btn-default" style="border-radius: 20px; border: 2px solid #312699; font-weight: bold; color: #312699; padding: 6px 20px; transition: all 0.3s;">
            <i class="fa fa-arrow-left"></i> Volver al Almacén
        </a>
    </div>
</div>

<!-- TABLA DE COSECHAS -->
<div class="container">
    <div class="table-responsive" style="box-shadow: 0 4px 12px rgba(0,0,0,0.1); border-radius: 10px; overflow: hidden; background: white;">
        <table id="modalPrecio" class="table table-hover table-striped vertical-align" style="margin-bottom: 0;">
            <thead style="background-color: #312699; color: white;">
                <tr>
                    <th class="text-center" style="padding: 12px;">Código Registro</th>
                    <th class="text-center" style="padding: 12px;">Código Almacén</th>
                    <th class="text-center" style="padding: 12px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($res as $data) {
                    $cant_galpon2 = $mis_galpon2->countAlmacenMateriales($data['codigo_orions_almacen']);
                    $cant_galpon1 = $mis_galpon1->countGalponir1($data['codigo_orions_almacen']);

                    $url_destino = "#";
                    if ($cant_galpon2 > 0) {
                        $url_destino = "galpon2.php";
                    } elseif ($cant_galpon1 > 0) {
                        $url_destino = "galpon1.php";
                    }
                ?>
                    <tr>
                        <td class="text-center" style="vertical-align: middle; font-weight: bold;"><?php echo $data['codigo']; ?></td>
                        <td class="text-center" style="vertical-align: middle;"><?php echo $data['codigo_orions_almacen']; ?></td>
                        <td class="text-center" style="vertical-align: middle;">
                            <!-- BOTÓN QUE ACTIVA EL MODAL -->
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalPrecio<?php echo $data['codigo_orions_almacen']; ?>" style="border-radius: 15px; font-weight: bold; padding: 5px 15px;">
                                <i class="fa fa-eye"></i> Ver Gastos Detallados
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- CONTENEDOR DE MODALES (Fuera de la tabla para evitar conflictos HTML) -->
<?php foreach ($res as $data) { ?>
    <div class="modal fade" id="modalPrecio<?php echo $data['codigo_orions_almacen']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="border-radius:18px; box-shadow:0 10px 30px rgba(0,0,0,0.3); border: none;">
                
                <div class="modal-header" style="background: linear-gradient(90deg, #312699, #4a3fcc); border-radius:18px 18px 0 0; padding: 15px 20px;">
                    <h5 class="modal-title text-white" style="font-weight: bold; font-size: 18px;">
                        💰 Detalle de Costos (Almacén: <?php echo $data['codigo_orions_almacen']; ?>)
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 0.8;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" style="font-size:15px; background-color: #f8f9fa; padding: 25px;">
                    <?php
                    $precio_final = 0;
                    
                    $cantidad_pollo     = $data['cantidad_pollo_g1'] ?? ($data['cantidad_pollo_g2'] ?? null);
                    $precio_pollo       = $data['precio_pollo_g1'] ?? ($data['precio_pollo_g2'] ?? null);
                    $cantidad_al        = $data['cantidad_g1'] ?? ($data['cantidad_g2'] ?? null);
                    $precio_al          = $data['precio_alimento_g1'] ?? ($data['precio_alimento_g2'] ?? null);
                    $fayido             = $data['fayido_g1'] ?? ($data['fayido_g2'] ?? null);
                    $inicio_ali         = $data['alimento_inicio_g1'] ?? ($data['alimento_inicio_g2'] ?? null);
                    $precio_ini         = $data['precio_inicio_g1'] ?? ($data['precio_inicio_g2'] ?? null);
                    $preinicio_ali      = $data['alimento_preinicio_g1'] ?? ($data['alimento_preinicio_g2'] ?? null);
                    $precio_pre         = $data['precio_preinicio_g1'] ?? ($data['precio_preinicio_g2'] ?? null);

                    $cloro              = $data['cloro'] ?? null;
                    $precio_cloro       = $data['precio_cloro'] ?? null;
                    $vinagre            = $data['vinagre'] ?? null;
                    $precio_vinagre     = $data['precio_vinagre'] ?? null;
                    $hacido_hacetico    = $data['hacido_hacetico'] ?? null;
                    $precio_hacido      = $data['precio_hacido'] ?? null;
                    $vitaminas          = $data['vitaminas'] ?? null;
                    $precio_vitaminas   = $data['precio_vitamina'] ?? null;
                    $anores             = $data['anores'] ?? null;
                    $precio_anores      = $data['precio_anores'] ?? null;
                    $vacunas            = $data['vacunas'] ?? null;
                    $precio_vacunas     = $data['precio_vacunas'] ?? null;
                    $respiros           = $data['respiros'] ?? null;
                    $precio_respiros    = $data['precio_respiros'] ?? null;
                    $tamo               = $data['tamo'] ?? null;
                    $precio_tamo        = $data['precio_tamo'] ?? null;
                    $cal                = $data['cal'] ?? null;
                    $precio_cal         = $data['precio_cal'] ?? null;
                    $antibiotico        = $data['antibiotico'] ?? null;
                    $precio_antibiotico = $data['precio_antibiotico'] ?? null;
                    $abc                = $data['abc'] ?? null;
                    $precio_abc         = $data['precio_abc'] ?? null;
                    $vicarbonato        = $data['vicarbonato'] ?? null;
                    $precio_vicarbonato = $data['precio_vicarbonato'] ?? null;
                    $melasa             = $data['melasa'] ?? null;
                    $precio_melasa      = $data['precio_melasa'] ?? null;
                    $agua_potable       = $data['agua_potable'] ?? null;
                    $precio_agua        = $data['precio_agua'] ?? null;
                    $luz                = $data['luz'] ?? null;
                    $precio_luz         = $data['precio_luz'] ?? null;
                    $arriendo           = $data['arriendo'] ?? null;
                    $precio_arriendo    = $data['precio_arriendo'] ?? null;
                    $gastos_varios      = $data['gastos_varios'] ?? null;
                    $precio_gastos_varios = $data['precio_gastos_varios'] ?? null;
                    $yodo               = $data['yodo'] ?? null;
                    $precio_yodo        = $data['precio_yodo'] ?? null;

                    $items = [];

                    if (!empty($cantidad_pollo) && !empty($precio_pollo)) {
                        $total_pollo = $cantidad_pollo * $precio_pollo;
                        $precio_final += $total_pollo;
                        $items[] = ['Precio por unidad Pollo', $cantidad_pollo, $precio_pollo, $total_pollo, '#eaf8f0', '#28a745', '🐔'];
                    }
                    if (!empty($inicio_ali) && !empty($precio_ini)) {
                        $total_inicio = $inicio_ali * $precio_ini;
                        $precio_final += $total_inicio;
                        $items[] = ['Precio por vulto Alimento Inicio', $inicio_ali, $precio_ini, $total_inicio, '#eaf8f0', '#007bff', '🌾'];
                    }
                    if (!empty($cantidad_al) && !empty($precio_al)) {
                        $total_al = $cantidad_al * $precio_al;
                        $precio_final += $total_al;
                        $items[] = ['Precio por vulto Alimento Engorde', $cantidad_al, $precio_al, $total_al, '#ecf5ff', '#007bff', '🌾'];
                    }
                    if (!empty($preinicio_ali) && !empty($precio_pre)) {
                        $total_pre = $preinicio_ali * $precio_pre;
                        $precio_final += $total_pre;
                        $items[] = ['Precio por vulto Alimento Crecimiento', $preinicio_ali, $precio_pre, $total_pre, '#eaf8f0', '#007bff', '🌾'];
                    }
                    if (!empty($cloro) && !empty($precio_cloro)) {
                        $total_cloro = $cloro * $precio_cloro;
                        $precio_final += $total_cloro;
                        $items[] = ['Cloro', $cloro, $precio_cloro, $total_cloro, '#e7f9ff', '#17a2b8', '🧴'];
                    }
                    if (!empty($vinagre) && !empty($precio_vinagre)) {
                        $total_vinagre = $vinagre * $precio_vinagre;
                        $precio_final += $total_vinagre;
                        $items[] = ['Vinagre', $vinagre, $precio_vinagre, $total_vinagre, '#fff7e6', '#ff9800', '🍶'];
                    }
                    if (!empty($vitaminas) && !empty($precio_vitaminas)) {
                        $total_vitaminas = $vitaminas * $precio_vitaminas;
                        $precio_final += $total_vitaminas;
                        $items[] = ['Vitaminas', $vitaminas, $precio_vitaminas, $total_vitaminas, '#f3e8ff', '#6f42c1', '💊'];
                    }
                    if (!empty($hacido_hacetico) && !empty($precio_hacido)) {
                        $total_acido = $hacido_hacetico * $precio_hacido;
                        $precio_final += $total_acido;
                        $items[] = ['Ácido Hídrico', $hacido_hacetico, $precio_hacido, $total_acido, '#ffe6ef', '#e83e8c', '🧪'];
                    }
                    if (!empty($anores) && !empty($precio_anores)) {
                        $total_anores = $anores * $precio_anores;
                        $precio_final += $total_anores;
                        $items[] = ['Anores', $anores, $precio_anores, $total_anores, '#fcf9f2', '#c9c54e', '💊'];
                    }
                    if (!empty($vacunas) && !empty($precio_vacunas)) {
                        $total_vacunas = $vacunas * $precio_vacunas;
                        $precio_final += $total_vacunas;
                        $items[] = ['Vacunas', $vacunas, $precio_vacunas, $total_vacunas, '#e6f9ed', '#20c997', '💉'];
                    }
                    if (!empty($respiros) && !empty($precio_respiros)) {
                        $total_respiros = $respiros * $precio_respiros;
                        $precio_final += $total_respiros;
                        $items[] = ['Respiros', $respiros, $precio_respiros, $total_respiros, '#e3f2fd', '#2196f3', '🌬️'];
                    }
                    if (!empty($tamo) && !empty($precio_tamo)) {
                        $total_tamo = $tamo * $precio_tamo;
                        $precio_final += $total_tamo;
                        $items[] = ['Tamo', $tamo, $precio_tamo, $total_tamo, '#fdf6e9', '#996515', '🌾'];
                    }
                
                    if (!empty($cal) && !empty($precio_cal)) {
                        $total_cal = $cal * $precio_cal;
                        $precio_final += $total_cal;
                        $items[] = ['Cal', $cal, $precio_cal, $total_cal, '#f0f0f0', '#777', '⚪'];
                    }
                    if (!empty($antibiotico) && !empty($precio_antibiotico)) {
                        $total_antibiotico = $antibiotico * $precio_antibiotico;
                        $precio_final += $total_antibiotico;
                        $items[] = ['Antibiótico', $antibiotico, $precio_antibiotico, $total_antibiotico, '#fbe7e8', '#d45963', '🩹'];
                    }
                    if (!empty($abc) && !empty($precio_abc)) {
                        $total_abc = $abc * $precio_abc;
                        $precio_final += $total_abc;
                        $items[] = ['Otros medicamentos (ABC)', $abc, $precio_abc, $total_abc, '#f7efff', '#a361ff', 'An'];
                    }
                    if (!empty($vicarbonato) && !empty($precio_vicarbonato)) {
                        $total_vicarbonato = $vicarbonato * $precio_vicarbonato;
                        $precio_final += $total_vicarbonato;
                        $items[] = ['Bicarbonato', $vicarbonato, $precio_vicarbonato, $total_vicarbonato, '#fff0e6', '#ff7a3d', '🧂'];
                    }
                    if (!empty($melasa) && !empty($precio_melasa)) {
                        $total_melasa = $melasa * $precio_melasa;
                        $precio_final += $total_melasa;
                        $items[] = ['Melasa', $melasa, $precio_melasa, $total_melasa, '#fdfae5', '#e6b800', '🍯'];
                    }
                    if (!empty($agua_potable) && !empty($precio_agua)) {
                        $total_agua = $agua_potable * $precio_agua;
                        $precio_final += $total_agua;
                        $items[] = ['Agua Potable', $agua_potable, $precio_agua, $total_agua, '#e3f5ff', '#0093d5', '💧'];
                    }
                    if ($luz !== null && $precio_luz !== null) {
                        $total_luz = $luz * $precio_luz;
                        $precio_final += $total_luz;
                        $items[] = ['Electricidad (Luz)', $luz, $precio_luz, $total_luz, '#fefce8', '#ffcc00', '💡'];
                    }
                    if ($arriendo !== null && $precio_arriendo !== null) {
                        $total_arriendo = $arriendo * $precio_arriendo;
                        $precio_final += $total_arriendo;
                        $items[] = ['Arriendo', $arriendo, $precio_arriendo, $total_arriendo, '#f0e6ff', '#8e44ad', '🏠'];
                    }
                    if (!empty($yodo) && !empty($precio_yodo)) {
                        $total_yodo = $yodo * $precio_yodo;
                        $precio_final += $total_yodo;
                        $items[] = ['Yodo', $yodo, $precio_yodo, $total_yodo, '#ffedcc', '#a34823', '🧪'];
                    }
                    if (!empty($precio_gastos_varios)) {
                        $cantidad_gastos = $gastos_varios ?? 1;
                        $total_gastos_varios = $cantidad_gastos * $precio_gastos_varios;
                        $precio_final += $total_gastos_varios;
                        $items[] = ['Gastos Varios', $cantidad_gastos, $precio_gastos_varios, $total_gastos_varios, '#f0eef0', '#5a6268', '🛍️'];
                    }
                    
                    if (!empty($fayido) && !empty($precio_pollo)) {
                        $total_fayido = $fayido * $precio_pollo;
                        $precio_final += $total_fayido;
                        $items[] = ['Pollos muertos', $fayido, $precio_pollo, $total_fayido, '#eaf8f0', '#28a745', '🐔'];
                    }

                    $total_items = count($items);
                    $half_point = ceil($total_items / 2);
                    $card_count = 0;

                    echo '<div class="row">';
                    echo '<div class="col-md-6">';

                    foreach ($items as $item) {
                        list($titulo, $cantidad, $precio_unitario, $total, $bg_color, $border_color, $icon) = $item;
                        $card_count++;

                        if ($card_count > $half_point) {
                            echo '</div>';
                            echo '<div class="col-md-6">';
                            $half_point = PHP_INT_MAX;
                        }
                    ?>
                        <div style="background:<?php echo $bg_color; ?>; border-left:5px solid <?php echo $border_color; ?>; padding:15px; border-radius:12px; margin-bottom:15px; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
                            <h6 style="font-weight:bold; color:<?php echo $border_color; ?>; margin-bottom: 8px;"><?php echo $icon; ?> <?php echo $titulo; ?></h6>
                            <p style="margin:0; font-size: 13px;"><b>Precio:</b> $<?php echo number_format($precio_unitario, 0, ',', '.'); ?></p>
                            <p style="margin:0; font-size: 13px;"><b>Cantidad:</b> <?php echo $cantidad; ?></p>
                            <p style="margin:0; font-size: 13px; font-weight: bold;"><b>Total:</b> $<?php echo number_format($total, 0, ',', '.'); ?></p>
                        </div>
                    <?php
                    }
                    echo '</div>'; // Cierre col-md-6
                    echo '</div>'; // Cierre row

                    // MORTANDAD (Fayidos)
                    if (!empty($fayido) && !empty($precio_pollo)) {
                        $precio_unitario_fayido = $precio_pollo;
                        $totalperdida = $fayido * $precio_pollo;

                    ?>
                        <div class="row">
                            <div class="col-12 mt-2">
                                <div style="background:#ffe8e8; border-left:5px solid #dc3545; padding:15px; border-radius:12px; margin-bottom:15px; box-shadow:0 2px 8px rgba(0,0,0,0.05);">
                                    <h6 style="font-weight:bold; color:#dc3545; margin-bottom: 5px;">☠ Cantidad de mortandad de pollos (Costo no sumado)</h6>
                                    <p style="margin:0; font-size: 13px;"><b>Cantidad Mortandad:</b> <?php echo $fayido; ?></p>
                                    <p style="margin:0; font-size: 13px;"><b>Precio unitario de pollo:</b> $<?php echo number_format($precio_unitario_fayido, 0, ',', '.'); ?></p>
                                    <p style="margin:0; font-size: 13px;"><b>Total perdida:</b> $<?php echo number_format($totalperdida, 0, ',', '.'); ?></p>
                                    <p style="margin:0; color:#dc3545; font-style:italic; font-size: 12px; margin-top: 5px;">* No incluido en el total final.</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <hr style="border-top: 2px dashed #ddd;">
                    
                    <!-- TOTAL FINAL -->
                    <div style="text-align:center; font-size:24px; font-weight:bold; color:#fff; padding:15px; border-radius:10px; background: linear-gradient(90deg, #28a745, #218838); box-shadow:0 4px 10px rgba(40,167,69,0.3);">
                        TOTAL FINAL: $<?php echo number_format($precio_final, 0, ',', '.'); ?>
                    </div>
                </div>
                
                <div class="modal-footer" style="background-color: #efefef; border-radius: 0 0 18px 18px;">
                    <button class="btn btn-secondary" data-dismiss="modal" style="border-radius: 10px; font-weight: bold; padding: 6px 20px;">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<!-- Campos ocultos de control -->
<input type="hidden" id="granTotalNetoVista" value="<?php echo isset($granTotalNeto) ? $granTotalNeto : ''; ?>">
<input type="hidden" id="codigoActualVista" value="<?php echo $codigo_filtro; ?>">