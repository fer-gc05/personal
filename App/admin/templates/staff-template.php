<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda M&M - Personal</title>
    <link href="../../libreries/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../../libreries/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div id="personal">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>

                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="shadow-sm" v-for="(persona, index) of personal">

                            <td>{{ persona.Nombre }}</td>
                            <td>{{ persona.Usuario }}</td>
                            <td>{{ persona.Rol }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button @click="btnEditar(persona.Id, persona.Nombre, persona.Usuario, persona.Rol)"
                                        class="btn btn-secondary" title="Editar">
                                        <i class='bx bx-edit-alt'></i>
                                    </button>
                                    <button @click="btnEliminar(persona.Id)" class="btn btn-danger" title="Eliminar">
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
    var url = "../config/bd/staff.php";

    var appPersonal = new Vue({
        el: "#personal",
        data: {
            personal: [],
            Id: "",
            Nombre: "",
            Usuario: "",
            password: "",
            Rol: "",
        },
        methods: {
            mostrar: function() {
                axios.post(url, {
                    opcion: 4
                }).then(response => {
                    this.personal = response.data;
                    console.log(this.personal);
                });
            },

            insertar: function() {
                axios.post(url, {
                    opcion: 1,
                    Nombre: this.Nombre,
                    Usuario: this.Usuario,
                    password: this.password,
                    Rol: this.Rol
                }).then(response => {
                    this.mostrar();
                });

                this.Nombre = "";
                this.Usuario = "";
                this.password = "";
                this.Rol = "";
            },

            editar: function(Id, Nombre, Usuario, Rol) {
                axios.post(url, {
                    opcion: 2,
                    Id: Id,
                    Nombre: Nombre,
                    Usuario: Usuario,
                    password: this.password,
                    Rol: Rol
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
                    html: '<div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input id="nombre" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Usuario</label><div class="col-sm-7"><input id="usuario" type="text" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Password</label><div class="col-sm-7"><input id="password" type="password" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Rol</label><div class="col-sm-7"><input id="rol" type="text" class="form-control" /></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Guardar',
                    confirmButtonColor: '#1cc88a',
                    cancelButtonColor: '#3085d6',
                    preConfirm: () => {
                        const nombre = document.getElementById('nombre').value;
                        const usuario = document.getElementById('usuario').value;
                        const password = document.getElementById('password').value;
                        const rol = document.getElementById('rol').value;

                        if (!nombre || !usuario || !password || !rol) {
                            Swal.showValidationMessage('Por favor, completa todos los campos.');
                        }

                        return [this.Nombre = nombre, this.Usuario = usuario, this.password =
                            password, this.Rol = rol
                        ];
                    }
                });

                if (this.Nombre && this.Usuario && this.password && this.Rol) {
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

            btnEditar: async function(Id, Nombre, Usuario, Rol) {
                await Swal.fire({
                    title: 'EDITAR',
                    html: '<div class="form-group"><div class="row"><label class="col-sm-3 col-form-label">Nombre</label><div class="col-sm-7"><input id="nombre" value="' +
                        Nombre +
                        '" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Usuario</label><div class="col-sm-7"><input id="usuario" value="' +
                        Usuario +
                        '" type="text" class="form-control"></div></div><div class="row"><label class="col-sm-3 col-form-label">Password</label><div class="col-sm-7"><input id="password" type="password" class="form-control" /></div></div><div class="row"><label class="col-sm-3 col-form-label">Rol</label><div class="col-sm-7"><input id="rol" value="' +
                        Rol +
                        '" type="text" class="form-control"></div></div>',
                    focusConfirm: false,
                    showCancelButton: true,
                }).then((result) => {
                    if (result.value) {
                        const nombre = document.getElementById('nombre').value;
                        const usuario = document.getElementById('usuario').value;
                        const password = document.getElementById('password').value;
                        const rol = document.getElementById('rol').value;

                        this.editar(Id, nombre, usuario, rol);
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