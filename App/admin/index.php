<?php 
include 'config/login.php';
require_once 'config/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login_style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login</title>
</head>

<body>
    <div class="wrapper">
        <form method="post" action="" class="form">
            <h1 class="title">INICIO</h1>
           
            <div class="inp">
                <input type="text" name="usuario" id="In-usuario" class="input" placeholder="Ingrese su usuario">
                <i class='bx bx-user'></i>
            </div>
            <div class="inp">
                <input type="password" name="password" id="In-password" class="input"
                    placeholder="Ingrese su contraseña">
                <i class='bx bx-lock'></i>
                <span class="toggle-password" onclick="togglePassword()">
                    <i class='bx bx-hide'></i>
                </span>
            </div>
            <input name="btningresar" class="submit" type="submit" value="Ingresar">
        </form>
    </div>

    <script>
    function togglePassword() {
        var passwordInput = document.getElementById("In-password");
        var toggleIcon = document.querySelector(".toggle-password i");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleIcon.classList.remove("bx-hide");
            toggleIcon.classList.add("bx-show");
        } else {
            passwordInput.type = "password";
            toggleIcon.classList.remove("bx-show");
            toggleIcon.classList.add("bx-hide");
        }
    }
    </script>
</body>

</html>