<?php
session_start();
if (empty($_SESSION['Id'])) {
    header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda M&M</title>
    <link  href="../styles/header_stely.css" rel="stylesheet">
    <link href="../../libreries/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../../libreries/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>

    <div class="d-flex" id="content-wrapper">
        <div id="sidebar-container" class="bg-light border-right">
            <div class="logo">
                <h4 class="font-weight-bold mb-0">Tienda M&M</h4>
            </div>
            <div class="menu list-group-flush">
                <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0"><i
                        class='bx bx-grid-alt lead mr-2'></i> Tablero</a>
                <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0"><i
                        class='bx bxs-cart-add lead mr-2'></i> Ventas</a>
                <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0"><i
                        class='bx bxs-cart-download lead mr-2'></i> Compras</a>
                <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0"><i
                        class='bx bx-calendar lead mr-2'></i> Estadisticas</a>
                <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0"><i
                        class='bx bx-receipt lead mr-2'></i> Facturas</a>
                <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0"> <i
                        class='bx bx-cog lead mr-2'></i> Configuración</a>
            </div>
        </div>
        <div id="page-content-wrapper" class="w-100 bg-light-blue">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container">
                    <button class="btn btn-secundary text-primary" id="menu-toggle">Menú <i
                            class='bx bxs-category bx-flip-horizontal lead mr-2'></i></button>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $_SESSION['Nombre']; ?>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="../config/logout.php">Cerrar sesión</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>