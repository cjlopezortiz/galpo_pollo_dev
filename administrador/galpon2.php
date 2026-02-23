<?php
require_once '../modelo/val-admin.php';
?>
<?php
if(isset($_GET['codigo_orions'])){
	$codigo = $_GET['codigo_orions'];
}
else{
	$codigo = "";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galpon 2</title>
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
		<div id="tablaGalpon2"></div>
	</div>

    <!-- FIN DEL CONTENIDO -->
    <?php
    include './modales/modalGalpon2.php';
    ?>
    <script src="../controlador/funciones-galpon2.js"></script>
    <?php
	include 'librerias-js.php';
	?>
    <script type="text/javascript">
        $(document).ready(function() {
			rol_user = <?php echo $rol_user; ?>;
			if (rol_user == 1 || rol_user == 2) {
				$('#tablaGalpon2').load('./vista_admin/vista_galpon2.php?codigo_orions=<?php echo $codigo; ?>');
			}
			 else {
				alert("Error...");
			}
			initgalpon2();
			// $('#guardarNuevoGalpon2').click(function() {
			// 	agregarDatosGalpon2();
			// });
			$('#actualizaDatosGalpon2').click(function() {
				modificarGalpon2();
			});
			$('#eliminarDatosGalpon2').click(function() {
				preguntarSiNoGalpon2();
			});
        });
    </script>
</body>

</html>