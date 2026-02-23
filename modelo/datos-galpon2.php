<?php

class misGalpon2
{
    function viewMaterialAlmacen($codigo)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();
        $consulta = "SELECT
                              codigo,
                            codigo_orions,
                            cantidad_pollo,
                            precio_pollo,
                            color,
                            fayido,
                            tipo_alimento,
                            cantidad,
                            precio_alimento,
                            fecha_inicio,
                            fecha_fin,
                            descripcion,
                            alimento_inicio,
                            precio_inicio,
                            alimento_preinicio,
                            precio_preinicio
                            FROM galpon_2
                            WHERE codigo = :codigo";
        $modules = $conexion->prepare($consulta);
        $modules->bindParam(":codigo", $codigo);
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
    //
    function viewGalpon2($codigo)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();
        $consulta = "SELECT
                             codigo,
                            codigo_orions,
                            cantidad_pollo,
                            precio_pollo,
                            color,
                            fayido,
                            tipo_alimento,
                            cantidad,
                            precio_alimento,
                            fecha_inicio,
                            fecha_fin,
                            descripcion,
                            alimento_inicio,
                            precio_inicio,
                            alimento_preinicio,
                            precio_preinicio
                            FROM galpon_2
                            WHERE codigo = :codigo";
        $modules = $conexion->prepare($consulta);
        $modules->bindParam(":codigo", $codigo);
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

    function viewGalpones2($codigo_orions = null)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();

        if ($codigo_orions != null) {
            $consulta = "SELECT
                            codigo,
                            codigo_orions,
                            cantidad_pollo,
                            precio_pollo,
                            color,
                            fayido,
                            tipo_alimento,
                            cantidad,
                            precio_alimento,
                            fecha_inicio,
                            fecha_fin,
                            descripcion,
                            alimento_inicio,
                            precio_inicio,
                            alimento_preinicio,
                            precio_preinicio
                     FROM galpon_2
                     WHERE codigo_orions = :codigo_orions
                     ORDER BY codigo ASC";

            $modules = $conexion->prepare($consulta);
            $modules->bindParam(':codigo_orions', $codigo_orions);
        } else {
            $consulta = "SELECT * FROM galpon_2 ORDER BY codigo ASC";
            $modules = $conexion->prepare($consulta);
        }

        $modules->execute();
        $arreglo = $modules->fetchAll(PDO::FETCH_ASSOC);

        return $arreglo;
    }


    //Cantidad 
    function countAlmacenMateriales($codigo_orions)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $consulta = "SELECT count(codigo_orions) as cant
                            FROM galpon_2
                            WHERE codigo_orions = :codigo_orions";
        $modules = $conexion->prepare($consulta);
        $modules->bindParam(":codigo_orions", $codigo_orions);
        $modules->execute();
        $data = $modules->fetch(PDO::FETCH_ASSOC);
        $total = 0;
        $total = $data['cant'];
        return $total;
    }

    function countGalpon2()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $consulta = "SELECT count(codigo_orions) as cant
                     FROM galpon_2";
        $modules = $conexion->prepare($consulta);
        $modules->execute();
        $data = $modules->fetch(PDO::FETCH_ASSOC);
        $total = 0;
        $total = $data['cant'];
        return $total;
    }
    function countGalponir2()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $consulta = "SELECT count(codigo_orions) as cant
                     FROM galpon_2";
        $modules = $conexion->prepare($consulta);
        $modules->execute();
        $data = $modules->fetch(PDO::FETCH_ASSOC);
        $total = 0;
        $total = $data['cant'];
        return $total;
    }
    // Máximo código de 
    public function maxGalpon2()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $sqlcon = "SELECT max(codigo) as maximo FROM galpon_2";
        $rescon = $conexion->prepare($sqlcon);
        $rescon->execute();
        $rowcon = $rescon->fetch(PDO::FETCH_ASSOC);
        $consecutivo = $rowcon['maximo'];
        $consecutivo++;
        return $consecutivo;
    }
}
