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
    function viewAlmacenes($codigo = null)
    {
        require_once 'conexion.php';
        $conexion = new Conexion();
        $arreglo = array();
        $params = [];
        $where_clause = "";

        // ----------------------------
        // 1. SI NO VIENE PARÁMETRO, BUSCAMOS EN GET o REQUEST
        // ----------------------------
        if ($codigo === null) {
            $codigo = $_REQUEST['codigo_orions_almacen'] ?? null;
        }

        // ----------------------------
        // 2. SI LLEGA CÓDIGO, APLICAMOS FILTRO
        // ----------------------------
        if (!empty($codigo)) {
            $where_clause = " WHERE a.codigo_orions = :codigo_orions_almacen ";
            $params[':codigo_orions_almacen'] = $codigo;
        }

        // ----------------------------
        // 3. CONSULTA PRINCIPAL
        // ----------------------------
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
                          g2.precio_preinicio AS precio_preinicio_g2

      
                      FROM almacen AS a
                      LEFT JOIN galpon_1 AS g ON a.codigo_orions = g.codigo_orions
                      LEFT JOIN galpon_2 AS g2 ON a.codigo_orions = g2.codigo_orions
                      $where_clause
                      ORDER BY a.codigo ASC";
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
