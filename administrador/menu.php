<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a href="index.php"> <img src="../imagenes/pollo4.jpg" alt=""/></a>
        </div>
        <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Inicio</a></li>
        <li><a href="index.php">Usuario: <?php echo $rol_user; ?> - <?php echo $user_nombre; ?></a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right"></ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="../modelo/salir.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
        </ul>
    </div>
</nav>