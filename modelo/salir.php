<?php
session_start();
if ($_SESSION['nombre']) {
    session_unset();
    session_destroy();
    echo '<script language = javascript>
    alert ("Su sesión ha terminado correctamente.")
    self.location = "../index.php"
    </script>';
} else {
    echo '<script language = javascript> 
    self.location = "../index.php"
    </script>';
}