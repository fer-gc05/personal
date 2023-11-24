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
        <div id="sells">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Codigo empleado</th>
                            <th>Codigo Producto</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="shadow-sm" v-for="(venta,indice) of ventas">
                            <td>{{venta.Codigo_E}}</td>
                            <td>{{venta.Codigo_p}}</td>
                            <td>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button @click="btnEditar(venta.Codigo_E, venta.Codigo_p)" class="btn btn-secondary"
                                        title="Editar"><i class='bx bx-edit-alt'></i></button>
                                    <button @click="btnEliminar(venta.Codigo_E)" class="btn btn-danger"
                                        title="Eliminar"><i class='bx bx-trash-alt'></i></button>
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
    var url = "../config/bd/sell.php";
    var app = new Vue({
        el: "#sells",
        data: {
            ventas: [],
            Codigo_E: "",
            Codigo_p: "",
        },
        methods: {
            mostrar: function() {
                axios.post(url, {
                    opcion: 4
                }).then(response => {
                    this.ventas = response.data;
                    console.log(this.ventas)
                });
            },

            insertar: function() {
                axios.post(url, {
                    opcion: 1,
                    Codigo_p: this.Codigo_p,
                    Codigo_E: this.Codigo_E
                }).then(response => {
                    this.mostrar();
                });
                this.Codigo_p = "",
                    this.Codigo_E = ""
            },

            editar: function(Codigo_E, Codigo_p) {
                axios.post(url, {
                    opcion: 2,
                    Codigo_p: Codigo_p,
                    Codigo_E: Codigo_E
                }).then(response => {
                    this.mostrar();
                });
            },

            eliminar: function($Codigo_E) {
                axios.post(url, {
                    opcion: 3,
                    Codigo_E: $Codigo_E
                }).then(response => {
                    this.mostrar();
                });
            },

            btnInsertar: async function() {
                const {
                    value: formValues
                } = await Swal.fire({
                    title: 'NUEVO',
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Codigo empleado</label><div class="col-sm-7"><input id="codigo_e" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Codigo de producto</label><div class="col-sm-7"><input id="codigo_p" type="text" class="form-control" /></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonColor: '#3085d6',
                    preConfirm: () => {
                        return [
                            this.Codigo_p = document.getElementById('codigo_p').value,
                            this.Codigo_E = document.getElementById('codigo_e').value
                        ]
                    }
                })
                if (this.Codigo_p == "" || this.Codigo_E == "") {
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

            btnEditar: async function(Codigo_E, Codigo_p) {
                await Swal.fire({
                    title: 'Editar registro',
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Codigo empleado</label><div class="col-sm-7"><input id="codigo_e" type="text" class="form-control" value="' +
                        Codigo_E +
                        '" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Codigo producto</label><div class="col-sm-7"><input id="codigo_p" type="text" class="form-control" value="' +
                        Codigo_p +
                        '" /></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        Codigo_E = document.getElementById('codigo_e').value,
                            Codigo_p = document.getElementById('codigo_p').value,
                            this.editar(Codigo_p, Codigo_E);
                        Swal.fire(
                            '¡Actualizado!',
                            'El registro ha sido actualizado.',
                            'success'
                        )
                    }
                })
            },

            btnEliminar: async function(Codigo_E) {
                Swal.fire({
                    title: '¿Está seguro de borrar este registro?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value) {
                        this.eliminar(Codigo_E);
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