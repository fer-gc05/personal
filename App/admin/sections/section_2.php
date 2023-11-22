<?php include ("../templates/header.php");?>
<div id="content" class="container-fluid p-5">
    <div class="btn-group dropright">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
            aria-expanded="false">Tablas</button>
        <div class="dropdown-menu">
            <button class="dropdown-item" id="B-cl" type="button">Cliente</button>
            <button class="dropdown-item" id="B-cr" type="button">Compra</button>
            <button class="dropdown-item" id="B-e" type="button">Empleado</button>
            <button class="dropdown-item" id="B-v" type="button">Venta</button>
            <button class="dropdown-item" id="B-ve" type="button">Vende</button>
            <button class="dropdown-item" id="B-p" type="button">Producto</button>
            <button class="dropdown-item" id="B-pr" type="button">Proveedor</button>
            <button class="dropdown-item" id="B-s" type="button">Suministra</button>
        </div>
    </div>
    <section class="py-3">
        <div class="row mb-3">
            <div class="table-responsive" id="asynchronous">
                <div id="clients-template-tabla"><?php include ("../templates/clients-template.php");?></div>
                <div id="buy-template-tabla"><?php include ("../templates/buy-template.php");?></div>
                <div id="staff-template-tabla"><?php include ("../templates/staff-template.php");?></div>
                <div id="sales-template-tabla"><?php include ("../templates/buy-sales.php");?></div>
                <div id="sell-template-tabla"><?php include ("../templates/sell-template.php");?></div>
                <div id="products-template-tabla"><?php include ("../templates/products-template.php");?></div>
                <div id="provider-template-tabla"><?php include ("../templates/provider-template.php");?></div>
                <div id="supply-template-tabla"><?php include ("../templates/supply-template.php");?></div>
            </div>
        </div>
    </section>
</div>
<?php include ("../templates/footer.php");?>