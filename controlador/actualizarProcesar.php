<?php
require_once "../modelo/conexion.php";
require_once "../modelo/datos-procesar.php";

$obj = new misProcesos();

// Recogemos los datos enviados por AJAX
$datos = array(
    'codigo_orions' => $_POST['codigo_orions'],
    'fila'          => $_POST['fila'],
    'precio_pollo'          => $_POST['precio_pollo'],
    'bruto'         => $_POST['bruto'],
    'canastas'      => $_POST['canastas'],
    'total_general' => $_POST['total_general']
);
// Llamamos a la función que pegamos en el paso anterior
echo $obj->registrarOActualizar($datos);
?>