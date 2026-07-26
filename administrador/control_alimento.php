<?php
require_once '../modelo/val-admin.php';
require_once '../modelo/datos-usuarios.php';
$mis_usuarios = new misUsuarios();
$res = $mis_usuarios->viewUsuarios();
if (is_array($res)) {
    // Si es un arreglo con la clave rol_id
    if (isset($res['rol_id'])) {
        $rol_id = $res['rol_id'];
    }
    // Si es un arreglo de registros
    elseif (isset($res[0]['rol_id'])) {
        $rol_id = $res[0]['rol_id'];
    }
    else {
        $rol_id = null;
    }
   // var_dump($rol_id);
} elseif ($res instanceof mysqli_result) {
    $fila = mysqli_fetch_assoc($res);
    if ($fila && isset($fila['rol_id'])) {
        $rol_id = $fila['rol_id'];
       // var_dump($rol_id);
    } else {
        echo "No se encontró el campo rol_id";
    }
} else {
    echo "viewUsuarios() no está retornando datos válidos.";
}
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
	<title>CONTROL DE ALIMENTO</title>
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
		<div id="tablaControlAlimento"></div>
	</div>

	<!-- FIN DEL CONTENIDO -->
	<?php
	include './modales/modalControlAlimento.php';
	?>
	<script src="../controlador/funciones-control-alimento.js"></script>
	<?php
	include 'librerias-js.php';
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			rol_user = <?php echo $rol_id ?>;
			if (rol_user == 1 || rol_user == 2) {
				$('#tablaControlAlimento').load('./vista_admin/vista_control_alimento.php');
			} else {
				alert("Error...");
			}
			// $('#agregarNuevoUsuario').click(function () {
			// 	agregardatosUsuario();
			// });
			//initControlAlimento();
			$('#actualizaDatosControlAlimento').click(function() {
				modificarControlAlimento();
			});

			$('#eliminarDatosControlAlimento').click(function() {
				preguntarSiNoControlAlimento();
			});
		});
	</script>
</body>

</html>