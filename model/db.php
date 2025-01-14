<?php
function getDBConnection()
{
    $connString = 'mysql:host=localhost;port=3335;dbname=eduforums;charset=utf8';
    $user = 'root';
    $pass = '';
    $db = null;
    try {
      $db = new PDO($connString, $user, $pass, [PDO::ATTR_PERSISTENT => true]);
    } catch (PDOException $e) 
    {
      echo $e;
    } finally 
    {
      return $db;
    }
}

function loginUserDB($userOrEmail, $pass)
{

}

function insertUserDB($user)
{

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