<?php
  include_once 'header.php';
?>



<body>
  <link rel="stylesheet" type="text/css" href="/style/signin-style.css" media="screen" />
  <title>Sign in</title>
  <section class = "login-form">
    <h2> Log in </h2>
    <div class = "login-form">
    <form action="includes/login-inc.php" method="post"> <!-- inc comes from includes -->
      <input type = "text" name = "username" placeholder="Username / email...">
      <input type = "password" name = "password" placeholder="Password...">
      <button type = "submit" name = "submit">Log in</button>
    </form>
  </div>
  <?php
    if(isset($_GET["error"])) //if we have something written in the url (like an error)
    {
      if($_GET["error"] == "emptyInput")
      {
        echo "<p> Fill in all fields! </p>";
      }
      else if($_GET["error"] == "wrongLogin")
      {
        echo "<p> Wrong login credentials! </p>";
      }
    }

   ?>

  </section>

<?php
  include_once 'footer.php';
?>
