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
        <div id="clients">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Identificacion</th>
                            <th>Nombre</th>
                            <th>Contacto</th>
                            <th>Direccion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="shadow-sm" v-for="(cliente,indice) of clientes">
                            <td>{{cliente.Id_c}}</td>
                            <td>{{cliente.Nombre}}</td>
                            <td>{{cliente.Contacto}}</td>
                            <td>{{cliente.Direccion}}</td>
                            <td>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button @click="btnEditar(cliente.Id_c, cliente.Nombre, cliente.Contacto, cliente.Direccion)"
                                        class="btn btn-secondary" title="Editar">
                                        <i class='bx bx-edit-alt'></i>
                                    </button>
                                    <button @click="btnEliminar(cliente.Id_c)" class="btn btn-danger" title="Eliminar">
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="../../libreries/bootstrap/bootstrap.min.js"></script>

    <script>
        var url = "../config/bd/clients.php";
        var app = new Vue({
            el: "#clients",
            data: {
                clientes: [],
                Id_c: "",
                Nombre: "",
                Contacto: "",
                Direccion: "",
            },
            methods: {
                mostrar: function () {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            opcion: 4
                        },
                        success: function (response) {
                            app.clientes = JSON.parse(response);
                            console.log(app.clientes);
                        }
                    });
                },

                insertar: function () {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            opcion: 1,
                            Id_c: this.Id_c,
                            Nombre: this.Nombre,
                            Contacto: this.Contacto,
                            Direccion: this.Direccion
                        },
                        success: function (response) {
                            app.mostrar();
                        }
                    });
                    this.Id_c = "";
                    this.Nombre = "";
                    this.Contacto = "";
                    this.Direccion = "";
                },

                editar: function (Id_c, Nombre, Contacto, Direccion) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            opcion: 2,
                            Id_c: Id_c,
                            Nombre: Nombre,
                            Contacto: Contacto,
                            Direccion: Direccion
                        },
                        success: function (response) {
                            app.mostrar();
                        }
                    });
                },

                borrar: function (Id_c) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            opcion: 3,
                            Id_c: Id_c
                        },
                        success: function (response) {
                            app.mostrar();
                        }
                    });
                },

                btnInsertar: async function () {
                    const { value: formValues } = await Swal.fire({
                        title: 'NUEVO',
                        html: '<div class="row"><label class="col-sm-3 col-form-label">Id del cliente</label><div class="col-sm-7"><input id="id" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Nombre del cliente</label><div class="col-sm-7"><input id="nombre" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Contacto</label><div class="col-sm-7"><input id="contacto" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Direccion</label><div class="col-sm-7"><input id="direccion" type="text" class="form-control" /></div></div>',
                        focusConfirm: false,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar',
                        confirmButtonColor: '#1cc88a',
                        cancelButtonColor: '#3085d6',
                        preConfirm: () => {
                            return [
                                this.Id_c = document.getElementById('id').value,
                                this.Nombre = document.getElementById('nombre').value,
                                this.Contacto = document.getElementById('contacto').value,
                                this.Direccion = document.getElementById('direccion').value
                            ];
                        }
                    });

                    if (this.Id_c == "" || this.Nombre == "" || this.Contacto == "" || this.Direccion == "") {
                        Swal.fire({
                            type: 'info',
                            title: 'Datos incompletos',
                        });
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
                        });
                    }
                },

                btnEditar: async function (Id_c, Nombre, Contacto, Direccion) {
                    await Swal.fire({
                        title: 'Editar registro',
                        html: '<div class="row"><label class="col-sm-3 col-form-label">Nombre del cliente</label><div class="col-sm-7"><input id="nombre" type="text" class="form-control" value="' +
                            Nombre +
                            '" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Contacto</label><div class="col-sm-7"><input id="contacto" type="text" class="form-control" value="' +
                            Contacto +
                            '" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Direccion</label><div class="col-sm-7"><input id="direccion" type="text" class="form-control" value="' +
                            Direccion + '" /></div></div>',
                        focusConfirm: false,
                        showCancelButton: true,
                    }).then((result) => {
                        if (result.value) {
                            Nombre = document.getElementById('nombre').value,
                                Contacto = document.getElementById('contacto').value,
                                Direccion = document.getElementById('direccion').value,
                                this.editar(Id_c, Nombre, Contacto, Direccion);
                            Swal.fire(
                                '¡Actualizado!',
                                'El registro ha sido actualizado.',
                                'success'
                            );
                        }
                    });
                },

                btnEliminar: async function (Id_c) {
                    Swal.fire({
                        title: '¿Está seguro de borrar este registro?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Eliminar'
                    }).then((result) => {
                        if (result.value) {
                            this.borrar(Id_c);
                            Swal.fire(
                                '¡Eliminado!',
                                'El registro ha sido borrado.',
                                'success'
                            );
                        }
                    });
                }
            },
            created: function () {
                this.mostrar();
            },
            computed: {

            }
        });
    </script>

</body>

</html>
