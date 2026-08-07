<?php

class misUsuarios
{
    // Retornar un solo usuario por su código de sesión
    function viewUsuarioSesion($codigo)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();
        $consulta = "SELECT codigo,
                            tipo_documento,
                            numero_documento,
                            nombre,
                            usuario,
                            contrasena,
                            email,
                            telefono,
                            estado,
                            rol_id
                    FROM usuario
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

    // Retornar un usuario
    function viewUsuarios()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();
        $consulta = "SELECT codigo,
                            tipo_documento,
                            numero_documento,
                            nombre,
                            usuario,
                            contrasena,
                            email,
                            telefono,
                            estado,
                            rol_id
                    FROM usuario
                    ORDER BY codigo ASC";
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

    function viewUsuariosDocumento($numero_documento)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();
        $consulta = "SELECT codigo,
                            tipo_documento,
                            numero_documento,
                            nombre,
                            usuario,
                            contrasena,
                            email,
                            telefono,
                            estado,
                            rol_id
                    FROM usuario
                    WHERE numero_documento = :numero_documento";
        $modules = $conexion->prepare($consulta);
        $modules->bindParam(":numero_documento", $numero_documento);
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

    // Retornar usuario específico
    function viewUsuario($codigo)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();
        $consulta = "SELECT codigo,
                            tipo_documento,
                            numero_documento,
                            nombre,
                            usuario,
                            contrasena,
                            email,
                            telefono,
                            estado,
                            rol_id
                    FROM usuario
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

    // Retornar todos por operador
    function viewUsuarioOperador($rol_user)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();
        $consulta = "SELECT codigo,
                            tipo_documento,
                            numero_documento,
                            nombre,
                            usuario,
                            contrasena,
                            email,
                            telefono,
                            estado,
                            rol_id
                      FROM usuario
                      WHERE rol_id = :rol_user";
        $modules = $conexion->prepare($consulta);
        $modules->bindParam(":rol_user", $rol_user);
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

    // Retornar usuarios por rol
    function viewUsuariosRol($rol)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();
        $consulta = "SELECT codigo,
                            tipo_documento,
                            numero_documento,
                            nombre,
                            usuario,
                            contrasena,
                            email,
                            telefono,
                            estado,
                            rol_id
                    FROM usuario
                    WHERE rol = :rol
                    ORDER BY nombre ASC";
        $modules = $conexion->prepare($consulta);
        $modules->bindParam(":rol", $rol);
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

    function countUsuarios($codigo)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $total = 0;
        $consulta = "SELECT count(codigo) as cant FROM usuario  WHERE codigo = :codigo";
        $modules = $conexion->prepare($consulta);
          $modules->bindParam(":codigo", $codigo);
        $modules->execute();
        $data = $modules->fetch(PDO::FETCH_ASSOC);
        $total = $data['cant'];
        return $total;
    }

    // Máximo código de usuarios
    public function maxUsuarios()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $sqlcon = "SELECT max(codigo) as maximo FROM usuario";
        $rescon = $conexion->prepare($sqlcon);
        $rescon->execute();
        $rowcon = $rescon->fetch(PDO::FETCH_ASSOC);
        $consecutivo = $rowcon['maximo'];
        $consecutivo++;
        return $consecutivo;
    }
    function viewUsuariosPorDocumento($numero_documento)
{
    require_once 'conexion.php';
    $conexion = new Conexion();

    $arreglo = array();

    $consulta = "SELECT
                    codigo,
                    tipo_documento,
                    numero_documento,
                    nombre,
                    usuario,
                    contrasena,
                    email,
                    telefono,
                    estado,
                    rol_id
                FROM usuario
                WHERE numero_documento = :numero_documento
                ORDER BY codigo ASC";

    $modules = $conexion->prepare($consulta);
    $modules->bindParam(':numero_documento', $numero_documento);
    $modules->execute();

    while ($data = $modules->fetch(PDO::FETCH_ASSOC)) {
        $arreglo[] = $data;
    }

    return $arreglo;
}
}
