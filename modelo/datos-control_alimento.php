<?php

class misAlimentos
{
    // Retornar todo el control de alimentos
    function viewControlAlimentos()
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
                    ORDER BY fecha_control_aliment ASC";
        $modules = $conexion->prepare($consulta);
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
                     WHERE codigo = :codigo";
        $modules = $conexion->prepare($consulta);
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
    function countAlimentos()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $total = 0;
        $consulta = "SELECT count(codigo) as cant FROM control_alimento";
        $modules = $conexion->prepare($consulta);
        $modules->execute();
        $data = $modules->fetch(PDO::FETCH_ASSOC);
        $total = $data['cant'];
        return $total;
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
