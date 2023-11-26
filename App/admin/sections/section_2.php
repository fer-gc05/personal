<?php include "../templates/header.php";?>

<div id="content" class="container-fluid p-5">
    <div class="btn-group dropright">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Tablas
        </button>
        <div class="dropdown-menu">
            <button class="dropdown-item" type="button">Clientes</button>
            <button class="dropdown-item" type="button">Categorias</button>
            <button class="dropdown-item" type="button">Productos</button>
            <button class="dropdown-item" type="button">Empleados</button>
            <button class="dropdown-item" type="button">Detalle factura</button>
            <button class="dropdown-item" type="button">Provedores</button>
            </div>
    </div>
    <section class="py-3">
        <div class="row mb-3">
            <div class="table-responsive" id="asynchronous">
            <?php include "../templates/clients-template.php"; ?>
            <?php include "../templates/category-template.php"; ?>
            <?php include "../templates/products-template.php"; ?>
            <?php include "../templates/staff-template.php"; ?>
            <?php include "../templates/invoice_detail-template.php"; ?>
            <?php include "../templates/clients-template.php"; ?>
            </div>
        </div>
    </section>
</div>

<?php include "../templates/footer.php"; ?>