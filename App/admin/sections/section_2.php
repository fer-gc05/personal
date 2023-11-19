<?php include ("../templates/header.php");?>
<div id="content" class="container-fluid p-5">
<div class="btn-group dropright">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
    Tablas
  </button>
  <div class="dropdown-menu">
    <button class="dropdown-item" type="button">Cliente</button>
    <button class="dropdown-item" type="button">Compra</button>
    <button class="dropdown-item" type="button">Empleado</button>
    <button class="dropdown-item" type="button">Venta</button>
    <button class="dropdown-item" type="button">Vende</button>
    <button class="dropdown-item" type="button">Producto</button>
    <button class="dropdown-item" type="button">Proveedor</button>
    <button class="dropdown-item" type="button">Suministra</button>
  </div>
</div>
<section class="py-3">
<div class="row mb-3">
            <div class="table-responsive" class= "asynchronous">
               <div id ="Cliente"></div>
               <div id ="Compra"></div>
               <div id ="Empleado"></div>
               <div id ="Venta "></div>
               <div id ="Vende"></div>
               <div id ="Producto"></div>
               <div id ="Proveedor"></div>
               <div id ="Suministra"></div>
                
            </div>
        </div>

</section>
</div>
<?php include ("../templates/footer.php");?>