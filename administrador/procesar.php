<!DOCTYPE html>
<html lang="es">
	<?php
	$codigo_orions = isset($_GET['codigo_orions']) ? $_GET['codigo_orions'] : '';
	?>

<head>
	<meta charset="UTF-8">
	<title>Sistema de Procesamiento</title>
	<?php include 'librerias-css.php'; ?>
</head>

<body id="body">
	<div class="col-sm-12">

	</div>
	<div class="container-fluid">
		<div id="contenedorProcesar"></div>
	</div>

	<?php include './modales/modaprocesar.php'; ?>
	<script src="../controlador/funciones-procesar.js"></script>
	<?php include 'librerias-js.php'; ?>

	<script type="text/javascript">
		$(document).ready(function() {
			// Pasamos el código como un parámetro de consulta a la vista
			var codigo = "<?php echo $codigo_orions; ?>";
			// Carga la tabla de procesamiento
			$('#contenedorProcesar').load('./vista_admin/vista_procesar.php?codigo_orions=' + codigo);

			$('#actualizaDatosProcesar').click(function() {
				modificarProcesar();
			});
			$('#eliminarDatosProcesar').click(function() {
				preguntarSiNoProcesar();
			});
		});
	</script>
</body>

</html>