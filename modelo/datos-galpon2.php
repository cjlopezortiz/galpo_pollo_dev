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
                            precio_preinicio,
                            edad,
                            salidas,
                            peso_salidas,
                            mortanda_dia
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
                            precio_preinicio,
                            edad,
                            salidas,
                            peso_salidas,
                            mortanda_dia
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

    function viewGalpones2($codigo_orions = null, $usuario_codigo = null, $rol_id = null)
    {
        require_once 'conexion.php';

        $conexion = new Conexion();

        // ==========================================
        // ROL 1: ADMINISTRADOR
        // Puede ver todos los registros
        // ==========================================
        if ($rol_id == 1) {

            if ($codigo_orions !== null) {

                // Administrador filtra solamente por codigo_orions
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
                            precio_preinicio,
                            edad,
                            salidas,
                            peso_salidas,
                            mortanda_dia,
                            usuario_codigo
                        FROM galpon_2
                        WHERE codigo_orions = :codigo_orions
                        ORDER BY codigo ASC";

                $modules = $conexion->prepare($consulta);

                $modules->bindParam(
                    ':codigo_orions',
                    $codigo_orions
                );
            } else {

                // Administrador ve todos los galpones
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
                            precio_preinicio,
                            edad,
                            salidas,
                            peso_salidas,
                            mortanda_dia,
                            usuario_codigo
                        FROM galpon_2
                        ORDER BY codigo ASC";

                $modules = $conexion->prepare($consulta);
            }
        } else {

            // ==========================================
            // ROL 2: USUARIO
            // Solo puede ver sus propios registros
            // ==========================================

            if ($codigo_orions !== null) {

                // Filtrar por codigo_orions + usuario
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
                            precio_preinicio,
                            edad,
                            salidas,
                            peso_salidas,
                            mortanda_dia,
                            usuario_codigo
                        FROM galpon_2
                        WHERE codigo_orions = :codigo_orions
                        AND usuario_codigo = :usuario_codigo
                        ORDER BY codigo ASC";

                $modules = $conexion->prepare($consulta);

                $modules->bindParam(
                    ':codigo_orions',
                    $codigo_orions
                );

                $modules->bindParam(
                    ':usuario_codigo',
                    $usuario_codigo,
                    PDO::PARAM_INT
                );
            } else {

                // Solo los galpones del usuario
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
                            precio_preinicio,
                            edad,
                            salidas,
                            peso_salidas,
                            mortanda_dia,
                            usuario_codigo
                        FROM galpon_2
                        WHERE usuario_codigo = :usuario_codigo
                        ORDER BY codigo ASC";

                $modules = $conexion->prepare($consulta);

                $modules->bindParam(
                    ':usuario_codigo',
                    $usuario_codigo,
                    PDO::PARAM_INT
                );
            }
        }

        $modules->execute();

        return $modules->fetchAll(PDO::FETCH_ASSOC);
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

    // function countGalpon2()
    // {
    //     require_once 'conexion.php';
    //     $conexion = new Conexion();
    //     $consulta = "SELECT count(codigo_orions) as cant
    //                  FROM galpon_2";
    //     $modules = $conexion->prepare($consulta);

    //     $modules->execute();
    //     $data = $modules->fetch(PDO::FETCH_ASSOC);
    //     $total = 0;
    //     $total = $data['cant'];
    //     return $total;
    // }
    function countGalpon2($usuario_codigo = null, $rol_id = null)
    {
        require_once 'conexion.php';

        $conexion = new Conexion();

        if ($rol_id == 1) {

            // ROL 1: Administrador
            // Cuenta todos los galpones
            $consulta = "SELECT COUNT(codigo) AS cant
                     FROM galpon_2";

            $modules = $conexion->prepare($consulta);
        } else {

            // ROL 2: Usuario
            // Cuenta solamente sus propios galpones
            $consulta = "SELECT COUNT(codigo) AS cant
                     FROM galpon_2
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
