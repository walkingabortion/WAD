<?php
  include_once 'header.php';
?>

<section class = "sell-form">
  <h2> Fill up the rows below: </h2>
  <div class = "sell-form">
  <form action="includes/sell-inc.php" method="post" enctype="multipart/form-data">
    <input type = "text" name = "bookTitle" placeholder="Book title...">
    <input type = "text" name = "bookAuthor" placeholder="Book author...">
    <input type = "number" name = "bookPrice" placeholder="Price...">
    <input type = "file" name = "file" >
    <button type = "submit" name = "submit">SELL SELL SELL</button>
  </form>
</div>

</section>

<?php

  if(isset($_GET["error"])) //if we have something written in the url (like an error)
  {
    if($_GET["error"] == "emptyInputSell")
    {
      echo "<p> Fill in all fields! </p>";
    }
    else if($_GET["error"] == "invalidPrice")
    {
      echo "<p> Price needs to be positive! </p>";
    }
    else if($_GET["error"] == "invalidFileType")
    {
      echo "<p> Types accepted are jpg, png and jpeg. </p>";
    }
    else if($_GET["error"] == "uploadSuccess")
    {
      echo "<p> You successfully <b>booked</b> a room in our database! </p>";
    }
  }

?>



<?php
  include_once 'footer.php';
?>
