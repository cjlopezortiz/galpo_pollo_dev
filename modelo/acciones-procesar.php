<?php
require_once 'conexion.php';
$conexion = new Conexion();
$accion = $_GET['accion'];

if ($accion == 'modificar') {
    // Recibimos todos los datos necesarios para identificar la celda exacta
    $codigo_id = $_POST['codigo']; // ID autoincremental (si existe)
    $codigo_orions = $_POST['codigo_orions']; // El código de cosecha (ej: 60411123)
    $fila = $_POST['fila']; // El número de fila (1 al 100)
    $precio_pollo = $_POST['precio_pollo']; // El número de fila (1 al 100)
    $bruto = $_POST['bruto'];
    $canastas = $_POST['canastas'];
    $total = $_POST['total_general'];

    // 1. Verificamos si ya existe esta combinación de Cosecha + Fila
    $check = $conexion->prepare("SELECT codigo FROM peso_neto_detalle WHERE codigo_orions = :corions AND fila = :f");
    $check->execute([":corions" => $codigo_orions, ":f" => $fila]);
    $registro_existente = $check->fetch(PDO::FETCH_ASSOC);

    if ($registro_existente) {
        // SI EXISTE: Actualizamos esa fila específica
        $sql = "UPDATE peso_neto_detalle SET bruto=:b, canastas=:c, total_general=:t, precio_pollo=:p, fecha=CURRENT_TIMESTAMP 
                WHERE codigo_orions=:corions AND fila=:f";
        $reg = $conexion->prepare($sql);
        $res = $reg->execute([
            ":b" => $bruto,
            ":c" => $canastas,
            ":t" => $total,
            ":p" => $precio_pollo,
            ":corions" => $codigo_orions,
            ":f" => $fila
        ]);
    } else {
        // NO EXISTE: Insertamos nuevo registro vinculándolo al código y a su fila
        $sql = "INSERT INTO peso_neto_detalle 
            (codigo_orions, fila, bruto, canastas, total_general, precio_pollo, fecha) 
            VALUES (:corions, :f, :b, :c, :t, :p, CURRENT_TIMESTAMP)";
        $reg = $conexion->prepare($sql);
        $res = $reg->execute([
            ":corions" => $codigo_orions,
            ":f" => $fila,
            ":b" => $bruto,
            ":c" => $canastas,
            ":t" => $total,
            ":p" => $precio_pollo
        ]);
    }
    echo $res ? 1 : 0;
} else if ($accion == 'eliminar') {
    // Eliminamos por ID único
    $sql = "DELETE FROM peso_neto_detalle WHERE codigo=:id";
    $del = $conexion->prepare($sql);
    $res = $del->execute([":id" => $_POST['codigo']]);
    echo $res ? 1 : 0;
}
