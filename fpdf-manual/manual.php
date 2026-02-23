<?php
include_once '../fpdf/fpdf.php';
include 'exfpdf.php';
include 'easyTable.php';

class PDF_HF extends exFPDF
{
    // ------------------- MARCA DE AGUA (FONDO) -------------------
    function FancyBackground()
    {
        // Color azul clarito para el fondo general
        $this->SetFillColor(230, 245, 255); 
        $this->Rect(0, 0, 220, 280, 'F');

        // Logo gigante transparente al centro
        $logo = '';

        if (file_exists($logo)) {
            // Guardamos la transparencia actual
            if (method_exists($this, 'SetAlpha')) {
                $this->SetAlpha(0.08); // súper transparente
            }

            // Colocar un logo grande centrado
            $this->Image($logo, 20, 35, 160, 160);

            // Restaurar opacidad
            if (method_exists($this, 'SetAlpha')) {
                $this->SetAlpha(1);
            }
        }
    }

    // --------------- HEADER ----------------
    function Header()
    {
        $this->FancyBackground(); // ← Fondo con color + logo gigante

        // Barra curva simulada
        $this->SetFillColor(220, 235, 255);
        $this->Rect(0, 0, 220, 30, 'F');

        // Línea decorativa
        $this->SetDrawColor(150, 180, 215);
        $this->SetLineWidth(0.6);
        $this->Line(10, 30, 205, 30);

        // LOGO IZQUIERDO
        $this->Image('../imagenes/pollo2.jpeg', 10, 4, 22, 22);

        // LOGO DERECHO
        $this->Image('../imagenes/pollo9.jpeg', 185, 4, 22, 22);

        // TÍTULO
        $this->SetY(7);
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(20, 50, 120);
        $this->Cell(0, 8, utf8_decode('MANUAL DE CRIANZA DE POLLOS BLANCOS DE ENGORDE'), 0, 1, 'C');

        // SUBTÍTULO
        $this->SetFont('Arial', '', 9);
        $this->SetTextColor(70, 70, 70);
        $this->Cell(0, 5, utf8_decode('Sistema de Gestión Avícola'), 0, 1, 'C');

        $this->Ln(10);
    }

    // --------------- FOOTER ----------------
    function Footer()
    {
        // Barra inferior curva
        $this->SetFillColor(230, 240, 255);
        $this->Rect(0, 262, 220, 25, 'F');

        // Línea superior
        $this->SetDrawColor(190, 200, 225);
        $this->SetLineWidth(0.5);
        $this->Line(10, 262, 205, 262);

        // LOGO IZQUIERDO FOOTER
        $this->Image('../imagenes/pollo.jpg', 12, 266, 15, 15);

        // LOGO DERECHO FOOTER
        $this->Image('../imagenes/galpo2.jpeg', 188, 266, 15, 15);

        // Texto
        $this->SetY(-18);
        $this->SetFont('Arial', '', 8);
        $this->SetTextColor(90, 90, 90);

        $this->Cell(0, 8, utf8_decode('© ' . date('Y') . ' Granjas Avícolas - Reporte interno'), 0, 0, 'L');

        // Número de página
        $this->SetFont('Arial', 'B', 9);
        $this->SetTextColor(50, 80, 130);
        $this->Cell(0, 8, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'R');
    }
}

$pdf = new PDF_HF('P', 'mm', 'Letter');
$pdf->SetMargins(5, 30, 5); // margen superior subido para no tapar header
$pdf->SetAutoPageBreak(true, 25); // deja espacio para footer
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 8);

/* ================================
   TABLA #1 — INFORMACIÓN GENERAL
================================ */
class PDF extends exFPDF
{
    // ----- HEADER -----
    function Header()
    {
        // Logo (opcional)
        // $this->Image('../img/logo.png', 10, 8, 20);

        // Título del PDF
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(40, 40, 40);
        $this->Cell(0, 10, utf8_decode('MANUAL DE CRIANZA DE POLLOS BLANCOS DE ENGORDE'), 0, 1, 'C');

        // Línea separadora
        $this->SetLineWidth(0.4);
        $this->Line(10, 20, 205, 20);

        $this->Ln(5);
    }

