<?php
include_once '../modelo/datos-almacen.php';
include_once '../modelo/datos-galpon2.php';
include_once '../modelo/datos-galpon1.php';
include_once '../fpdf/fpdf.php';
include 'exfpdf.php';
include 'easyTable.php';

// Instancias y Obtención de Datos
$mis_almacen = new misAlmacenes();
$mis_galpon2 = new misGalpon2();
$mis_galpon1 = new misGalpon1();

$codigo = $_GET['codigo'] ?? null;
$res = $mis_almacen->viewAlmacenes($codigo);
$gast = $res[0] ?? []; // Datos del almacén

// ======================================================
// 1. RECOLECCIÓN DE DATOS DE GASTOS Y CÁLCULO DEL TOTAL
// ======================================================
$precio_final = 0;
$gastos_detalles = [];

// Inicialización de datos generales
$cantidad_pollo     = $gast['cantidad_pollo_g1'] ?? $gast['cantidad_pollo_g2'] ?? 0;
$cantidad_total     = $gast['cantidad_total'] ?? $gast['cantidad_total'] ?? 0;
$precio_pollo       = $gast['precio_pollo_g1'] ?? $gast['precio_pollo_g2'] ?? 0;
$cantidad_al        = $gast['cantidad_g1'] ?? $gast['cantidad_g2'] ?? 0;
$precio_al          = $gast['precio_alimento_g1'] ?? $gast['precio_alimento_g2'] ?? 0;
$fayido             = $gast['fayido_g1'] ?? $gast['fayido_g2'] ?? 0;
$inicio_ali         = $gast['alimento_inicio_g1'] ?? $gast['alimento_inicio_g2'] ?? 0;
$precio_ini         = $gast['precio_inicio_g1'] ?? $gast['precio_inicio_g2'] ?? 0;
$preinicio_ali      = $gast['alimento_preinicio_g1'] ?? $gast['alimento_preinicio_g2'] ?? 0;
$precio_pre         = $gast['precio_preinicio_g1'] ?? $gast['precio_preinicio_g2'] ?? 0;

// Lista de todos los campos de gastos, incluyendo los faltantes
$campos_gastos = [
    // [etiqueta, campo_cantidad, campo_precio]
    ['Pollo', 'cantidad_pollo_g1', 'precio_pollo_g1'],
    ['Alimento Engorde', 'cantidad_g1', 'precio_alimento_g1'],
    // NUEVOS CAMPOS (Inicio y Preinicio)
    ['Alimento Inicio', 'alimento_inicio_g1', 'precio_inicio_g1'],
    ['Alimento Crecimiento', 'alimento_preinicio_g1', 'precio_preinicio_g1'],
    ['Cloro', 'cloro', 'precio_cloro'],
    ['Vinagre', 'vinagre', 'precio_vinagre'],
    ['Ácido Acético', 'hacido_hacetico', 'precio_hacido'],
    ['Vitaminas', 'vitaminas', 'precio_vitamina'],
    ['Anores', 'anores', 'precio_anores'],
    ['Vacunas', 'vacunas', 'precio_vacunas'],
    ['Respiros', 'respiros', 'precio_respiros'],
    ['Tamo', 'tamo', 'precio_tamo'],
    ['Cal', 'cal', 'precio_cal'],
    ['Antibiótico', 'antibiotico', 'precio_antibiotico'],
    ['Otros (ABC)', 'abc', 'precio_abc'],
    ['Bicarbonato', 'vicarbonato', 'precio_vicarbonato'],
    ['Melasa', 'melasa', 'precio_melasa'],
    ['Agua Potable', 'agua_potable', 'precio_agua'],
    ['Electricidad (Luz)', 'luz', 'precio_luz'],
    ['Arriendo', 'arriendo', 'precio_arriendo'],
    ['Yodo', 'yodo', 'precio_yodo'],
    ['Gastos Varios', 'gastos_varios', 'precio_gastos_varios']
];

