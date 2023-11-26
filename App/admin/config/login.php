<?php
require_once 'conexion.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$conexion = Conexion::Conectar(); 

if (!empty($_POST['btningresar'])) {
    if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];

        $consulta = $conexion->query("SELECT * FROM Personal WHERE Usuario= '$usuario' AND password ='$password'");

        if ($datos = $consulta->fetch(PDO::FETCH_OBJ)) {
            $_SESSION['Id'] = $datos->Id;
            $_SESSION['Nombre'] = $datos->Nombre;
            $_SESSION['Rol'] = $datos->Rol;

            header('location:sections/section_1.php');
            exit();
        } else {
            echo "<div class='alert alert-danger'>Datos incorrectos</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Campos vacíos</div>";
    }
}
?>
