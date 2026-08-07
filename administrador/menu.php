<?php
$rol_user = $_SESSION['rol_id'];
$user_nombre = $_SESSION['nombre'];
?>

<!-- Importación de iconos FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<nav class="navbar-modern">
    <div class="nav-container-flex">
        
        <!-- SECCIÓN IZQUIERDA: Logotipo -->
        <a class="nav-brand-modern" href="index.php">
            <div class="logo-wrapper">
                <img src="../imagenes/pollopdf2.png" alt="Logo" class="navbar-logo">
            </div>
            <div class="brand-text-wrapper">
                <span class="brand-text-top">LÍNEA DE POLLO</span>
                <span class="brand-text-sub">PANEL DE CONTROL</span>
            </div>
        </a>

        <!-- SECCIÓN CENTRAL: Inicio y Usuario -->
        <div class="nav-center-content">
            <a class="nav-link-modern active-modern" href="index.php">
                <i class="fas fa-th-large"></i> INICIO
            </a>
            
            <span class="nav-user-info-modern">
                <i class="far fa-user text-accent"></i>
                <span class="text-muted-modern"><?php echo $rol_user; ?>:</span> 
                <strong class="user-name-text"><?php echo $user_nombre; ?></strong>
            </span>
        </div>

        <!-- SECCIÓN DERECHA: Cerrar Sesión fijo a la derecha -->
        <div class="nav-right-content">
            <a class="btn-logout-modern" href="../modelo/salir.php">
                <i class="fas fa-sign-out-alt"></i> CERRAR SESIÓN
            </a>
        </div>

    </div>
</nav>

<style>
    /* --- CONFIGURACIÓN ESTRUCTURAL FORZADA CON FLEXBOX --- */
    
    .navbar-modern {
        background-color: #aabeec !important; /* Fondo azul oscuro profundo */
        padding: 0.6rem 1.5rem;
        border-bottom: 1px solid #303238;
        width: 100%;
        box-sizing: border-box;
    }

    /* Contenedor principal que distribuye las 3 zonas */
    .nav-container-flex {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important; /* Empuja la derecha al extremo */
        width: 100%;
    }

    /* Evitar que Bootstrap viejo meta viñetas o estilos de lista */
    .nav-center-content, .nav-right-content {
        display: flex !important;
        align-items: center !important;
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Alineación central de los elementos de menú */
    .nav-center-content {
        flex-grow: 1;
        margin-left: 2rem !important;
        gap: 15px; /* Espacio limpio entre Inicio y Usuario */
    }

    /* Brand / Logo */
    .nav-brand-modern {
        display: flex !important;
        align-items: center !important;
        text-decoration: none !important;
    }

    .logo-wrapper {
        background: #fff;
        padding: 3px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
    }

    .navbar-logo {
        height: 38px;
        width: auto;
        display: block;
    }

    .brand-text-wrapper {
        display: flex;
        flex-direction: column;
        line-height: 1.2;
    }

    .brand-text-top {
        font-weight: 700;
        color: #f8fafc;
        font-size: 1.1rem;
    }

    .brand-text-sub {
        font-size: 0.72rem;
        color: #38bdf8;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Enlace de Inicio */
    .nav-link-modern {
        color: #94a3b8 !important;
        font-weight: 500 !important;
        font-size: 0.95rem;
        padding: 0.5rem 1rem !important;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
    }

    .active-modern, .nav-link-modern:hover {
        color: #f8fafc !important;
        background-color: #d88fd2 !important;
        border-radius: 6px;
    }

    /* Información de Usuario */
    .nav-user-info-modern {
        color: #e2e8f0;
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        border-left: 1px solid #bdd2f0; /* Línea divisoria elegante */
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .text-accent {
        color: #38bdf8;
    }

    .text-muted-modern {
        color: #64748b;
    }

    .user-name-text {
        color: #f1f5f9;
        font-weight: 600;
    }

    /* Botón de Cerrar Sesión (A la extrema derecha fijo) */
    .btn-logout-modern {
        color: #f1f5f9 !important;
        background-color: #b47db0 !important; /* Rojo moderno plano */
        border-radius: 6px !important;
        font-weight: 600 !important;
        font-size: 0.9rem !important;
        padding: 0.5rem 1.2rem !important;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.2);
        transition: all 0.2s ease;
    }

    .btn-logout-modern:hover {
        background-color: #6de65d !important;
        transform: translateY(-1px);
    }
</style>