<?php
// Comprovar current dir
//echo "index " . getcwd() . "<br>";

require_once ("./controller/controller.php");

// Comprovar current dir
//echo "index " . getcwd() . "<br>";

$msgError = "";
$errorBox = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    /*
    if (!isset($_POST["resetPassMail"])) {
        $user = $_POST["user"];
        $pass = $_POST["password"];
        $result = loginUser($user, $pass);

        if (is_string($result)) {
            $msgError = $result;
        } 
        else if ($result != false) {
            session_start();
            $_SESSION['username'] = $result['username'];
            header('Location: ./view/home.php');
            exit();
        }

    } else {
        if (verifyExistentUser($_POST["resetPassMail"]) == true) {
            $user = [
            'email' => $_POST["resetPassMail"],
            'resetPassCode' => generateResetPassCode($_POST["resetPassMail"])
            ];
            sendEmail($user, "password");
        }
    }*/

    $user = $_POST["user"];
    $pass = $_POST["password"];
    $result = loginUser($user, $pass);

    if (is_string($result)) {
        $msgError = $result;
    } 
    else if ($result != false) {
        session_start();
        $_SESSION['username'] = $result['username'];
        header('Location: ./view/home.php');
        exit();
    }

} else if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_COOKIE['PHPSESSID'])) {
        header('Location: ./view/home.php');
        exit();
    }

    // si el $_Get es empty sabem que hem entrar per primera vegada sino vol dir que venim desde el registre 
    if (!empty($_GET)) {
        //mirem si el registre s'ha completat correctament
        if (isset($_GET["register"]))
        $_GET["register"] == "success" ? $msgError = "<div class='error-box'>Registre correcte</div>" : '';
        if (isset($_GET["verificationMail"]))
        $_GET["verificationMail"] == "success" ? $msgError = "<div class='error-box'>Correu verificat correctament</div>" : '';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <title>Star Dust - Red Social de Pelis y Series</title>
        <meta charset="utf-8">
        <meta name="author" content="Cetisi">
        <meta name="description" content="Comparte tus opiniones sobre películas y series en Star Dust">
        <meta name="keywords" content="foro, películas, series, opiniones, comunidad, red social">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="./img/logo-white.png">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/index.css">
    </head>

    <body id="screen">
        <section class="form-box">
            
            <!-- Reset password   -->
             <!-- <form class="reset-password-form inactive" action="<?php htmlspecialchars($_SERVER["REQUEST_METHOD"]) ?>" method="POST">
                <div class="input-box" id="input-email">
                    <label for="email"><ion-icon name="person-outline"></ion-icon></label>
                    <input type="text" id="resetPassMail" name="resetPassMail" required="true" placeholder="">
                    <span>Email</span>
                    <p id="userError" class="inactive"></p>
                </div>
                <button class="button-86" id="reset-pass-form-button">Submit</button>
            </form>  -->
           <!-- Fi reset password  -->
          
            <div id="main-container">
            <!-- Encabezado -->
            <header class="text-center py-3">
                <img src="./img/Star_Dust.png" alt="Star Dust Logo" class="logo">
                <h1 class="title">Bienvenido a Star Dust</h1>
                <p class="subtitle">Comparte tus opiniones sobre películas y series favoritas</p>
            </header>

            <!-- Caja de login -->
            <section class="form-box">
                <div class="form-container">
                    <h1 class="form-title">Inicia Sesión</h1>
                    <?= $msgError ?>
                    <form class="login-form" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                        <div class="input-box mb-3">
                            <label for="usr" class="form-label">Usuario o Email</label>
                            <input type="text" id="usr" name="user" class="form-control" required placeholder="Ingresa tu usuario o correo">
                        </div>
                        <div class="input-box mb-3">
                            <label for="pswd" class="form-label">Contraseña</label>
                            <input type="password" id="pswd" name="password" class="form-control" required placeholder="Ingresa tu contraseña">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Entrar</button>
                    </form>
                    <div class="extra-options mt-3">
                        <p><a href="#" class="link-light">¿Olvidaste tu contraseña?</a></p>
                        <p>¿No tienes cuenta? <a href="./view/signUp.php" class="link-light">Regístrate</a></p>
                    </div>
                </div>
        </section>

        <!-- Pie de página -->
        <footer class="text-center mt-4 text-light">
            <p>&copy; 2025 Star Dust | Creado por Jan Ferrer y Mario Ruiz</p>
        </footer>
    
    <div id="falling-stars"></div>
    </body>
    <script src="./js/stars.js"></script>
</html>