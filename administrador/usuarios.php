<?php
require_once '../modelo/val-admin.php';
?>
<?php

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Usuarios</title>
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
		<div id="tablaUsuarios"></div>
	</div>

	<!-- FIN DEL CONTENIDO -->
	<?php
	include './modales/modalUsuario.php';
	?>
	<script src="../controlador/funciones-usuarios.js"></script>
	<?php
	include 'librerias-js.php';
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			rol_user = <?php echo $rol_user ?>;
			if (rol_user == 1 || rol_user == 2) {
				$('#tablaUsuarios').load('./vista_admin/vista_usuario.php');
			} else {
				alert("Error...");
			}
			// $('#agregarNuevoUsuario').click(function () {
			// 	agregardatosUsuario();
			// });
			initUsuario();
			$('#actualizaDatosUsuario').click(function() {
				modificarUsuario();
			});

			$('#eliminarDatosUsuario').click(function() {
				preguntarSiNoUsuario();
			});
		});
	</script>
</body>

</html>