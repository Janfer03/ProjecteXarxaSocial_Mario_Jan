<?php
function getDBConnection()
{
    $connString = 'mysql:host=localhost;port=3335;dbname=eduforums;charset=utf8';
    $user = 'root';
    $pass = '';
    $db = null;

    try {$db = new PDO($connString, $user, $pass, [PDO::ATTR_PERSISTENT => true]); } 
    catch (PDOException $e) { echo $e; } 
    finally { return $db; }
}

function loginUserDB($userOrEmail, $pass)
{
    $result = false;
  $conn = getDBConnection();
  $sql = "SELECT * FROM `users` WHERE `mail`=:userOrEmail OR `username`=:userOrEmail";
    try {
        $usuaris = $conn->prepare($sql);
        $usuaris->execute([':userOrEmail' => $userOrEmail]);
        if ($usuaris->rowCount() == 1) {
            $dadesUsuari = $usuaris->fetch(PDO::FETCH_ASSOC);
            if ($dadesUsuari['active'] == 1) {
                if (password_verify($pass, $dadesUsuari['passHash'])) {
                $result = $dadesUsuari;
                updateLastSignIn($userOrEmail);
                } 
                else  $result = "Wrong password";
            } 
            else $result = "User not activated";
        } else $result = "User or email does not exists";
        

    } 
    catch (PDOException $e) 
    {
        echo "";
    } 
    finally 
    {
        return $result;
    }
}

function insertUserDB($user)
{
    $result = false;
  $conn = getDBConnection();
  $userExists = verifyExistentUserDB($user);
  if ($userExists == true) {
    $result = "User or email already exist";
  } else if ($userExists == false) {
    $sql = "INSERT INTO users (mail, username, passHash, userFirstName, userLastName, creationDate, removeDate, lastSignIn, active, activationCode) VALUES (:mail, :username ,:passHash, :userFirstName, :userLastName, now(), null, null,0,:activationCode)";
    $mail = $user['email'];
    $pass = $user['passHash'];
    $username = $user['username'];
    $userFirstName = $user['userFirstName'];
    $userLastName = $user['userLastName'];
    $activationCode = $user['activationCode'];
    try {
      $resultat = $conn->prepare($sql);
      $resultat->execute([':mail' => $mail, ':username' => $username, ':passHash' => $pass, ':userFirstName' => $userFirstName, ':userLastName' => $userLastName, ':activationCode' => $activationCode]);

      if ($resultat) {
        $result = true;
      }
    } catch (PDOException $e) {
      echo "";
    } finally {
      return $result;
    }
  }
}

function verifyExistentUserDB($user)
{

}

function updateLastSignIn($userOrEmail)
{

}

function getActivationCode($mail)
{

}

function updateActiveDB($mail)
{

}

function generateResetPassCodeDB($mail)
{

}

function verifyResetPassCodeDB($mail, $resetPassCode)
{
    
}