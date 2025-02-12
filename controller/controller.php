<?php
use PHPMailer\PHPMailer\PHPMailer;
//require '../vendor/autoload.php';
//require '../../vendor/autoload.php';
echo getcwd();
require 'C:/Users/mruiz/Desktop/DAM2_2/M7/PHP/projectePHP/ProjecteXarxaSocial_Mario_Jan/vendor/autoload.php';

//require_once("./../model/db.php");
//require_once("C:/Users/mruiz/Desktop/DAM2_2/M7/PHP/projectePHP/ProjecteXarxaSocial_Mario_Jan/model/db.php");

//use PHPMailer\PHPMailer\PHPMailer;

//require '../vendor/autoload.php';
//require_once("./../model/db.php");

// Absoluta
// require_once("./../model/db.php");
// Des de root
// require_once("./model/db.php");

// Comprovar current dir
//echo "controller " . getcwd() . "<br>";

$ruta = getcwd();

if(str_contains($ruta, "view"))
{
  require_once("./../model/db.php");
}
else{
  require_once("./model/db.php");
}

function loginUser($userOrEmail, $pass)
{
  return loginUserDB($userOrEmail, $pass);
}

function insertUser($user)
{
  return insertUserDB($user);
}

function verifyExistentUser($mail)
{
  $user = [
    'email' => $mail,
    'username' => '',
  ];
  return verifyExistentUserDB($user);
}

function generateResetPassCode($mail)
{
  return generateResetPassCodeDB($mail);
}


function generateActivationCode()
{
  return hash("sha256", rand(0, 9999));
}


function sendEmail($user, $type)
{
  $mail = new PHPMailer(true);
  $mail->IsSMTP();
  //Configuració del servidor de Correu
  //Modificar a 0 per eliminar msg error
  $mail->SMTPDebug = 0;
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls';
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = 587;
  //Credencials del compte GMAIL
  $mail->Username = 'stardustmail001@gmail.com';
  $mail->Password = 'ohii vbck pgzh gtrf';

  //Dades del correu electrònic
  $mail->SetFrom('stardustmail001@gmail.com', 'Soporte StarDust');
  $mail->Subject = ($type == "verification") ? ' ' : 'Restablecer contraseña';
  $mail->isHTML(true);
  $mail->CharSet = 'UTF-8';
  $mail->Body = mailBodyConstructor($user, $type);
  //Destinatari
  $address = $user['email'];
  $mail->AddAddress($address);

  //Enviament
  $result = $mail->Send();
  if (!$result) {
    echo 'Error: ' . $mail->ErrorInfo;
  } else {
    echo "Correu enviat";
  }
}

function mailBodyConstructor($user, $type)
{
  if ($type == "verification") {
    $verificationLink = 'http://localhost/controller/mailCheckAccount.php?code=' . $user['activationCode'] . '&mail=' . $user['email'];
    $body = "
          <html>
          <body>
              <p>Hola " . $user['username'] . ",</p>
              <p>Gracias por registrarte en nuestro sitio. Por favor haz clic en el siguiente botón para verificar tu correo electrónico:</p>
              <a href='" . $verificationLink . "' style='display:inline-block;background-color:#4CAF50;color:white;padding:14px 20px;text-align:center;text-decoration:none;display:inline-block;font-size:16px;margin:4px 2px;cursor:pointer;border-radius:10px;'>Verificar Correo</a>
              <p>Si el botón no funciona, también puedes copiar y pegar el siguiente enlace en tu navegador:</p>
              <p><a href='" . $verificationLink . "'>" . $verificationLink . "</a></p>
              <p>Gracias,<br>Tu equipo</p>
          </body>
          </html>
      ";
  } else if ($type == "password") {

    //TODO: PENDIENTE CAMBIAR EL MAIL
    $passwordLink = 'http://cetisi.cat/view/resetPassword.php?code=' . $user['resetPassCode'] . '&mail=' . $user['email'];
    $body = "
      <html>
      <body>
        <p>Hola,</p>
        <p>Recibiste este correo porque solicitaste restablecer tu contraseña en nuestro sitio web.</p>
        <p>Si no hiciste esta solicitud, puedes ignorar este mensaje.</p>
        <p>Para restablecer tu contraseña, haz clic en el siguiente botón:</p>
        <a href='" . $passwordLink . "' style='display:inline-block;background-color:#4CAF50;color:white;padding:14px 20px;text-align:center;text-decoration:none;display:inline-block;font-size:16px;margin:4px 2px;cursor:pointer;border-radius:10px;'>Restablecer Contraseña</a>
        <p>Si el botón no funciona, puedes copiar y pegar el siguiente enlace en tu navegador:</p>
        <p><a href='" . $passwordLink . "'>" . $passwordLink . "</a></p>
        <p>Gracias,</p>
        <p>Tu equipo de soporte</p>
      </body>
      </html>";
  }
  else if ($type == "confirmation"){
    //TODO: PONER EL CUERPO DEL MAIL DE CONFIRMACION DE CAMBIO DE CONTRASEÑA
  }

  return $body;
}

function updateActive($mail)
{
  updateActiveDB($mail);
}

