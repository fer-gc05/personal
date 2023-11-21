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
        <div id="supply">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Codigo del Producto</th>
                            <th>Codigo del Proveedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="shadow-sm" v-for="(suministro,indice) of suministros">
                            <td>{{suministro.Codigo_p}}</td>
                            <td>{{suministro.Codigo_pro}}</td>
                            <td>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button @click="btnEditar" class="btn btn-secondary" title="Editar"><i
                                            class='bx bx-edit-alt'></i></button>
                                    <button @click="btnEliminar" class="btn btn-danger" title="Eliminar"><i
                                            class='bx bx-trash-alt'></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="col">
                    <button @click="btnInsertar" class="btn btn-success" title="Nuevo"><i class='bx bxs-save'></i></button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
    <script src="../../libreries/jquery/jquery-3.3.1.min.js"></script>
    <script src="../../libreries/bootstrap/bootstrap.min.js"></script>

    <script>
    var url = "../config/bd/supply.php";
    var app = new Vue({
        el: "#supply",
        data: {
            suministros: [],
            Codigo_p: "",
            Codigo_pro: "",
        },

        methods: {
            mostrar: function() {
                axios.post(url, {
                    opcion: 4
                }).then(response => {
                    this.suministros = response.data;
                    console.log(this.suministros)
                });
            },

            insertar: function() {
                axios.post(url, {
                    opcion: 1,
                    Codigo_p: this.Codigo_p,
                    Codigo_pro: this.Codigo_pro
                }).then(response => {
                    this.mostrar();
                });
                this.Codigo_p = "",
                    this.Codigo_pro = ""
            },

            editar: function(Codigo_p, Codigo_pro) {
                axios.post(url, {
                    opcion: 2,
                    Codigo_p: Codigo_p,
                    Codigo_pro: Codigo_pro
                }).then(response => {
                    this.mostrar();
                });
            },

            borrar: function(Codigo_p) {
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
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Codigo del Producto</label><div class="col-sm-7"><input id="producto" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Codigo de Proveedor</label><div class="col-sm-7"><input id="proveedor" type="text" class="form-control" /></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonColor: '#3085d6',
                    preConfirm: () => {
                        return [
                            this.Codigo_p = document.getElementById('producto').value,
                            this.Codigo_pro = document.getElementById('proveedor').value
                        ]
                    }
                })
                if (this.Codigo_p == "" || this.Codigo_pro == "") {
                    Swal.fire({
                        type: 'info',
                        title: 'Datos incompletos',
                    })
                } else {
                    this.mostrar();
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

            btnEditar: async function(Codigo_p, Codigo_pro) {
                await Swal.fire({
                    title: 'Editar registro',
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Codigo del Producto</label><div class="col-sm-7"><input id="producto" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Codigo de Proveedor</label><div class="col-sm-7"><input id="proveedor" type="text" class="form-control" /></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        Codigo_p = document.getElementById('producto').value,
                            Codigo_pro = document.getElementById('proveedor').value,

                            this.editar(Codigo_p, Codigo_pro);
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
                    title: '¿Está seguro de borrar este registro', 
                        type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.value) {
                        this.borrar(Codigo_p);
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