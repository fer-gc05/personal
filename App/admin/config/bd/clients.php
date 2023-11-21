<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Id_c = (isset($_POST['Id_c'])) ? $_POST['Id_c'] : '';
$Nombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : '';
$Contacto = (isset($_POST['Contacto'])) ? $_POST['Contacto'] : '';
$Direccion = (isset($_POST['Direccion'])) ? $_POST['Direccion'] : '';

switch($opcion){
    case 1:
        $consulta = "INSERT INTO Clientes ( Id_c, Nombre, Contacto, Direccion) VALUES('$Id_c', '$Nombre', '$Contacto', '$Direccion') ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 2:
        $consulta = "UPDATE Clientes SET Nombre='$Nombre', Contacto='$Contacto', Direccion= '$Direccion' WHERE Id_c='$Id_c'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3:
        $consulta = "DELETE FROM Clientes WHERE Id_c='$Id_c' ";		
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