<?php
//session_start();
require_once 'conexion.php';
$conexion = new Conexion();

if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
    $loginNombre = $_POST["usuario"];
    $loginPassword = $_POST["contrasena"];
    $sql = "SELECT * FROM usuario WHERE usuario=:usuario AND contrasena=:contrasena";
    $modules = $conexion->prepare($sql);
    $modules->bindParam(":usuario", $loginNombre);
    $modules->bindParam(":contrasena", $loginPassword);
    $modules->execute();
    $total = $modules->rowCount();
    if ($total > 0) {
        $row = $modules->fetch(PDO::FETCH_ASSOC);
        if (($row['usuario'] == $loginNombre) && ($row['contrasena']== $loginPassword) && ($row['estado'] == 1) || ($row['estado_reporte_id'] == 1) && ($row['estado_reporte_id'] == 2) && ($row['estado_reporte_id'] == 3) && ($row['estado_reporte_id'] == 4)) {
            session_start();
            $_SESSION['codigo'] = $row['codigo'];
            $_SESSION['contrasena'] = $row['contrasena'];
            $_SESSION['tipo_documento'] = $row['tipo_documento'];
            $_SESSION['numero_documento'] = $row['numero_documento'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['telefono'] = $row['telefono'];
            $_SESSION['ciudad'] = $row['ciudad'];
            $_SESSION['regional_cod'] = $row['regional_cod'];
            $_SESSION['centro_formacion_cod'] = $row['centro_formacion_cod'];
            $_SESSION['direccion_sede'] = $row['direccion_sede'];
            $_SESSION['cargo'] = $row['cargo'];
            $_SESSION['area'] = $row['area'];
            $_SESSION['rol_id'] = $row['rol_id'];
            $_SESSION['estado'] = $row['estado'];
            $_SESSION['estado_reporte_id'] = $row['estado_reporte_id'];
            header("Location: ../administrador/index.php");
        } else {
            //session_destroy();
            echo '<script language = javascript>
            alert("Por favor verifique la información registrada 1.");
            self.location = "../index.php" 
            </script>';
        }
    } else {
        //session_destroy();
        echo '<script language = javascript>
        alert("Por favor verifique la información registrada 2.");
        self.location = "../index.php"
        </script>';
    }
} else {
    //session_destroy();
    echo '<script language = javascript>
	alert("Por favor verifique la información registrada 3.");
	self.location = "../index.php"
	</script>';
}
