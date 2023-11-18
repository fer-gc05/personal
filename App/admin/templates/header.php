<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda M&M</title>
    <link rel="stylesheet" href="../styles/header_stely.css">
    <link rel="stylesheet" href="../styles/main_stely.css">
    <link rel="stylesheet" href="../../libreries/bootstrap/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <div class="d-flex" id="content-wrapper">
        <div id="sidebar-container" class="bg-light border-right">
            <div class="logo">
                <h4 class="font-weight-bold mb-0">Tienda M&M</h4>
            </div>
            <div class="menu list-group-flush">
                <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0"><i
                        class="icon ion-md-apps lead mr-2"></i> Tablero</a>
                <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0"><i
                        class="icon ion-md-people lead mr-2"></i> Usuarios</a>
                <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0"><i
                        class="icon ion-md-stats lead mr-2"></i> Estadísticas</a>
                <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0"><i
                        class="icon ion-md-calendar lead mr-2"></i> Eventos</a>
                <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0"><i
                        class="icon ion-md-person lead mr-2"></i> Perfil</a>
                <a href="#" class="list-group-item list-group-item-action text-muted bg-light p-3 border-0"> <i
                        class="icon ion-md-settings lead mr-2"></i> Configuración</a>
            </div>
        </div>
        <div id="page-content-wrapper" class="w-100 bg-light-blue">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container">
                    <button class="btn btn-primary text-primary" id="menu-toggle">Mostrar / esconder menu</button>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item active">
                                <a class="nav-link text-dark" href="#">Inicio</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Diego
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">Mi perfil</a>
                                    <a class="dropdown-item" href="#">Suscripciones</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Cerrar sesión</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
