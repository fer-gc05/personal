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
        <div id="providers">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Telefono</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="shadow-sm" v-for="(proveedor,indice) of proveedores">
                            <td>{{proveedor.Codigo_pro}}</td>
                            <td>{{proveedor.Telefono}}</td>
                            <td>{{proveedor.Nombre}}</td>
                            <td>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button @click="btnEditar(proveedor.Codigo_pro,proveedor.Telefono,proveedor.Nombre)" class="btn btn-secondary" title="Editar"><i
                                            class='bx bx-edit-alt'></i></button>
                                    <button @click="btnEliminar(proveedor.Codigo_pro)" class="btn btn-danger" title="Eliminar"><i
                                            class='bx bx-trash-alt'></i></button>
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
    var url = "../config/bd/provider.php";
    var app = new Vue({
        el: "#providers",
        data: {
            proveedores: [],
            Codigo_pro: "",
            Telefono: "",
            Nombre: "",
        },
        methods: {
            mostrar: function() {
                axios.post(url, {
                    opcion: 4
                }).then(response => {
                    this.proveedores = response.data;
                    console.log(this.proveedores)
                });
            },

            insertar: function() {
                axios.post(url, {
                    opcion: 1,
                    Codigo_pro: this.Codigo_pro,
                    Telefono: this.Telefono,
                    Nombre: this.Nombre
                }).then(response => {
                    this.mostrar();
                });
                this.Codigo_pro = "",
                    this.Telefono = "",
                    this.Nombre = ""
            },

            editar: function(Codigo_pro, Telefono, Nombre) {
                axios.post(url, {
                    opcion: 2,
                    Codigo_pro: Codigo_pro,
                    Telefono: Telefono,
                    Nombre: Nombre
                }).then(response => {
                    this.mostrar();
                });
            },

            eliminar: function(Codigo_pro) {
                axios.post(url, {
                    opcion: 3,
                    Codigo_pro: Codigo_pro
                }).then(response => {
                    this.mostrar();
                });
            },

            btnInsertar: async function() {
                const {
                    value: formValues
                } = await Swal.fire({
                    title: 'NUEVO',
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Codigo</label><div class="col-sm-7"><input id="codigo" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">telefono</label><div class="col-sm-7"><input id="telefono" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input id="nombre" type="text" class="form-control" /></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonColor: '#3085d6',
                    preConfirm: () => {
                        return [
                            this.Codigo_pro = document.getElementById('codigo').value,
                            this.Nombre = document.getElementById('nombre').value,
                            this.Telefono = document.getElementById('telefono').value
                        ]
                    }
                })
                if (this.Codigo_pro == "" || this.Nombre == "" || this.Telefono == "") {
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

            btnEditar: async function(Codigo_pro, Telefono, Nombre) {
                await Swal.fire({
                    title: 'Editar registro',
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Telefono</label><div class="col-sm-7"><input id="telefono" type="text" class="form-control" value="' +
                        Telefono +
                        '" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input id="nombre" type="text" class="form-control" value="' +
                        Nombre +
                        '" /></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        Nombre = document.getElementById('nombre').value,
                            Telefono = document.getElementById('telefono').value
                        this.editar(Codigo_pro, Telefono, Nombre);
                        Swal.fire(
                            '¡Actualizado!',
                            'El registro ha sido actualizado.',
                            'success'
                        )
                    }
                })
            },

            btnEliminar: async function(Codigo_pro) {
                Swal.fire({
                    title: '¿Está seguro de borrar este registro?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value) {
                        this.eliminar(Codigo_pro);
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