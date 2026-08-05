<?php
include_once '../modelo/datos-almacen.php';
include_once '../modelo/datos-galpon2.php';
include_once '../modelo/datos-galpon1.php';
require_once '../modelo/datos-procesar.php';

include_once '../fpdf/fpdf.php';
include 'exfpdf.php';
include 'easyTable.php';

// Instancias y Obtención de Datos
$mis_almacen = new misAlmacenes();
$mis_galpon2 = new misGalpon2();
$mis_galpon1 = new misGalpon1();
$obj         = new misProcesos();

$codigo = $_GET['codigo'] ?? null;
$res = $mis_almacen->viewAlmacenes($codigo);
$gast = $res[0] ?? []; // Datos del almacén

$codigoUnico = $gast['codigo_orions_almacen'] ?? '';
$total_data = $obj->totalNetoPorCodigo($codigoUnico);

$total_neto = $total_data['total_neto'] ?? 0;
$precio_pollo_liqui = $total_data['precio_pollo'] ?? 0;
$total_final = $total_neto * $precio_pollo_liqui;

// Consulta de datos
$reslikidacion = $obj->viewProcesosliki($codigoUnico);

// Extraer los datos de la liquidación desde la consulta SQL
$likiData           = (is_array($reslikidacion) && !empty($reslikidacion)) ? reset($reslikidacion) : [];
$totalNetoLiki      = $likiData['suma_total_general'] ?? 0;
$granTotalValorLiki = $likiData['gran_total_valor'] ?? 0;
$totalkilosnetos    = $likiData['suma_total_bruto'] ?? 0;

// ======================================================
// 1. RECOLECCIÓN DE DATOS DE GASTOS Y CÁLCULO DEL TOTAL
// ======================================================
$precio_final = 0;
$gastos_detalles = [];

// Inicialización de datos generales
$cantidad_pollo     = $gast['cantidad_pollo_g1'] ?? $gast['cantidad_pollo_g2'] ?? 0;
$cantidad_total     = $gast['cantidad_total'] ?? 0;
$precio_pollo       = $gast['precio_pollo_g1'] ?? $gast['precio_pollo_g2'] ?? 0;
$cantidad_al        = $gast['cantidad_g1'] ?? $gast['cantidad_g2'] ?? 0;
$precio_al          = $gast['precio_alimento_g1'] ?? $gast['precio_alimento_g2'] ?? 0;
$fayido             = $gast['fayido_g1'] ?? $gast['fayido_g2'] ?? 0;
$inicio_ali         = $gast['alimento_inicio_g1'] ?? $gast['alimento_inicio_g2'] ?? 0;
$precio_ini         = $gast['precio_inicio_g1'] ?? $gast['precio_inicio_g2'] ?? 0;
$preinicio_ali      = $gast['alimento_preinicio_g1'] ?? $gast['alimento_preinicio_g2'] ?? 0;
$precio_pre         = $gast['precio_preinicio_g1'] ?? $gast['precio_preinicio_g2'] ?? 0;
$edades             = $gast['edad_g1'] ?? $gast['edad_g2'] ?? 0;
$dossalidas         = $gast['salidas_g1'] ?? $gast['salidas_g2'] ?? 0;
$pesosalidas        = $gast['peso_salidas_g1'] ?? $gast['peso_salidas_g2'] ?? 0;
$mortandadita       = $gast['mortanda_dia_g1'] ?? $gast['mortanda_dia_g2'] ?? 0;

