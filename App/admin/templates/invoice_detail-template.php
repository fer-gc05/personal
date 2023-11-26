<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda M&M - Detalle Factura</title>
    <link href="../../libreries/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../../libreries/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div id="detalleFactura">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>

                            <th>Factura</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="shadow-sm" v-for="(detalle, index) of detalleFactura">

                            <td>{{ detalle.Factura }}</td>
                            <td>{{ detalle.Producto }}</td>
                            <td>{{ detalle.Cantidad }}</td>
                            <td>{{ detalle.Total }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button
                                        @click="btnEditar(detalle.Id, detalle.Factura, detalle.Producto, detalle.Cantidad, detalle.Total)"
                                        class="btn btn-secondary" title="Editar">
                                        <i class='bx bx-edit-alt'></i>
                                    </button>
                                    <button @click="btnEliminar(detalle.Id)" class="btn btn-danger" title="Eliminar">
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
    var url = "../config/bd/invoice_detail.php"

    var appDetalleFactura = new Vue({
        el: "#detalleFactura",
        data: {
            detalleFactura: [],
            Id: "",
            Factura: "",
            Producto: "",
            Cantidad: "",
            Total: "",
        },
        methods: {
            mostrar: function() {
                axios.post(url, {
                    opcion: 4
                }).then(response => {
                    this.detalleFactura = response.data;
                    console.log(this.detalleFactura);
                });
            },

            insertar: function() {
                axios.post(url, {
                    opcion: 1,
                    Factura: this.Factura,
                    Producto: this.Producto,
                    Cantidad: this.Cantidad,
                    Total: this.Total
                }).then(response => {
                    this.mostrar();
                });

                this.Factura = "";
                this.Producto = "";
                this.Cantidad = "";
                this.Total = "";
            },

            editar: function(Id, Factura, Producto, Cantidad, Total) {
                axios.post(url, {
                    opcion: 2,
                    Id: Id,
                    Factura: Factura,
                    Producto: Producto,
                    Cantidad: Cantidad,
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
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Factura</label><div class="col-sm-7"><input id="factura" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Producto</label><div class="col-sm-7"><input id="producto" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Cantidad</label><div class="col-sm-7"><input id="cantidad" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Total</label><div class="col-sm-7"><input id="total" type="text" class="form-control" /></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonColor: '#3085d6',
                    preConfirm: () => {
                        const factura = document.getElementById('factura').value;
                        const producto = document.getElementById('producto').value;
                        const cantidad = document.getElementById('cantidad').value;
                        const total = document.getElementById('total').value;

                        if (!factura || !producto || !cantidad || !total) {
                            Swal.showValidationMessage('Por favor, completa todos los campos.');
                        }

                        return [this.Factura = factura, this.Producto = producto, this
                            .Cantidad = cantidad, this.Total = total
                        ];
                    }
                });

                if (this.Factura && this.Producto && this.Cantidad && this.Total) {
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

            btnEditar: async function(Id, Factura, Producto, Cantidad, Total) {
                const {
                    value: formValues
                } = await Swal.fire({
                    title: 'EDITAR',
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Factura</label><div class="col-sm-7"><input id="factura" value="' +
                        Factura +
                        '" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Producto</label><div class="col-sm-7"><input id="producto" value="' +
                        Producto +
                        '" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Cantidad</label><div class="col-sm-7"><input id="cantidad" value="' +
                        Cantidad +
                        '" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Total</label><div class="col-sm-7"><input id="total" value="' +
                        Total + '" type="text" class="form-control" /></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        const factura = document.getElementById('factura').value;
                        const producto = document.getElementById('producto').value;
                        const cantidad = document.getElementById('cantidad').value;
                        const total = document.getElementById('total').value;

                        this.editar(Id, factura, producto, cantidad, total);
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