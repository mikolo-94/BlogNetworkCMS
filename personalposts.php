<?php
session_start();
// om sessionen login_user inte är aktiv skickas användaren tillbaka till index.php
if(!$_SESSION["name"]) {
    header("Location: index.php");
    die; }
Include('db.php');
Include('header.php');

?>
<div id="menu">
    <h3>Meny</h3>
    <ul>
        <li><a href="createpage.php">Skapa sida</a></li>
        <li><a href="editpage.php">Redigera sida</a></li>
        <li><a href="createpost.php">Skapa inlägg</a></li>
        <li><a href="personalposts.php">Hantera inlägg</a></li>
        <li><a href="fileupload.php">Ladda upp bild</a></li>
        <li><a href="images.php">Hantera bilder</a></li>
        <li><a href="index.php">Hem</a></li>
        <li> <a href="logout.php">Logga ut</a></li>
    </ul>

</div>
    <div id="content">
        <h3>Hantera inlägg</h3>
        <?php
        $username = $_SESSION["name"];
//hämtar info och username från vem som är inloggad. Allt skrivs ut där nere och jag skickar med länkar till delete och edit sidorna där de utförs
        $sql = "SELECT title, created, postid FROM post WHERE username=$username";
        $result = db_select($sql);

        ?>

        <table>
       <?php foreach ($result as $row): ?>
  <tr>
    <td><?= $row['title'] ?></td>
    <td><?= $row['created'] ?></td>
      <td><?= '<a href="editpost.php?postid=' . $row['postid'] ?>">  Edit</a></td>
      <td><?= '<a href="deletepost.php?postid=' . $row['postid'] ?>">  Delete</a></td>
  </tr>
        <?php endforeach;?>
</table>







    </div>

<?php
Include('footer.php');
?>