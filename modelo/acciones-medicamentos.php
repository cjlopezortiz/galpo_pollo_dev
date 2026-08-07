<?php
date_default_timezone_set("America/Bogota");
require_once 'conexion.php';

$conexion = new Conexion();
session_start();
$usuario_codigo = $_SESSION['codigo'];
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    try {
        if ($accion == 'registrar') {
            // Captura de datos del formulario de creación
            $codigo_orions   = $_POST['codigo_orions'] ?? '';
            $fecha           = $_POST['fecha'] ?? date('Y-m-d');
            $nombre_producto = !empty($_POST['nombre_producto']) ? $_POST['nombre_producto'] : NULL;
            $causa           = !empty($_POST['causa']) ? $_POST['causa'] : NULL;
            $laboratorio     = !empty($_POST['laboratorio']) ? $_POST['laboratorio'] : NULL;
            $registro_ica    = !empty($_POST['registro_ica']) ? $_POST['registro_ica'] : NULL;
            $dosis           = !empty($_POST['dosis']) ? $_POST['dosis'] : NULL;
            $lote_producto   = !empty($_POST['lote_producto']) ? $_POST['lote_producto'] : NULL;
            $vencimiento     = !empty($_POST['vencimiento']) ? $_POST['vencimiento'] : NULL;
            $administracion  = !empty($_POST['administracion']) ? $_POST['administracion'] : NULL;
            $animales        = !empty($_POST['animales']) ? intval($_POST['animales']) : 0;
            $galpon_tratado  = !empty($_POST['galpon_tratado']) ? $_POST['galpon_tratado'] : NULL;

            $sql = "INSERT INTO medicamentos (
                        codigo_orions, 
                        fecha, 
                        nombre_producto, 
                        causa, 
                        laboratorio, 
                        registro_ica, 
                        dosis, 
                        lote_producto, 
                        vencimiento, 
                        administracion, 
                        animales, 
                        galpon_tratado,
                        usuario_codigo
                    ) VALUES (
                        :codigo_orions, 
                        :fecha, 
                        :nombre_producto, 
                        :causa, 
                        :laboratorio, 
                        :registro_ica, 
                        :dosis, 
                        :lote_producto, 
                        :vencimiento, 
                        :administracion, 
                        :animales, 
                        :galpon_tratado,
                        usuario_codigo
                    )";

            $reg = $conexion->prepare($sql);
            $reg->bindParam(':codigo_orions', $codigo_orions);
            $reg->bindParam(':fecha', $fecha);
            $reg->bindParam(':nombre_producto', $nombre_producto);
            $reg->bindParam(':causa', $causa);
            $reg->bindParam(':laboratorio', $laboratorio);
            $reg->bindParam(':registro_ica', $registro_ica);
            $reg->bindParam(':dosis', $dosis);
            $reg->bindParam(':lote_producto', $lote_producto);
            $reg->bindParam(':vencimiento', $vencimiento);
            $reg->bindParam(':administracion', $administracion);
            $reg->bindParam(':animales', $animales);
            $reg->bindParam(':galpon_tratado', $galpon_tratado);
            $reg->bindParam(':usuario_codigo', $usuario_codigo);

            if ($reg->execute()) {
                echo 1;
            } else {
                echo 0;
            }
        } else if ($accion == 'modificar') {
            // Captura de datos del formulario de edición (las variables traen el sufijo "u")
            $codigo          = $_POST['codigou'] ?? 0;
            $codigo_orions   = $_POST['codigo_orionsu'] ?? '';
            $fecha           = $_POST['fechau'] ?? date('Y-m-d');
            $nombre_producto = !empty($_POST['nombre_productou']) ? $_POST['nombre_productou'] : NULL;
            $causa           = !empty($_POST['causau']) ? $_POST['causau'] : NULL;
            $laboratorio     = !empty($_POST['laboratoriou']) ? $_POST['laboratoriou'] : NULL;
            $registro_ica    = !empty($_POST['registro_icau']) ? $_POST['registro_icau'] : NULL;
            $dosis           = !empty($_POST['dosisu']) ? $_POST['dosisu'] : NULL;
            $lote_producto   = !empty($_POST['lote_productou']) ? $_POST['lote_productou'] : NULL;
            $vencimiento     = !empty($_POST['vencimientou']) ? $_POST['vencimientou'] : NULL;
            $administracion  = !empty($_POST['administracionu']) ? $_POST['administracionu'] : NULL;
            $animales        = !empty($_POST['animalesu']) ? intval($_POST['animalesu']) : 0;
            $galpon_tratado  = !empty($_POST['galpon_tratadou']) ? $_POST['galpon_tratadou'] : NULL;

            $sql = "UPDATE registro_medicamentos SET 
                        codigo_orions = :codigo_orions,
                        fecha = :fecha,
                        nombre_producto = :nombre_producto,
                        causa = :causa,
                        laboratorio = :laboratorio,
                        registro_ica = :registro_ica,
                        dosis = :dosis,
                        lote_producto = :lote_producto,
                        vencimiento = :vencimiento,
                        administracion = :administracion,
                        animales = :animales,
                        galpon_tratado = :galpon_tratado
                    WHERE codigo = :codigo";

            $reg = $conexion->prepare($sql);
            $reg->bindParam(':codigo', $codigo);
            $reg->bindParam(':codigo_orions', $codigo_orions);
            $reg->bindParam(':fecha', $fecha);
            $reg->bindParam(':nombre_producto', $nombre_producto);
            $reg->bindParam(':causa', $causa);
            $reg->bindParam(':laboratorio', $laboratorio);
            $reg->bindParam(':registro_ica', $registro_ica);
            $reg->bindParam(':dosis', $dosis);
            $reg->bindParam(':lote_producto', $lote_producto);
            $reg->bindParam(':vencimiento', $vencimiento);
            $reg->bindParam(':administracion', $administracion);
            $reg->bindParam(':animales', $animales);
            $reg->bindParam(':galpon_tratado', $galpon_tratado);

            if ($reg->execute()) {
                echo 1;
            } else {
                echo 0;
            }
        } else if ($accion == 'eliminar') {
            $codigo = $_POST['codigo'] ?? 0;

            $sql = "DELETE FROM registro_medicamentos WHERE codigo = :codigo";
            $del = $conexion->prepare($sql);
            $del->bindParam(':codigo', $codigo);

            if ($del->execute()) {
                echo 1;
            } else {
                echo 0;
            }
        } else {
            echo 2; // Acción no válida
        }
    } catch (PDOException $e) {
        // En caso de error en la BD imprime 0 para que JavaScript lo detecte como error
        echo 0;
    }
} else {
    echo 3; // Parámetro 'accion' faltante
}