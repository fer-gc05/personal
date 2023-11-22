<?php include ("../templates/header.php");?>

<div id="content" class="container-fluid p-5">
    <div class="btn-group dropright">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"
            aria-expanded="false">Tablas</button>
        <div class="dropdown-menu">
            <button class="dropdown-item" data-target="clients-template-tabla">Cliente</button>
            <button class="dropdown-item" data-target="buy-template-tabla">Compra</button>
            <button class="dropdown-item" data-target="staff-template-tabla">Empleado</button>
            <button class="dropdown-item" data-target="sales-template-tabla">Venta</button>
            <button class="dropdown-item" data-target="sell-template-tabla">Vende</button>
            <button class="dropdown-item" data-target="products-template-tabla">Producto</button>
            <button class="dropdown-item" data-target="provider-template-tabla">Proveedor</button>
            <button class="dropdown-item" data-target="supply-template-tabla">Suministra</button>
        </div>
    </div>
    <section class="py-3">
        <div class="row mb-3">
            <div class="table-responsive" id="asynchronous">
                <?php
                $tablaIds = array(
                    "clients-template-tabla",
                    "buy-template-tabla",
                    "staff-template-tabla",
                    "sales-template-tabla",
                    "sell-template-tabla",
                    "products-template-tabla",
                    "provider-template-tabla",
                    "supply-template-tabla"
                );

                foreach ($tablaIds as $tablaId) {
                    echo '<div id="' . $tablaId . '" style="display: none;">';
                    include ("../templates/" . str_replace("-tabla", "", $tablaId) . ".php");
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </section>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var dropdownItems = document.querySelectorAll('.dropdown-item');
    var tablaContainers = document.querySelectorAll('.table-responsive > div');

    tablaContainers.forEach(function(container) {
        container.style.display = 'none';
    });

    dropdownItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var target = item.getAttribute('data-target');

            tablaContainers.forEach(function(container) {
                container.style.display = 'none';
            });

            var selectedContainer = document.getElementById(target);
            if (selectedContainer) {
                selectedContainer.style.display = 'block';
            }
        });
    });
});
</script>

<?php include ("../templates/footer.php");?>