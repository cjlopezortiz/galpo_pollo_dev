<?php
date_default_timezone_set("America/Bogota");
require_once 'conexion.php';
require_once 'datos-usuarios.php';
$conexion = new Conexion();
$mis_usuarios = new misUsuarios();
if (isset($_GET['accion'])) {
	$accion = $_GET['accion'];
	if ($accion == 'registrar') {
		$maxUsuarios = $mis_usuarios->maxUsuarios();
		$codigo = $maxUsuarios;
		$tipo_documento = $_POST['tipo_documento'];
		$numero_documento = $_POST['numero_documento'];
		$nombre = $_POST['nombre'];
		$usuario = $_POST['usuario'];
		$contrasena = $_POST['contrasena'];
		$email = $_POST['email'];
		$telefono = $_POST['telefono'];
		$estado = $_POST['estado'];
		$rol_id = $_POST['rol_id'];
		$sql = "INSERT INTO usuario (codigo, tipo_documento, numero_documento, nombre, usuario, contrasena, email, telefono, estado, rol_id) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$reg = $conexion->prepare($sql);
		$reg->bindParam(1, $maxUsuarios);
		$reg->bindParam(2, $tipo_documento);
		$reg->bindParam(3, $numero_documento);
		$reg->bindParam(4, $nombre);
		$reg->bindParam(5, $usuario);
		$reg->bindParam(6, $contrasena);
		$reg->bindParam(7, $email);
		$reg->bindParam(8, $telefono);
		$reg->bindParam(9, $estado);
		$reg->bindParam(10, $rol_id);
		if ($reg->execute() == TRUE) {
			echo 1;
		} else {
			echo 0;
		}
    
	} else if ($accion == 'modificar') {
				$codigo = $_POST['codigo'];
				$tipo_documento = $_POST['tipo_documento'];
				$numero_documento = $_POST['numero_documento'];
				$nombre = $_POST['nombre'];
				$usuario = $_POST['usuario'];
				$contrasena = $_POST['contrasena'];
				$email = $_POST['email'];
				$telefono = $_POST['telefono'];
				$estado = $_POST['estado'];
				$rol_id = $_POST['rol_id'];

		$sql = "UPDATE usuario SET 
					   tipo_documento=:tipo_documento,
					   numero_documento=:numero_documento,
					   nombre=:nombre,
					   usuario=:usuario,
					   contrasena=:contrasena,
					   email=:email,
					   telefono=:telefono,
					   estado=:estado,
					   rol_id=:rol_id
				WHERE codigo = :codigo;";

		$reg = $conexion->prepare($sql);
		$reg->bindParam(":codigo", $codigo);
		$reg->bindParam(":tipo_documento", $tipo_documento);
		$reg->bindParam(":numero_documento", $numero_documento);
		$reg->bindParam(":nombre", $nombre);
		$reg->bindParam(":usuario", $usuario);
		$reg->bindParam(":contrasena", $contrasena);
		$reg->bindParam(":email", $email);
		$reg->bindParam(":telefono", $telefono);
		$reg->bindParam(":estado", $estado);
		$reg->bindParam(":rol_id", $rol_id);
		if ($reg->execute() == TRUE) {
			echo 1;
		} else {
			echo 0;
		}
	} else if ($accion == 'eliminar') {
		$codigo = $_POST['codigo'];
		$sql = "DELETE FROM usuario WHERE codigo = :codigo;";
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