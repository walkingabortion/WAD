<?php
function emptyInputSell($bookTitle, $bookAuthor, $bookPrice, $file)
{
  $result;  //will be true or false
  if(empty($bookTitle) || empty($bookAuthor) || empty($bookPrice) || empty($file))
  {
      $result = true;
  }
  else
  {
    $result = false;
  }

  return $result;
}

function invalidPrice($bookPrice)
{
  $result;
  if(0 > $bookPrice)
  {
    $result = true;
  }
  else{
    $result = false;
  }

  return $result;
}

function invalidFileType($file)
{
  $result;

  $fileName = $_FILES['file']['name'];

  $fileExt = explode('.', $fileName); //get file exension
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png');
  if(!(in_array($fileActualExt, $allowed)))
  {
    $result = true;
  }
  else{
    $result = false;
  }

  return $result;
}

function upload_book_to_db($connection, $bookTitle, $bookAuthor, $bookPrice, $file, $username)
{
  $sql = "INSERT INTO book (bookTitle, bookAuthor, bookPrice, bookImage, bookOwner) VALUES (?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($connection);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../sell.php?error=stmtFailed");
    exit();
  }
  $actualFile = addslashes(file_get_contents($_FILES['file']['tmp_name']));
  mysqli_stmt_bind_param($stmt, "ssibs", $bookTitle, $bookAuthor, $bookPrice, $actualFile, $username);
  mysqli_stmt_execute($stmt);

  mysqli_stmt_close($stmt);

  header("location: ../sell.php?error=none");
  exit();


}
