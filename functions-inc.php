<?php

function emptyInputSignup($fullName, $email, $username, $password, $passwordRepeat)
{
  $result;  //will be true or false
  if(empty($fullName) || empty($email) || empty($username) || empty($password) || empty($passwordRepeat))
  {
      $result = true;
  }
  else
  {
    $result = false;
  }

  return $result;
}

function invalidUid($username)
{
  $result;
  if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) //if there are invalid chars in the username, signal true
  {
    $result = true;
  }
  else{
    $result = false;
  }

  return $result;
}

function invalidEmail($email)
{
  $result;
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))  //if email is valid, filter_var returns true
  {
    $result = true;
  }
  else{
    $result = false;
  }

  return $result;
  }

function passwordMatch($password, $passwordRepeat)
{
    $result;
    if($password !== $passwordRepeat)
    {
      $result = true;
    }
    else{
      $result = false;
    }

    return $result;
}

function uidExists($connection, $username, $email)
{
    $sql = "SELECT * FROM users where usersName = ? OR usersEmail = ?;"; //first ; closes sql query
    $stmt = mysqli_stmt_init($connection);  //this is a "prepare" statement, we use it to see if it's ok to move forward
    if (!mysqli_stmt_prepare($stmt, $sql)) //if there are errors, exit
    {
      header("location: ../signup.php?error=stmtFailed");
      exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email); //second param means 2 strings (the username and the email)
    mysqli_stmt_execute($stmt); // now we actually grab the data

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData))  //the role of this function is to return all the rows of the user, if he's found in the database (because we will use this function in login as well)
    {
      return $row;
    }
    else
    {
      $result = false;
      return $result;
    }

    mysqli_stmt_close($stmt);
}
function createUser($connection, $fullName, $email, $username, $password)
{
    $sql = "INSERT INTO users (usersFullname, usersEmail, usersName, usersPassword) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      header("location: ../signup.php?error=stmtFailed");
      exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); //we hash the password first

    mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $username, $hashedPassword);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: ../signup.php?error=none");
    exit();
}

function emptyInputLogin($username, $password)
{
  $result;
  if(empty($username) || empty($password))
  {
      $result = true;
  }
  else
  {
    $result = false;
  }

  return $result;
}

function loginUser($connection, $username, $password)
{
  $uidExists = uidExists($connection, $username, $username); //the user can login with either username or email, so send username taken to both username and email to this function

  if($uidExists === false)
  {
    header("location: ../login.php?error=wrongLogin");
    exit();
  }
  //keep in mind that uidExists will return an associative array full of data with the users
  // we can access its data
  $hashedPassword = $uidExists["usersPassword"]; //we need to compare the password provided with the hashed password stored

  $checkPassword = password_verify($password, $hashedPassword);

  if($checkPassword === false) //the passwords are not the same, go back and login again
  {
    header("location: ../login.php?error=wrongLogin");
    exit();
  }
  else if($checkPassword === true)
  {
    session_start(); //we need to start a session
    $_SESSION["usersId"] = $uidExists["usersId"];     //for this session, the uid is taken from the logged in user and replaced here
    $_SESSION["usersName"] = $uidExists["usersName"]; //same with the username

    header("location: ../index.php");

  }

}
