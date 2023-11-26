<?php 
session_start();
if(!empty($_POST['btningresar'])){
  if(!empty($_POST['usuario']) and!empty($_POST['password'])){

    $usuario= $_POST['usuario'];
    $password= $_POST['password'];

    $consulta =$conexion->query("SELECT * FROM Personal WHERE Usuario= '$usuario' AND password ='$password'  ");

    if ($datos =$consulta->fetch_object()) {

        $_SESSION['Id'] = $datos->Id;
        $_SESSION['Nombre'] = $datos->Nombre;
        $_SESSION['Rol'] = $datos->Rol;

        header('location:/sections/section_1.php');

    } else {
       echo "<div class= 'alert alert-danger'>Datos incorrectos</div>";
    }
    

  }else{
    echo"<div class= 'alert alert-danger'>Campos vacios</div>";
  }
}
?>