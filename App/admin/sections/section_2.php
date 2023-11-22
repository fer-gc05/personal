<?php include ("../templates/header.php");?>
<div id="content" class="container-fluid p-5">
    <div class="btn-group dropright">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
            aria-expanded="false">Tablas</button>
        <div class="dropdown-menu">
            <button class="dropdown-item" id="B-cl" type="button">Cliente</button>
            <button class="dropdown-item" id="B-o" type="button">Compra</button>
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

            </div>
        </div>

    </section>
</div>
<?php include ("../templates/footer.php");?>