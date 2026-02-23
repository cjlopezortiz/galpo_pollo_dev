<?php
date_default_timezone_set("America/Bogota");
require_once 'conexion.php';
require_once 'datos-almacen.php';
$conexion = new Conexion();
$mis_almacenes = new misAlmacenes();

if (isset($_GET['accion'])) {
	$accion = $_GET['accion'];
	if ($accion == 'registrar') {
		$maxAlmacenes = $mis_almacenes->maxAlmacen();
		$codigo = $maxAlmacenes;
		$codigo_orions = $_POST['codigo_orions'];
		$descripcion_material = $_POST['descripcion_material'];
		$cantidad_total = $_POST['cantidad_total'];
		$precio_kilo = $_POST['precio_kilo'];
		$cloro = $_POST['cloro'];
		$vinagre = $_POST['vinagre'];
		$hacido_hacetico = $_POST['hacido_hacetico'];
		$vitaminas = $_POST['vitaminas'];
		$precio_cloro = $_POST['precio_cloro'];
		$precio_vinagre = $_POST['precio_vinagre'];
		$yodo = $_POST['yodo'];
		$precio_yodo = $_POST['precio_yodo'];
		$precio_hacido = $_POST['precio_hacido'];
		$precio_vitamina = $_POST['precio_vitamina'];
		// 👉 NUEVAS VARIABLES
		$anores = $_POST['anores'];
		$precio_anores = $_POST['precio_anores'];
		$vacunas = $_POST['vacunas'];
		$precio_vacunas = $_POST['precio_vacunas'];
		$respiros = $_POST['respiros'];
		$precio_respiros = $_POST['precio_respiros'];
		$tamo = $_POST['tamo'];
		$precio_tamo = $_POST['precio_tamo'];
		$cal = $_POST['cal'];
		$precio_cal = $_POST['precio_cal'];
		$antibiotico = $_POST['antibiotico'];
		$precio_antibiotico = $_POST['precio_antibiotico'];
		$abc = $_POST['abc'];
		$precio_abc = $_POST['precio_abc'];
		$vicarbonato = $_POST['vicarbonato'];
		$precio_vicarbonato = $_POST['precio_vicarbonato'];
		$melasa = $_POST['melasa'];
		$precio_melasa = $_POST['precio_melasa'];
		$agua_potable = $_POST['agua_potable'];
		$precio_agua = $_POST['precio_agua'];
		$luz = $_POST['luz'];
		$precio_luz = $_POST['precio_luz'];
		$arriendo = $_POST['arriendo'];
		$precio_arriendo = $_POST['precio_arriendo'];
		$gastos_varios = $_POST['gastos_varios'];
		$precio_gastos_varios = $_POST['precio_gastos_varios'];
		$sql = "INSERT INTO almacen(
                    codigo, codigo_orions, descripcion_material, cantidad_total, precio_kilo,
                    cloro, vinagre, hacido_hacetico, vitaminas,
                    precio_cloro, precio_vinagre, yodo, precio_yodo, precio_hacido, precio_vitamina,
                    anores, precio_anores, vacunas, precio_vacunas,
                    respiros, precio_respiros, tamo, precio_tamo,
                    cal, precio_cal, antibiotico, precio_antibiotico,
                    abc, precio_abc, vicarbonato, precio_vicarbonato,
                    melasa, precio_melasa, agua_potable, precio_agua,
					luz, precio_luz, arriendo, precio_arriendo, gastos_varios, 
					precio_gastos_varios
                ) 
				VALUES (
						?, ?, ?, ?, 
						?, ?, ?, ?, 
						?, ?, ?, ?, 
						?, ?, ?, ?, 
						?, ?, ?, ?, 
						?, ?, ?, ?, 
						?, ?, ?, ?, 
						?, ?, ?, ?, 
						?, ?, ?, ?, 
						?, ?, ?, ?, ?
                        )";
		$reg = $conexion->prepare($sql);
		$reg->bindParam(1,  $maxAlmacenes);
		$reg->bindParam(2,  $codigo_orions);
		$reg->bindParam(3,  $descripcion_material);
		$reg->bindParam(4,  $cantidad_total);
		$reg->bindParam(5,  $precio_kilo);

		$reg->bindParam(6,  $cloro);
		$reg->bindParam(7,  $vinagre);
		$reg->bindParam(8,  $hacido_hacetico);
		$reg->bindParam(9,  $vitaminas);

		$reg->bindParam(10, $precio_cloro);
		$reg->bindParam(11, $precio_vinagre);
		$reg->bindParam(12, $yodo);
		$reg->bindParam(13, $precio_yodo);

		$reg->bindParam(14, $precio_hacido);
		$reg->bindParam(15, $precio_vitamina);

		$reg->bindParam(16, $anores);
		$reg->bindParam(17, $precio_anores);
		$reg->bindParam(18, $vacunas);
		$reg->bindParam(19, $precio_vacunas);

		$reg->bindParam(20, $respiros);
		$reg->bindParam(21, $precio_respiros);
		$reg->bindParam(22, $tamo);
		$reg->bindParam(23, $precio_tamo);

		$reg->bindParam(24, $cal);
		$reg->bindParam(25, $precio_cal);
		$reg->bindParam(26, $antibiotico);
		$reg->bindParam(27, $precio_antibiotico);

		$reg->bindParam(28, $abc);
		$reg->bindParam(29, $precio_abc);
		$reg->bindParam(30, $vicarbonato);
		$reg->bindParam(31, $precio_vicarbonato);

		$reg->bindParam(32, $melasa);
		$reg->bindParam(33, $precio_melasa);
		$reg->bindParam(34, $agua_potable);
		$reg->bindParam(35, $precio_agua);

		$reg->bindParam(36, $luz);
		$reg->bindParam(37, $precio_luz);
		$reg->bindParam(38, $arriendo);
		$reg->bindParam(39, $precio_arriendo);

		$reg->bindParam(40, $gastos_varios);
		$reg->bindParam(41, $precio_gastos_varios);


		if ($reg->execute() == TRUE) {
			echo 1;
		} else {
			echo 0;
		}
	} else if ($accion == 'modificar') {

		$codigo = $_POST['codigo'];
		$codigo_orions = $_POST['codigo_orions'];
		$descripcion_material = $_POST['descripcion_material'];
		$cantidad_total = $_POST['cantidad_total'];
		$precio_kilo = $_POST['precio_kilo'];
		$cloro = $_POST['cloro'];
		$vinagre = $_POST['vinagre'];
		$hacido_hacetico = $_POST['hacido_hacetico'];
		$vitaminas = $_POST['vitaminas'];
		$precio_cloro = $_POST['precio_cloro'];
		$precio_vinagre = $_POST['precio_vinagre'];
		$yodo = $_POST['yodo'];
		$precio_yodo = $_POST['precio_yodo'];
		$precio_hacido = $_POST['precio_hacido'];
		$precio_vitamina = $_POST['precio_vitamina'];
		// 👉 NUEVAS VARIABLES
		$anores = $_POST['anores'];
		$precio_anores = $_POST['precio_anores'];
		$vacunas = $_POST['vacunas'];
		$precio_vacunas = $_POST['precio_vacunas'];
		$respiros = $_POST['respiros'];
		$precio_respiros = $_POST['precio_respiros'];
		$tamo = $_POST['tamo'];
		$precio_tamo = $_POST['precio_tamo'];
		$cal = $_POST['cal'];
		$precio_cal = $_POST['precio_cal'];
		$antibiotico = $_POST['antibiotico'];
		$precio_antibiotico = $_POST['precio_antibiotico'];
		$abc = $_POST['abc'];
		$precio_abc = $_POST['precio_abc'];
		$vicarbonato = $_POST['vicarbonato'];
		$precio_vicarbonato = $_POST['precio_vicarbonato'];
		$melasa = $_POST['melasa'];
		$precio_melasa = $_POST['precio_melasa'];
		$agua_potable = $_POST['agua_potable'];
		$precio_agua = $_POST['precio_agua'];
		$luz = $_POST['luz'];
		$precio_luz = $_POST['precio_luz'];
		$arriendo = $_POST['arriendo'];
		$precio_arriendo = $_POST['precio_arriendo'];
		$gastos_varios = $_POST['gastos_varios'];
		$precio_gastos_varios = $_POST['precio_gastos_varios'];

		$sql = "UPDATE almacen SET
		codigo_orions = :codigo_orions,
		descripcion_material = :descripcion_material,
		cantidad_total = :cantidad_total,
		precio_kilo = :precio_kilo,
		cloro = :cloro,
		vinagre = :vinagre,
		hacido_hacetico = :hacido_hacetico,
		vitaminas = :vitaminas,
		precio_cloro = :precio_cloro,
		precio_vinagre = :precio_vinagre,
		yodo = :yodo,
		precio_yodo = :precio_yodo,
		precio_hacido = :precio_hacido,
		precio_vitamina = :precio_vitamina,
		anores = :anores,
		precio_anores = :precio_anores,
		vacunas = :vacunas,
		precio_vacunas = :precio_vacunas,
		respiros = :respiros,
		precio_respiros = :precio_respiros,
		tamo = :tamo,
		precio_tamo = :precio_tamo,
		cal = :cal,
		precio_cal = :precio_cal,
		antibiotico = :antibiotico,
		precio_antibiotico = :precio_antibiotico,
		abc = :abc,
		precio_abc = :precio_abc,
		vicarbonato = :vicarbonato,
		precio_vicarbonato = :precio_vicarbonato,
		melasa = :melasa,
		precio_melasa = :precio_melasa,
		agua_potable = :agua_potable,
		precio_agua = :precio_agua,
		luz = :luz,
		precio_luz = :precio_luz,
		arriendo = :arriendo,
		precio_arriendo = :precio_arriendo,
		gastos_varios = :gastos_varios,
		precio_gastos_varios = IFNULL(precio_gastos_varios, 0) + :precio_gastos_varios
	WHERE codigo = :codigo";


		$reg = $conexion->prepare($sql);

		$reg->bindParam(":codigo", $codigo);
		$reg->bindParam(":codigo_orions", $codigo_orions);
		$reg->bindParam(":descripcion_material", $descripcion_material);
		$reg->bindParam(":cantidad_total", $cantidad_total);
		$reg->bindParam(":precio_kilo", $precio_kilo);
		$reg->bindParam(":cloro", $cloro);
		$reg->bindParam(":vinagre", $vinagre);
		$reg->bindParam(":hacido_hacetico", $hacido_hacetico);
		$reg->bindParam(":vitaminas", $vitaminas);
		$reg->bindParam(":precio_cloro", $precio_cloro);
		$reg->bindParam(":precio_vinagre", $precio_vinagre);
		$reg->bindParam(":yodo", $yodo);
		$reg->bindParam(":precio_yodo", $precio_yodo);
		$reg->bindParam(":precio_hacido", $precio_hacido);
		$reg->bindParam(":precio_vitamina", $precio_vitamina);
		$reg->bindParam(":anores", $anores);
		$reg->bindParam(":precio_anores", $precio_anores);
		$reg->bindParam(":vacunas", $vacunas);
		$reg->bindParam(":precio_vacunas", $precio_vacunas);
		$reg->bindParam(":respiros", $respiros);
		$reg->bindParam(":precio_respiros", $precio_respiros);
		$reg->bindParam(":tamo", $tamo);
		$reg->bindParam(":precio_tamo", $precio_tamo);
		$reg->bindParam(":cal", $cal);
		$reg->bindParam(":precio_cal", $precio_cal);
		$reg->bindParam(":antibiotico", $antibiotico);
		$reg->bindParam(":precio_antibiotico", $precio_antibiotico);
		$reg->bindParam(":abc", $abc);
		$reg->bindParam(":precio_abc", $precio_abc);
		$reg->bindParam(":vicarbonato", $vicarbonato);
		$reg->bindParam(":precio_vicarbonato", $precio_vicarbonato);
		$reg->bindParam(":melasa", $melasa);
		$reg->bindParam(":precio_melasa", $precio_melasa);
		$reg->bindParam(":agua_potable", $agua_potable);
		$reg->bindParam(":precio_agua", $precio_agua);
		$reg->bindParam(":luz", $luz);
		$reg->bindParam(":precio_luz", $precio_luz);
		$reg->bindParam(":arriendo", $arriendo);
		$reg->bindParam(":precio_arriendo", $precio_arriendo);
		$reg->bindParam(":gastos_varios", $gastos_varios);
		$reg->bindParam(":precio_gastos_varios", $precio_gastos_varios);

		echo $reg->execute() ? 1 : 0;
	} else if ($accion == 'eliminar') {

		$codigo = $_POST['codigo'];

		$sql = "DELETE FROM almacen WHERE codigo = :codigo;";
		$del = $conexion->prepare($sql);
		$del->bindParam(":codigo", $codigo);

		echo $del->execute() ? 1 : 0;
	} else {
		echo 2;
	}
} else {
	echo 3;
}
