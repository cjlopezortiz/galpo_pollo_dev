<?php
date_default_timezone_set("America/Bogota");
require_once 'conexion.php';
require_once 'datos-galpon1.php';
$conexion = new Conexion();
$mis_galpon1 = new misGalpon1();
session_start();
$usuario_codigo = $_SESSION['codigo'];
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

		$sql = "INSERT INTO galpon_1 (codigo, codigo_orions, cantidad_pollo, precio_pollo, color, fayido, tipo_alimento, cantidad, precio_alimento, fecha_inicio, fecha_fin, descripcion, alimento_inicio, precio_inicio, alimento_preinicio, precio_preinicio,usuario_codigo) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
		$reg->bindParam(17, $usuario_codigo);

		if ($reg->execute()) {

			/* ===============================
        OBTENER SIGUIENTE CODIGO ALMACEN
     ================================ */
			$sqlMaxAlmacen = "SELECT IFNULL(MAX(codigo),0)+1 AS codigo FROM almacen";
			$stmtMaxAlmacen = $conexion->prepare($sqlMaxAlmacen);
			$stmtMaxAlmacen->execute();
			$rowAlmacen = $stmtMaxAlmacen->fetch(PDO::FETCH_ASSOC);

			$codigoAlmacen = $rowAlmacen['codigo'];

			/* ===============================
        INSERT EN ALMACEN
     ================================ */
			$sqlAlmacen = "INSERT INTO almacen (codigo, codigo_orions, usuario_codigo) VALUES (?, ?, ?)";
			$stmtAlmacen = $conexion->prepare($sqlAlmacen);

			$stmtAlmacen->bindParam(1, $codigoAlmacen);
			$stmtAlmacen->bindParam(2, $codigo_orions);
			$stmtAlmacen->bindParam(3, $usuario_codigo);

			if (!$stmtAlmacen->execute()) {
				echo "ERROR ALMACEN: " . implode(" | ", $stmtAlmacen->errorInfo());
				exit;
			}

			/* ===============================
        OBTENER SIGUIENTE CODIGO DETALLE
     ================================ */
			$sqlMaxDetalle = "SELECT IFNULL(MAX(codigo),0)+1 AS codigo FROM peso_neto_detalle";
			$stmtMaxDetalle = $conexion->prepare($sqlMaxDetalle);
			$stmtMaxDetalle->execute();
			$rowDetalle = $stmtMaxDetalle->fetch(PDO::FETCH_ASSOC);

			$codigoDetalle = $rowDetalle['codigo'];

			/* ===============================
        INSERT EN PESO_NETO_DETALLE
     ================================ */
			$sqlDetalle = "INSERT INTO peso_neto_detalle (codigo, codigo_orions, usuario_codigo) VALUES (?, ?, ?)";
			$stmtDetalle = $conexion->prepare($sqlDetalle);

			$stmtDetalle->bindParam(1, $codigoDetalle);
			$stmtDetalle->bindParam(2, $codigo_orions);
			$stmtDetalle->bindParam(3, $usuario_codigo);

			if (!$stmtDetalle->execute()) {
				echo "ERROR DETALLE: " . implode(" | ", $stmtDetalle->errorInfo());
				exit;
			}

			/* ===============================
        OBTENER SIGUIENTE CODIGO CONTROL ALIMENTO
     ================================ */
			$sqlMaxAlimento = "SELECT IFNULL(MAX(codigo),0)+1 AS codigo FROM control_alimento";
			$stmtMaxAlimento = $conexion->prepare($sqlMaxAlimento);
			$stmtMaxAlimento->execute();
			$rowAlimento = $stmtMaxAlimento->fetch(PDO::FETCH_ASSOC);

			$codigoAlimento = $rowAlimento['codigo'];

			/* ===============================
        INSERT EN CONTROL_ALIMENTO
     ================================ */
			$sqlAlimento = "INSERT INTO control_alimento (codigo, codigo_orions, usuario_codigo) VALUES (?, ?, ?)";
			$stmtAlimento = $conexion->prepare($sqlAlimento);

			$stmtAlimento->bindParam(1, $codigoAlimento);
			$stmtAlimento->bindParam(2, $codigo_orions);
			$stmtAlimento->bindParam(3, $usuario_codigo);

			if (!$stmtAlimento->execute()) {
				echo "ERROR CONTROL ALIMENTO: " . implode(" | ", $stmtAlimento->errorInfo());
				exit;
			}


			/* ===============================
        OBTENER REGISTRO DE USO DE MEDICAMENTOS VETERINARIOS
     ================================ */
			$sqlMaxRegistroMedicamento = "SELECT IFNULL(MAX(codigo),0)+1 AS codigo FROM registro_medicamentos";
			$stmtMaxRegistroMedicamento = $conexion->prepare($sqlMaxRegistroMedicamento);
			$stmtMaxRegistroMedicamento->execute();
			$rowRegistroMedicamento = $stmtMaxRegistroMedicamento->fetch(PDO::FETCH_ASSOC);

			$codigoRegistroMedicamento = $rowRegistroMedicamento['codigo'];

			/* ===============================
        INSERT REGISTRO DE USO DE MEDICAMENTOS VETERINARIOS
     ================================ */
			$sqlRegistroMedicamento = "INSERT INTO registro_medicamentos (codigo, codigo_orions, usuario_codigo) VALUES (?, ?, ?)";
			$stmtRegistroMedicamento = $conexion->prepare($sqlRegistroMedicamento);

			$stmtRegistroMedicamento->bindParam(1, $codigoRegistroMedicamento);
			$stmtRegistroMedicamento->bindParam(2, $codigo_orions);
			$stmtRegistroMedicamento->bindParam(3, $usuario_codigo);

			if (!$stmtRegistroMedicamento->execute()) {
				echo "ERROR REGISTRO DE USO DE MEDICAMENTOS VETERINARIOS: " . implode(" | ", $stmtRegistroMedicamento->errorInfo());
				exit;
			}

			echo 1;
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
		$edad = $_POST['edad'];
		$salidas = $_POST['salidas'];
		$peso_salidas = $_POST['peso_salidas'];
		$mortanda_dia = $_POST['mortanda_dia'];


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
					   precio_preinicio=:precio_preinicio,
					   edad=:edad,
					   salidas=:salidas,
					   peso_salidas=:peso_salidas,
					   mortanda_dia=:mortanda_dia

					  
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
		$reg->bindParam(":edad", $edad);
		$reg->bindParam(":salidas", $salidas);
		$reg->bindParam(":peso_salidas", $peso_salidas);
		$reg->bindParam(":mortanda_dia", $mortanda_dia);

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
