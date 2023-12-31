<?php include "../templates/header.php"; ?>
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

    <div class="btn-group dropright">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Tablas
        </button>
        <div class="dropdown-menu">
            <button class="dropdown-item" type="button" onclick="showTable('clients')">Clientes</button>
            <button class="dropdown-item" type="button" onclick="showTable('categories')">Categorías</button>
            <button class="dropdown-item" type="button" onclick="showTable('products')">Productos</button>
            <button class="dropdown-item" type="button" onclick="showTable('staff')">Empleados</button>
            <button class="dropdown-item" type="button" onclick="showTable('invoice_detail')">Detalle factura</button>
            <button class="dropdown-item" type="button" onclick="showTable('suppliers')">Proveedores</button>
        </div>
    </div>
    <section class="py-3">
        <div class="row mb-3">
            <div class="table-responsive" id="asynchronous">
                <div id="clientsTable" style="display: none;"><?php include "../templates/clients-template.php"; ?>
                </div>
                <div id="categoriesTable" style="display: none;"><?php include "../templates/category-template.php"; ?>
                </div>
                <div id="productsTable" style="display: none;"><?php include "../templates/products-template.php"; ?>
                </div>
                <div id="staffTable" style="display: none;"><?php include "../templates/staff-template.php"; ?></div>
                <div id="invoiceDetailTable" style="display: none;">
                    <?php include "../templates/invoice_detail-template.php"; ?></div>
                <div id="suppliersTable" style="display: none;"><?php include "../templates/suppliers-template.php"; ?>
                </div>
            </div>
        </div>
    </section>

<?php include "../templates/footer.php"; ?>