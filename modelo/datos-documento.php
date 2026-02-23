<?php

class misDocumentos
{
    
    function viewDocumento($id_tipo_documento)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();
        $consulta = "SELECT
                            id_tipo_documento,
                            nombre,
                            sigla
                            FROM tipo_documento
                            WHERE id_tipo_documento = :id_tipo_documento";
        $modules = $conexion->prepare($consulta);
        $modules->bindParam(":id_tipo_documento", $id_tipo_documento);
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

    function viewDocumentos()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();
        $consulta = "SELECT
                            id_tipo_documento,
                            nombre,
                            sigla
                            FROM tipo_documento
                            ORDER BY id_tipo_documento ASC";
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

    function countDocumento()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $consulta = "SELECT count(id_tipo_documento) as cant
                     FROM tipo_documento";
        $modules = $conexion->prepare($consulta);
        $modules->execute();
        $data = $modules->fetch(PDO::FETCH_ASSOC);
        $total = 0;
        $total = $data['cant'];
        return $total;
    }

}
