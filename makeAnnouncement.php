<?php
  include_once 'header.php';
?>

<section class = "announcement-form">
  <h2> Fill up the rows below to make the announcement: </h2>
  <div class = "announcement-form">
  <form action="includes/makeAnnouncement-inc.php" method="post">
    <input type = "text" name = "announcementTitle" placeholder="Title...">
    <input type = "text" name = "announcementContent" placeholder="Content...">
    <button type = "submit" name = "submit">Post announcement</button>
  </form>
</div>
</section>

<?php
if(isset($_GET["error"])) //if we have something written in the url (like an error)
{
  if($_GET["error"] == "emptyInput")
  {
    echo '<p class="errorMessage"> Fill in all fields! </p>';
  }
  else if($_GET["error"] == "invalidMessageSize")
  {
    echo '<p class="errorMessage"> Message cannot have more than 500 characters! </p>';
  }
  else if($_GET["error"] == "invalidTitleSize")
  {
    echo '<p class="errorMessage"> Title cannot have more than 80 characters! </p>';
  }
  else if($_GET["error"] == "stmtFailed")
  {
    echo '<p class="errorMessage"> Something went wrong, try again! </p>';
  }
  else if($_GET["error"] == "success")
  {
    echo '<p class="successMessage"> You successfully posted the announcement! </p>';
  }
}
?>

<?php
  include_once 'footer.php';
?>
