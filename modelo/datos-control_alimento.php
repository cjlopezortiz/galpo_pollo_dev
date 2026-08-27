<?php

class misAlimentos
{
    // Retornar todo el control de alimentos
    // Retornar control de alimentos según el rol
    // Retornar control de alimentos según el rol y código_orions
    function viewControlAlimentos($usuario_codigo, $codigo_orions = null, $rol_id = null)
    {
        require_once 'conexion.php';

        $conexion = new Conexion();

        // Consulta base
        $consulta = "SELECT
                    codigo,
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
                    observaciones,
                    usuario_codigo
                FROM control_alimento
                WHERE 1=1";

        // Si NO es administrador, filtra por usuario
        if ($rol_id != 1) {
            $consulta .= " AND usuario_codigo = :usuario_codigo";
        }

        // Si viene codigo_orions, filtra por él
        if (!empty($codigo_orions)) {
            $consulta .= " AND codigo_orions = :codigo_orions";
        }

        $consulta .= " ORDER BY codigo ASC";

        $modules = $conexion->prepare($consulta);

        // Bind usuario para rol diferente de administrador
        if ($rol_id != 1) {
            $modules->bindParam(
                ':usuario_codigo',
                $usuario_codigo,
                PDO::PARAM_INT
            );
        }

        // Bind codigo_orions si existe
        if (!empty($codigo_orions)) {
            $modules->bindParam(
                ':codigo_orions',
                $codigo_orions,
                PDO::PARAM_STR
            );
        }

        $modules->execute();

        return $modules->fetchAll(PDO::FETCH_ASSOC);
    }
    function viewControlAlimento()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();
        $consulta = "SELECT codigo,
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
                    FROM control_alimento
                      WHERE usuario_codigo = :usuario_codigo
                     ORDER BY codigo ASC";
        $modules = $conexion->prepare($consulta);
        $modules->bindParam(':usuario_codigo', $usuario_codigo);
        $modules->bindParam(':codigo_orions', $codigo_orions);
        $modules->execute();
        $total = $modules->rowCount();
        if ($total > 0) {
            $i = 0;
            while ($data = $modules->fetch(PDO::FETCH_ASSOC)) {
                $arreglo[$i] = $data;
                $i++;
            }
        }
        return $arreglo;
    }

    // Contar el total de registros de control de alimentos

    function countAlimentos($usuario_codigo = null, $rol_id = null)
    {
        require_once 'conexion.php';

        $conexion = new Conexion();

        if ($rol_id == 1) {

            // ROL 1: Administrador
            // Cuenta todos los galpones
            $consulta = "SELECT COUNT(codigo) AS cant
                     FROM control_alimento";

            $modules = $conexion->prepare($consulta);
        } else {

            // ROL 2: Usuario
            // Cuenta solamente sus propios galpones
            $consulta = "SELECT COUNT(codigo) AS cant
                     FROM control_alimento
                     WHERE usuario_codigo = :usuario_codigo";

            $modules = $conexion->prepare($consulta);

            $modules->bindParam(
                ':usuario_codigo',
                $usuario_codigo,
                PDO::PARAM_INT
            );
        }

        $modules->execute();

        $data = $modules->fetch(PDO::FETCH_ASSOC);

        return $data['cant'];
    }

    // Máximo ID consecutivo de la tabla
    public function maxAlimentos()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $sqlcon = "SELECT max(codigo) as maximo FROM control_alimento";
        $rescon = $conexion->prepare($sqlcon);
        $rescon->execute();
        $rowcon = $rescon->fetch(PDO::FETCH_ASSOC);
        $consecutivo = $rowcon['maximo'];
        $consecutivo++;
        return $consecutivo;
    }
}
