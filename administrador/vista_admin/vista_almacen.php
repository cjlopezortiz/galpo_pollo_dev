<?php
require_once '../../modelo/val-admin.php';
include_once '../../modelo/datos-almacen.php';
include_once '../../modelo/datos-galpon2.php';
include_once '../../modelo/datos-galpon1.php';

// Validamos el usuario
if ($rol_user != 1 && $rol_user != 2) {
    echo '<script language = javascript>
    alert ("Debe seleccionar un centro de formación.") 
    self.location="../index.php"
    </script>';
} else {
    // Instancias
    $mis_almacen = new misAlmacenes();
    $mis_galpon2 = new misGalpon2();
    $mis_galpon1 = new misGalpon1();
    // Coonsulta todos al almacen
    $res2 = $mis_galpon2->viewGalpones2();
    $res1 = $mis_galpon1->viewGalpones1();
    //$res = $mis_almacen->viewAlmacenes();
    $codigo = $res[0]['codigo_orions_almacen'] ?? null;
    $res = $mis_almacen->viewAlmacenes($codigo);

    //var_dump($res);
}
?>
<div class="col-sm-12">
    <div class="page-head">
        <style>
            /* Contenedor principal */
            .page-head-modern {
                background: linear-gradient(135deg, #0000ff, #ffffff);
                padding: 25px 30px;
                border-radius: 12px;
                color: #fff;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                margin-bottom: 20px;
            }

            /* Título */
            .page-head-modern h1 {
                font-size: 32px;
                font-weight: 700;
                margin: 0;
            }

            /* Subtítulo */
            .page-head-modern small {
                font-size: 16px;
                opacity: 0.9;
            }

            /* Breadcrumb */
            .breadcrumb-modern {
                background: #ffffff;
                padding: 12px 18px;
                border-radius: 10px;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                margin-bottom: 10px;
            }

            .breadcrumb-modern li a {
                color: #0d6efd;
                font-weight: 500;
                text-decoration: none;
            }

            .breadcrumb-modern li a:hover {
                text-decoration: underline;
            }
        </style>
        <div class="page-head">
            <div class="page-head-modern">
                <h1>Almacén de Galpones
                    <small>Almacén de Insumos Avícolas medicamentos y materiales de manejo necesarios para la crianza:</small>
                </h1>
            </div>
        </div>
        <ul class="breadcrumb breadcrumb-modern">
            <li>
                <a href="index.php">Inicio</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <span class="active">Almacén de Insumos Avícolas - medicamentos y materiales de manejo necesarios para la crianza:</span>
            </li>
        </ul>
        <br />
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <th>
                        <div class="text-center">Item</div>
                    </th>
                    <th>
                        <div class="text-center">Codigo <br />cosecha</div>
                    </th>
                    <th>
                        <div class="text-center">gastos<br />cosecha</div>
                    </th>
                    <th>
                        <div class="text-center">Liquidación<br />cosecha</div>
                    </th>
                    <!-- <th>
                        <div class="text-center">Gastos<br />varios</div>
                    </th> -->
                    <th>
                        <div class="text-center">PDF</div>
                    </th>
                    <th>
                        <div class="text-center">Editar</div>
                    </th>
                </thead>
                <tbody>
                    <?php
                    foreach ($res as $data) {
                        // Verificar si pertenece al galpón 1 o 2
                        $cant_galpon2 = $mis_galpon2->countAlmacenMateriales($data['codigo_orions_almacen']);
                        $cant_galpon1 = $mis_galpon1->countGalponir1($data['codigo_orions_almacen']);
                        // $cant_codigoAl = $mis_galpon1->countAlmacenCodigoGalpones1($data['codigo_orions']);

                        // URL destino según el galpón
                        $url_destino = "#";

                        if ($cant_galpon2 > 0) {
                            $url_destino = "galpon2.php";
                        } elseif ($cant_galpon1 > 0) {
                            $url_destino = "galpon1.php";
                        }

                        // Preparar datos para editar
                        $datos =  $data['codigo'] . "||" .
                            $data['codigo_orions_almacen'] . "||" .
                            $data['descripcion_material'] . "||" .
                            $data['cantidad_total'] . "||" .
                            $data['precio_kilo'] . "||" .
                            $data['cloro'] . "||" .
                            $data['vinagre'] . "||" .
                            $data['hacido_hacetico'] . "||" .
                            $data['vitaminas'] . "||" .
                            $data['precio_cloro'] . "||" .
                            $data['precio_vinagre'] . "||" .
                            $data['yodo'] . "||" .
                            $data['precio_yodo'] . "||" .
                            $data['precio_hacido'] . "||" .
                            $data['precio_vitamina'] . "||" .
                            $data['anores'] . "||" .
                            $data['precio_anores'] . "||" .
                            $data['vacunas'] . "||" .
                            $data['precio_vacunas'] . "||" .
                            $data['respiros'] . "||" .
                            $data['precio_respiros'] . "||" .
                            $data['tamo'] . "||" .
                            $data['precio_tamo'] . "||" .
                            $data['cal'] . "||" .
                            $data['precio_cal'] . "||" .
                            $data['antibiotico'] . "||" .
                            $data['precio_antibiotico'] . "||" .
                            $data['abc'] . "||" .
                            $data['precio_abc'] . "||" .
                            $data['vicarbonato'] . "||" .
                            $data['precio_vicarbonato'] . "||" .
                            $data['melasa'] . "||" .
                            $data['precio_melasa'] . "||" .
                            $data['agua_potable'] . "||" .
                            $data['precio_agua']  . "||" .
                            $data['luz'] . "||" .
                            $data['precio_luz']  . "||" .
                            $data['arriendo'] . "||" .
                            $data['precio_arriendo']  . "||" .
                            $data['gastos_varios'] . "||" .
                            $data['precio_gastos_varios'];
                    ?>
                        <tr>

                            <!-- CÓDIGO -->
                            <td>
                                <div class="text-center"><?php echo $data['codigo']; ?></div>
                            </td>
                            <!-- CÓDIGO ORIONS + GALPÓN -->
                            <td class="text-center" style="padding:10px;">
                                <?php
                                if (!empty($data['codigo_orions_g1'])) {
                                    $url = "galpon1.php?codigo_orions=" . $data['codigo_orions_g1'];
                                } elseif (!empty($data['codigo_orions_g2'])) {
                                    $url = "galpon2.php?codigo_orions=" . $data['codigo_orions_g2'];
                                } else {
                                    $url = "#";
                                }
                                ?>
                                <a href="<?php echo $url; ?>" style="display:block; width:100%; height:100%; text-decoration:none; color:inherit;">
                                    <div>
                                        <?php if (!empty($data['codigo_orions_g1'])) { ?>
                                            <span style="
                                                display:inline-block;
                                                background:#28a745;
                                                color:white;
                                                padding:4px 12px;
                                                border-radius:20px;
                                                font-size:12px;
                                                font-weight:bold;
                                                box-shadow:0px 1px 4px rgba(0,0,0,0.2);">
                                                GALPÓN 1Galpón Avícola Norte
                                            </span>
                                            <div style="margin-top:5px; font-size:15px; font-weight:bold; color:#007bff;">
                                                <?php echo $data['codigo_orions_g1']; /* ya no es <a> */ ?>
                                            </div>
                                            <div style="
                                                margin-top:7px;
                                                background:#f0f6ff;
                                                border:1px solid #d0d7e1;
                                                border-radius:10px;
                                                padding:8px 10px;
                                                font-size:12px;
                                                color:#333;
                                                box-shadow:0 2px 5px rgba(0,0,0,0.1);
                                                line-height:16px;">
                                                <div><b>Fecha Inicio:</b> <?php echo $data['fecha_inicio_g1']; ?></div>
                                                <div><b>Fecha Fin:</b> <?php echo $data['fecha_fin_g1']; ?></div>
                                            </div>
                                        <?php } ?>
                                        <?php if (!empty($data['codigo_orions_g2'])) { ?>
                                            <span style="
                                                display:inline-block;
                                                background:#007bff;
                                                color:white;
                                                padding:4px 12px;
                                                border-radius:20px;
                                                font-size:12px;
                                                font-weight:bold;
                                                box-shadow:0px 1px 4px rgba(0,0,0,0.2); ">
                                                GALPÓN   Galpón Avícola Sur
                                            </span>
                                            <div style="margin-top:5px; font-size:15px; font-weight:bold; color:#007bff;">
                                                <?php echo $data['codigo_orions_g2']; /* ya no es <a> */ ?>
                                            </div>
                                            <div style="
                                                margin-top:7px;
                                                background:#eef5ff;
                                                border:1px solid #c6d4e6;
                                                border-radius:10px;
                                                padding:8px 10px;
                                                font-size:12px;
                                                color:#333;
                                                box-shadow:0 2px 5px rgba(0,0,0,0.1);
                                                line-height:16px;">
                                                <div><b>Fecha Inicio:</b> <?php echo $data['fecha_inicio_g2']; ?></div>
                                                <div><b>Fecha Fin:</b> <?php echo $data['fecha_fin_g2']; ?></div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </a>
                            </td>
                            <!-- BOTÓN VER GASTOS -->
                            <td style="cursor:pointer;"
                                data-toggle="modal"
                                data-target="#modalPrecio<?php echo $data['codigo_orions_almacen']; ?>">

                                <div class="text-center">
                                    <button type="button"
                                        class="btn btn-info btn-sm">
                                        Ver gastos
                                    </button>
                                </div>


                            </td>
                            <!-- MODAL DE GASTOS -->
                            <!-- MODAL DE GASTOS - DISEÑO MODERNO -->
                            <div class="modal fade" id="modalPrecio<?php echo $data['codigo_orions_almacen']; ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content" style="border-radius:18px; box-shadow:0 4px 20px rgba(0,0,0,0.25);">

                                        <div class="modal-header" style="background: linear-gradient(90deg, #007bff, #0056b3); border-radius:18px 18px 0 0;">
                                            <h5 class="modal-title text-white">💰 Detalle de Costos</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body" style="font-size:15px;">

                                            <?php
                                            $precio_final = 0;
                                            // Inicialización de todas las variables (asumo que esta parte está correcta)
                                            // ... [Variables PHP inicializadas como en el código anterior] ...
                                            $cantidad_pollo     = $data['cantidad_pollo_g1'] ?? $data['cantidad_pollo_g2'];
                                            $precio_pollo       = $data['precio_pollo_g1'] ?? $data['precio_pollo_g2'];
                                            $cantidad_al        = $data['cantidad_g1'] ?? $data['cantidad_g2'];
                                            $precio_al          = $data['precio_alimento_g1'] ?? $data['precio_alimento_g2'];
                                            $fayido             = $data['fayido_g1'] ?? $data['fayido_g2'];
                                            $inicio_ali         = $data['alimento_inicio_g1'] ?? $data['alimento_inicio_g2'];
                                            $precio_ini         = $data['precio_inicio_g1'] ?? $data['precio_inicio_g2'];
                                            $preinicio_ali      = $data['alimento_preinicio_g1'] ?? $data['alimento_preinicio_g2'];
                                            $precio_pre         = $data['precio_preinicio_g1'] ?? $data['precio_preinicio_g2'];

                                            $cloro              = $data['cloro'] ?? null;
                                            $precio_cloro       = $data['precio_cloro'] ?? null;
                                            $vinagre            = $data['vinagre'] ?? null;
                                            $precio_vinagre     = $data['precio_vinagre'] ?? null;
                                            $hacido_hacetico    = $data['hacido_hacetico'] ?? null;
                                            $precio_hacido      = $data['precio_hacido'] ?? null;
                                            $vitaminas          = $data['vitaminas'] ?? null;
                                            $precio_vitaminas   = $data['precio_vitamina'] ?? null;

                                            $anores             = $data['anores'] ?? null;
                                            $precio_anores      = $data['precio_anores'] ?? null;
                                            $vacunas            = $data['vacunas'] ?? null;
                                            $precio_vacunas     = $data['precio_vacunas'] ?? null;
                                            $respiros           = $data['respiros'] ?? null;
                                            $precio_respiros    = $data['precio_respiros'] ?? null;
                                            $tamo               = $data['tamo'] ?? null;
                                            $precio_tamo        = $data['precio_tamo'] ?? null;
                                            $cal                = $data['cal'] ?? null;
                                            $precio_cal         = $data['precio_cal'] ?? null;
                                            $antibiotico        = $data['antibiotico'] ?? null;
                                            $precio_antibiotico = $data['precio_antibiotico'] ?? null;
                                            $abc                = $data['abc'] ?? null;
                                            $precio_abc         = $data['precio_abc'] ?? null;
                                            $vicarbonato        = $data['vicarbonato'] ?? null;
                                            $precio_vicarbonato = $data['precio_vicarbonato'] ?? null;
                                            $melasa             = $data['melasa'] ?? null;
                                            $precio_melasa      = $data['precio_melasa'] ?? null;
                                            $agua_potable       = $data['agua_potable'] ?? null;
                                            $precio_agua        = $data['precio_agua'] ?? null;
                                            $luz                = $data['luz'] ?? null;
                                            $precio_luz         = $data['precio_luz'] ?? null;
                                            $arriendo           = $data['arriendo'] ?? null;
                                            $precio_arriendo    = $data['precio_arriendo'] ?? null;
                                            $gastos_varios      = $data['gastos_varios'] ?? null;
                                            $precio_gastos_varios = $data['precio_gastos_varios'] ?? null;
                                            $yodo               = $data['yodo'] ?? null;
                                            $precio_yodo        = $data['precio_yodo'] ?? null;


                                            // ARRAY DE TODOS LOS ELEMENTOS
                                            // Esto nos permite iterar sobre ellos y repartirlos equitativamente.
                                            // FORMATO: [título, cantidad, precio_unitario, color_fondo, color_borde/texto, ícono]
                                            $items = [];

                                            if (!empty($cantidad_pollo) && !empty($precio_pollo)) {
                                                $total_pollo = $cantidad_pollo * $precio_pollo;
                                                $precio_final += $total_pollo;
                                                $items[] = ['Precio por unidad Pollo', $cantidad_pollo, $precio_pollo, $total_pollo, '#eaf8f0', '#28a745', '🐔'];
                                            }
                                            if (!empty($inicio_ali) && !empty($precio_ini)) {
                                                $total_inicio = $inicio_ali * $precio_ini;
                                                $precio_final += $total_inicio;
                                                $items[] = ['Precio por vulto Alimento Inicio', $inicio_ali, $precio_ini, $total_inicio, '#eaf8f0', '#007bff', '🌾'];
                                            }
                                            if (!empty($cantidad_al) && !empty($precio_al)) {
                                                $total_al = $cantidad_al * $precio_al;
                                                $precio_final += $total_al;
                                                $items[] = ['Precio por vulto Alimento Engorde', $cantidad_al, $precio_al, $total_al, '#ecf5ff', '#007bff', '🌾'];
                                            }
                                            if (!empty($preinicio_ali) && !empty($precio_pre)) {
                                                $total_pre = $preinicio_ali * $precio_pre;
                                                $precio_final += $total_pre;
                                                $items[] = ['Precio por vulto Alimento Crecimiento', $preinicio_ali, $precio_pre, $total_pre, '#eaf8f0', '#007bff', '🌾'];
                                            }
                                            if (!empty($cloro) && !empty($precio_cloro)) {
                                                $total_cloro = $cloro * $precio_cloro;
                                                $precio_final += $total_cloro;
                                                $items[] = ['Cloro', $cloro, $precio_cloro, $total_cloro, '#e7f9ff', '#17a2b8', '🧴'];
                                            }
                                            if (!empty($vinagre) && !empty($precio_vinagre)) {
                                                $total_vinagre = $vinagre * $precio_vinagre;
                                                $precio_final += $total_vinagre;
                                                $items[] = ['Vinagre', $vinagre, $precio_vinagre, $total_vinagre, '#fff7e6', '#ff9800', '🍶'];
                                            }
                                            if (!empty($vitaminas) && !empty($precio_vitaminas)) {
                                                $total_vitaminas = $vitaminas * $precio_vitaminas;
                                                $precio_final += $total_vitaminas;
                                                $items[] = ['Vitaminas', $vitaminas, $precio_vitaminas, $total_vitaminas, '#f3e8ff', '#6f42c1', '💊'];
                                            }
                                            // El card de la imagen: Ácido Hídrico
                                            if (!empty($hacido_hacetico) && !empty($precio_hacido)) {
                                                $total_acido = $hacido_hacetico * $precio_hacido;
                                                $precio_final += $total_acido;
                                                $items[] = ['Ácido Hídrico', $hacido_hacetico, $precio_hacido, $total_acido, '#ffe6ef', '#e83e8c', '🧪'];
                                            }

                                            // Nuevos elementos
                                            if (!empty($anores) && !empty($precio_anores)) {
                                                $total_anores = $anores * $precio_anores;
                                                $precio_final += $total_anores;
                                                $items[] = ['Anores', $anores, $precio_anores, $total_anores, '#fcf9f2', '#c9c54e', '💊'];
                                            }
                                            if (!empty($vacunas) && !empty($precio_vacunas)) {
                                                $total_vacunas = $vacunas * $precio_vacunas;
                                                $precio_final += $total_vacunas;
                                                $items[] = ['Vacunas', $vacunas, $precio_vacunas, $total_vacunas, '#e6f9ed', '#20c997', '💉'];
                                            }
                                            if (!empty($respiros) && !empty($precio_respiros)) {
                                                $total_respiros = $respiros * $precio_respiros;
                                                $precio_final += $total_respiros;
                                                $items[] = ['Respiros', $respiros, $precio_respiros, $total_respiros, '#e3f2fd', '#2196f3', '🌬️'];
                                            }
                                            if (!empty($tamo) && !empty($precio_tamo)) {
                                                $total_tamo = $tamo * $precio_tamo;
                                                $precio_final += $total_tamo;
                                                $items[] = ['Tamo', $tamo, $precio_tamo, $total_tamo, '#fdf6e9', '#996515', '🌾'];
                                            }
                                            if (!empty($cal) && !empty($precio_cal)) {
                                                $total_cal = $cal * $precio_cal;
                                                $precio_final += $total_cal;
                                                $items[] = ['Cal', $cal, $precio_cal, $total_cal, '#f0f0f0', '#777', '⚪'];
                                            }
                                            // El card de la imagen: Antibiótico
                                            if (!empty($antibiotico) && !empty($precio_antibiotico)) {
                                                $total_antibiotico = $antibiotico * $precio_antibiotico;
                                                $precio_final += $total_antibiotico;
                                                $items[] = ['Antibiótico', $antibiotico, $precio_antibiotico, $total_antibiotico, '#fbe7e8', '#d45963', '🩹'];
                                            }
                                            // El card de la imagen: Otros medicamentos (ABC)
                                            if (!empty($abc) && !empty($precio_abc)) {
                                                $total_abc = $abc * $precio_abc;
                                                $precio_final += $total_abc;
                                                $items[] = ['Otros medicamentos (ABC)', $abc, $precio_abc, $total_abc, '#f7efff', '#a361ff', '🅰️🅱️🆑'];
                                            }
                                            // El card de la imagen: Bicarbonato
                                            if (!empty($vicarbonato) && !empty($precio_vicarbonato)) {
                                                $total_vicarbonato = $vicarbonato * $precio_vicarbonato;
                                                $precio_final += $total_vicarbonato;
                                                $items[] = ['Bicarbonato', $vicarbonato, $precio_vicarbonato, $total_vicarbonato, '#fff0e6', '#ff7a3d', '🧂'];
                                            }
                                            // El card de la imagen: Melasa
                                            if (!empty($melasa) && !empty($precio_melasa)) {
                                                $total_melasa = $melasa * $precio_melasa;
                                                $precio_final += $total_melasa;
                                                $items[] = ['Melasa', $melasa, $precio_melasa, $total_melasa, '#fdfae5', '#e6b800', '🍯'];
                                            }
                                            // El card de la imagen: Agua Potable
                                            if (!empty($agua_potable) && !empty($precio_agua)) {
                                                $total_agua = $agua_potable * $precio_agua;
                                                $precio_final += $total_agua;
                                                $items[] = ['Agua Potable', $agua_potable, $precio_agua, $total_agua, '#e3f5ff', '#0093d5', '💧'];
                                            }
                                            if (!empty($luz) && !empty($precio_luz)) {
                                                $total_luz = $luz * $precio_luz;
                                                $precio_final += $total_luz;
                                                $items[] = ['Electricidad (Luz)', $luz, $precio_luz, $total_luz, '#fefce8', '#ffcc00', '💡'];
                                            }
                                            if (!empty($arriendo) && !empty($precio_arriendo)) {
                                                $total_arriendo = $arriendo * $precio_arriendo;
                                                $precio_final += $total_arriendo;
                                                $items[] = ['Arriendo', $arriendo, $precio_arriendo, $total_arriendo, '#f0e6ff', '#8e44ad', '🏠'];
                                            }
                                            if (!empty($yodo) && !empty($precio_yodo)) {
                                                $total_yodo = $yodo * $precio_yodo;
                                                $precio_final += $total_yodo;
                                                $items[] = ['Yodo', $yodo, $precio_yodo, $total_yodo, '#ffedcc', '#a34823', '🧪'];
                                            }

                                            // Gastos Varios
                                            $total_gastos_varios = 0;
                                            $display_gastos_varios = false;
                                            if (!empty($precio_gastos_varios)) {
                                                $cantidad_gastos = $gastos_varios ?? 1;
                                                $total_gastos_varios = $cantidad_gastos * $precio_gastos_varios;
                                                $precio_final += $total_gastos_varios;
                                                $items[] = ['Gastos Varios', $cantidad_gastos, $precio_gastos_varios, $total_gastos_varios, '#f0eef0', '#5a6268', '🛍️'];
                                            }


                                            $total_items = count($items);
                                            $half_point = ceil($total_items / 2); // Punto medio para dividir las cards
                                            $card_count = 0;

                                            echo '<div class="row">';
                                            echo '<div class="col-md-6">'; // Inicio de la Columna 1

                                            // IMPRIMIR TODOS LOS CARDS
                                            foreach ($items as $item) {
                                                list($titulo, $cantidad, $precio_unitario, $total, $bg_color, $border_color, $icon) = $item;
                                                $card_count++;

                                                // Si pasamos el punto medio, cerramos la columna 1 y abrimos la columna 2
                                                if ($card_count > $half_point) {
                                                    echo '</div>'; // Cierre de Columna 1
                                                    echo '<div class="col-md-6">'; // Apertura de Columna 2
                                                    $half_point = PHP_INT_MAX; // Aseguramos que no se abra otra columna
                                                }
                                            ?>
                                                <div style="
                        background:<?php echo $bg_color; ?>;
                        border-left:5px solid <?php echo $border_color; ?>;
                        padding:15px; 
                        border-radius:12px; 
                        margin-bottom:15px;
                        box-shadow:0 2px 8px rgba(0,0,0,0.1);
                    ">
                                                    <h6 style="font-weight:bold; color:<?php echo $border_color; ?>;"><?php echo $icon; ?> <?php echo $titulo; ?></h6>
                                                    <p style="margin:0;"><b>Precio:</b> $<?php echo number_format($precio_unitario, 0, ',', '.'); ?></p>
                                                    <p style="margin:0;"><b>Cantidad:</b> <?php echo $cantidad; ?></p>
                                                    <p style="margin:0;"><b>Total:</b> $<?php echo number_format($total, 0, ',', '.'); ?></p>
                                                </div>
                                            <?php
                                            }

                                            // Asegurar que la última columna (1 o 2) se cierre.
                                            echo '</div>'; // Cierre de la última columna abierta

                                            // --------- CARD DE FAYIDOS (Fuera del loop y de la suma de costos) ---------
                                            // Se coloca en la parte inferior para que no desequilibre las columnas de costos.
                                            if (!empty($fayido) && !empty($precio_pollo)) {
                                                $precio_unitario_fayido = $precio_pollo;
                                            ?>
                                                <div class="col-12 mt-3">
                                                    <div style="
                        background:#ffe8e8;
                        border-left:5px solid #dc3545;
                        padding:15px; 
                        border-radius:12px; 
                        margin-bottom:15px;
                        box-shadow:0 2px 8px rgba(0,0,0,0.1);
                    ">
                                                        <h6 style="font-weight:bold; color:#dc3545;">☠ Cantidad de mortanda de pollos (Costo no sumado)</h6>
                                                        <p style="margin:0;"><b>Precio unitario de pollo:</b> $<?php echo number_format($precio_unitario_fayido, 0, ',', '.'); ?></p>
                                                        <p style="margin:0;"><b>Cantidad Mortanda de pollos:</b> <?php echo $fayido; ?></p>
                                                        <p style="margin:0; color:#dc3545; font-style:italic;">* No incluido en el total final.</p>
                                                    </div>
                                                </div>
                                            <?php
                                            }

                                            echo '</div>'; // Cierre del Row principal
                                            ?>
                                            <hr>
                                            <div style="
                    text-align:center;
                    font-size:22px;
                    font-weight:bold;
                    color:#000;
                    padding:10px;
                    border-radius:10px;
                    background:#f4f4f4;
                    box-shadow:0 2px 5px rgba(0,0,0,0.15);
                ">
                                                TOTAL FINAL: $<?php echo number_format($precio_final, 0, ',', '.'); ?>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- CARD DE CANTIDAD + TOTAL -->
                            <td>
                                <div class="text-center"
                                    style="border: 1px solid #d0d7e1; border-radius: 10px; padding: 10px; background:#f0f6ff;">
                                    <div style="font-size:17px; font-weight:bold;">
                                        <?php echo $data['cantidad_total']; ?> kg
                                    </div>
                                    <div style="font-size:14px;">
                                        Precio: $<?php echo number_format($data['precio_kilo'], 0, ',', '.'); ?>
                                    </div>
                                    <div style="font-size:16px; font-weight:bold; margin-top:6px;">
                                        Total: $<?php echo number_format($data['cantidad_total'] * $data['precio_kilo'], 0, ',', '.'); ?>
                                    </div>
                                </div>
                            </td>
                            <!-- DESCRIPCIÓN -->
                            <!-- <td>
                                <div class="text-center">
                                    <?php echo !empty($data['descripcion_material']) ? $data['descripcion_material'] : "N/A"; ?>
                                </div>
                            </td> -->

                            <td style="cursor:pointer;"
                                onclick="window.open('../fpdf-pago/pagos.php?codigo_orions_almacen=<?php echo $data['codigo_orions_almacen']; ?>', '_blank');">
                                <div class="text-center" style="text-decoration:none;">
                                    <div class="galpon-card" style="pointer-events:none;"> <!-- permite que el td reciba el clic -->
                                        <a href="../fpdf-pago/pagos.php?codigo_orions_almacen=<?php echo $data['codigo_orions_almacen']; ?>"
                                            target="_blank"
                                            style="pointer-events:none;">
                                            <img src="../imagenes/logo-pdf.png" style="text-decoration:none;">
                                            <div class="almacen-box">Ver</div>

                                        </a>
                                    </div>
                                </div>
                            </td>


                            <!-- BOTÓN EDITAR -->
                            <td>
                                <div class="text-center">
                                    <button class="btn btn-primary"
                                        data-toggle="modal"
                                        data-target="#modalEdicionAmacen"
                                        onclick="agregarFormAlmacen('<?php echo $datos ?>')">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>
        <!-- <div>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalNuevoAlmacen">Crear un almacen para la cosecha</button>
            <br />
        </div> -->
    </div>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>