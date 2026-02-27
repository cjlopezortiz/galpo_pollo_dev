<?php

require_once(__DIR__ . '/../modelo/conexion.php');

$conexion = new Conexion();

$codigo = $_GET['codigo'] ?? null;

if (!$codigo) {
    echo json_encode([]);
    exit;
}

$stmt = $conexion->prepare("
    SELECT fila, bruto, canasta, neto
    FROM peso_neto_detalle
    WHERE codigo_almacen = ?
    ORDER BY fila ASC
");

$stmt->execute([$codigo]);

$datos = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($datos);