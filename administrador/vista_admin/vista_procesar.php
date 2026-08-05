<?php
require_once '../../modelo/val-admin.php';
include_once '../../modelo/datos-procesar.php';
include_once '../../modelo/datos-almacen.php';
include_once '../../modelo/datos-galpon2.php';
include_once '../../modelo/datos-galpon1.php';

$codigo_filtro = isset($_GET['codigo_orions']) ? $_GET['codigo_orions'] : '0';

$obj         = new misProcesos();
$mis_almacen = new misAlmacenes();
$mis_galpon2 = new misGalpon2();
$mis_galpon1 = new misGalpon1();

// 1. Obtener la información del almacén filtrada explícitamente por el código Orion actual
$resliki = $mis_almacen->viewAlmacenes($codigo_filtro);

// Consultas de procesos
$res           = $obj->viewProcesos($codigo_filtro);
$reslikidacion = $obj->viewProcesosliki($codigo_filtro);

// Extraer los datos de la liquidación desde la consulta SQL
$likiData           = (is_array($reslikidacion) && !empty($reslikidacion)) ? reset($reslikidacion) : [];
$totalNetoLiki      = $likiData['suma_total_general'] ?? 0;
$granTotalValorLiki = $likiData['gran_total_valor'] ?? 0;
$totalkilosnetos    = $likiData['suma_total_bruto'] ?? 0;

$granTotalBruto     = 0;
$granTotalCanastas  = 0;
$granTotalNeto      = 0;
$granTotalValor     = 0;

// Inicializamos el total de gastos acumulado para el panel de liquidación
$precio_final_liquidacion = 0;
?>