foreach ($campos_gastos as $campo) {
    $etiqueta = $campo[0];
    // Se usa el nombre del campo_cantidad_g1 si existe, si no, se usa el de g2 (o null/0)
    $cant_key = str_replace('g1', 'g2', $campo[1]);
    $cantidad = $gast[$campo[1]] ?? $gast[$cant_key] ?? 0;

    $precio_key = str_replace('g1', 'g2', $campo[2]);
    $precio_unitario = $gast[$campo[2]] ?? $gast[$precio_key] ?? 0;

    // Ajuste especial para 'Gastos Varios' si solo se registra el precio total.
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
// Ajuste especial para Pollo y Alimento que tienen un campo de cantidad único
$total_pollo = ($cantidad_pollo * $precio_pollo);
$total_al = ($cantidad_al * $precio_al);
$total_ini = ($inicio_ali * $precio_ini);
$total_pre = ($preinicio_ali * $precio_pre);


// ======================================================
// 2. DEFINICIÓN DEL PDF 
// ======================================================
class PDF_HF extends exFPDF
{
    public $fecha_inicio;
    public $fecha_fin;
    public $descripcion;
    function FancyBackground()
    {
        $this->SetFillColor(230, 245, 255);
        $this->Rect(0, 0, 220, 280, 'F');
        $logo = '';
        if (file_exists($logo)) {
            if (method_exists($this, 'SetAlpha')) {
                $this->SetAlpha(0.08);
            }
            $this->Image($logo, 20, 35, 160, 160);
            if (method_exists($this, 'SetAlpha')) {
                $this->SetAlpha(1);
            }
        }
    }

    function Header()
    {


        // Fondo suave degradado superior
        $this->SetFillColor(235, 245, 255);
        $this->Rect(0, 0, 220, 35, 'F');

        // Línea decorativa inferior
        $this->SetDrawColor(70, 130, 180);
        $this->SetLineWidth(0.8);
        $this->Line(10, 35, 210, 35);

        // ----------- LOGOS -------------
        // Logo izquierdo
        $this->Image('../imagenes/pollo2.jpeg', 12, 6, 22, 22);
        // Logo derecho
        $this->Image('../imagenes/pollo9.jpeg', 178, 6, 22, 22);


        // ----------- TÍTULO PRINCIPAL -------------
        $this->SetY(6);
        $this->SetFont('Arial', 'B', 16);
        $this->SetTextColor(30, 60, 130);
        $this->Cell(0, 10, utf8_decode('REPORTE DE COSTOS DE PRODUCCIÓN AVÍCOLA'), 0, 1, 'C');


        // ----------- FECHAS -------------
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(80, 80, 80);

        // Caja suave de fondo para fechas
        $this->SetFillColor(255, 255, 255);
        $this->SetXY(60, 18);
        $this->Rect(60, 18, 95, 13, 'F');



        $this->SetXY(60, 19);
        $this->Cell(95, 5, 'Inicio de cosecha: ' . $this->fecha_inicio, 0, 1, 'C');
        $this->SetX(60);
        $this->Cell(95, 5, 'Fin de cosecha: ' . $this->fecha_fin, 0, 1, 'C');

        // Espacio hacia el contenido
        $this->Ln(8);
        // ----------- SUBTÍTULO (DEBAJO DEL TÍTULO) -------------
        $this->SetFont('Arial', 'I', 10);
        $this->SetTextColor(80, 80, 80);
        $this->Cell(0, 6, utf8_decode('Sistema de Gestión Avícola ML'), 0, 1, 'C');
    }



    function Footer()
    {
        // Fondo del footer
        $this->SetFillColor(230, 240, 255);
        $this->Rect(0, 262, 220, 25, 'F');
    
        // Línea superior decorativa
        $this->SetDrawColor(190, 200, 225);
        $this->SetLineWidth(0.5);
        $this->Line(10, 262, 205, 262);
    
        // Logos del footer
        $this->Image('../imagenes/pollo.jpg', 12, 266, 15, 15);
        $this->Image('../imagenes/pollo.jpg', 188, 266, 15, 15);
    
        // -------------------------------------------------
        //       OBSERVACIONES CENTRADAS (descripcion_material)
        // -------------------------------------------------
     
    
            // Título centrado
            $this->SetXY(30, 239);
            $this->SetFont('Arial', 'B', 9);
            $this->SetTextColor(30, 60, 130);
            $this->Cell(160, 50, utf8_decode("Observaciones Cosecha:"), 0, 1, 'C');
    
            // Texto centrado dentro de la caja
            $this->SetXY(30, 244);
            $this->SetFont('Arial', '', 8);
            $this->SetTextColor(60, 60, 60);
            $this->MultiCell(160, 50, utf8_decode($this->descripcion), 0, 'C');
        
    
        // -------------------------------------------------
        //       TEXTO LEGAL Y PAGINACIÓN
        // -------------------------------------------------
        $this->SetY(-13);
        $this->SetFont('Arial', '', 8);
        $this->SetTextColor(30, 60, 130);
        $this->Cell(0, -5, utf8_decode('© ' . date('Y') . ' Granjas Avícolas - Reporte interno'), 0, 0, 'L');
    
        $this->SetFont('Arial', 'B', 9);
        $this->SetTextColor(50, 80, 130);
        $this->Cell(0, -5, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'R');
    }
    
}

$pdf = new PDF_HF('P', 'mm', 'Letter');
$pdf->fecha_inicio = $gast['fecha_inicio_g1'] ?? $gast['fecha_inicio_g2'] ?? '';
$pdf->fecha_fin    = $gast['fecha_fin_g1'] ?? $gast['fecha_fin_g2'] ?? '';
$pdf->descripcion    = $gast['descripcion_g1'] ?? $gast['descripcion_g2'] ?? '';
$pdf->SetMargins(5, 30, 5);
$pdf->SetAutoPageBreak(true, 25);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 8);

