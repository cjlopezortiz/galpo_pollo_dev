<?php
date_default_timezone_set("America/Bogota");
require_once 'conexion.php';

$conexion = new Conexion();

if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    try {
        if ($accion == 'registrar') {
            // Captura de datos del formulario de creación
            $codigo_orions          = $_POST['codigo_orions'] ?? '';
            $fecha_control_aliment  = $_POST['fecha_control_aliment'] ?? date('Y-m-d');
            $entradas               = !empty($_POST['entradas']) ? $_POST['entradas'] : 0.00;
            $salidas                = !empty($_POST['salidas']) ? $_POST['salidas'] : 0.00;
            $consumo_tabla          = !empty($_POST['consumo_tabla']) ? $_POST['consumo_tabla'] : 0.00;
            $consumo_real           = !empty($_POST['consumo_real']) ? $_POST['consumo_real'] : 0.00;
            $acumulado_tabla        = !empty($_POST['acumulado_tabla']) ? $_POST['acumulado_tabla'] : 0.00;
            $acumulado_real         = !empty($_POST['acumulado_real']) ? $_POST['acumulado_real'] : 0.00;
            $saldo_real             = !empty($_POST['saldo_real']) ? $_POST['saldo_real'] : 0.00;
            $programacion           = !empty($_POST['programacion']) ? $_POST['programacion'] : 0.00;
            $observaciones          = !empty($_POST['observaciones']) ? $_POST['observaciones'] : NULL;

            $sql = "INSERT INTO control_alimento (
                        codigo_orions, 
                        fecha_control_aliment, 
                        entradas, 
                        salidas, 
                        consumo_tabla, 
                        consumo_real, 
                        acumulado_tabla, 
                        acumulado_real, 
                        saldo_real, 
                        programacion, 
                        observaciones
                    ) VALUES (
                        :codigo_orions, 
                        :fecha_control_aliment, 
                        :entradas, 
                        :salidas, 
                        :consumo_tabla, 
                        :consumo_real, 
                        :acumulado_tabla, 
                        :acumulado_real, 
                        :saldo_real, 
                        :programacion, 
                        :observaciones
                    )";

            $reg = $conexion->prepare($sql);
            $reg->bindParam(':codigo_orions', $codigo_orions);
            $reg->bindParam(':fecha_control_aliment', $fecha_control_aliment);
            $reg->bindParam(':entradas', $entradas);
            $reg->bindParam(':salidas', $salidas);
            $reg->bindParam(':consumo_tabla', $consumo_tabla);
            $reg->bindParam(':consumo_real', $consumo_real);
            $reg->bindParam(':acumulado_tabla', $acumulado_tabla);
            $reg->bindParam(':acumulado_real', $acumulado_real);
            $reg->bindParam(':saldo_real', $saldo_real);
            $reg->bindParam(':programacion', $programacion);
            $reg->bindParam(':observaciones', $observaciones);

            if ($reg->execute()) {
                echo 1;
            } else {
                echo 0;
            }
        } else if ($accion == 'modificar') {
            // Captura de datos del formulario de edición (las variables traen el sufijo "u")
            $codigo                 = $_POST['codigou'] ?? 0;
            $codigo_orions          = $_POST['codigo_orionsu'] ?? '';
            $fecha_control_aliment  = $_POST['fecha_control_alimentu'] ?? date('Y-m-d');
            $entradas               = !empty($_POST['entradasu']) ? $_POST['entradasu'] : 0.00;
            $salidas                = !empty($_POST['salidasu']) ? $_POST['salidasu'] : 0.00;
            $consumo_tabla          = !empty($_POST['consumo_tablau']) ? $_POST['consumo_tablau'] : 0.00;
            $consumo_real           = !empty($_POST['consumo_realu']) ? $_POST['consumo_realu'] : 0.00;
            $acumulado_tabla        = !empty($_POST['acumulado_tablau']) ? $_POST['acumulado_tablau'] : 0.00;
            $acumulado_real         = !empty($_POST['acumulado_realu']) ? $_POST['acumulado_realu'] : 0.00;
            $saldo_real             = !empty($_POST['saldo_realu']) ? $_POST['saldo_realu'] : 0.00;
            $programacion           = !empty($_POST['programacionu']) ? $_POST['programacionu'] : 0.00;
            $observaciones          = !empty($_POST['observacionesu']) ? $_POST['observacionesu'] : NULL;

            $sql = "UPDATE control_alimento SET 
                        codigo_orions = :codigo_orions,
                        fecha_control_aliment = :fecha_control_aliment,
                        entradas = :entradas,
                        salidas = :salidas,
                        consumo_tabla = :consumo_tabla,
                        consumo_real = :consumo_real,
                        acumulado_tabla = :acumulado_tabla,
                        acumulado_real = :acumulado_real,
                        saldo_real = :saldo_real,
                        programacion = :programacion,
                        observaciones = :observaciones
                    WHERE codigo = :codigo";

            $reg = $conexion->prepare($sql);
            $reg->bindParam(':codigo', $codigo);
            $reg->bindParam(':codigo_orions', $codigo_orions);
            $reg->bindParam(':fecha_control_aliment', $fecha_control_aliment);
            $reg->bindParam(':entradas', $entradas);
            $reg->bindParam(':salidas', $salidas);
            $reg->bindParam(':consumo_tabla', $consumo_tabla);
            $reg->bindParam(':consumo_real', $consumo_real);
            $reg->bindParam(':acumulado_tabla', $acumulado_tabla);
            $reg->bindParam(':acumulado_real', $acumulado_real);
            $reg->bindParam(':saldo_real', $saldo_real);
            $reg->bindParam(':programacion', $programacion);
            $reg->bindParam(':observaciones', $observaciones);

            if ($reg->execute()) {
                echo 1;
            } else {
                echo 0;
            }
        } else if ($accion == 'eliminar') {
            $codigo = $_POST['codigo'] ?? 0;

            $sql = "DELETE FROM control_alimento WHERE codigo = :codigo";
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
