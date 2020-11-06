<?php

$serverName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "FreshSocks";


$connection = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);

if(!$connection)
{
  die("Can't connect to the database: " . mysqli_connect_error());
}
