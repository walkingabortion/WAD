<?php
 session_start();
 session_unset();
 session_destroy(); //this will lock out the user
 header("location: ../index.php");
 exit();
