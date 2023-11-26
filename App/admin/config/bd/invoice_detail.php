<?php
include_once '../conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Id = (isset($_POST['Id'])) ? $_POST['Id'] : '';
$Factura = (isset($_POST['Factura'])) ? $_POST['Factura'] : '';
$Producto = (isset($_POST['Producto'])) ? $_POST['Producto'] : '';
$Cantidad = (isset($_POST['Cantidad'])) ? $_POST['Cantidad'] : '';
$Total = (isset($_POST['Total'])) ? $_POST['Total'] : '';

switch ($opcion) {
    case 1:
        $consulta = "INSERT INTO Detalle_Factura (Factura, Producto, Cantidad, Total) VALUES('$Factura', '$Producto', '$Cantidad', '$Total') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 2:
        $consulta = "UPDATE Detalle_Factura SET Factura='$Factura', Producto='$Producto', Cantidad='$Cantidad', Total='$Total' WHERE Id='$Id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 3:
        $consulta = "DELETE FROM Detalle_Factura WHERE Id='$Id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        break;
    case 4:
        $consulta = "SELECT * FROM Detalle_Factura";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);

$conexion = NULL;
?>
