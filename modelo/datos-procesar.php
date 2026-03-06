<?php
class misProcesos
{
    // Esta es la función que ya tienes para mostrar los datos
    function viewProcesos($codigo = null)
    {
        if (!$codigo) return [];

        require_once 'conexion.php';
        $conexion = new Conexion();

        $consulta = "
        SELECT 
            codigo,
            codigo_orions,
            fila,
            precio_pollo,
            bruto,
            canastas,
            (bruto - canastas) AS neto_calculado,
            total_general
        FROM peso_neto_detalle
        WHERE codigo_orions = :codigo";

        $modules = $conexion->prepare($consulta);
        $modules->execute([':codigo' => $codigo]);
        $resultados = $modules->fetchAll(PDO::FETCH_ASSOC);

        $datosOrdenados = [];
        foreach ($resultados as $r) {
            $datosOrdenados[$r['fila']] = $r;
        }

        return $datosOrdenados;
    }

   public function totalNetoPorCodigo($codigo) 
{
    require_once 'conexion.php';
    $conexion = new Conexion();

    $sql = "
        SELECT 
            IFNULL(precio_pollo, 0) as precio_pollo, 
            IFNULL(SUM(bruto - canastas), 0) as total_neto
        FROM peso_neto_detalle
        WHERE codigo_orions = :codigo
        LIMIT 1
    ";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([':codigo' => $codigo]);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado ? $resultado : ['precio_pollo' => 0, 'total_neto' => 0];
}

    // AQUÍ DEBES PEGAR EL NUEVO CÓDIGO
    public function registrarOActualizar($datos)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();

        // Usamos ON DUPLICATE KEY UPDATE para que identifique la pareja (codigo_orions + fila)
        $db = $conexion->prepare("
        INSERT INTO peso_neto_detalle 
            (codigo_orions, fila, bruto, precio_pollo, canastas, total_general, fecha) 
        VALUES 
            (:orions, :fila, :bruto, :precio_pollo, :canastas, :total, CURRENT_TIMESTAMP)
        ON DUPLICATE KEY UPDATE 
            precio_pollo = :precio_pollo, 
            bruto = :bruto, 
            canastas = :canastas, 
            total_general = :total,
            fecha = CURRENT_TIMESTAMP
    ");

        return $db->execute([
            ':orions'   => $datos['codigo_orions'],
            ':fila'     => $datos['fila'], // Crucial para no sobrescribir la fila 1
            ':precio_pollo'     => $datos['precio_pollo'],
            ':bruto'    => $datos['bruto'],
            ':canastas' => $datos['canastas'],
            ':total'    => $datos['total_general']
        ]);
    }
}