<div class="page-title">
    <div class="row">
        <style>
            .panel-success {
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 2px 8px rgba(0, 0, 0, .15);
            }

            .panel-success .panel-heading {
                font-size: 16px;
                background: #28a745 !important;
                color: white !important;
            }

            .panel-success table th {
                background: #f8f9fa;
                width: 50%;
            }

            .panel-success table td {
                font-weight: bold;
            }
        </style>
        <!-- Título -->
        <div class="col-md-8">
            <h1>
                <i class="fa fa-calculator"></i>
                Procesamiento de Pesaje
                <small>Venta de Pollo</small>
            </h1>

            <p>
                Trabajando con el Código:
                <strong><?php echo htmlspecialchars($codigo_filtro); ?></strong>
            </p>

            <br>

            <div class="text-left">
                <a href="almacen.php" class="btn btn-default"
                    style="border-radius:20px;border:1px solid #312699;font-weight:bold;">
                    <i class="fa fa-arrow-left"></i>
                    Volver al Almacén
                </a>
            </div>
        </div>

        <!-- Liquidación -->
        <div class="col-md-4">
            <div class="panel panel-success" style="margin-top:10px;">
                <div class="panel-heading text-center">
                    <strong>
                        <i class="fa fa-bar-chart"></i>
                        Liquidación de la Cosecha
                    </strong>
                </div>
                <?php
                if (!empty($resliki)) {
                    foreach ($resliki as $data) {
                        $precio_final = 0;

                        // Asignación de variables seguras
                        $cantidad_pollo     = $data['cantidad_pollo_g1'] ?? $data['cantidad_pollo_g2'] ?? 0;
                        $precio_pollo       = $data['precio_pollo_g1'] ?? $data['precio_pollo_g2'] ?? 0;
                        $cantidad_al        = $data['cantidad_g1'] ?? $data['cantidad_g2'] ?? 0;
                        $precio_al          = $data['precio_alimento_g1'] ?? $data['precio_alimento_g2'] ?? 0;
                        $fayido             = $data['fayido_g1'] ?? $data['fayido_g2'] ?? 0;
                        $inicio_ali         = $data['alimento_inicio_g1'] ?? $data['alimento_inicio_g2'] ?? 0;
                        $precio_ini         = $data['precio_inicio_g1'] ?? $data['precio_inicio_g2'] ?? 0;
                        $preinicio_ali      = $data['alimento_preinicio_g1'] ?? $data['alimento_preinicio_g2'] ?? 0;
                        $precio_pre         = $data['precio_preinicio_g1'] ?? $data['precio_preinicio_g2'] ?? 0;

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
                        $gas                = $data['gas'] ?? null;
                        $precio_gas         = $data['precio_gas'] ?? null;
                        $alimento_itacol    = $data['alimento_itacol'] ?? null;
                        $precio_itacol      = $data['precio_itacol'] ?? null;

                        // Cálculo de Gastos
                        if (!empty($cantidad_pollo) && !empty($precio_pollo)) $precio_final += ($cantidad_pollo * $precio_pollo);
                        if (!empty($inicio_ali) && !empty($precio_ini)) $precio_final += ($inicio_ali * $precio_ini);
                        if (!empty($cantidad_al) && !empty($precio_al)) $precio_final += ($cantidad_al * $precio_al);
                        if (!empty($preinicio_ali) && !empty($precio_pre)) $precio_final += ($preinicio_ali * $precio_pre);
                        if (!empty($cloro) && !empty($precio_cloro)) $precio_final += ($cloro * $precio_cloro);
                        if (!empty($vinagre) && !empty($precio_vinagre)) $precio_final += ($vinagre * $precio_vinagre);
                        if (!empty($vitaminas) && !empty($precio_vitaminas)) $precio_final += ($vitaminas * $precio_vitaminas);
                        if (!empty($hacido_hacetico) && !empty($precio_hacido)) $precio_final += ($hacido_hacetico * $precio_hacido);
                        if (!empty($anores) && !empty($precio_anores)) $precio_final += ($anores * $precio_anores);
                        if (!empty($vacunas) && !empty($precio_vacunas)) $precio_final += ($vacunas * $precio_vacunas);
                        if (!empty($respiros) && !empty($precio_respiros)) $precio_final += ($respiros * $precio_respiros);
                        if (!empty($tamo) && !empty($precio_tamo)) $precio_final += ($tamo * $precio_tamo);
                        if (!empty($cal) && !empty($precio_cal)) $precio_final += ($cal * $precio_cal);
                        if (!empty($antibiotico) && !empty($precio_antibiotico)) $precio_final += ($antibiotico * $precio_antibiotico);
                        if (!empty($abc) && !empty($precio_abc)) $precio_final += ($abc * $precio_abc);
                        if (!empty($vicarbonato) && !empty($precio_vicarbonato)) $precio_final += ($vicarbonato * $precio_vicarbonato);
                        if (!empty($melasa) && !empty($precio_melasa)) $precio_final += ($melasa * $precio_melasa);
                        if (!empty($agua_potable) && !empty($precio_agua)) $precio_final += ($agua_potable * $precio_agua);
                        if ($luz !== null && $precio_luz !== null) $precio_final += ($luz * $precio_luz);
                        if ($arriendo !== null && $precio_arriendo !== null) $precio_final += ($arriendo * $precio_arriendo);
                        if (!empty($yodo) && !empty($precio_yodo)) $precio_final += ($yodo * $precio_yodo);
                        if (!empty($gas) && !empty($precio_gas)) $precio_final += ($gas * $precio_gas);
                        if (!empty($alimento_itacol) && !empty($precio_itacol)) $precio_final += ($alimento_itacol * $precio_itacol);
                        if (!empty($precio_gastos_varios)) $precio_final += (($gastos_varios ?? 1) * $precio_gastos_varios);
                        //if (!empty($fayido) && !empty($precio_pollo)) $precio_final += ($fayido * $precio_pollo);

                        $precio_final_liquidacion = $precio_final;
                    }
                }

                // 1. Calcular la utilidad/ganancia neta
                $ganancia_final = $granTotalValorLiki - $precio_final_liquidacion;
                ?>

                <table class="table table-bordered table-striped" style="margin-bottom:0;">
                    <tr>
                        <th>Total Gastos</th>
                        <td class="text-right">
                            $ <?php echo number_format($precio_final_liquidacion, 0, ',', '.'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Total Kilos Brutos</th>
                        <td class="text-right">
                            <?php echo number_format($totalkilosnetos, 3, ',', '.'); ?> Kg
                        </td>
                    </tr>
                    <tr>
                        <th>Total Kilos Menos canastas</th>
                        <td class="text-right">
                            <?php echo number_format($totalNetoLiki, 3, ',', '.'); ?> Kg
                        </td>
                    </tr>
                    <tr>
                        <th>Valor Total Venta</th>
                        <td class="text-right text-success">
                            <strong>
                                $ <?php echo number_format($granTotalValorLiki, 0, ',', '.'); ?>
                            </strong>
                        </td>
                    </tr>

                    <!-- Fila de Ganancia / Pérdida -->
                    <tr>
                        <th>
                            <?php echo ($ganancia_final >= 0) ? 'Ganancia Neta' : 'Pérdida Neta'; ?>
                        </th>
                        <td class="text-right <?php echo ($ganancia_final >= 0) ? 'text-success' : 'text-danger'; ?>">
                            <strong>
                                $ <?php echo number_format($ganancia_final, 0, ',', '.'); ?>
                            </strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table id="tablaCalculadora" class="table table-hover table-bordered table-condensed">
        <thead style="background-color: #2f353b; color: white;">
            <tr>
                <th width="120" class="text-center">Código Cosecha</th>
                <th width="50" class="text-center">Fila</th>
                <th class="text-center">Peso Bruto (Kg)</th>
                <th class="text-center">Peso Canastas (Kg)</th>
                <th class="text-center" style="background-color: #26a69a;">Total Neto</th>
                <th class="text-center" style="background:#4CAF50; color:white;">Valor Total</th>
                <th class="text-center" style="background:#4CAF50; color:white;">Cliente</th>
                <th width="80" class="text-center">Acción</th>
            </tr>
        </thead>

        <tbody>
            <?php
            for ($i = 1; $i <= 100; $i++) {
                // Obtenemos los datos de la fila de forma segura
                $data = $res[$i] ?? null;

                $id               = $data['codigo'] ?? '';
                $bruto            = (isset($data['bruto']) && is_numeric($data['bruto'])) ? (float)$data['bruto'] : 0;
                $canastas         = (isset($data['canastas']) && is_numeric($data['canastas'])) ? (float)$data['canastas'] : 0;
                $precio_pollo     = (isset($data['precio_pollo']) && is_numeric($data['precio_pollo'])) ? (float)$data['precio_pollo'] : 0;
                $peso_observacion = $data['peso_observacion'] ?? '';

                $totalFila = $bruto - $canastas;
                $valorFila = $totalFila * $precio_pollo;

                $granTotalBruto    += $bruto;
                $granTotalCanastas += $canastas;
                $granTotalNeto     += $totalFila;
                $granTotalValor    += $valorFila;

                // Preparamos la cadena formateada para el JavaScript del Modal
                $cadena = $id . "||" . $bruto . "||" . $precio_pollo . "||" . $canastas . "||" . $totalFila . "||" . $codigo_filtro . "||" . $peso_observacion . "||" . $i;
            ?>
                <tr>
                    <!-- 1. Código Cosecha -->
                    <td class="text-center" style="vertical-align: middle; background: #f0f4f7; font-weight: bold;">
                        <?php echo htmlspecialchars($codigo_filtro); ?>
                    </td>

                    <!-- 2. Fila -->
                    <td class="text-center" style="vertical-align: middle; background: #f9f9f9;">
                        <strong><?php echo $i; ?></strong>
                    </td>

                    <!-- 3. Peso Bruto -->
                    <td>
                        <input type="text" class="form-control input-sm text-center" value="<?php echo number_format($bruto, 3); ?>" readonly>
                    </td>

                    <!-- 4. Peso Canastas -->
                    <td>
                        <input type="text" class="form-control input-sm text-center" value="<?php echo number_format($canastas, 3); ?>" readonly>
                    </td>

                    <!-- 5. Total Neto -->
                    <td style="background-color: #e9f7f6;">
                        <input type="text" class="form-control input-sm text-center" value="<?php echo number_format($totalFila, 3); ?>" readonly style="font-weight:bold; color: #000;">
                    </td>

                    <!-- 6. Valor Total -->
                    <td style="background:#f0fff0;">
                        <input type="text" class="form-control input-sm text-center" value="<?php echo number_format($valorFila, 0); ?>" readonly style="font-weight:bold;">
                    </td>

                    <!-- 7. Observación Cliente (CORREGIDO: input visible y seguro) -->
                    <td style="background-color: #e9f7f6;">
                        <input type="text" class="form-control input-sm text-center" value="<?php echo htmlspecialchars($peso_observacion); ?>" readonly style="font-weight:bold; color: #000;">
                    </td>

                    <!-- 8. Acción -->
                    <td class="text-center">
                        <button type="button" class="btn btn-warning btn-sm btn-circle" data-toggle="modal" data-target="#modalEdicionProcesar" onclick="agregarFormProcesar('<?php echo htmlspecialchars($cadena); ?>')">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot style="background-color: #f1f4f7; font-size: 1.2em;">
            <tr>
                <th class="text-right" colspan="2">TOTALES:</th>
                <th class="text-center"><?php echo number_format($granTotalBruto, 3); ?> Kg</th>
                <th class="text-center text-danger"><?php echo number_format($granTotalCanastas, 3); ?> Kg</th>
                <th class="text-center" style="background-color: #26a69a; color: white;">
                    <?php echo number_format($granTotalNeto, 3); ?> Kg
                </th>
                <th class="text-center" style="background:#4CAF50; color:white;">
                    $ <?php echo number_format($granTotalValor, 0); ?>
                </th>
                <div style="text-align: left;">
                <th class="text-center" colspan="2" style="background-color: #2693a6; color: white;">
                    <a href="almacen.php" class="btn btn-default" style="border-radius: 20px; border: 1px solid #919926; font-weight: bold;">
                        <i class="fa fa-arrow-left"></i> Volver al Almacén
                    </a>
                </th>
                </div>
            </tr>
        </tfoot>
    </table>

    <input type="hidden" id="granTotalNetoVista" value="<?php echo $granTotalNeto; ?>">
    <input type="hidden" id="codigoActualVista" value="<?php echo htmlspecialchars($codigo_filtro); ?>">
</div>