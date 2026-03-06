<?php
require_once '../../modelo/val-admin.php';
include_once '../../modelo/datos-procesar.php';

$codigo_filtro = isset($_GET['codigo_orions']) ? $_GET['codigo_orions'] : '0';

$obj = new misProcesos();
$res = $obj->viewProcesos($codigo_filtro);


$granTotalBruto = 0;
$granTotalCanastas = 0;
$granTotalNeto = 0;
$granTotalValor = 0;
?>

<div class="page-title">
    <h1><i class="fa fa-calculator"></i> Procesamiento de Pesaje <small>Venta de Pollo</small></h1>
    <p>Trabajando con el Código: <strong><?php echo $codigo_filtro; ?></strong></p>
    <br>
    <div class="text-center">
        <a href="almacen.php" class=" btn btn-default" style="border-radius: 20px; border: 1px solid #312699; font-weight: bold;">
            <i class="fa fa-arrow-left"></i> Volver al Almacén
        </a>
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
                <th width="80" class="text-center">Acción</th>
            </tr>
        </thead>

        <tbody>
            <?php
            for ($i = 1; $i <= 100; $i++) {
                // --- AQUÍ VA EL CAMBIO ---
                // Buscamos en el array usando el número de fila ($i) como índice
                $data = $res[$i] ?? null;

                // Si existe data, sacamos los valores; si no, quedan vacíos o en 0
                $id = $data['codigo'] ?? '';
                $bruto = $data['bruto'] ?? 0;
                $canastas = $data['canastas'] ?? 0;
                $precio_pollo = $data['precio_pollo'] ?? 0;
                // -------------------------

                // El resto del código sigue igual...
                $totalFila = $bruto - $canastas;
                $valorFila = $totalFila * $precio_pollo;

                $granTotalBruto += $bruto;
                $granTotalCanastas += $canastas;
                $granTotalNeto += $totalFila;
                $granTotalValor += $valorFila;

                // Preparamos la cadena para el modal incluyendo la fila ($i)
                $cadena = $id . "||" . $bruto . "||" . $precio_pollo . "||" . $canastas . "||" . $totalFila . "||" . $codigo_filtro . "||" . $i;
                // Añadimos $i al final para identificar qué fila estamos editando
            ?>
                <tr>
                    <td class="text-center" style="vertical-align: middle; background: #f0f4f7; font-weight: bold;">
                        <?php echo $codigo_filtro; ?>
                    </td>
                    <td class="text-center" style="vertical-align: middle; background: #f9f9f9;">
                        <strong><?php echo $i; ?></strong>
                    </td>
                    <td>
                        <input type="text" class="form-control input-sm text-center" value="<?php echo number_format($bruto, 1); ?>" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control input-sm text-center" value="<?php echo number_format($canastas, 1); ?>" readonly>
                    </td>
                    <td style="background-color: #e9f7f6;">
                        <input type="text" class="form-control input-sm text-center" value="<?php echo number_format($totalFila, 1); ?>" readonly style="font-weight:bold; color: #000;">
                    </td>
                    <td style="background:#f0fff0;">
                        <input type="text" class="form-control input-sm text-center" value="<?php echo number_format($valorFila, 0); ?>"
                            readonly
                            style="font-weight:bold;">
                    </td>
                    <td class="text-center">
                        <button class="btn btn-warning btn-sm btn-circle" data-toggle="modal" data-target="#modalEdicionProcesar" onclick="agregarFormProcesar('<?php echo $cadena ?>')">
                            <i class="glyphicon glyphicon-pencil"></i>
                        </button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot style="background-color: #f1f4f7; font-size: 1.2em;">
            <tr>
                <th class="text-right" colspan="2">TOTALES:</th>
                <th class="text-center"><?php echo number_format($granTotalBruto, 1); ?> Kg</th>
                <th class="text-center text-danger"><?php echo number_format($granTotalCanastas, 1); ?> Kg</th>
                <th class="text-center" style="background-color: #26a69a; color: white;">
                    <?php echo number_format($granTotalNeto, 1); ?> Kg
                </th>
                <th class="text-center" style="background:#4CAF50; color:white;">
                    $ <?php echo number_format($granTotalValor, 0); ?>
                </th>
                <th class="text-center" style="background-color: #2633a6; color: white;">
                    <a href="almacen.php" class=" btn btn-default" style="border-radius: 20px; border: 1px solid #919926; font-weight: bold;">
                        <i class="fa fa-arrow-left"></i> Volver al Almacén
                    </a>
                </th>


            </tr>
        </tfoot>

    </table>
    <!-- TOTAL NETO OCULTO PARA EL MODAL -->
    <input type="hidden"
        id="granTotalNetoVista"
        value="<?php echo $granTotalNeto; ?>">

    <input type="hidden"
        id="codigoActualVista"
        value="<?php echo $codigo_filtro; ?>">
</div>