<?php
  include_once 'header.php';
?>

<?php
if(isset($_SESSION['usersName']))
{
  require_once 'includes/dbh-inc.php';
  $owner = $_SESSION['usersName'];
  echo '<p class="welcomeMessage"> Here are your books for sale, '.$owner.' </p>';

  $query = "Select * from book ";
  $result = mysqli_query($connection, $query);  //this is used below
}
?>
<article class="tableUser">
  <table border="1">
    <tr class="columnTitles">
      <th>Image</th>
      <th>Title</th>
      <th>Author</th>
      <th>Price</th>
    </tr>
    <?php while($row = mysqli_fetch_array($result))
    {

      if($row['bookOwner'] == $owner)
      {?>
        <tr>
          <td><?php echo '<img src="data:image/png; base64, '.base64_encode($row['bookImage']).'" height="50" width="50" />'; ?></td>
          <td><?php echo "$row[bookTitle]"; ?></td>
          <td><?php echo "$row[bookAuthor]"; ?></td>
          <td><?php echo "$row[bookPrice]"; ?></td>
          <td><a class="deleteEntry" href="delete.php?id=<?php echo $row["bookId"]; ?>"> Delete this entry </a></td>
        </tr>
<?php }
    } ?>
  </table>
</article>
<?php
  include_once 'footer.php';
?>
