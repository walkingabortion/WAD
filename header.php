<!DOCTYPE html>
<?php
  session_start();
  //echo '<p> Session started </p>';
  ?>
<html>

<head>
  <meta charset="utf-8">
  <meta name="description" content="SOCKS SOCKS SOCKS">
  <title>Fresh Socks</title>
  <link rel="stylesheet" type="text/css" href="style/index-style.css" media="screen" />
</head>

<body>
  <header>
    <div class="topBox">
      <h1 class="logo"> Fresh socks </h1>
      <div class="signin">
        <?php if(!isset($_SESSION['usersName'])) //if the user is logged in, we display a different content
        {
          echo "<a href='signup.php'>Sign up</a>";
          echo "<a href='login.php'>Log in</a>";
        }
        else
        {
          $currentUser = $_SESSION['usersName'];
          if($currentUser == 'admin')
          {
              echo "<a href='godMode.php'> God Mode </a>";
              echo "<a href='makeAnnouncement.php'> Make announcement </a>";
          }
          else
          {
              echo "<a href='account.php'> My account </a>";
              echo "<a href='sell.php'> Sell a book </a>";
          }
          echo "<a href='includes/logout-inc.php'> Log out </a>";
        }
        ?>

      </div>
    </div>

    <hr>

    <h4>
      <nav class="navigation">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="main/about.html">About</a></li>
          <li><a href="announcements.php">Announcements</a></li>
          <li><a href="main/contact.html">Contact</a></li>
        </ul>
      </nav>
    </h4>
    </header>
    <hr>
