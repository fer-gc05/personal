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
                            <th>Cedula</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="shadow-sm" v-for="(cliente,indice) of clientes">
                            <td>{{cliente.Cedula}}</td>
                            <td>{{cliente.Nombre}}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-secondary" title="Editar">
                                        <i class='bx bx-edit-alt'></i>
                                    </button>
                                    <button class="btn btn-danger" title="Eliminar">
                                        <i class='bx bx-trash-alt'></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="col">
                    <button class="btn btn-success" title="Nuevo"><i class='bx bxs-save'></i></button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="../../libreries/jquery/jquery-3.3.1.min.js"></script>
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
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        opcion: 4
                    },
                    success: function(response) {
                        try {
                            app.clientes = JSON.parse(response);
                            console.log('Datos obtenidos:', app.clientes);
                        } catch (error) {
                            console.error('Error al parsear la respuesta JSON:', error);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error en la solicitud Ajax:', textStatus, errorThrown);
                    }
                });
            },
            // ... (resto de tus métodos CRUD)
        },
        created: function() {
            this.mostrar();
        },
        computed: {
            // ...
        }
    });
    </script>

</body>

</html>