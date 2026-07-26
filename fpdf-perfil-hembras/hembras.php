<?php
include_once '../modelo/datos-galpon2.php';
include_once '../modelo/datos-galpon1.php';
include_once '../fpdf/fpdf.php';
include 'exfpdf.php';
include 'easyTable.php';

$mis_galpon2 = new misGalpon2();
$mis_galpon1 = new misGalpon1();

$codigo = $_GET['codigo'] ?? null;

// Datos de ejemplo para la gráfica (reemplazar con datos reales)
$datos_crecimiento = [
    12, 18, 25, 30, 36, 42, 48, 55, 61, 68,
    75, 81, 88, 94, 101, 108, 114, 121, 128, 134,
    141, 146, 150, 153, 155, 156, 156, 156, 156, 156
];
$etiquetas_dias = range(1, 30);

// Configuración de la gráfica
$chartConfig = [
    'type' => 'line', 
    'data' => [
        'labels' => $etiquetas_dias,
        'datasets' => [[
            'label' => 'Curva de Crecimiento',
            'data' => $datos_crecimiento,
            'borderColor' => '#4e79a7',
            'backgroundColor' => 'transparent',
            'fill' => false,
            'pointRadius' => 0
        ]]
    ],
    'options' => [
        'title' => [
            'display' => true,
            'text' => 'PERFIL DE CRECIMIENTO HEMBRAS'
        ],
        'scales' => [
            'yAxes' => [[
                'ticks' => [
                    'beginAtZero' => true,
                    'suggestedMax' => 180
                ]
            ]]
        ]
    ]
];

$chartUrl = 'https://quickchart.io/chart?w=600&h=300&c=' . urlencode(json_encode($chartConfig));

// Inicializar FPDF
$pdf = new FPDF(); // o new exFPDF()
$pdf->AddPage('L'); // Horizontal

// --- INSERTAR IMÁGENES FLANQUEANDO EL TÍTULO ---

// Imagen Izquierda
// Parámetros: ruta, x, y, ancho, alto (0 para automático), tipo
$pdf->Image('../imagenes/pollopdf3.png', 10, 10, 30, 0, 'PNG'); 

// Imagen Derecha
// Calculamos la posición x para que esté a la derecha
$ancho_pagina = $pdf->GetPageWidth();
$ancho_imagen_derecha = 30;
$posicion_x_derecha = $ancho_pagina - $ancho_imagen_derecha - 10;
$pdf->Image('../imagenes/pollopdf3.png', $posicion_x_derecha, 10, $ancho_imagen_derecha, 0, 'PNG');

// --- TÍTULO ---
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetXY(0, 15); // Centrar verticalmente con las imágenes
$pdf->Cell(0, 10, 'REPORTE DE CURVA DE CRECIMIENTO', 0, 1, 'C');

// Espacio antes de la gráfica
$pdf->Ln(20);

// --- INSERTAR GRÁFICA ---
// Asegúrate de incluir 'PNG' como quinto parámetro para evitar el error anterior
$pdf->Image($chartUrl, 10, $pdf->GetY(), 270, 0, 'PNG');

$pdf->Output();
?>