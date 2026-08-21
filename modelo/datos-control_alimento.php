<?php

class misAlimentos
{
    // Retornar todo el control de alimentos
    // Retornar control de alimentos según el rol
    function viewControlAlimentos($usuario_codigo, $rol_id)
    {
        require_once 'conexion.php';

        $conexion = new Conexion();

        if ($rol_id == 1) {

            // ADMINISTRADOR: puede ver todos los registros
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
                    ORDER BY codigo ASC";

            $modules = $conexion->prepare($consulta);
        } else {

            // ROL 2: solamente puede ver sus propios registros
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
                    WHERE usuario_codigo = :usuario_codigo
                    ORDER BY codigo ASC";

            $modules = $conexion->prepare($consulta);

            $modules->bindParam(
                ':usuario_codigo',
                $usuario_codigo,
                PDO::PARAM_INT
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
