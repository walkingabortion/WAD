<?php

if(isset($_POST["submit"])) //if submit was pressed
{
  $username = $_POST["username"];
  $password = $_POST["password"];

  require_once 'dbh-inc.php';
  require_once 'functions-inc.php';

  if(emptyInputLogin($username, $password) !== false)
  {
      header("location: ../login.php?error=emptyInput");
      exit();
  }

loginUser($connection, $username, $password);
}
else {
  header("location: ../login.php");
  exit();
}
