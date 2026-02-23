<?php
require_once '../modelo/val-admin.php';
?>
<?php
if(isset($_GET['cod_centro_formacion'])){
	$centro_formacion_cod = $_GET['cod_centro_formacion'];
}
else{
	$centro_formacion_cod  = "";
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentós</title>
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
		<div id="tablaDocumento"></div>
	</div>

    <!-- FIN DEL CONTENIDO -->
    <?php
    include './modales/modalDocumento.php';
    ?>
    <script src="../controlador/funciones-documento.js"></script>
    <?php
	include 'librerias-js.php';
	?>
    <script type="text/javascript">
        $(document).ready(function() {
        	rol_user = <?php echo $rol_user; ?>;
			if (rol_user == 1 || rol_user == 2) {
				$('#tablaDocumento').load('./vista_admin/vista_documento.php');
			}
			else if(rol_user == 3) {
				$('#tablaDocumento').load('./vista_operador/vista_documento.php');
			}
			else if(rol_user == 4) {
				$('#tablaDocumento').load('./vista_usuario/vista_documento.php');
			}
			 else {
				alert("Error...");
			}
			initDocumento();
			$('#actualizaDatosDocumento').click(function() {
				modificarDocumento();
			});
			$('#eliminarDatosDocumento').click(function() {
				preguntarSiNoDocumento();
			});
        });
    </script>
</body>

</html>