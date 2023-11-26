<?php
include_once '../conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Id = (isset($_POST['Id'])) ? $_POST['Id'] : '';
$Nombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : '';
$Telefono = (isset($_POST['Telefono'])) ? $_POST['Telefono'] : '';

switch ($opcion) {
    case 1:
        $consulta = "INSERT INTO Proveedor (Nombre, Telefono) VALUES('$Nombre', '$Telefono') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 2:
        $consulta = "UPDATE Proveedor SET Nombre='$Nombre', Telefono='$Telefono' WHERE Id='$Id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 3:
        $consulta = "DELETE FROM Proveedor WHERE Id='$Id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 4:
        $consulta = "SELECT * FROM Proveedor";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = NULL;
?>
