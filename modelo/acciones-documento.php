<?php
date_default_timezone_set("America/Bogota");
require_once 'conexion.php';
$conexion = new Conexion();
if (isset($_GET['accion'])) {
	$accion = $_GET['accion'];
	if ($accion == 'registrar') {
		$nombre = $_POST['nombre'];
		$sigla = $_POST['sigla'];
		$sql = "INSERT INTO tipo_documento (nombre, sigla) 
				VALUES (?, ?)";
		$reg = $conexion->prepare($sql);
		$reg->bindParam(1, $nombre);
		$reg->bindParam(2, $sigla);
		if ($reg->execute() == TRUE) {
			echo 1;
		} else {
			echo 0;
		}
       
	} else if ($accion == 'modificar') {
				$id_tipo_documento = $_POST['id_tipo_documento'];
				$nombre = $_POST['nombre'];
				$sigla = $_POST['sigla'];

		$sql = "UPDATE tipo_documento SET 
					   nombre=:nombre,
					   sigla=:sigla
				WHERE id_tipo_documento = :id_tipo_documento;";

		$reg = $conexion->prepare($sql);
		$reg->bindParam(":id_tipo_documento", $id_tipo_documento);
		$reg->bindParam(":nombre", $nombre);
		$reg->bindParam(":sigla", $sigla);
		if ($reg->execute() == TRUE) {
			echo 1;
		} else {
			echo 0;
		}
	} else if ($accion == 'eliminar') {
		$id_tipo_documento = $_POST['id_tipo_documento'];
		$sql = "DELETE FROM tipo_documento WHERE id_tipo_documento = :id_tipo_documento;";
		$del = $conexion->prepare($sql);
		$del->bindParam(":id_tipo_documento", $id_tipo_documento);
		if ($del->execute() == TRUE) {
			echo 1;
		} else {
			echo 0;
		}
	} else {
		echo 2;
	}
} else {
	echo 3;
}