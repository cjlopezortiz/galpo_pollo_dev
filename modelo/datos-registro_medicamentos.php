<?php

class misMedicamentos
{
    // Retornar todo el registro de medicamentos
    function viewMedicamentos($usuario_codigo, $codigo_orions = null, $rol_id = null)
    {
        require_once 'conexion.php';

        $conexion = new Conexion();
        // ROL 1: puede ver todos los registros
        $consulta = "SELECT 
                        codigo,
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
                    FROM registro_medicamentos
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

    // Retornar todo el registro de medicamentos
    function viewMedicamento()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();
        $consulta = "SELECT codigo,
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
                            galpon_tratado 
                    FROM registro_medicamentos 
                    WHERE usuario_codigo = :usuario_codigo
                    WHERE codigo = :codigo";
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
    function countMedicamento($usuario_codigo = null, $rol_id = null)
    {
        require_once 'conexion.php';

        $conexion = new Conexion();

        if ($rol_id == 1) {

            // ROL 1: Administrador
            // Cuenta todos los galpones
            $consulta = "SELECT COUNT(codigo) AS cant
                     FROM registro_medicamentos";

            $modules = $conexion->prepare($consulta);
        } else {

            // ROL 2: Usuario
            // Cuenta solamente sus propios galpones
            $consulta = "SELECT COUNT(codigo) AS cant
                     FROM registro_medicamentos
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
    public function maxMedicamento()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $sqlcon = "SELECT max(codigo) as maximo FROM registro_medicamentos";
        $rescon = $conexion->prepare($sqlcon);
        $rescon->execute();
        $rowcon = $rescon->fetch(PDO::FETCH_ASSOC);
        $consecutivo = $rowcon['maximo'];
        $consecutivo++;
        return $consecutivo;
    }
}