/* ================================
    TABLA #1 — DETALLE DE COSTOS (Dos columnas de campos)
================================ */
$pdf->SetY(45);

$t_costos = new easyTable($pdf, '%{25, 25, 25, 25}', 'border:1; paddingY:2; min-h:6;');

// CABECERA 
$t_costos->easyCell(utf8_decode('DETALLE DE COSTOS (TODOS LOS GASTOS)'), 'colspan:4; align:C; font-style:B; bgcolor:#C6E0B4; paddingY:3'); // <--- UTF8_DECODE
$t_costos->printRow();

$total_items = count($gastos_detalles);
$half_point = ceil($total_items / 2);
$item_index = 0;

for ($i = 0; $i < $half_point; $i++) {
    // Fila para Cantidad
    $item1 = $gastos_detalles[$i] ?? null;
    $item2 = $gastos_detalles[$i + $half_point] ?? null;

    // Etiqueta Columna 1
    $t_costos->easyCell(utf8_decode($item1['etiqueta'] . ' (Cant.):'), 'font-style:B; bgcolor:#F9F9F9'); // <--- UTF8_DECODE
    // Valor Columna 1
    $t_costos->easyCell(number_format($item1['cantidad']), 'align:C');

    // Etiqueta Columna 2
    if ($item2) {
        $t_costos->easyCell(utf8_decode($item2['etiqueta'] . ' (Cant.):'), 'font-style:B; bgcolor:#F9F9F9'); // <--- UTF8_DECODE
    } else {
        $t_costos->easyCell('', 'bgcolor:#F9F9F9');
    }
    // Valor Columna 2
    if ($item2) {
        $t_costos->easyCell(number_format($item2['cantidad']), 'align:C');
    } else {
        $t_costos->easyCell('');
    }
    $t_costos->printRow();

    // Fila para Precio Unitario
    // Etiqueta Columna 1
    $t_costos->easyCell(utf8_decode($item1['etiqueta'] . ' (Precio Unit.):'), 'font-style:B; bgcolor:#F0F0F0'); // <--- UTF8_DECODE
    // Valor Columna 1
    $t_costos->easyCell('$ ' . number_format($item1['precio']), 'align:C');

    // Etiqueta Columna 2
    if ($item2) {
        $t_costos->easyCell(utf8_decode($item2['etiqueta'] . ' (Precio Unit.):'), 'font-style:B; bgcolor:#F0F0F0'); // <--- UTF8_DECODE
    } else {
        $t_costos->easyCell('', 'bgcolor:#F0F0F0');
    }
    // Valor Columna 2
    if ($item2) {
        $t_costos->easyCell('$ ' . number_format($item2['precio']), 'align:C');
    } else {
        $t_costos->easyCell('');
    }
    $t_costos->printRow();

    // Fila para Total Parcial
    // Etiqueta Columna 1
    $t_costos->easyCell(utf8_decode($item1['etiqueta'] . ' (Total):'), 'font-style:B; bgcolor:#EFEFEF'); // <--- UTF8_DECODE
    // Valor Columna 1
    $t_costos->easyCell('$ ' . number_format($item1['total']), 'align:C; font-style:B');

    // Etiqueta Columna 2
    if ($item2) {
        $t_costos->easyCell(utf8_decode($item2['etiqueta'] . ' (Total):'), 'font-style:B; bgcolor:#EFEFEF'); // <--- UTF8_DECODE
    } else {
        $t_costos->easyCell('', 'bgcolor:#EFEFEF');
    }
    // Valor Columna 2
    if ($item2) {
        $t_costos->easyCell('$ ' . number_format($item2['total']), 'align:C; font-style:B');
    } else {
        $t_costos->easyCell('');
    }
    $t_costos->printRow();

    // Separador de elementos
    $t_costos->easyCell('', 'colspan:4; bgcolor:#FFFFFF; paddingY:0.5');
    $t_costos->printRow();
}

