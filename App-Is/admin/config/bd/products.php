<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$_POST = json_decode(file_get_contents("php://input"), true);
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$Codigo_p = (isset($_POST['Codigo_p'])) ? $_POST['Codigo_p'] : '';
$Nombre = (isset($_POST['Nombre'])) ? $_POST['Nombre'] : '';
$Precio = (isset($_POST['Precio'])) ? $_POST['Precio'] : '';
$Categoria = (isset($_POST['Categoria'])) ? $_POST['Categoria'] : '';

switch($opcion){
    case 1:
        $consulta = "INSERT INTO Productos (Codigo_p, Nombre, Precio, Categoría) VALUES('$Codigo_p', '$Nombre', '$Precio', '$Categoria') ";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                
        break;
    case 2:
        $consulta = "UPDATE Productos SET Nombre='$Nombre', Precio='$Precio', Categoría='$Categoria' WHERE Codigo_p='$Codigo_p'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3:
        $consulta = "DELETE FROM Productos WHERE Codigo_p='$Codigo_p' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;         
    case 4:
        $consulta = "SELECT * FROM `Productos`";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}
print json_encode($data, JSON_UNESCAPED_UNICODE);
$conexion = NULL;
?>
