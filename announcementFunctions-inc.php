<?php

function emptyInput($announcementTitle, $announcementContent)
{
  $result;
  if(empty($announcementTitle) || empty($announcementContent))
  {
      $result = true;
  }
  else
  {
    $result = false;
  }
  return $result;
}
function invalidMessageSize($announcementContent)
{
  $result;
  if(strlen($announcementContent) > 500)
  {
      $result = true;
  }
  else
  {
    $result = false;
  }
  return $result;
}
function invalidTitleSize($announcementTitle)
{
  $result;
  if(strlen($announcementTitle) > 80)
  {
      $result = true;
  }
  else
  {
    $result = false;
  }
  return $result;
}
function makeAnnouncement($connection, $announcementTitle, $announcementContent)  //made a typo in DB, "annonce..."
{
  $sql = 'INSERT INTO announcements (announcementTitle, annoncementContent) VALUES (?, ?);';
  $stmt = mysqli_prepare($connection, $sql);
  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../makeAnnouncement.php?error=stmtFailed");
    exit();
  }
  mysqli_stmt_bind_param($stmt, 'ss', $announcementTitle, $announcementContent);
  mysqli_stmt_execute($stmt);

  mysqli_close($connection);

}