$todamortanda = $fayido  + $mortandadita;
$campos_gastos = [
    ['CANTIDAD POLLOS', 'cantidad_pollo_g1', 'precio_pollo_g1'],
    ['ALIMENTO ENGORDE', 'cantidad_g1', 'precio_alimento_g1'],
    ['ALIMENTO INICIO', 'alimento_inicio_g1', 'precio_inicio_g1'],
    ['ALIMENTO PREINICIO', 'alimento_preinicio_g1', 'precio_preinicio_g1'],
    ['CLORO', 'cloro', 'precio_cloro'],
    ['VINAGRE', 'vinagre', 'precio_vinagre'],
    ['ÁCIDO ACÉTICO', 'hacido_hacetico', 'precio_hacido'],
    ['VITAMINAS', 'vitaminas', 'precio_vitamina'],
    ['ANORES', 'anores', 'precio_anores'],
    ['VACUNAS', 'vacunas', 'precio_vacunas'],
    ['RESPIROS', 'respiros', 'precio_respiros'],
    ['TAMO', 'tamo', 'precio_tamo'],
    ['CAL', 'cal', 'precio_cal'],
    ['ANTIBIÓTICO', 'antibiotico', 'precio_antibiotico'],
    ['OTROS (AFG)', 'abc', 'precio_abc'],
    ['BICARBONATO', 'vicarbonato', 'precio_vicarbonato'],
    ['MELASA', 'melasa', 'precio_melasa'],
    ['AGUA POTABLE', 'agua_potable', 'precio_agua'],
    ['ELECTRICIDAD (LUZ)', 'luz', 'precio_luz'],
    ['ARRIENDO', 'arriendo', 'precio_arriendo'],
    ['YODO', 'yodo', 'precio_yodo'],
    ['GASTOS VARIOS', 'gastos_varios', 'precio_gastos_varios'],
    //['POLLOS MUERTOS', 'fayido_g1', 'precio_pollo_g1'],
    ['Gas', 'gas', 'precio_gas'],
    ['Alimento Itacol', 'alimento_itacol', 'precio_itacol']
];
foreach ($campos_gastos as $campo) {
    $etiqueta = $campo[0];
    $cant_key = str_replace('g1', 'g2', $campo[1]);
    $cantidad = $gast[$campo[1]] ?? $gast[$cant_key] ?? 0;

    $precio_key = str_replace('g1', 'g2', $campo[2]);
    $precio_unitario = $gast[$campo[2]] ?? $gast[$precio_key] ?? 0;

    if ($etiqueta === 'Gastos Varios' && $cantidad == 0 && $precio_unitario > 0) {
        $cantidad = 1;
    }

    $total = $cantidad * $precio_unitario;

    if ($cantidad > 0 && $precio_unitario > 0) {
        $precio_final += $total;
        $gastos_detalles[] = [
            'etiqueta' => $etiqueta,
            'cantidad' => $cantidad,
            'precio' => $precio_unitario,
            'total' => $total
        ];
    }
}

// ======================================================
// 2. DEFINICIÓN DEL PDF REESTRUTURADO y MODERNO
// ======================================================
class PDF_HF extends exFPDF
{
    public $fecha_inicio;
    public $fecha_fin;
    public $descripcion;

    function Header()
    {
        // Encabezado con Estilo Corporativo Elegante (Azul Profundo)
        $this->SetFillColor(24, 43, 73);
        $this->Rect(0, 0, 220, 38, 'F');

        // Detalles estéticos en el encabezado
        $this->SetFillColor(212, 175, 55); // Línea dorada sutil de acento
        $this->Rect(0, 36, 220, 2, 'F');

        // Logos Integrados Limpios
        if (file_exists('../imagenes/pollo2.jpeg')) {
            $this->Image('../imagenes/pollo2.jpeg', 12, 6, 24, 24);
        }
        if (file_exists('../imagenes/pollo9.jpeg')) {
            $this->Image('../imagenes/pollo9.jpeg', 180, 6, 24, 24);
        }

        // Título Principal
        $this->SetY(8);
        $this->SetFont('Helvetica', 'B', 15);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(0, 8, utf8_decode('REPORTE DE COSTOS DE PRODUCCIÓN AVÍCOLA'), 0, 1, 'C');

        $this->SetFont('Helvetica', 'I', 9);
        $this->SetTextColor(200, 210, 230);
        $this->Cell(0, 4, utf8_decode('Sistema Informativo de Gestión de Galpones'), 0, 1, 'C');

        // Contenedor de Fechas Estilo "Badge" Moderno
        $this->SetY(24);
        $this->SetFont('Helvetica', 'B', 9);
        $this->SetTextColor(255, 255, 255);
        $texto_fechas = "Período de Cosecha: " . ($this->fecha_inicio ? $this->fecha_inicio : 'N/A') . "  al  " . ($this->fecha_fin ? $this->fecha_fin : 'N/A');
        $this->Cell(0, 6, utf8_decode($texto_fechas), 0, 1, 'C');

        $this->Ln(15);
    }

    function Footer()
    {
        // Posicionamiento dinámico del Footer
        $this->SetY(-22);

        // Fondo Gris Suave Limpio
        $this->SetFillColor(245, 247, 250);
        $this->Rect(0, 260, 220, 20, 'F');

        // Línea divisoria superior
        $this->SetDrawColor(210, 215, 225);
        $this->SetLineWidth(0.4);
        $this->Line(0, 260, 220, 260);

        // Texto Legal e Interno
        $this->SetFont('Helvetica', '', 8);
        $this->SetTextColor(110, 120, 140);
        $this->SetX(12);
        $this->Cell(0, 10, utf8_decode('© ' . date('Y - m - d') . ' Granjas Avícolas · Reporte Técnico Automatizado'), 0, 0, 'L');

        // Paginación Moderna
        $this->SetFont('Helvetica', 'B', 9);
        $this->SetTextColor(24, 43, 73);
        $this->SetX(-25);
        $this->Cell(0, 10, $this->PageNo(), 0, 0, 'L');
    }
}

