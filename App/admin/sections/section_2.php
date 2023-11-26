<?php include "../templates/header.php"; ?>

<div id="content" class="container-fluid p-5">
    <div class="btn-group dropright">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Tablas
        </button>
        <div class="dropdown-menu">
            <button class="dropdown-item" type="button"
                onclick="loadContent('../templates/clients-template.php')">Clientes</button>
            <button class="dropdown-item" type="button" onclick="loadContent('purchases-template.php')">Compras</button>
            <button class="dropdown-item" type="button"
                onclick="loadContent('employees-template.php')">Empleados</button>
            <!-- Agrega botones para otras páginas -->
        </div>
    </div>
    <section class="py-3">
        <div class="row mb-3">
            <!-- Contenedor para cargar el contenido de forma asíncrona -->
            <div class="table-responsive" id="asynchronous"></div>
        </div>
    </section>
</div>

<?php include "../templates/footer.php"; ?>

<script>
function loadContent(page) {
    axios.get(page)
        .then(response => {
            document.getElementById('asynchronous').innerHTML = response.data;


            if (typeof app !== 'undefined') {
                app.$destroy();
            }

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
                                return [
                                    this.Cedula = document.getElementById('cedula')
                                    .value,
                                    this.Nombre = document.getElementById('nombre')
                                    .value
                                ];
                            }
                        });

                        if (this.Cedula === "" || this.Nombre === "") {
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
        })
        .catch(error => {
            console.error('Error al cargar la página:', error);
        });
}
</script>