<?php

// Comprovar current dir
//echo "singup " . getcwd() . "<br>";

require ("./../controller/controller.php");

//echo "singup " . getcwd() . "<br>";

$msgError = "";
$errorBox = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar campos de entrada
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $username = trim($_POST["username"]);
    $firstName = trim($_POST["firstname"]);
    $lastName = trim($_POST["lastname"]);
    $pass = $_POST["password"];
    $passVerify = $_POST["veri-pswd"];

    // Validaciones básicas
    if (!$email) {
        $msgError = "Email invalid.";
    } elseif (strlen($username) < 3) {
        $msgError = "Al menys 3 lletras de nom d'usuari.";
    } elseif (strlen($pass) < 6) {
        $msgError = "la contrasenya ha de ser de almenys 6 digits";
    } elseif ($pass !== $passVerify) {
        $msgError = "Les contrasenyes no coinsideixen";
    } else {
        // Crear datos del usuario
        $user = [
            'email' => $email,
            'username' => $username,
            'userFirstName' => $firstName,
            'userLastName' => $lastName,
            'passHash' => password_hash($pass, PASSWORD_BCRYPT),
            'activationCode' => generateActivationCode()
        ];

        // Intentar registrar al usuario
        $rslt = insertUser($user);
        if ($rslt === true) {
            //el correo envia un enlace a otro php y este es el que luego redirige al index.php
            sendEmail($user, "verification");
            header('Location: ../index.php?register=success&verificationMail=n');
            exit();
        } 
        else {
            $msgError = "Error al crear l'usuari. Si us plau intenteulo un altre cop.";
        }
    }

    // Mostrar mensaje de error
    if ($msgError) {
        $errorBox = "<div class='error-box'>$msgError</div>";
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

<body>
    <div id="main-container">
        <header>
            <img src="../img/Star_Dust.png" alt="Logo" class="logo">
            <h1 class="title">Sign Up</h1>
            <p class="subtitle">Crea tu cuenta en StarDust</p>
        </header>

        <div class="form-container">
            <?= $errorBox ?>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                <div class="input-box">
                    <label for="username"><ion-icon name="at-outline"></ion-icon></label>
                    <input type="text" id="username" name="username" required placeholder="Username">
                </div>

                <div class="input-box">
                    <label for="email"><ion-icon name="mail-outline"></ion-icon></label>
                    <input type="email" id="email" name="email" required placeholder="Email">
                </div>

                <div class="input-box">
                    <label for="firstname"><ion-icon name="person"></ion-icon></label>
                    <input type="text" id="firstname" name="firstname" required placeholder="First Name">
                </div>

                <div class="input-box">
                    <label for="lastname"><ion-icon name="person"></ion-icon></label>
                    <input type="text" id="lastname" name="lastname" required placeholder="Last Name">
                </div>

                <div class="input-box">
                    <label for="password"><ion-icon name="lock-closed-outline"></ion-icon></label>
                    <input type="password" id="password" name="password" required placeholder="Password">
                </div>

                <div class="input-box">
                    <label for="veri-pswd"><ion-icon name="lock-closed-outline"></ion-icon></label>
                    <input type="password" id="veri-pswd" name="veri-pswd" required placeholder="Verify Password">
                </div>

                <div>
                    <button class="btn-primary" type="submit">Crear Cuenta</button>
                </div>

                <div class="extra-options">
                    <p>Already have an account?</p>
                    <a href="../index.php">Sign In</a>
                </div>
            </form>
        </div>

        <footer>
            <p>&copy; 2025 EduForum. All Rights Reserved.</p>
        </footer>
    </div>
</body>

</html>