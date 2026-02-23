<?php
require_once '../modelo/val-admin.php';

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Almacen</title>
	<?php
	include 'librerias-css.php';
	?>
</head>

<body id="body">
<div class="col-sm-12">
		<?php
		include 'menu.php';
		?>
	</div>
	<div class="container-fluid">
		<div id="tablaAlmacen"></div>
	</div>

    <!-- FIN DEL CONTENIDO -->
    <?php
    include './modales/modalAlmacen.php';
    ?>
    <script src="../controlador/funciones-almacen.js"></script>
    <?php
	include 'librerias-js.php';
	?>
    <script type="text/javascript">
        $(document).ready(function() {
        	rol_user = <?php echo $rol_user; ?>;
			if (rol_user == 1 || rol_user == 2) {
				$('#tablaAlmacen').load('./vista_admin/vista_almacen.php');
			}
			 else {
				alert("Error...");
			}
			initAlmacen();
			// $('#guardarNuevoAlmacen').click(function() {
			// 	agregarDatosAlmacen();
			// });
			$('#actualizaDatosAlmacen').click(function() {
				modificarAlmacen();
			});
			$('#eliminarDatosAlmecen').click(function() {
				preguntarSiNoAlmacen();
			});
        });
    </script>
</body>

</html>