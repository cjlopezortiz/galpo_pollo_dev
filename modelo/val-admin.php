<?php
session_start();
require_once 'datos-usuarios.php';
// include_once 'modelo/datos-reporte.php';
$mis_usuarios = new misUsuarios();
// $mis_reporte = new misReportes();
if ($_SESSION) {
    $user_numero_doc = $_SESSION['numero_documento'];
    $user_nombre = $_SESSION['nombre'];
    $user_email = $_SESSION['email'];
    $rol_user = $_SESSION['rol_id'];
    $estado_user = $_SESSION['estado'];
    // $estado_reporte_id_user = $_SESSION['estado_reporte_id'];
    $user_codigo = $_SESSION['codigo'];
    $user_usuario = $_SESSION['usuario'];
    $user_contrasena = $_SESSION['contrasena'];
    /** Información del usuario */
    $mi_usuarios = $mis_usuarios->viewUsuario($user_codigo);
    if (count($mi_usuarios) > 0) {
        /** Valida si el usuario de la sesión corresponde **/
        if ($user_numero_doc != $mi_usuarios[0]['numero_documento']) {
            session_destroy();
            echo '<script language = javascript>
         alert("Por favor revisar la información del usuario 1.")
         self.location = "../index.php"
         </script>';
        }
    } else {
        echo '<script language = javascript>
     alert("Por favor revisar la información del usuario 2.")
     self.location = "../index.php"
     </script>';
    }
} else {
    $user_numero_doc = "";
    $user_codigo = "";
    $user_nombre = "";
    $user_usuario = "";
    $user_contrasena = "";
    $user_email = "";
    $rol_user = "";
    $estado_user = "";
    $estado_reporte_id_user = "";
    echo '<script language = javascript>
 alert("Por favor revisar la información del usuario 3.")
 self.location = "../index.php"
 </script>';
}
