<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda M&M</title>
    <link rel="stylesheet" href="../../libreries/bootstrap/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="container">
        <div id="staff">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Id de ventas realizadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="shadow-sm" v-for="(empleado,indice) of empleados">
                            <td>{{empleado.Codigo_e}}</td>
                            <td>{{empleado.Nombre}}</td>
                            <td>{{empleado.Id}}</td>
                            <td>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button class="btn btn-secondary" title="Editar"><i
                                            class='bx bx-edit-alt'></i></button>
                                    <button class="btn btn-danger" title="Eliminar"><i
                                            class='bx bx-trash-alt'></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios@1.1.2/dist/axios.min.js"></script>
    <script src="../../libreries/jquery/jquery-3.3.1.slim.min.js"></script>
    <script src="../../libreries/bootstrap/bootstrap.min.js"></script>

    <script>
    var url = "../config/bd/sales.php";
    var app = new Vue({
        el: "#staff",
        data: {
            empleados: [],
            Codigo_e: "",
            Nombre: "",
            Id: "",
        },
        methods: {
            mostrar: function() {
                axios.post(url, {
                    opcion: 4
                }).then(response => {
                    this.empleados = response.data;
                    console.log(this.empleados)
                });
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