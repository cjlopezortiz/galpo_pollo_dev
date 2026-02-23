<?php
date_default_timezone_set("America/Bogota");
require_once '../modelo/val-admin.php';
require_once '../modelo/datos-usuarios.php';
require '../modelo/datos-almacen.php';
require '../modelo/datos-galpon1.php';
require '../modelo/datos-galpon2.php';
require '../modelo/datos-documento.php';
require_once '../modelo/datos-rol.php';
$mis_usuarios = new misUsuarios();
$mis_almacen = new misAlmacenes();
$mis_documentos = new misDocumentos();
$mis_galpon2 = new misGalpon2();
$mis_galpon1 = new misGalpon1();
$mis_roles = new misRoles();
?>
<?php
if ($rol_user == 1 || $rol_user == 2) {
    if ($rol_user == 1) {
        $pagina = "Administrador";
    } elseif ($rol_user == 2) {
        $pagina = "Asignador";
    } else {
        $pagina = "";
    }
    $cant_usuarios = $mis_usuarios->countUsuarios();
    $cant_almacen = $mis_almacen->countAlmacen();
    $cant_galpon2 = $mis_galpon2->countGalpon2();
    $cant_galpon1 = $mis_galpon1->countGalpon1();
    $cant_documento = $mis_documentos->countDocumento();
    $rol = $mis_roles->viewRoles();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pagina ?></title>
    <?php
    include 'librerias-css.php';
    ?>
</head>

<body>
    <div class="container">
        <?php
        include 'menu.php';
        ?>
        <!-- BEGIN PAGE HEAD-->

        <!-- END PAGE HEAD-->
        <!-- BEGIN PAGE BREADCRUMB -->
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <a href="index.php">Inicio:</a>
                <i class="fa fa-circle"></i>
            </li>
            <li class="text-primary">
                <span class="active">Proyecto Galpon:</span>
                <i class="fa fa-circle"></i>
            </li>
            <li class="text-primary">
                <span class="active">Panel principal:</span>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
        <!-- END PAGE BREADCRUMB -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <h3 class="text-right">Bienvenido: <?php echo $user_nombre; ?></h3>
        <?php
        if ($rol_user == 1 || $rol_user == 2) {
        ?>
            <style>
                .galpon-card {
                    border-radius: 15px;
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                    transition: transform .2s;
                    padding: 20px;
                    text-align: center;
                    background: #ffffff;
                    margin-bottom: 25px;
                }

                .galpon-card:hover {
                    transform: scale(1.05);
                }

                .galpon-title {
                    font-size: 22px;
                    font-weight: bold;
                    color: #007bff;
                }

                .galpon-sub {
                    font-size: 16px;
                    color: #555;
                }

                .almacen-box {
                    margin-top: 15px;
                    padding: 12px;
                    border-radius: 10px;
                    background: #f1f7ff;
                    font-weight: bold;
                    color: #007bff;
                }

                .almacen-box:hover {
                    background: #d9eaff;
                }
            </style>

            <div class="row">
                <h1 class="text-center">GALPÓNES: AVÍCOLA</h1>
                <br><br>

                <!-- GALPON 1 -->
                <div class="col-sm-4">
                    <a href="galpon1.php" style="text-decoration:none;">
                        <div class="galpon-card">
                            <div class="galpon-title">Galpón Avícola Norte</div>
                            <div class="galpon-sub">Cantidad de cosechas: <b><?php echo $cant_galpon1; ?></b></div>

                            <a href="almacen.php" style="text-decoration:none;">
                                <div class="almacen-box">Almacenamiento</div>
                            </a>
                        </div>
                    </a>
                </div>

                <!-- GALPON 2 -->
                <div class="col-sm-4">
                    <a href="galpon2.php" style="text-decoration:none;">
                        <div class="galpon-card">
                            <div class="galpon-title">Galpón Avícola Sur</div>
                            <div class="galpon-sub">Cantidad de cosechas: <b><?php echo $cant_galpon2; ?></b></div>

                            <a href="almacen.php" style="text-decoration:none;">
                                <div class="almacen-box">Almacenamiento</div>
                            </a>
                        </div>
                    </a>
                </div>

                <!-- GALPON 3 -->
                <div class="col-sm-4">
                    <a href="#" style="text-decoration:none;">
                        <div class="galpon-card">
                            <div class="galpon-title">Galpón Avícola Central</div>
                            <div class="galpon-sub">Cantidad de cosechas: <b>N/A</b></div>

                            <a href="#" style="text-decoration:none;">
                                <div class="almacen-box">Almacenamiento</div>
                            </a>
                        </div>
                    </a>
                </div>

                <!-- GALPON 4 -->
                <div class="col-sm-4">
                    <a href="#" style="text-decoration:none;">
                        <div class="galpon-card">
                            <div class="galpon-title">Galpón Avícola La Colmena</div>
                            <div class="galpon-sub">Cantidad de cosechas: <b>N/A</b></div>

                            <a href="#" style="text-decoration:none;">
                                <div class="almacen-box">Almacenamiento</div>
                            </a>
                        </div>
                    </a>
                </div>

                <!-- GALPON 5 -->
                <div class="col-sm-4">
                    <a href="#" style="text-decoration:none;">
                        <div class="galpon-card">
                            <div class="galpon-title">Galpón Avícola El Corral</div>
                            <div class="galpon-sub">Cantidad de cosechas: <b>N/A</b></div>

                            <a href="#" style="text-decoration:none;">
                                <div class="almacen-box">Almacenamiento</div>
                            </a>
                        </div>
                    </a>
                </div>

                <!-- GALPON 6 -->
                <div class="col-sm-4">
                    <a href="#" style="text-decoration:none;">
                        <div class="galpon-card">
                            <div class="galpon-title">Galpón Avícola La Pradera</div>
                            <div class="galpon-sub">Cantidad de cosechas: <b>N/A</b></div>

                            <a href="#" style="text-decoration:none;">
                                <div class="almacen-box">Almacenamiento</div>
                            </a>
                        </div>
                    </a>
                </div>
                <div class="row">
                    <h1 class="text-center" style="margin-top:40px;">Usuarios</h1>
                    <br><br>
                          <!-- Munuel 6 -->
                    <div class="col-sm-4">
                        <a href="#" style="text-decoration:none;">
                            <div class="galpon-card">
                                <div class="galpon-title"><a type="button" href='..//fpdf-manual/manual.php' target="_blank">Manual de usuario</a></div>
                                <div class="galpon-sub"><a type="button" href='..//fpdf-manual/manual.php' target="_blank">Manual para él cuido y crianza de la cosecha<b></a></b></div>
                                <a type="button" href='..//fpdf-manual/manual.php' target="_blank">
                                <img src="../imagenes/logo-pdf.png" style="text-decoration:none;">
                                    <div class="almacen-box">Ver</div>
                                </a>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="usuarios.php" style="text-decoration:none;">
                            <div class="galpon-card">
                                <div class="galpon-title">Usuarios</div>

                                <div class="galpon-sub">
                                    <?php if ($rol_user == 1 || $rol_user == 2): ?>
                                        Cantidad: <b><?php echo $cant_usuarios; ?></b>
                                    <?php endif; ?>

                                    <?php if ($rol_user == 3 || $rol_user == 4): ?>
                                        <b class="text-primary">Ver →</b>
                                    <?php endif; ?>
                                </div>

                                <a href="usuarios.php" style="text-decoration:none;">
                                    <div class="almacen-box">Entrar</div>
                                </a>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    </div>
    <?php
    include 'librerias-js.php';
    ?>
</body>

</html>
