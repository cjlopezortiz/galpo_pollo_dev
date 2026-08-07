<?php

class misMedicamentos
{
    // Retornar todo el registro de medicamentos
    function viewMedicamentos($usuario_codigo)
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
                    ORDER BY fecha DESC";
        $modules = $conexion->prepare($consulta);
        $modules->bindParam(':usuario_codigo', $usuario_codigo);
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
    function countMedicamento()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $total = 0;
        $consulta = "SELECT count(codigo) as cant FROM registro_medicamentos";
        $modules = $conexion->prepare($consulta);
        $modules->execute();
        $data = $modules->fetch(PDO::FETCH_ASSOC);
        $total = $data['cant'];
        return $total;
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
