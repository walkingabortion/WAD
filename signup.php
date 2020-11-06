<?php
  include_once 'header.php';
?>
<style>
<?php include 'style/signin-style.css'; ?>
</style>

  <section class = "signup-form">
    <h2> Sign Up </h2>
    <div class = "signup-form">
    <form action="includes/signup-inc.php" method="post"> <!-- inc comes from includes -->
      <input type = "text" name = "fullName" placeholder="Full name...">
      <input type = "text" name = "email" placeholder="Email...">
      <input type = "text" name = "username" placeholder="Username...">
      <input type = "password" name = "password" placeholder="Password...">
      <input type = "password" name = "passwordRepeat" placeholder="Repeat Password...">
      <button type = "submit" name = "submit">Sign up</button>
    </form>
  </div>
    <?php
      if(isset($_GET["error"])) //if we have something written in the url (like an error)
      {
        if($_GET["error"] == "emptyInput")
        {
          echo "<p> Fill in all fields! </p>";
        }
        else if($_GET["error"] == "invalidUid")
        {
          echo "<p> Choose a proper username! </p>";
        }
        else if($_GET["error"] == "invalidEmail")
        {
          echo "<p> Choose a proper email! </p>";
        }
        else if($_GET["error"] == "passwordMatch")
        {
          echo "<p> Passwords do not match! </p>";
        }
        else if($_GET["error"] == "usernameTaken")
        {
          echo "<p> Username already taken! </p>";
        }
        else if($_GET["error"] == "stmtFailed")
        {
          echo "<p> Something went wrong, try again! </p>";
        }
        else if($_GET["error"] == "none")
        {
          echo "<p> You signed up successfully! </p>";
        }
      }

     ?>
  </section>
  <?php
    include_once 'footer.php';
  ?>
