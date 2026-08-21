<?php
require_once '../../modelo/val-admin.php';
include '../../modelo/datos-galpon2.php';
include '../../modelo/datos-almacen.php';
include_once '../../modelo/datos-usuarios.php';
$mis_usuarios = new misUsuarios();
$res = $mis_usuarios->viewUsuarios();
if (is_array($res)) {
    // Si es un arreglo con la clave rol_id
    if (isset($res['rol_id'])) {
        $rol_id = $res['rol_id'];
    }
    // Si es un arreglo de registros
    elseif (isset($res[0]['rol_id'])) {
        $rol_id = $res[0]['rol_id'];
    } else {
        $rol_id = null;
    }
    //var_dump($rol_id);
} elseif ($res instanceof mysqli_result) {
    $fila = mysqli_fetch_assoc($res);
    if ($fila && isset($fila['rol_id'])) {
        $rol_id = $fila['rol_id'];
        // var_dump($rol_id);
    } else {
        echo "No se encontró el campo rol_id";
    }
} else {
    echo "viewUsuarios() no está retornando datos válidos.";
}
$rol_user = $rol_id;
/// Validamos el usuario
if ($rol_user != 1 && $rol_user != 2) {
    echo '<script language = javascript>
    alert ("Debe seleccionar un centro de formación.") 
    self.location="../index.php"
    </script>';
} else {
    // Instancias
     // Instancias
    // Instancias
    $mis_almacen = new misAlmacenes();
    $mis_galpon2 = new misGalpon2();
     // Coonsulta todos al almacen
    $user_codigo = $_SESSION['codigo'];
    $rol_id = $_SESSION['rol_id'];

    if (isset($_GET['codigo_orions']) && !empty($_GET['codigo_orions'])) {

        $codigo_orions = $_GET['codigo_orions'];

        $res = $mis_galpon2->viewGalpones2(
            $codigo_orions,
            $user_codigo,
            $rol_id
        );
    } else {

        $res = $mis_galpon2->viewGalpones2(
            null,
            $user_codigo,
            $rol_id
        );
    }
}
?>
<div class="col-sm-12">
    <!-- Inicio titulos de la pagina-->
    <div class="page-head">
        <link rel="stylesheet" href=".././css/stylos.css">
        <div class="page-head">
            <!-- BEGIN PAGE TITLE -->
            <!-- TÍTULO MODERNO -->
            <div class="page-head-modern">
                <h1>
                    GALPÓN AVÍCOLA SUR HEMBRAS
                    <!-- <small>Produccion de Pollos de Engorde</small> -->
                </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <!-- BREADCRUMB 1 -->
        <ul class="breadcrumb breadcrumb-modern">
            <li>
                <h4>Producción de Pollos de Engorde</h4>
                <a href="index.php">Inicio</a>
            </li>
        </ul>

        <!-- BREADCRUMB 2 -->
        <ul class="breadcrumb breadcrumb-modern">
            <li>
                <a href="almacen.php">Almacén</a>
            </li>
            <li>
                <a target="_blank" href="control_alimento.php">Control de Alimento</a>
            </li>
            <li>
                <a target="_blank" href="registro_medicamentos.php">REGISTRO DE USO DE MEDICAMENTOS VETERINARIOS</a>
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
                        <div class="text-center">Perfil <br />Hembras</div>
                    </th>
                    <th>
                        <div class="text-center">código <br />cosecha</div>
                    </th>
                    <th>
                        <div class="text-center">Fecha<br />Inicio</div>
                    </th>
                    <th>
                        <div class="text-center">Fecha<br />Fin</div>
                    </th>
                    <th>
                        <div class="text-center">Edad<br />Inicio</div>
                    </th>
                    <th>
                        <div class="text-center">Tipo<br /> Alimento</div>
                    </th>
                    <th>
                        <div class="text-center">Color <br />Pollo</div>
                    </th>
                    <th>
                        <div class="text-center">Cantidad <br />Pollos</div>
                    </th>
                    <th>
                        <div class="text-center">Mortanda Cosecha<br />Dia</div>
                    </th>
                    <th>
                        <div class="text-center">Mortanda Cosecha <br />Total</div>
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
                            $data['precio_preinicio'] . "||" .
                            $data['edad'] . "||" .
                            $data['salidas'] . "||" .
                            $data['peso_salidas'] . "||" .
                            $data['mortanda_dia'];


                        $url_destino = "almacen.php";

                    ?>
                        <tr>
                            <td>
                                <div class="text-center"><?php echo $data['codigo']; ?></div>
                            </td>
                            <td style="cursor:pointer;" title="PERFIL Hembras"
                                onclick="window.open('../fpdf-perfil-hembras/hembras.php?codigo_orions=<?php echo $data['codigo_orions']; ?>', '_blank');">
                                <div class="text-center" style="text-decoration:none;">
                                    <div class="galpon-card" style="pointer-events:none;"> <!-- permite que el td reciba el clic -->
                                        <a href="../fpdf-perfil-hembras/hembras.php?codigo_orions=<?php echo $data['codigo_orions']; ?>"
                                            target="_blank"
                                            style="pointer-events:none;">
                                            <img src="../imagenes/logo-pdf.png" style="text-decoration:none;">
                                            <div class="almacen-box">Ver</div>

                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td style="cursor:pointer;">
                                <div class="text-center" style="pointer-events:none;">
                                    <?php echo !empty($data['codigo_orions']) ? $data['codigo_orions'] : 'N/A'; ?>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <?php
                                    $fecha = new DateTime($data['fecha_inicio']);
                                    // 1. Muestra solo la fecha (día/mes/año)
                                    echo $fecha->format('d/m/Y');
                                    ?>
                                    <!-- 2. Título en medio -->
                                    <h6>Hora</h6>
                                    <?php
                                    // 3. Muestra solo la hora (hora:minutos:segundos)
                                    echo $fecha->format('H:i:s');
                                    ?>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <?php
                                    $fecha = new DateTime($data['fecha_fin']);
                                    // 1. Muestra solo la fecha (día/mes/año)
                                    echo $fecha->format('d/m/Y');
                                    ?>
                                    <!-- 2. Título en medio -->
                                    <h6>Hora</h6>
                                    <?php
                                    // 3. Muestra solo la hora (hora:minutos:segundos)
                                    echo $fecha->format('H:i:s');
                                    ?>
                                </div>
                            </td>
                            <td>
                                <div class="text-center"><?php echo !empty($data['edad']) ? $data['edad'] : 'N/A'; ?></div>
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
                                </div>
                            </td>
                            <td>
                                <div class="text-center"><?php echo !empty($data['mortanda_dia']) ? $data['mortanda_dia'] : 'N/A'; ?></div>
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
                                    <!-- <div style="font-size:12px; color:green; font-weight:bold;">
                                        $<?php echo number_format($precio_total, 0, ',', '.'); ?>
                                    </div> -->
                                </div>
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