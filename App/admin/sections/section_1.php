<?php include ("../templates/header.php");?>

<div id="content" class="container-fluid p-5">
    <section class="py-3">
        <div class="row">
            <div class="col-xl-3 col-lg-6">
                <div class="card mb-5 shadow-sm border-0 shadow-hover">
                    <div class="card-body d-flex">
                        <div>
                            <div class="circle rounded-circle bg-info align-self-center d-flex mr-3">
                                <i class='bx bxs-cart-add text-secundary align-self-center mx-auto lead'></i>
                            </div>
                        </div>
                        <div class="align-self-center">
                            <h5 class="mb-0">000</h5>
                            <small class="text-muted">Total de ventas</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card mb-5 shadow-sm border-0 shadow-hover">
                    <div class="card-body d-flex">
                        <div>
                            <div class="circle rounded-circle bg-info align-self-center d-flex mr-3">
                                <i class='bx bx-money text-secundary align-self-center mx-auto lead'></i>
                            </div>
                        </div>
                        <div class="align-self-center">
                            <h5 class="mb-0">0000</h5>
                            <small class="text-muted">Ganancias</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card mb-5 shadow-sm border-0 shadow-hover">
                    <div class="card-body d-flex">
                        <div>
                            <div class="circle rounded-circle bg-info align-self-center d-flex mr-3">
                                <i class='bx bx-money text-secundary align-self-center mx-auto lead'></i>
                            </div>
                        </div>
                        <div class="align-self-center">
                            <h5 class="mb-0">0000</h5>
                            <small class="text-muted">Gastos</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6">
                <div class="card mb-5 shadow-sm border-0 shadow-hover">
                    <div class="card-body d-flex">
                        <div>
                            <div class="circle rounded-circle bg-info align-self-center d-flex mr-3">
                                <i class='bx bx-user-circle text-secundary align-self-center mx-auto lead'></i>
                            </div>
                        </div>
                        <div class="align-self-center">
                            <h5 class="mb-0">0000</h5>
                            <small class="text-muted">Numero de clientes</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
        <div class="btn-group dropright">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Tablas
        </button>
        <div class="dropdown-menu">
            <button class="dropdown-item" type="button">Clientes</button>
            <button class="dropdown-item" type="button">Compras</button>
            <button class="dropdown-item" type="button">Empleados</button>
            <button class="dropdown-item" type="button">Productos</button>
            <button class="dropdown-item" type="button">Proveedores</button>
            <button class="dropdown-item" type="button">Suministra</button>
            <button class="dropdown-item" type="button">Vende</button>
            <button class="dropdown-item" type="button">Ventas</button>
        </div>
    </div>
    
    <div class="table-responsive" id="asynchronous">
                <?php include('../templates/clients-template.php')?>

            </div>
        </div>
    </section>
</div>

<?php include ("../templates/footer.php")?>