// Total General de Costos
$t_costos->easyCell(utf8_decode('TOTAL GENERAL DE COSTOS:'), 'colspan:2; align:L; font-style:B; bgcolor:#D9E1F2; paddingY:4; font-size:10'); // <--- UTF8_DECODE
$t_costos->easyCell('$ ' . number_format($precio_final), 'colspan:2; align:R; font-style:B; bgcolor:#D9E1F2; paddingY:4; font-size:10');
$t_costos->printRow();

$t_costos->endTable(5);

/* ==========================================================
    TABLA #2 — LIQUIDACIÓN VENTA Y FAYIDOS (Diseño en una columna simple)
========================================================== */
$pdf->Ln(5);

$t_liquidacion = new easyTable($pdf, '%{50,50}', 'border:1; paddingY:3;');

$t_liquidacion->easyCell(utf8_decode('RESUMEN DE VENTA Y PÉRDIDAS'), 'colspan:2; align:C; font-style:B; bgcolor:#C6E0B4; paddingY:4'); // <--- UTF8_DECODE
$t_liquidacion->printRow();

// Datos de Venta
$cantidad_total = $gast['cantidad_total'] ?? 0;
$precio_kilo = $gast['precio_kilo'] ?? 0;
$total_final_venta = $cantidad_total * $precio_kilo;

// Validar si hay liquidación de venta
$hay_venta = ($cantidad_total > 0 && $precio_kilo > 0);

if ($hay_venta) {
    $ganancia_final = $total_final_venta - $precio_final;
} else {
    $ganancia_final = 0; // o $total_final_venta
}


// FILA CANTIDAD KILOS VENDIDOS
$t_liquidacion->easyCell(utf8_decode('Cantidad Total Kilos Vendidos:'), 'font-style:B; bgcolor:#F9F9F9; paddingY:3'); // <--- UTF8_DECODE
$t_liquidacion->easyCell(number_format($total_final_venta), 'align:C; paddingY:3');
$t_liquidacion->printRow();

// FILA PRECIO KILO
$t_liquidacion->easyCell(utf8_decode('Precio por Kilo de Venta:'), 'font-style:B; bgcolor:#F9F9F9; paddingY:3'); // <--- UTF8_DECODE
$t_liquidacion->easyCell('$ ' . number_format($precio_kilo), 'align:C; paddingY:3');
$t_liquidacion->printRow();

// FILA TOTAL VENTA
$t_liquidacion->easyCell(utf8_decode('TOTAL LIQUIDACIÓN VENTA:'), 'font-style:B; bgcolor:#D9E1F2; paddingY:4'); // <--- UTF8_DECODE
$t_liquidacion->easyCell('$ ' . number_format($total_final_venta), 'align:R; font-style:B; bgcolor:#D9E1F2; paddingY:4');
$t_liquidacion->printRow();

// Fila separadora
$t_liquidacion->easyCell(utf8_decode(''), 'colspan:2; paddingY:1');
$t_liquidacion->printRow();

// FILA FAYIDOS (Pérdidas)
$t_liquidacion->easyCell(utf8_decode('CANTIDAD DE POLLOS MUERTOS COSECHA (PÉRDIDA):'), 'font-style:B; bgcolor:#FFEBEB; paddingY:3; color:#DC3545'); // <--- UTF8_DECODE
$t_liquidacion->easyCell(number_format($fayido), 'align:C; paddingY:3; bgcolor:#FFEBEB; color:#DC3545');
$t_liquidacion->printRow();

$t_liquidacion->endTable(8);

// MINI TABLA DE GANANCIA FINAL
$pdf->Ln(3);

$t_ganancia = new easyTable($pdf, '%{100}', 'border:1; paddingY:6; bgcolor:#E2F0D9;');

$t_ganancia->easyCell(
    utf8_decode('GANANCIA FINAL'),
    'align:C; font-style:B; font-size:11; bgcolor:#A9D08E; paddingY:4'
);
$t_ganancia->printRow();

$t_ganancia->easyCell(
    '$ ' . number_format($ganancia_final),
    'align:C; font-style:B; font-size:14; color:#155724; paddingY:6'
);

$t_ganancia->printRow();
$t_ganancia->endTable(10);


$pdf->Output();
