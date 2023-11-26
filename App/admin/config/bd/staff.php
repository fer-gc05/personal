<?php
include_once '../conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Id = (isset($_POST['Id'])) ? $_POST['Id'] : '';
$Nombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : '';
$Usuario = (isset($_POST['Usuario'])) ? $_POST['Usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$Rol = (isset($_POST['Rol'])) ? $_POST['Rol'] : '';

switch ($opcion) {
    case 1:
        $consulta = "INSERT INTO Personal (Nombre, Usuario, password, Rol) VALUES('$Nombre', '$Usuario', '$password', '$Rol') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 2:
        $consulta = "UPDATE Personal SET Nombre='$Nombre', Usuario='$Usuario', password='$password', Rol='$Rol' WHERE Id='$Id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 3:
        $consulta = "DELETE FROM Personal WHERE Id='$Id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 4:
        $consulta = "SELECT * FROM Personal";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = NULL;
?>
