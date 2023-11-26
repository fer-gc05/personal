<?php
include_once ('../conexion.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Id = (isset($_POST['Id'])) ? $_POST['Id'] : '';
$Cedula = (isset($_POST['Cedula'])) ? $_POST['Cedula']:'';
$Nombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : '';

switch($opcion){
    case 1:
        $consulta = "INSERT INTO Clientes ( Id, Cedula, Nombre) VALUES('$Id', '$Cedula', $Nombre') ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 2:
        $consulta = "UPDATE Clientes SET Cedula='$Cedula, Nombre='$Nombre'' WHERE Id='$Id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3:
        $consulta = "DELETE FROM Clientes WHERE Id='$Id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;         
    case 4:
        $consulta = "SELECT * FROM `Clientes`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;