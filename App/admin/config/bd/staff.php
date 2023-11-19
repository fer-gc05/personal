<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Codigo_e = (isset($_POST['Codigo_E'])) ? $_POST['Codigo_E'] : '';
$Nombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : '';
$Id = (isset($_POST['Id'])) ? $_POST['Id'] : '';

switch($opcion){
    case 1:
        $consulta = "INSERT INTO Empleados (Codigo_e, Nombre, Id) VALUES('$Codigo_e', '$Nombre', '$Id') ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 2:
        $consulta = "UPDATE Empleados SET Nombre='$Nombre', Id='$Id' WHERE Codigo_e='$Codigo_e'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3:
        $consulta = "DELETE FROM Empleados WHERE Codigo_e='$Codigo_e' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;         
    case 4:
        $consulta = "SELECT * FROM `Empleados`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>
