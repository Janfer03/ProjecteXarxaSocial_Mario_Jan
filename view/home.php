<?php
//iniciar SESSION
session_start();

//comprobar si el usuario no tiene SESSION activa
if (!isset($_SESSION['username'])) {
    //Redirigir al index si no hay SESSION
    header('Location: ../index.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Home | Cetisi</title>
    <meta charset="utf-8">
    <meta name="author" content="Cetisi">
    <meta name="description" content="Página de inicio de la red social simulada">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../img/logo-white.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/home.css">
</head>

<body id="screen">
    <div class="container mt-5">
        <h1 class="text-center">¡Bienvenido, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
        <p class="text-center">Esta es tu página de inicio.</p>

        <div class="text-center mt-4">
            <!-- Botón de logout -->
            <a href="../controller/logOut.php" class="btn btn-danger">Cerrar sesión</a>
        </div>
    </div>
</body>