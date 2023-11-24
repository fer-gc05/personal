<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Codigo_E = (isset($_POST['Codigo_E'])) ? $_POST['Codigo_E'] : '';
$Codigo_p = (isset($_POST['Codigo_p'])) ? $_POST['Codigo_p'] : '';

switch($opcion){
    case 1:
        $consulta = "INSERT INTO Vende (Codigo_E, Codigo_p) VALUES('$Codigo_E', '$Codigo_p') ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 2:
        $consulta = "UPDATE Vende SET Codigo_p='$Codigo_p' WHERE Codigo_E='$Codigo_E'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3:
        $consulta = "DELETE FROM Vende WHERE Codigo_E='$Codigo_E' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;         
    case 4:
        $consulta = "SELECT * FROM `Vende`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>