// Configuración de Página (Carta / Letter estándar)
$pdf = new PDF_HF('P', 'mm', 'Letter');
$pdf->fecha_inicio = $gast['fecha_inicio_g1'] ?? $gast['fecha_inicio_g2'] ?? '';
$pdf->fecha_fin    = $gast['fecha_fin_g1'] ?? $gast['fecha_fin_g2'] ?? '';
$pdf->descripcion  = $gast['descripcion_g1'] ?? $gast['descripcion_g2'] ?? 'Sin observaciones registradas.';

$pdf->SetMargins(12, 42, 12);
$pdf->SetAutoPageBreak(true, 40); // Espacio prudente para evitar colisiones con el footer
$pdf->AddPage();

/* ==========================================================
    TABLA #1 — DETALLE DE COSTOS (Estructura Limpia de 2 Columnas)
========================================================== */
$t_costos = new easyTable($pdf, '%{28, 22, 28, 22}', 'border:1; border-color:#E2E8F0; paddingY:2.5; font-size:8.5;');

// Cabecera Principal de la Tabla
$t_costos->easyCell(utf8_decode('DESGLOSE DETALLADO DE COSTOS DE INSUMOS'), 'colspan:4; align:C; font-style:B; font-size:10; bgcolor:#182B49; font-color:#FFFFFF; paddingY:3.5');
$t_costos->printRow();

$total_items = count($gastos_detalles);
$half_point = ceil($total_items / 2);

for ($i = 0; $i < $half_point; $i++) {
    $item1 = $gastos_detalles[$i] ?? null;
    $item2 = $gastos_detalles[$i + $half_point] ?? null;

    // --- BLOQUE IZQUIERDO ---
    $t_costos->easyCell(utf8_decode($item1['etiqueta']), 'font-style:B; bgcolor:#F8FAFC; color:#334155');
    $detalles_1 = "Cant: " . number_format($item1['cantidad']) . "\nPrec : $ " . number_format($item1['precio']) . "\nTotal: $ " . number_format($item1['total']);
    $t_costos->easyCell(utf8_decode($detalles_1), 'align:L; font-style:I; color:#475569');

    // --- BLOQUE DERECHO ---
    if ($item2) {
        $t_costos->easyCell(utf8_decode($item2['etiqueta']), 'font-style:B; bgcolor:#F8FAFC; color:#334155');
        $detalles_2 = "Cant: " . number_format($item2['cantidad']) . "\nPrec : $ " . number_format($item2['precio']) . "\nTotal: $ " . number_format($item2['total']);
        $t_costos->easyCell(utf8_decode($detalles_2), 'align:L; font-style:I; color:#475569');
    } else {
        $t_costos->easyCell('', 'bgcolor:#FAFAFA');
        $t_costos->easyCell('');
    }
    $t_costos->printRow();
}

// Fila de Cierre: Total Insumos
$t_costos->easyCell(utf8_decode('TOTAL INVERSIÓN OPERATIVA ACUMULADA'), 'colspan:2; align:L; font-style:B; font-size:9.5; bgcolor:#F1F5F9; color:#1E293B; paddingY:4');
$t_costos->easyCell('$ ' . number_format($precio_final), 'colspan:2; align:C; font-style:B; font-size:10.5; bgcolor:#F1F5F9; color:#0F172A; paddingY:4');
$t_costos->printRow();

// Indicador de Pérdidas (Fayidos) con Alerta Visual Roja Sutil
$t_costos->easyCell(utf8_decode('BAJAS REGISTRADAS EN COSECHA (AVES MUERTAS)'), 'colspan:2; align:L; font-style:B; font-size:9.5; bgcolor:#F1F5F9; color:#1E293B; paddingY:4');
$t_costos->easyCell(number_format($todamortanda) . ' Aves', 'colspan:2; align:C; font-style:B; font-size:10.5; bgcolor:#FFE4C4; color:#FFE4C4; paddingY:4');
$t_costos->printRow();

$t_costos->endTable(8);

/* ==========================================================
    TABLA #2 — LIQUIDACIÓN VENTA Y PÉRDIDAS
========================================================== */
$t_liquidacion = new easyTable($pdf, '%{65, 35}', 'border:1; border-color:#E2E8F0; paddingY:3.5; font-size:9;');

$t_liquidacion->easyCell(utf8_decode('RESUMEN DE LIQUIDACIÓN COMERCIAL'), 'colspan:2; align:C; font-style:B; font-size:10; bgcolor:#182B49; font-color:#FFFFFF; paddingY:3.5');
$t_liquidacion->printRow();


