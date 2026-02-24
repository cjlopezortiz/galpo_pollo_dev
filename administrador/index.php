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

<body style="background: linear-gradient(135deg,#4e73df,#1cc88a); min-height:100vh;">

<div class="container mt-4">

<?php include 'menu.php'; ?>

<ul class="page-breadcrumb breadcrumb bg-white p-3 rounded shadow-sm">
    <li><a href="index.php">Inicio</a> <i class="fa fa-circle"></i></li>
    <li class="text-primary">Proyecto Galpón <i class="fa fa-circle"></i></li>
    <li class="text-primary">Panel principal</li>
</ul>

<h4 class="text-right text-white mb-4">
    Bienvenido: <strong><?php echo $user_nombre; ?></strong>
</h4>

<?php if ($rol_user == 1 || $rol_user == 2): ?>

<style>
.galpon-card{
    border-radius:20px;
    box-shadow:0 8px 20px rgba(0,0,0,.15);
    transition:.3s;
    padding:25px;
    text-align:center;
    background:#ffffff;
    margin-bottom:30px;
}
.galpon-card:hover{
    transform:translateY(-8px);
}
.galpon-title{
    font-size:20px;
    font-weight:700;
    color:#007bff;
}
.galpon-sub{
    font-size:15px;
    color:#555;
    margin-top:5px;
}
.almacen-box{
    margin-top:15px;
    padding:10px;
    border-radius:10px;
    background:#f1f7ff;
    font-weight:bold;
    color:#007bff;
    transition:.3s;
}
.almacen-box:hover{
    background:#d9eaff;
}
.section-title{
    text-align:center;
    margin:40px 0 30px 0;
    font-weight:700;
    color:white;
}
</style>

<h2 class="section-title">GALPONES AVÍCOLA</h2>

<div class="row">

    <!-- Galpón 1 -->
    <div class="col-md-4">
        <div class="galpon-card">
            <div class="galpon-title">Galpón Avícola Norte</div>
            <div class="galpon-sub">
                Cantidad de cosechas: <b><?php echo $cant_galpon1; ?></b>
            </div>
            <a href="galpon1.php">
                <div class="almacen-box">Entrar</div>
            </a>
        </div>
    </div>

    <!-- Galpón 2 -->
    <div class="col-md-4">
        <div class="galpon-card">
            <div class="galpon-title">Galpón Avícola Sur</div>
            <div class="galpon-sub">
                Cantidad de cosechas: <b><?php echo $cant_galpon2; ?></b>
            </div>
            <a href="galpon2.php">
                <div class="almacen-box">Entrar</div>
            </a>
        </div>
    </div>

    <!-- Galpón 3 -->
    <div class="col-md-4">
        <div class="galpon-card">
            <div class="galpon-title">Galpón Avícola Central</div>
            <div class="galpon-sub">Cantidad de cosechas: <b>N/A</b></div>
            <div class="almacen-box">Próximamente</div>
        </div>
    </div>

</div>

<div class="row">

    <!-- Galpón 4 -->
    <div class="col-md-4">
        <div class="galpon-card">
            <div class="galpon-title">Galpón Avícola La Colmena</div>
            <div class="galpon-sub">Cantidad de cosechas: <b>N/A</b></div>
            <div class="almacen-box">Próximamente</div>
        </div>
    </div>

    <!-- Galpón 5 -->
    <div class="col-md-4">
        <div class="galpon-card">
            <div class="galpon-title">Galpón Avícola El Corral</div>
            <div class="galpon-sub">Cantidad de cosechas: <b>N/A</b></div>
            <div class="almacen-box">Próximamente</div>
        </div>
    </div>

    <!-- Galpón 6 -->
    <div class="col-md-4">
        <div class="galpon-card">
            <div class="galpon-title">Galpón Avícola La Pradera</div>
            <div class="galpon-sub">Cantidad de cosechas: <b>N/A</b></div>
            <div class="almacen-box">Próximamente</div>
        </div>
    </div>

</div>

<h2 class="section-title"></h2>

<div class="row">

    <div class="col-md-4">
        <div class="galpon-card">
            <div class="galpon-title">Manual de Usuario</div>
            <div class="galpon-sub">Manual para el cuido y crianza</div>
            <a href="../fpdf-manual/manual.php" target="_blank">
                <div class="almacen-box">Ver PDF</div>
            </a>
        </div>
    </div>

    <div class="col-md-4">
        <div class="galpon-card">
            <div class="galpon-title">Usuarios</div>
            <div class="galpon-sub">
                Cantidad: <b><?php echo $cant_usuarios; ?></b>
            </div>
            <a href="usuarios.php">
                <div class="almacen-box">Entrar</div>
            </a>
        </div>
    </div>

</div>

<?php endif; ?>

</div>

<?php include 'librerias-js.php'; ?>
</body>

</html>
