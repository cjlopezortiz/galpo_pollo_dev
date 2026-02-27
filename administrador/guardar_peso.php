<?php

require_once(__DIR__ . '/../modelo/conexion.php');

$conexion = new Conexion();

$codigo = $_POST['codigo'] ?? null;
$datos  = json_decode($_POST['datos'] ?? '', true);

if (!$codigo || !$datos) {
    echo "error";
    exit;
}

// Eliminar registros anteriores
$stmtDelete = $conexion->prepare("DELETE FROM peso_neto_detalle WHERE codigo_almacen = ?");
$stmtDelete->execute([$codigo]);

foreach ($datos as $index => $fila) {

    $bruto   = floatval($fila['bruto']);
    $canasta = floatval($fila['canasta']);
    $neto    = $bruto - $canasta;

    if ($neto < 0) $neto = 0;

    $fila_numero = $index + 1;

    $stmtInsert = $conexion->prepare("
        INSERT INTO peso_neto_detalle 
        (codigo_almacen, fila, bruto, canasta, neto)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmtInsert->execute([
        $codigo,
        $fila_numero,
        $bruto,
        $canasta,
        $neto
    ]);
}

echo "ok";