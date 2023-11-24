<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Codigo_pro = (isset($_POST['Codigo_pro'])) ? $_POST['Codigo_pro'] : '';
$Telefono = (isset($_POST['Telefono'])) ? $_POST['Telefono'] : '';
$Nombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : '';

switch($opcion){
    case 1:
        $consulta = "INSERT INTO Proveedor (Codigo_pro, Telefono, Nombre) VALUES('$Codigo_pro', '$Telefono', '$Nombre') ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 2:
        $consulta = "UPDATE Proveedor SET Telefono='$Telefono', Nombre='$Nombre' WHERE Codigo_pro='$Codigo_pro'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3:
        $consulta = "DELETE FROM Proveedor WHERE Codigo_pro='$Codigo_pro' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;         
    case 4:
        $consulta = "SELECT * FROM `Proveedor`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>
