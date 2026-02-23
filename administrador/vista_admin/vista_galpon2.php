<?php
require_once '../../modelo/val-admin.php';
include '../../modelo/datos-galpon2.php';
include '../../modelo/datos-almacen.php';
/// Validamos el usuario
if ($rol_user != 1 && $rol_user != 2) {
    echo '<script language = javascript>
    alert ("Debe seleccionar un centro de formación.") 
    self.location="../index.php"
    </script>';
} else {
    // Instancias
    $mis_galpon2 = new misGalpon2();
    $mis_almacen = new misAlmacenes();
    // Coonsulta todos los documentos
    if (isset($_GET['codigo_orions']) && !empty($_GET['codigo_orions'])) {
        $codigo_orions = $_GET['codigo_orions'];
        $res = $mis_galpon2->viewGalpones2($codigo_orions);
    } else {
        $res = $mis_galpon2->viewGalpones2();
    }
}
?>
<div class="col-sm-12">
    <!-- Inicio titulos de la pagina-->
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
            <!-- BEGIN PAGE TITLE -->
            <!-- TÍTULO MODERNO -->
            <div class="page-head-modern">
                <h1>
                    Galpón Avícola Sur
                    <small>Produccion de Pollos de Engorde</small>
                </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <!-- BREADCRUMB 1 -->
        <ul class="breadcrumb breadcrumb-modern">
            <li>
                <a href="index.php">Inicio</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="index.php">Produccion de Pollos de Engorde</a>
            </li>
        </ul>

        <!-- BREADCRUMB 2 -->
        <ul class="breadcrumb breadcrumb-modern">
            <li>
                <a href="almacen.php">Almacén</a>
            </li>
        </ul>
        <br />
        <!-- INICIO DEL CONTENIDO -->
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <th>
                        <div class="text-center">Item</div>
                    </th>
                    <th>
                        <div class="text-center">código cosecha</div>
                    </th>
                    <th>
                        <div class="text-center">Fecha<br />Inicio</div>
                    </th>
                    <th>
                        <div class="text-center">Tipo Alimento</div>
                    </th>
                    <th>
                        <div class="text-center">Color Pollo</div>
                    </th>
                    <th>
                        <div class="text-center">Cantidad Pollos</div>
                    </th>
                    <th>
                        <div class="text-center">Cantidad Alimento Inicio</div>
                    </th>
                    <th>
                        <div class="text-center">Cantidad Alimento Crecimiento</div>
                    </th>
                    <th>
                        <div class="text-center">Cantidad Alimento Engorde</div>
                    </th>
                    <th>
                        <div class="text-center">Mortanda Cosecha Perdida</div>
                    </th>
                    <th>
                        <div class="text-center">Fecha<br />Fin</div>
                    </th>
                    <th>
                        <div class="text-center">Observaciones</div>
                    </th>
                    <th>
                        <div class="text-center">Editar</div>
                    </th>
                </thead>
                <tbody>
                    <?php
                    $cant = 1;
                    //   $cant_galpon2 = $mis_galpon2->countAlmacenMateriales($data['codigo_orions']);

                    foreach ($res as $data) {
                        $cant_galpon2 = $mis_galpon2->countGalponir2(['codigo_orions']);

                        // Datos
                        $datos = $data['codigo'] . "||" .
                            $data['codigo_orions'] . "||" .
                            $data['cantidad_pollo'] . "||" .
                            $data['precio_pollo'] . "||" .
                            $data['color'] . "||" .
                            $data['fayido'] . "||" .
                            $data['tipo_alimento'] . "||" .
                            $data['cantidad'] . "||" .
                            $data['precio_alimento'] . "||" .
                            $data['fecha_inicio'] . "||" .
                            $data['fecha_fin'] . "||" .
                            $data['descripcion'] . "||" .
                            $data['alimento_inicio'] . "||" .
                            $data['precio_inicio'] . "||" .
                            $data['alimento_preinicio'] . "||" .
                            $data['precio_preinicio'];


                        $url_destino = "almacen.php";

                    ?>
                        <tr>
                            <td>
                                <div class="text-center"><?php echo $data['codigo']; ?></div>
                            </td>
                            <td style="cursor:pointer;">
                                <div class="text-center" style="pointer-events:none;">
                                    <?php echo !empty($data['codigo_orions']) ? $data['codigo_orions'] : 'N/A'; ?>
                                </div>
                            </td>

                            <td>
                                <div class="text-center"><?php echo $data['fecha_inicio']; ?></div>
                            </td>
                            <td>
                                <div class="text-center"><?php echo !empty($data['tipo_alimento']) ? $data['tipo_alimento'] : 'N/A'; ?></div>
                            </td>
                            <td>
                                <div class="text-center"><?php echo !empty($data['color']) ? $data['color'] : 'N/A'; ?> </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <?php
                                    $cantidad = $data['cantidad_pollo'];
                                    // Precio unitario tomado desde la consulta
                                    $precio_unitario = $data['precio_pollo'];
                                    // Cálculo del total
                                    $precio_total = $cantidad * $precio_unitario;
                                    ?>
                                    <!-- Mostrar la cantidad -->
                                    <?php echo $cantidad; ?>
                                    <!-- Mostrar el precio debajo -->
                                    <div style="font-size:12px; color:green; font-weight:bold;">
                                        $<?php echo number_format($precio_total, 0, ',', '.');
                                            ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <?php
                                    $cantidad = $data['alimento_inicio'];
                                    // Precio unitario tomado desde la consulta
                                    $precio_unitario = $data['precio_inicio'];
                                    // Cálculo del total
                                    $precio_total = $cantidad * $precio_unitario;
                                    ?>
                                    <!-- Mostrar la cantidad -->
                                    <?php echo $cantidad; ?>
                                    <!-- Mostrar el precio debajo -->
                                    <div style="font-size:12px; color:green; font-weight:bold;">
                                        $<?php echo number_format($precio_total, 0, ',', '.');
                                            ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <?php
                                    $cantidad = $data['alimento_preinicio'];
                                    // Precio unitario tomado desde la consulta
                                    $precio_unitario = $data['precio_preinicio'];
                                    // Cálculo del total
                                    $precio_total = $cantidad * $precio_unitario;
                                    ?>
                                    <!-- Mostrar la cantidad -->
                                    <?php echo $cantidad; ?>
                                    <!-- Mostrar el precio debajo -->
                                    <div style="font-size:12px; color:green; font-weight:bold;">
                                        $<?php echo number_format($precio_total, 0, ',', '.');
                                            ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <?php
                                    $cantidad = $data['cantidad'];
                                    // Precio unitario tomado desde la consulta
                                    $precio_unitario = $data['precio_alimento'];
                                    // Cálculo del total
                                    $precio_total = $cantidad * $precio_unitario;
                                    ?>
                                    <!-- Mostrar la cantidad -->
                                    <?php echo $cantidad; ?>
                                    <!-- Mostrar el precio debajo -->
                                    <div style="font-size:12px; color:green; font-weight:bold;">
                                        $<?php echo number_format($precio_total, 0, ',', '.'); ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <?php
                                    $cantidad = $data['fayido'];
                                    // Precio unitario tomado desde la consulta
                                    $precio_unitario = $data['precio_pollo'];
                                    // Cálculo del total
                                    $precio_total = $cantidad * $precio_unitario;
                                    ?>
                                    <!-- Mostrar la cantidad -->
                                    <?php echo $cantidad; ?>
                                    <!-- Mostrar el precio debajo -->
                                    <div style="font-size:12px; color:green; font-weight:bold;">
                                        $<?php echo number_format($precio_total, 0, ',', '.'); ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center"><?php echo $data['fecha_fin']; ?></div>
                            </td>
                            <td>
                                <div class="text-center"><?php echo !empty($data['descripcion']) ? $data['descripcion'] : 'N/A'; ?></div>
                            </td>
                            <td>
                                <div class="text-center"><button class="btn btn-primary glyphicon glyphicon glyphicon-pencil" data-toggle="modal" data-target="#modalEdicionGalpon2" onclick="agregarFormGalpon2('<?php echo  $datos ?>')"></button></div>
                            </td>
                        </tr>

                    <?php
                        $cant++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <br />
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalNuevoGalpon2">Crear cosecha</button>
        <br />
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>