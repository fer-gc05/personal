<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Id = (isset($_POST['Id'])) ? $_POST['Id'] : '';
$Fecha = (isset($_POST['Fecha'])) ? $_POST['Fecha'] : '';
$Total = (isset($_POST['Total'])) ? $_POST['Total'] : '';

switch($opcion){
    case 1:
        $consulta = "INSERT INTO Ventas (Id, Fecha, Total) VALUES('$Id', '$Fecha', '$Total') ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 2:
        $consulta = "UPDATE Ventas SET Fecha='$Fecha', Total='$Total' WHERE Id='$Id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3:
        $consulta = "DELETE FROM Ventas WHERE Id='$Id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;         
    case 4:
        $consulta = "SELECT * FROM `Ventas`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>
