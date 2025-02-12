<?php
// chdir("..");
require "../controller/controller.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(!empty($_GET)){
    isset($_GET["code"]) ? $resetPassCode = $_GET["code"] : $resetPassCode ='';
    isset($_GET["mail"]) ? $mail = $_GET["mail"] : $mail = '';

    if(!verifyResetPassCode($mail, $resetPassCode) || !verifyTimeLeft($mail, $resetPassCode))
    {
      //todo: meter en la url una variable get para luego en el indice mostrar el error
      header('Location: ../index.php?resetPass=error');
      exit();
    }
    else 
    {
      $firstPass = $_POST["firstPassword"];
      $scndPass = $_POST["scndPassword"];
    
      if($firstPass != $scndPass) $msgError = "Las contraseñas no coinciden";
      else if(updatePassword($mail, $firstPass)){
        //mail de confirmacion
        sendEmail($mail, "confirmation");
        header('Location: ../index.php?resetPass=success');
        exit();
      }
      else 
      {
        header('Location: ../index.php?resetPass=error');
        exit();
      }
    }
  }
}



?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <title>Sign Up</title>
        <meta charset="utf-8">
        <meta name="author" content="StarDust">
        <meta name="description" content="description">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../img/Star_Dust.png">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/index.css">
    </head>

    <body id="screen">
        
    </body>


</html>
