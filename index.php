<?php
  include_once 'header.php';
?>
<?php //this should be only on the index file for a fancy welcome
if(isset($_SESSION['usersName']))
{
  $currentUser = $_SESSION['usersName'];
  if($currentUser == 'admin')
    {
        echo '<p class="welcomeMessage"> Hello there GOD </p>';
    }
  else
  {
    echo '<p class="welcomeMessage"> Hello there '. $_SESSION['usersName'] .' </p>';
  }
}
 ?>
 <?php
  require_once 'includes/dbh-inc.php';

  $query = "Select * from book ";
  $result = mysqli_query($connection, $query);
 ?>
    <div class="topPicksMessage">
      Today's top picks based on user's rating are:
    </div>
    <section>
      <article class="tableTop3">
        <table border="1">
          <tr class="columnTitles">
            <th>Picture</th>
            <th>Book title</th>
            <th>Price</th>
            <th>Seller rating</th>
          </tr>
          <tr>
            <td>Book1_picture</td>
            <td>Book1 title</td>
            <td>Book1 price</td>
            <td>Book1 seller rating</td>
          </tr>
          <tr>
                  <td>Book2_picture</td>
                  <td>Book2 title</td>
                  <td>Book2 price</td>
                  <td>Book2 seller rating</td>
                </tr>
          <tr>
            <td>Book3_picture</td>
            <td>Book3 title</td>
            <td>Book3 price</td>
            <td>Book3 seller rating</td>
          </tr>
        </table>
      </article>
      <hr>

      <article class="tableGeneral">
        <table border="1">
          <tr class="columnTitles">
            <th>Image</th>
            <th>Title</th>
            <th>Author</th>
            <th>Price</th>
            <th>Seller</th>
          </tr>
          <?php while($row = mysqli_fetch_array($result))
          {?>
            <tr>
                <td><?php echo '<img src="data:image/png; base64, '.base64_encode($row['bookImage']).'" height="50" width="50" />'; ?></td>
                <td><?php echo "$row[bookTitle]"; ?></td>
                <td><?php echo "$row[bookAuthor]"; ?></td>
                <td><?php echo "$row[bookPrice]"; ?></td>
                <td><?php echo "$row[bookOwner]"; ?></td>
              </tr>
  <?php } ?>
        </table>
      </article>
    </section>

    <?php
      include_once 'footer.php';
    ?>
