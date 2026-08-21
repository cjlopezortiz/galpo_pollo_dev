<?php
class misAlmacenes
{

    function viewAlmacen($codigo)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();

        $consulta = "SELECT
                        codigo,
                        codigo_orions,
                        descripcion_material,
                        cantidad_total,
                        precio_kilo
                     FROM almacen
                     WHERE codigo = :codigo";

        $modules = $conexion->prepare($consulta);
        $modules->bindParam(":codigo", $codigo);
        $modules->execute();

        while ($data = $modules->fetch(PDO::FETCH_ASSOC)) {
            $arreglo[] = $data;
        }

        return $arreglo;
    }

    // --- FILTRO POR codigo_orions ---
    function viewAlmacencodigo_orions($codigo_orions)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();

        $consulta = "SELECT 
                          a.codigo,
                          a.codigo_orions AS codigo_orions_almacen,
                          a.descripcion_material,
                          a.cantidad_total,
                          a.precio_kilo,
                          g.codigo_orions AS codigo_orions_g1,
                          g.tipo_alimento,
                          g.fayido,
                          g.cantidad,
                          g.cantidad_pollo,
                          g.precio_pollo,
                          g.precio_alimento
                      FROM almacen AS a
                      INNER JOIN galpon_1 AS g 
                          ON a.codigo_orions = g.codigo_orions
                      WHERE a.codigo_orions = :codigo_orions
                      ORDER BY a.codigo ASC";

        $modules = $conexion->prepare($consulta);
        $modules->bindParam(":codigo_orions", $codigo_orions);
        $modules->execute();

        while ($data = $modules->fetch(PDO::FETCH_ASSOC)) {
            $arreglo[] = $data;
        }

        return $arreglo;
    }

    // --- ESTA ES LA FUNCIÓN PRINCIPAL (CORREGIDA) ---
    // --- FUNCIÓN PARA MOSTRAR ALMACENES SEGÚN EL ROL ---
    function viewAlmacenes($codigo = null, $usuario_codigo = null, $rol_id = null)
    {
        require_once 'conexion.php';

        $conexion = new Conexion();

        // Obtener datos de sesión si no vienen como parámetros
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($usuario_codigo === null) {
            $usuario_codigo = $_SESSION['codigo'] ?? 0;
        }

        if ($rol_id === null) {
            $rol_id = $_SESSION['rol_id'] ?? 0;
        }

        $arreglo = array();
        $params = array();
        $where = array();

        // ==========================================
        // FILTRO POR CÓDIGO DE COSECHA / ORIONS
        // ==========================================
        if (!empty($codigo)) {

            $where[] = "a.codigo_orions = :codigo_orions_almacen";

            $params[':codigo_orions_almacen'] = $codigo;
        }

        // ==========================================
        // ROL 1 = ADMINISTRADOR
        // Puede ver todos los registros
        // ==========================================
        if ($rol_id == 1) {

            // No se agrega filtro por usuario

        } else {

            // ==========================================
            // ROL 2 = USUARIO
            // Solo puede ver sus propios registros
            // ==========================================

            $where[] = "a.usuario_codigo = :usuario_codigo";

            $params[':usuario_codigo'] = $usuario_codigo;
        }

        // ==========================================
        // CONSTRUIR WHERE
        // ==========================================
        $where_clause = "";

        if (!empty($where)) {

            $where_clause = " WHERE " . implode(" AND ", $where);
        }

        // ==========================================
        // CONSULTA
        // ==========================================
        $consulta = "SELECT 

                    a.codigo,
                    a.codigo_orions AS codigo_orions_almacen,
                    a.descripcion_material,
                    a.cantidad_total,
                    a.precio_kilo,

                    a.cloro,
                    a.vinagre,
                    a.hacido_hacetico,
                    a.vitaminas,

                    a.precio_cloro,
                    a.precio_vinagre,
                    a.yodo,
                    a.precio_yodo,
                    a.precio_hacido,
                    a.precio_vitamina,

                    a.anores,
                    a.precio_anores,

                    a.vacunas,
                    a.precio_vacunas,

                    a.respiros,
                    a.precio_respiros,

                    a.tamo,
                    a.precio_tamo,

                    a.cal,
                    a.precio_cal,

                    a.antibiotico,
                    a.precio_antibiotico,

                    a.abc,
                    a.precio_abc,

                    a.vicarbonato,
                    a.precio_vicarbonato,

                    a.melasa,
                    a.precio_melasa,

                    a.agua_potable,
                    a.precio_agua,

                    a.luz,
                    a.precio_luz,

                    a.arriendo,
                    a.precio_arriendo,

                    a.gastos_varios,
                    a.precio_gastos_varios,

                    a.gas,
                    a.precio_gas,

                    a.alimento_itacol,
                    a.precio_itacol,

                    a.usuario_codigo,

                    -- ==================================
                    -- GALPÓN 1
                    -- ==================================

                    g.codigo_orions AS codigo_orions_g1,
                    g.tipo_alimento AS tipo_alimento_g1,
                    g.fayido AS fayido_g1,
                    g.cantidad AS cantidad_g1,
                    g.cantidad_pollo AS cantidad_pollo_g1,
                    g.precio_pollo AS precio_pollo_g1,
                    g.precio_alimento AS precio_alimento_g1,
                    g.fecha_inicio AS fecha_inicio_g1,
                    g.fecha_fin AS fecha_fin_g1,
                    g.descripcion AS descripcion_g1,
                    g.alimento_inicio AS alimento_inicio_g1,
                    g.precio_inicio AS precio_inicio_g1,
                    g.alimento_preinicio AS alimento_preinicio_g1,
                    g.precio_preinicio AS precio_preinicio_g1,
                    g.edad AS edad_g1,
                    g.salidas AS salidas_g1,
                    g.peso_salidas AS peso_salidas_g1,
                    g.mortanda_dia AS mortanda_dia_g1,

                    -- ==================================
                    -- GALPÓN 2
                    -- ==================================

                    g2.codigo_orions AS codigo_orions_g2,
                    g2.tipo_alimento AS tipo_alimento_g2,
                    g2.fayido AS fayido_g2,
                    g2.cantidad AS cantidad_g2,
                    g2.cantidad_pollo AS cantidad_pollo_g2,
                    g2.precio_pollo AS precio_pollo_g2,
                    g2.precio_alimento AS precio_alimento_g2,
                    g2.fecha_inicio AS fecha_inicio_g2,
                    g2.fecha_fin AS fecha_fin_g2,
                    g2.descripcion AS descripcion_g2,
                    g2.alimento_inicio AS alimento_inicio_g2,
                    g2.precio_inicio AS precio_inicio_g2,
                    g2.alimento_preinicio AS alimento_preinicio_g2,
                    g2.precio_preinicio AS precio_preinicio_g2,
                    g2.edad AS edad_g2,
                    g2.salidas AS salidas_g2,
                    g2.peso_salidas AS peso_salidas_g2,
                    g2.mortanda_dia AS mortanda_dia_g2

                FROM almacen a

                LEFT JOIN galpon_1 g
                    ON a.codigo_orions = g.codigo_orions
                    AND (
                        :rol_join_g1 = 1
                        OR g.usuario_codigo = :usuario_join_g1
                    )

                LEFT JOIN galpon_2 g2
                    ON a.codigo_orions = g2.codigo_orions
                    AND (
                        :rol_join_g2 = 1
                        OR g2.usuario_codigo = :usuario_join_g2
                    )

                $where_clause

                ORDER BY a.codigo ASC";

        // ==========================================
        // PARÁMETROS DE LOS JOIN
        // ==========================================

        $params[':rol_join_g1'] = $rol_id;
        $params[':usuario_join_g1'] = $usuario_codigo;

        $params[':rol_join_g2'] = $rol_id;
        $params[':usuario_join_g2'] = $usuario_codigo;

        // ==========================================
        // EJECUTAR
        // ==========================================

        $modules = $conexion->prepare($consulta);

        $modules->execute($params);

        while ($data = $modules->fetch(PDO::FETCH_ASSOC)) {

            $arreglo[] = $data;
        }

        return $arreglo;
    }
    function countAlmacen()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $consulta = "SELECT count(codigo) as cant
                     FROM almacen";
        $modules = $conexion->prepare($consulta);
        $modules->execute();
        $data = $modules->fetch(PDO::FETCH_ASSOC);
        $total = 0;
        $total = $data['cant'];
        return $total;
    }
    // Máximo código del almacen
    public function maxAlmacen()
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $sqlcon = "SELECT max(codigo) as maximo FROM almacen";
        $rescon = $conexion->prepare($sqlcon);
        $rescon->execute();
        $rowcon = $rescon->fetch(PDO::FETCH_ASSOC);
        $consecutivo = $rowcon['maximo'];
        $consecutivo++;
        return $consecutivo;
    }
}
