<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda M&M - Categorías</title>
    <link href="../../libreries/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../../libreries/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div id="categorias">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>

                            <th>Nombre</th>
                            <th>Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="shadow-sm" v-for="(categoria, indice) of categorias">

                            <td>{{ categoria.Nombre }}</td>
                            <td>{{ categoria.Descripcion }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button @click="btnEditar(categoria.Id, categoria.Nombre, categoria.Descripcion)"
                                        class="btn btn-secondary" title="Editar">
                                        <i class='bx bx-edit-alt'></i>
                                    </button>
                                    <button @click="btnEliminar(categoria.Id)" class="btn btn-danger" title="Eliminar">
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
    var urlCategorias = "../config/bd/category.php";
    var appCategorias = new Vue({
        el: "#categorias",
        data: {
            categorias: [],
            Id: "",
            Nombre: "",
            Descripcion: ""
        },
        methods: {
            mostrar: function() {
                axios.post(urlCategorias, {
                    opcion: 4
                }).then(response => {
                    this.categorias = response.data;
                    console.log(this.categorias);
                });
            },

            insertar: function() {
                axios.post(urlCategorias, {
                    opcion: 1,
                    Nombre: this.Nombre,
                    Descripcion: this.Descripcion
                }).then(response => {
                    this.mostrar();
                });

                this.Nombre = "";
                this.Descripcion = "";
            },

            editar: function(Id, Nombre, Descripcion) {
                axios.post(urlCategorias, {
                    opcion: 2,
                    Id: Id,
                    Nombre: Nombre,
                    Descripcion: Descripcion
                }).then(response => {
                    this.mostrar();
                });
            },

            eliminar: function(Id) {
                axios.post(urlCategorias, {
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
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Nombre de la categoría</label><div class="col-sm-7"><input id="nombre" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Descripción de la categoría</label><div class="col-sm-7"><input id="descripcion" type="text" class="form-control" /></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonColor: '#3085d6',
                    preConfirm: () => {
                        const nombre = document.getElementById('nombre').value;
                        const descripcion = document.getElementById('descripcion').value;

                        if (!nombre || !descripcion) {
                            Swal.showValidationMessage('Por favor, completa todos los campos.');
                        }

                        return [this.Nombre = nombre, this.Descripcion = descripcion];
                    }
                });

                if (this.Nombre && this.Descripcion) {
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

            btnEditar: async function(Id, Nombre, Descripcion) {
                await Swal.fire({
                    title: 'EDITAR',
                    html: '<div class="form-group"><div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input id="nombre" value="' +
                        Nombre +
                        '" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Descripción</label><div class="col-sm-7"><input id="descripcion" value="' +
                        Descripcion +
                        '" type="text" class="form-control"></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        Nombre = document.getElementById('nombre').value;
                        Descripcion = document.getElementById('descripcion').value;

                        this.editar(Id, Nombre, Descripcion);
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