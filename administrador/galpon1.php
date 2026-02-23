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
    <title>Galpon 1</title>
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
		<div id="tablaGalpon1"></div>
	</div>

    <!-- FIN DEL CONTENIDO -->
    <?php
    include './modales/modalGalpon1.php';
    ?>
    <script src="../controlador/funciones-galpon1.js"></script>
    <?php
	include 'librerias-js.php';
	?>
    <script type="text/javascript">
        $(document).ready(function() {
			rol_user = <?php echo $rol_user; ?>;
			if (rol_user == 1 || rol_user == 2) {
				$('#tablaGalpon1').load('./vista_admin/vista_galpon1.php?codigo_orions=<?php echo $codigo; ?>');
			}
			 else {
				alert("Error...");
			}
			// $('#guardarNuevoGalpon1').click(function() {
			// 	agregarDatosGalpon1();
			// });
			initgalpon1();
			$('#actualizaDatosGalpon1').click(function() {
				modificarGalpon1();
			});
			$('#eliminarDatosGalpon1').click(function() {
				preguntarSiNoGalpon1();
			});
        });
    </script>
</body>

</html>