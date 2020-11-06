<?php
  session_start();

if(isset($_POST["submit"])) //if submit was pressed
{
  $bookTitle = $_POST["bookTitle"];
  $bookAuthor = $_POST["bookAuthor"];
  $bookPrice = $_POST["bookPrice"];

  $file = $_FILES['file'];
  $fileName = $_FILES['file']['name'];
  $fileTempName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.', $fileName); //get file exension
  $fileActualExt = strtolower(end($fileExt));
  $allowed = array('jpg', 'jpeg', 'png');


  require_once 'dbh-inc.php';
  require_once 'upload-inc.php';

  if(emptyInputSell($bookTitle, $bookAuthor, $bookPrice, $file) !== false)
  {
      header("location: ../sell.php?error=emptyInputSell");
      exit();
  }
  if(invalidPrice($bookPrice) !== false)
  {
      header("location: ../sell.php?error=invalidPrice");
      exit();
  }
  if(invalidFileType($file) !== false)
  {
      header("location: ../sell.php?error=invalidFileType");
      exit();
  }
  /*This stores the file to database*/
  $username = $_SESSION['usersName'];


  if($fileSize < 10000000) // 10MB
  {
  /*  $sql = 'INSERT INTO book (bookTitle, bookAuthor, bookPrice, bookImage, bookOwner) VALUES (?, ?, ?, ?, ?);';
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      header("location: ../sell.php?error=stmtFailed");
      exit();
    }
    $actualFile = addslashes(file_get_contents($_FILES['file']['tmp_name']));
    mysqli_stmt_bind_param($stmt, 'ssiss', $bookTitle, $bookAuthor, $bookPrice, $actualFile, $username);
    mysqli_stmt_execute($stmt);


    mysqli_stmt_close($stmt);
    */
    $image = $_FILES['file']['tmp_name'];
    $img = file_get_contents($image);
    $sql = 'INSERT INTO book (bookTitle, bookAuthor, bookPrice, bookImage, bookOwner) VALUES (?, ?, ?, ?, ?);';
    $stmt = mysqli_prepare($connection,$sql);
    mysqli_stmt_bind_param($stmt, 'ssiss', $bookTitle, $bookAuthor, $bookPrice, $img, $username);
    mysqli_stmt_execute($stmt);

    mysqli_close($connection);

    header("location: ../sell.php?uploadSuccess");
    exit();
  }
  else
  {
    echo "File too large!";
  }

}
else
{
    header("location: ../sell.php");
    exit();
}