    // ----- FOOTER -----
    function Footer()
    {
        // Posición 15 mm desde abajo
        $this->SetY(-15);

        // Línea superior del footer
        $this->SetLineWidth(0.3);
        $this->Line(10, $this->GetY(), 205, $this->GetY());

        $this->SetFont('Arial', '', 8);
        $this->SetTextColor(100, 100, 100);

        // Texto izquierda
        $this->Cell(0, 8, utf8_decode('Manual de Gestión de Galpones'), 0, 0, 'L');

        // Texto derecha con número de página
        $this->Cell(0, 8, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'R');
    }
}
$t3 = new easyTable($pdf, '%{40,60}', 'border:1; paddingY:3;');
$pdf = new PDF_HF('P', 'mm', 'Letter');
$pdf->SetMargins(5, 30, 5); 
$pdf->SetAutoPageBreak(true, 25);
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

/* ==============================================
   MANUAL DE CRIANZA DE POLLOS BLANCOS DE ENGORDE
   ============================================== */


// RESTABLECER TEXTO NORMAL
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(40, 40, 40);

// ---------- SECCIÓN 1 ----------
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, utf8_decode('1. Introducción'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 6, utf8_decode(
    "Este manual describe los pasos fundamentales para la crianza adecuada "
    . "de pollos blancos de engorde, garantizando salud, crecimiento óptimo "
    . "y eficiencia de producción."
));
$pdf->Ln(3);

// ---------- SECCIÓN 2 ----------
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, utf8_decode('2. Preparación del Galpón'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 6, utf8_decode(
    "• Limpiar y desinfectar el galpón antes de recibir los pollitos.\n"
    . "• Verificar ventilación, temperatura y humedad.\n"
    . "• Colocar cama nueva (viruta o cascarilla).\n"
    . "• Instalar bebederos y comederos adecuados."
));
$pdf->Ln(3);

// ---------- SECCIÓN 3 ----------
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, utf8_decode('3. Recepción de Pollitos'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 6, utf8_decode(
    "• Temperatura recomendada al ingreso: 32°C - 34°C.\n"
    . "• Proveer agua con electrolitos las primeras 12 horas.\n"
    . "• Revisar que los pollitos tengan: vientre cerrado, patas firmes y plumas secas."
));
$pdf->Ln(3);

// ---------- SECCIÓN 4 ----------
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, utf8_decode('4. Alimentación'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 6, utf8_decode(
    "• Usar alimento iniciador hasta los 14 días.\n"
    . "• Del día 15 en adelante usar alimento de engorde.\n"
    . "• Mantener alimento fresco, seco y disponible las 24 horas."
));
$pdf->Ln(3);

// ---------- SECCIÓN 5 ----------
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, utf8_decode('5. Agua'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 6, utf8_decode(
    "• El agua debe estar siempre limpia y fresca.\n"
    . "• Lavar bebederos diariamente.\n"
    . "• Ajustar la altura del bebedero según crecimiento."
));
$pdf->Ln(3);

// ---------- SECCIÓN 6 ----------
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, utf8_decode('6. Temperatura y Ventilación'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 6, utf8_decode(
    "• Reducir 2°C por semana hasta llegar a 24°C.\n"
    . "• Evitar corrientes de aire directas.\n"
    . "• Mantener ventilación cruzada para eliminar humedad y gases."
));
$pdf->Ln(3);

// ---------- SECCIÓN 7 ----------
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, utf8_decode('7. Manejo Sanitario'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 6, utf8_decode(
    "• Aplicar el plan de vacunación recomendado.\n"
    . "• Observar a diario signos de enfermedades.\n"
    . "• Separar inmediatamente aves enfermas."
));
$pdf->Ln(3);

// ---------- SECCIÓN 8 ----------
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, utf8_decode('8. Crecimiento y Control de Peso'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 6, utf8_decode(
    "• Realizar pesajes semanales.\n"
    . "• Registrar consumo de alimento y mortalidad.\n"
    . "• Evaluar conversión alimenticia."
));
$pdf->Ln(3);

// ---------- SECCIÓN 9 ----------
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, utf8_decode('9. Manejo de Cama'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 6, utf8_decode(
    "• Mantener la cama seca para evitar dermatitis en patas.\n"
    . "• Cambiar cama húmeda o aglomerada.\n"
    . "• Evitar acumulación de amoníaco."
));
$pdf->Ln(3);

// ---------- SECCIÓN 10 ----------
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, utf8_decode('10. Sacrificio'), 0, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(0, 6, utf8_decode(
    "• Edad recomendada: 40 a 50 días.\n"
    . "• Evitar estrés durante el cargue.\n"
    . "• Revisar ayuno, transporte y manejo."
));
$pdf->Ln(8);

$pdf->Output();
