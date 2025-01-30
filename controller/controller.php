<?php
//use PHPMailer\PHPMailer\PHPMailer;

//require '../vendor/autoload.php';
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

/*
function generateActivationCode()
{
  return hash("sha256", rand(0, 9999));
}

function generateResetPassCode($mail)
{
  return generateResetPassCodeDB($mail);
}

*/