$cantidad_kilos  = $total_neto;
$precio_kilo     = $precio_pollo_liqui;
$total_venta     = $total_final;
$ganancia_final = $granTotalValorLiki - $precio_final;
//$ganancia_final  = $total_venta - $precio_final;
$sueldo_empleado = 0.30 * $ganancia_final;


// ==========================================================
// FILAS DE DATOS DE VENTA
// ==========================================================
$t_liquidacion->easyCell(utf8_decode('VOLUMEN NETO COMERCIALIZADO (KILOGRAMOS)'), 'font-style:M; color:#334155; bgcolor:#F8FAFC');
// CORRECCIÓN AQUÍ: Se usa $totalNetoLiki directamente como número, no como array
$t_liquidacion->easyCell(number_format($totalNetoLiki, 3, ',', '.') . ' Kg', 'align:C; font-style:B; color:#0F172A');
$t_liquidacion->printRow();

$t_liquidacion->easyCell(utf8_decode('INGRESO BRUTO TOTAL POR LIQUIDACIÓN'), 'font-style:M; bgcolor:#F0F8FF; color:#1E293B');
$t_liquidacion->easyCell('$ ' . number_format($granTotalValorLiki, 0, ',', '.'), 'align:C; font-style:B; bgcolor:#F0F8FF; color:#0F172A; paddingY:4');
$t_liquidacion->printRow();

$t_liquidacion->easyCell(utf8_decode('GANANCIA FINAL MENOS GASTOS'), 'font-style:M; bgcolor:#F0FFFF; color:#1E293B; paddingY:4');
$t_liquidacion->easyCell('$ ' . number_format($ganancia_final, 0, ',', '.'), 'align:C; font-style:B; bgcolor:#F0FFFF; color:#0F172A; paddingY:4');
$t_liquidacion->printRow();

$t_liquidacion->endTable(8);

/* ==========================================================
    BLOQUE DESTACADO: SUELDO EMPLEADO / PAGO TOTAL
========================================================== */
$estilo_color_ganancia = ($ganancia_final >= 0) ? 'color:#166534; bgcolor:#F5F5DC; border-color:#BBF7D0;' : 'color:#00FFFF; bgcolor:#00FFFF; border-color:#00FFFF;';
$titulo_rentabilidad   = ($ganancia_final >= 0) ? 'SUELDO EMPLEADO (30%)' : 'PAGO TOTAL NEGATIVO DE EMPLEADO';

$t_ganancia = new easyTable($pdf, '%{100}', 'border:1; ' . $estilo_color_ganancia . ' paddingY:4;');
$t_ganancia->easyCell(utf8_decode($titulo_rentabilidad), 'align:C; font-style:B; font-size:10;');
$t_ganancia->printRow();
$t_ganancia->easyCell('$ ' . number_format($sueldo_empleado, 0, ',', '.'), 'align:C; font-style:B; font-size:15; paddingY:5');
$t_ganancia->printRow();
$t_ganancia->endTable(8);

/* ==========================================================
    BLOQUE DESTACADO: UTILIDAD NETO / GANANCIA FINAL
========================================================== */
$estilo_color_ganancia = ($ganancia_final >= 0) ? 'color:#166534; bgcolor:#F0FDF4; border-color:#BBF7D0;' : 'color:#991B1B; bgcolor:#FEF2F2; border-color:#FCA5A5;';
$titulo_rentabilidad   = ($ganancia_final >= 0) ? 'RENTABILIDAD NETA POSITIVA' : 'BALANCE OPERATIVO NEGATIVO';

$t_ganancia = new easyTable($pdf, '%{100}', 'border:1; ' . $estilo_color_ganancia . ' paddingY:4;');
$t_ganancia->easyCell(utf8_decode($titulo_rentabilidad), 'align:C; font-style:B; font-size:10;');
$t_ganancia->printRow();
$t_ganancia->easyCell('$ ' . number_format($ganancia_final - ($ganancia_final * 0.30), 0, ',', '.'), 'align:C; font-style:B; font-size:15; paddingY:5');
$t_ganancia->printRow();
$t_ganancia->endTable(8);

/* ==========================================================
    SECCIÓN DINÁMICA DE OBSERVACIONES (Se adapta al tamaño del texto)
========================================================== */
$pdf->Ln(2);
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->SetTextColor(24, 43, 73);
$pdf->Cell(0, 6, utf8_decode("OBSERVACIONES Y NOTAS DE COSECHA:"), 0, 1, 'L');

$pdf->SetFont('Helvetica', 'I', 9);
$pdf->SetTextColor(71, 85, 105);
// El uso de MultiCell aquí previene de forma nativa desbordamientos si el texto es muy largo
$pdf->MultiCell(0, 5, utf8_decode($pdf->descripcion), 0, 'L');

$pdf->Output();
