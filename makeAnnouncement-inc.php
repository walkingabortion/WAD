<?php
if(isset($_POST["submit"]))
{

  $announcementTitle = $_POST["announcementTitle"];
  $announcementContent = $_POST["announcementContent"];

  require_once 'dbh-inc.php';
  require_once 'announcementFunctions-inc.php';

  if(emptyInput($announcementTitle, $announcementContent) !== false)
  {
      header("location: ../makeAnnouncement.php?error=emptyInput");
      exit();
  }
  if(invalidMessageSize($announcementContent) !== false)
  {
    header("location: ../makeAnnouncement.php?error=invalidMessageSize");
    exit();
  }

  if(invalidTitleSize($announcementTitle) !== false)
  {
    header("location: ../makeAnnouncement.php?error=invalidTitleSize");
    exit();
  }
  makeAnnouncement($connection, $announcementTitle, $announcementContent);

  header("location: ../makeAnnouncement.php?success");
  exit();
}
else
{
    header("location: ../makeAnnouncement.php");
    exit();
}
