<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda M&M - Productos</title>
    <link href="../../libreries/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../../libreries/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div id="productos">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>

                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Existencia</th>
                            <th>Categoria</th>
                            <th>Proveedor</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="shadow-sm" v-for="(producto, index) of productos">

                            <td>{{ producto.Nombre }}</td>
                            <td>{{ producto.Precio }}</td>
                            <td>{{ producto.Existencia }}</td>
                            <td>{{ producto.Categoria }}</td>
                            <td>{{ producto.Proveedor }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button
                                        @click="btnEditar(producto.Id, producto.Nombre, producto.Precio, producto.Existencia, producto.Categoria, producto.Proveedor)"
                                        class="btn btn-secondary" title="Editar">
                                        <i class='bx bx-edit-alt'></i>
                                    </button>
                                    <button @click="btnEliminar(producto.Id)" class="btn btn-danger" title="Eliminar">
                                        <i class='bx bx-trash-alt'></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="col">
                    <button @click="btnInsertar" class="btn btn-success" title="Nuevo"><i
                            class='bx bxs-save'></i></button>
                </div>
            </div>
        </div>
    </div>

    <script src="../../libreries/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="../../libreries/Popper/popper.min.js"></script>
    <script src="../../libreries/Vue/vue.js"></script>
    <script src="../../libreries/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../libreries/Axios/axios.js"></script>
    <script src="../../libreries/bootstrap/bootstrap.min.js"></script>

    <script>
    var url = "../config/bd/products.php";

    var appProductos = new Vue({
        el: "#productos",
        data: {
            productos: [],
            Id: "",
            Nombre: "",
            Precio: "",
            Existencia: "",
            Categoria: "",
            Proveedor: "",
        },
        methods: {
            mostrar: function() {
                axios.post(url, {
                    opcion: 4
                }).then(response => {
                    this.productos = response.data;
                    console.log(this.productos);
                });
            },

            insertar: function() {
                axios.post(url, {
                    opcion: 1,
                    Nombre: this.Nombre,
                    Precio: this.Precio,
                    Existencia: this.Existencia,
                    Categoria: this.Categoria,
                    Proveedor: this.Proveedor
                }).then(response => {
                    this.mostrar();
                });

                this.Nombre = "";
                this.Precio = "";
                this.Existencia = "";
                this.Categoria = "";
                this.Proveedor = "";
            },

            editar: function(Id, Nombre, Precio, Existencia, Categoria, Proveedor) {
                axios.post(url, {
                    opcion: 2,
                    Id: Id,
                    Nombre: Nombre,
                    Precio: Precio,
                    Existencia: Existencia,
                    Categoria: Categoria,
                    Proveedor: Proveedor
                }).then(response => {
                    this.mostrar();
                });
            },

            eliminar: function(Id) {
                axios.post(url, {
                    opcion: 3,
                    Id: Id
                }).then(response => {
                    this.mostrar();
                });
            },

            btnInsertar: async function() {
                const {
                    value: formValues
                } = await Swal.fire({
                    title: 'NUEVO',
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input id="nombre" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Precio</label><div class="col-sm-7"><input id="precio" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Existencia</label><div class="col-sm-7"><input id="existencia" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Categoria</label><div class="col-sm-7"><input id="categoria" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Proveedor</label><div class="col-sm-7"><input id="proveedor" type="text" class="form-control" /></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonColor: '#3085d6',
                    preConfirm: () => {
                        const nombre = document.getElementById('nombre').value;
                        const precio = document.getElementById('precio').value;
                        const existencia = document.getElementById('existencia').value;
                        const categoria = document.getElementById('categoria').value;
                        const proveedor = document.getElementById('proveedor').value;

                        if (!nombre || !precio || !existencia || !categoria || !proveedor) {
                            Swal.showValidationMessage('Por favor, completa todos los campos.');
                        }

                        return [this.Nombre = nombre, this.Precio = precio, this.Existencia =
                            existencia, this.Categoria = categoria, this.Proveedor =
                            proveedor
                        ];
                    }
                });

                if (this.Nombre && this.Precio && this.Existencia && this.Categoria && this.Proveedor) {
                    this.insertar();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        type: 'success',
                        title: '¡Datos agregados!'
                    });
                }
            },

            btnEditar: async function(Id, Nombre, Precio, Existencia, Categoria, Proveedor) {
                await Swal.fire({
                    title: 'EDITAR',
                    html: '<div class="form-group"><div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input id="nombre" value="' +
                        Nombre +
                        '" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Precio</label><div class="col-sm-7"><input id="precio" value="' +
                        Precio +
                        '" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Existencia</label><div class="col-sm-7"><input id="existencia" value="' +
                        Existencia +
                        '" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Categoria</label><div class="col-sm-7"><input id="categoria" value="' +
                        Categoria +
                        '" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Proveedor</label><div class="col-sm-7"><input id="proveedor" value="' +
                        Proveedor +
                        '" type="text" class="form-control"></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        const nombre = document.getElementById('nombre').value;
                        const precio = document.getElementById('precio').value;
                        const existencia = document.getElementById('existencia').value;
                        const categoria = document.getElementById('categoria').value;
                        const proveedor = document.getElementById('proveedor').value;

                        this.editar(Id, nombre, precio, existencia, categoria, proveedor);
                        Swal.fire(
                            '¡Actualizado!',
                            'El registro ha sido actualizado.',
                            'success'
                        )
                    }
                });

            },

            btnEliminar: async function(Id) {
                Swal.fire({
                    title: '¿Está seguro de borrar este registro?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value) {
                        this.eliminar(Id);
                        Swal.fire(
                            '¡Eliminado!',
                            'El registro ha sido borrado.',
                            'success'
                        );
                    }
                });
            }
        },
        created: function() {
            this.mostrar();
        },
        computed: {}
    });
    </script>

</body>

</html>