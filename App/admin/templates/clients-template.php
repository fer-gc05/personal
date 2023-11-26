<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda M&M</title>
    <link href="../../libreries/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../../libreries/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div id="clients">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="shadow-sm" v-for="(cliente, indice) of clientes">
                            <td>{{ cliente.Cedula }}</td>
                            <td>{{ cliente.Nombre }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button @click="btnEditar(cliente.Id, cliente.Cedula, cliente.Nombre)"
                                        class="btn btn-secondary" title="Editar">
                                        <i class='bx bx-edit-alt'></i>
                                    </button>
                                    <button @click="btnEliminar(cliente.Id)" class="btn btn-danger" title="Eliminar">
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
    var url = "../config/bd/clients.php";
    var app = new Vue({
        el: "#clients",
        data: {
            clientes: [],
            Id: "",
            Cedula: "",
            Nombre: "",
        },
        methods: {
            mostrar: function() {
                axios.post(url, {
                    opcion: 4
                }).then(response => {
                    this.clientes = response.data;
                    console.log(this.clientes);
                });
            },

            insertar: function() {
                axios.post(url, {
                    opcion: 1,
                    Cedula: this.Cedula,
                    Nombre: this.Nombre
                }).then(response => {
                    this.mostrar();
                });

                this.Cedula = "";
                this.Nombre = "";
            },

            editar: function(Id, Cedula, Nombre) {
                axios.post(url, {
                    opcion: 2,
                    Id: Id,
                    Cedula: Cedula,
                    Nombre: Nombre
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
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Cedula del cliente</label><div class="col-sm-7"><input id="cedula" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Nombre del cliente</label><div class="col-sm-7"><input id="nombre" type="text" class="form-control" /></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonColor: '#3085d6',
                    preConfirm: () => {
                        const cedula = document.getElementById('cedula').value;
                        const nombre = document.getElementById('nombre').value;

                        if (!cedula || !nombre) {
                            Swal.showValidationMessage('Por favor, completa todos los campos.');
                        }

                        return [this.Cedula = cedula, this.Nombre = nombre];
                    }
                });

                if (this.Cedula && this.Nombre) {
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

            btnEditar: async function(Id, Cedula, Nombre) {
                await Swal.fire({
                    title: 'EDITAR',
                    html: '<div class="form-group"><div class="row"><label class="col-sm-3 col-form-label">Cedula</label><div class="col-sm-7"><input id="cedula" value="' +
                        Cedula +
                        '" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input id="nombre" value="' +
                        Nombre +
                        '" type="text" class="form-control"></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        Cedula = document.getElementById('cedula').value,
                            Nombre = document.getElementById('nombre').value,

                            this.editar(Id, Cedula, Nombre);
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