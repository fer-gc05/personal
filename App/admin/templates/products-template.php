<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda M&M</title>
    <link href="../../libreries/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="container">
        <div id="products">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Categoria</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="shadow-sm" v-for="(producto, indice) of productos">
                            <td>{{producto.Codigo_p}}</td>
                            <td>{{producto.Nombre}}</td>
                            <td>{{producto.Precio}}</td>
                            <td>{{producto.Categoria}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button
                                        @click="btnEditar(producto.Codigo_p, producto.Nombre, producto.Precio, producto.Categoria)"
                                        class="btn btn-secondary" title="Editar">
                                        <i class='bx bx-edit-alt'></i>
                                    </button>
                                    <button @click="btnEliminar(producto.Codigo_p)" class="btn btn-danger"
                                        title="Eliminar">
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@0.23.0/dist/axios.min.js"></script>
    <script src="../../libreries/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../libreries/bootstrap/bootstrap.min.js"></script>

    <script>
    var url = "../config/bd/products.php";
    var app = new Vue({
        el: "#products",
        data: {
            productos: [],
            Codigo_p: "",
            Nombre: "",
            Precio: "",
            Categoria: "",
        },
        methods: {
            mostrar: function() {
                axios.post(url, {
                    opcion: 4
                }).then(response => {
                    this.productos = response.data;
                    console.log(this.productos)
                });
            },

            insertar: function() {
                axios.post(url, {
                    opcion: 1,
                    Codigo_p: this.Codigo_p,
                    Nombre: this.Nombre,
                    Precio: this.Precio,
                    Categoria: this.Categoria
                }).then(response => {
                    this.mostrar();
                });
                this.Codigo_p = "",
                    this.Nombre = "",
                    this.Precio = "",
                    this.Categoria = ""
            },

            editar: function(Codigo_p, Nombre, Precio, Categoria) {
                axios.post(url, {
                    opcion: 2,
                    Codigo_p: Codigo_p,
                    Nombre: Nombre,
                    Precio: Precio,
                    Categoria: Categoria
                }).then(response => {
                    this.mostrar();
                });
            },

            eliminar: function(Codigo_p) {
                axios.post(url, {
                    opcion: 3,
                    Codigo_p: Codigo_p
                }).then(response => {
                    this.mostrar();
                });
            },

            btnInsertar: async function() {
                const {
                    value: formValues
                } = await Swal.fire({
                    title: 'NUEVO',
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Codigo</label><div class="col-sm-7"><input id="codigo" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input id="nombre" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Precio</label><div class="col-sm-7"><input id="precio" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Categoria</label><div class="col-sm-7"><input id="categoria" type="text" class="form-control" /></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonColor: '#3085d6',
                    preConfirm: () => {
                        return [
                            this.Codigo_p = document.getElementById('codigo').value,
                            this.Nombre = document.getElementById('nombre').value,
                            this.Precio = document.getElementById('precio').value,
                            this.Categoria = document.getElementById('categoria').value
                        ]
                    }
                })
                if (this.Codigo_p == "" || this.Nombre == "" || this.Precio == "" || this.Categoria == "") {
                    Swal.fire({
                        type: 'info',
                        title: 'Datos incompletos',
                    })
                } else {
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
                    })
                }
            },

            btnEditar: async function(Codigo_p, Nombre, Precio, Categoria) {
                await Swal.fire({
                    title: 'Editar registro',
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input id="nombre" type="text" class="form-control" value="' +
                        Nombre +
                        '" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Precio</label><div class="col-sm-7"><input id="precio" type="text" class="form-control" value="' +
                        Precio +
                        '" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Categoria</label><div class="col-sm-7"><input id="categoria" type="text" class="form-control" value="' +
                        Categoria + '" /></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        Nombre = document.getElementById('nombre').value,
                            Precio = document.getElementById('precio').value,
                            Categoria = document.getElementById('categoria').value,
                            this.editar(Codigo_p, Nombre, Precio, Categoria);
                        Swal.fire(
                            '¡Actualizado!',
                            'El registro ha sido actualizado.',
                            'success'
                        )
                    }
                })
            },

            btnEliminar: async function(Codigo_p) {
                Swal.fire({
                    title: '¿Está seguro de borrar este registro?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value) {
                        this.eliminar(Codigo_p); // Cambiado de this.borrar a this.eliminar
                        Swal.fire(
                            '¡Eliminado!',
                            'El registro ha sido borrado.',
                            'success'
                        )
                    }
                })
            }
        },
        created: function() {
            this.mostrar();
        },
        computed: {

        }
    });
    </script>

</body>

</html>