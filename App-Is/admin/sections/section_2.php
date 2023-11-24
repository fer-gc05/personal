<?php include ("../templates/header.php");?>

<div id="content" class="container-fluid p-5">
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
    <section class="py-3">
        <div class="row mb-3">
            <div class="table-responsive" id="asynchronous">
                

            </div>
        </div>
    </section>
</div>

<?php include ("../templates/footer.php"); ?>