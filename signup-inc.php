<?php

if(isset($_POST["submit"])) //if submit was pressed
{
  $fullName = $_POST["fullName"];
  $email = $_POST["email"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $passwordRepeat = $_POST["passwordRepeat"];

  require_once 'dbh-inc.php';
  require_once 'functions-inc.php';

  if(emptyInputSignup($fullName, $email, $username, $password, $passwordRepeat) !== false) //this is not equal to if true (we could get smth not false)
  {
      header("location: ../signup.php?error=emptyInput"); //this will also tell us what the error was (in the URL)
      exit();
  }
  if(invalidUid($username) !== false)
  {
      header("location: ../signup.php?error=invalidUid");
      exit();
  }
  if(invalidEmail($email) !== false)
  {
      header("location: ../signup.php?error=invalidEmail");
      exit();
  }
  if(passwordMatch($password, $passwordRepeat) !== false)
  {
      header("location: ../signup.php?error=passwordMatch");
      exit();
  }
  if(uidExists($connection, $username, $email) !== false)
  {
      header("location: ../signup.php?error=usernameTaken");
      exit();
  }

  createUser($connection, $fullName, $email, $username, $password);

}
else
{
    header("location: ../signup.php"); //if the submit is not pressed, it takes you to the previus page, aka signup
    exit();
}
