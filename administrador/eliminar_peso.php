<?php

require_once(__DIR__ . '/../modelo/conexion.php');

$conexion = new Conexion();

$codigo = $_POST['codigo'] ?? null;

if (!$codigo) {
    echo "error";
    exit;
}

$stmt = $conexion->prepare("DELETE FROM peso_neto_detalle WHERE codigo_almacen = ?");
$stmt->execute([$codigo]);

echo "ok";