<?php

require_once 'includes/dbh-inc.php';

$id = $_GET['id'];
$query = "Delete from book where bookId = '$id'";
$del = mysqli_query($connection, $query);

if($del)
{
    mysqli_close($db); // Close connection
    header("location: ../account.php"); // redirects to all records page
    exit();
}
else
{
    echo "Error deleting record"; // display error message if not delete

}
