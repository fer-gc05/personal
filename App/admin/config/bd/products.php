<?php
include_once '../conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Id = (isset($_POST['Id'])) ? $_POST['Id'] : '';
$Nombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : '';
$Precio = (isset($_POST['Precio'])) ? $_POST['Precio'] : '';
$Existencia = (isset($_POST['Existencia'])) ? $_POST['Existencia'] : '';
$Categoria = (isset($_POST['Categoria'])) ? $_POST['Categoria'] : '';
$Proveedor = (isset($_POST['Proveedor'])) ? $_POST['Proveedor'] : '';

switch ($opcion) {
    case 1:
        $consulta = "INSERT INTO Productos (Nombre, Precio, Existencia, Categoria, Proveedor) VALUES('$Nombre', '$Precio', '$Existencia', '$Categoria', '$Proveedor') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 2:
        $consulta = "UPDATE Productos SET Nombre='$Nombre', Precio='$Precio', Existencia='$Existencia', Categoria='$Categoria', Proveedor='$Proveedor' WHERE Id='$Id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 3:
        $consulta = "DELETE FROM Productos WHERE Id='$Id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 4:
        $consulta = "SELECT * FROM Productos";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = NULL;
?>
