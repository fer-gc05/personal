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

            <!-- Resto de tu contenido -->

        </div>
    </div>

    <script src="../../libreries/bootstrap/bootstrap.min.js"></script>
    <script src="../../libreries/jquery/jquery-3.7.1.min.js"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#content-wrapper").toggleClass("toggled");
    });
    </script>
</body>

</html>