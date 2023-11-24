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
        <div id="sales">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Fecha</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="shadow-sm" v-for="(venta,indice) of ventas">
                            <td>{{venta.Id}}</td>
                            <td>{{venta.Fecha}}</td>
                            <td>{{venta.Total}}</td>
                            <td>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button @click="btnEditar(venta.Id, venta.Fecha, venta.Total)"
                                        class="btn btn-secondary" title="Editar">
                                        <i class='bx bx-edit-alt'></i>
                                    </button>
                                    <button @click="btnEliminar(venta.Id)" class="btn btn-danger" title="Eliminar">
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
    var url = "../config/bd/sales.php";
    var app = new Vue({
        el: "#sales",
        data: {
            ventas: [],
            Id: "",
            Fecha: "",
            Total: "",
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
                    Id: this.Id,
                    Fecha: this.Fecha,
                    Total: this.Total
                }).then(response => {
                    this.mostrar();
                });
                this.Id = "",
                    this.Fecha = "",
                    this.Total = ""
            },

            editar: function(Id, Fecha, Total) {
                axios.post(url, {
                    opcion: 2,
                    Id: Id,
                    Fecha: Fecha,
                    Total: Total
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
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Id</label><div class="col-sm-7"><input id="id" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Fecha</label><div class="col-sm-7"><input id="fecha" type="date" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Total</label><div class="col-sm-7"><input id="total" type="text" class="form-control" /></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonColor: '#3085d6',
                    preConfirm: () => {
                        return [
                            this.Id = document.getElementById('id').value,
                            this.Fecha = document.getElementById('fecha').value,
                            this.Total = document.getElementById('total').value
                        ]
                    }
                })
                if (this.Id == "" || this.Fecha == "" || this.Total == "") {
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

            btnEditar: async function(Id, Fecha, Total) {
                await Swal.fire({
                    title: 'Editar registro',
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Fecha</label><div class="col-sm-7"><input id="fecha" type="date" class="form-control" value="' +
                        Fecha +
                        '" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Total</label><div class="col-sm-7"><input id="total" type="text" class="form-control" value="' +
                        Total +
                        '" /></div></div>',

                    focusConfirm: false,
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        Fecha = document.getElementById('fecha').value,
                            Total = document.getElementById('total').value,
                            this.editar(Id, Fecha, Total);
                        Swal.fire(
                            '¡Actualizado!',
                            'El registro ha sido actualizado.',
                            'success'
                        )
                    }
                })
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