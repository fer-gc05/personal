<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Codigo_p = (isset($_POST['Codigo_p'])) ? $_POST['Codigo_p'] : '';
$Codigo_pro = (isset($_POST['Codigo_pro'])) ? $_POST['Codigo_pro'] : '';

switch($opcion){
    case 1:
        $consulta = "INSERT INTO Suministra (Codigo_p, Codigo_pro) VALUES('$Codigo_p', '$Codigo_pro') ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 2:
        $consulta = "UPDATE Suministra SET Codigo_pro='$Codigo_pro' WHERE Codigo_p='$Codigo_p'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3:
        $consulta = "DELETE FROM Suministra WHERE Codigo_p='$Codigo_p' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;         
    case 4:
        $consulta = "SELECT * FROM `Suministra`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>
