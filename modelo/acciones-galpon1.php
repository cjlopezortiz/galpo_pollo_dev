<?php
date_default_timezone_set("America/Bogota");
require_once 'conexion.php';
require_once 'datos-galpon1.php';
$conexion = new Conexion();
$mis_galpon1 = new misGalpon1();
if (isset($_GET['accion'])) {
	$accion = $_GET['accion'];
	if ($accion == 'registrar') {
		$maxGalpon1 = $mis_galpon1->maxGalpon1();
		$codigo = $maxGalpon1;

		$codigo_orions = $_POST['codigo_orions'];
		$cantidad_pollo = $_POST['cantidad_pollo'];
		$precio_pollo = $_POST['precio_pollo'];
		$color = $_POST['color'];
		$fayido = $_POST['fayido'];
		$tipo_alimento = $_POST['tipo_alimento'];
		$cantidad = $_POST['cantidad'];
		$precio_alimento = $_POST['precio_alimento'];
		$fecha_inicio = $_POST['fecha_inicio'];
		$fecha_fin = $_POST['fecha_fin'];
		$descripcion = $_POST['descripcion'];
		$alimento_inicio = $_POST['alimento_inicio'];
		$precio_inicio = $_POST['precio_inicio'];
		$alimento_preinicio = $_POST['alimento_preinicio'];
		$precio_preinicio = $_POST['precio_preinicio'];

		$sql = "INSERT INTO galpon_1 (codigo, codigo_orions, cantidad_pollo, precio_pollo, color, fayido, tipo_alimento, cantidad, precio_alimento, fecha_inicio, fecha_fin, descripcion, alimento_inicio, precio_inicio, alimento_preinicio, precio_preinicio) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$reg = $conexion->prepare($sql);

		$reg->bindParam(1,  $maxGalpon1);
		$reg->bindParam(2,  $codigo_orions);
		$reg->bindParam(3,  $cantidad_pollo);
		$reg->bindParam(4,  $precio_pollo);
		$reg->bindParam(5,  $color);
		$reg->bindParam(6,  $fayido);
		$reg->bindParam(7,  $tipo_alimento);
		$reg->bindParam(8,  $cantidad);
		$reg->bindParam(9,  $precio_alimento);
		$reg->bindParam(10, $fecha_inicio);
		$reg->bindParam(11, $fecha_fin);
		$reg->bindParam(12, $descripcion);
		$reg->bindParam(13, $alimento_inicio);
		$reg->bindParam(14, $precio_inicio);
		$reg->bindParam(15, $alimento_preinicio);
		$reg->bindParam(16, $precio_preinicio);

		if ($reg->execute()) {

			// --- INSERT DEL ALMACÉN ---
			$sql = "INSERT INTO almacen (codigo, codigo_orions) VALUES (?, ?)";
			$reg = $conexion->prepare($sql);

			$reg->bindParam(1, $codigo);
			$reg->bindParam(2, $codigo_orions);

			if ($reg->execute()) {
				echo 1; // TODO BIEN
			} else {
				echo "ERROR ALMACEN: " . implode(" | ", $reg->errorInfo());
			}
		} else {
			echo "ERROR GALPON: " . implode(" | ", $reg->errorInfo());
		}
	} else if ($accion == 'modificar') {
		$codigo = $_POST['codigo'];
		$codigo_orions = $_POST['codigo_orions'];
		$cantidad_pollo = $_POST['cantidad_pollo'];
		$precio_pollo = $_POST['precio_pollo'];
		$color = $_POST['color'];
		$fayido = $_POST['fayido'];
		$tipo_alimento = $_POST['tipo_alimento'];
		$cantidad = $_POST['cantidad'];
		$precio_alimento = $_POST['precio_alimento'];
		$fecha_inicio = $_POST['fecha_inicio'];
		$fecha_fin = $_POST['fecha_fin'];
		$descripcion = $_POST['descripcion'];
		$alimento_inicio = $_POST['alimento_inicio'];
		$precio_inicio = $_POST['precio_inicio'];
		$alimento_preinicio = $_POST['alimento_preinicio'];
		$precio_preinicio = $_POST['precio_preinicio'];


		$sql = "UPDATE galpon_1 SET 

					   codigo_orions=:codigo_orions,
					   cantidad_pollo=:cantidad_pollo,
					   precio_pollo=:precio_pollo,
					   color=:color,
					   fayido=:fayido,
					   tipo_alimento=:tipo_alimento,
					   cantidad=:cantidad,
					   precio_alimento=:precio_alimento,
					   fecha_inicio=:fecha_inicio,
					   fecha_fin=:fecha_fin,
					   descripcion=:descripcion,
					   alimento_inicio=:alimento_inicio,
					   precio_inicio=:precio_inicio,
					   alimento_preinicio=:alimento_preinicio,
					   precio_preinicio=:precio_preinicio

					  
				WHERE codigo = :codigo;";

		$reg = $conexion->prepare($sql);
		$reg->bindParam(":codigo", $codigo);
		$reg->bindParam(":codigo_orions", $codigo_orions);
		$reg->bindParam(":cantidad_pollo", $cantidad_pollo);
		$reg->bindParam(":precio_pollo", $precio_pollo);
		$reg->bindParam(":color", $color);
		$reg->bindParam(":fayido", $fayido);
		$reg->bindParam(":tipo_alimento", $tipo_alimento);
		$reg->bindParam(":cantidad", $cantidad);
		$reg->bindParam(":precio_alimento", $precio_alimento);
		$reg->bindParam(":fecha_inicio", $fecha_inicio);
		$reg->bindParam(":fecha_fin", $fecha_fin);
		$reg->bindParam(":descripcion", $descripcion);
		$reg->bindParam(":alimento_inicio", $alimento_inicio);
		$reg->bindParam(":precio_inicio", $precio_inicio);
		$reg->bindParam(":alimento_preinicio", $alimento_preinicio);
		$reg->bindParam(":precio_preinicio", $precio_preinicio);

		if ($reg->execute() == TRUE) {
			echo 1;
		} else {
			echo 0;
		}
	} else if ($accion == 'eliminar') {
		$codigo = $_POST['codigo'];
		$sql = "DELETE FROM galpon_1 WHERE codigo = :codigo;";
		$del = $conexion->prepare($sql);
		$del->bindParam(":codigo", $codigo);
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
