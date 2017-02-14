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
        <h3>Hantera bilder</h3>
        <?php
        //listar alla bilder som inloggad användare har laddat upp
        $username = $_SESSION["name"];

        $sql = "SELECT title, postid, image FROM post WHERE username=$username";
        $result = db_select($sql);

        ?>

        <table>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?= $row['title'] ?></td>
                    <td><img src="images/<?= $row['image'] ?>" alt="<?= $row['title'] ?>"> </td>

                    <td><?= '<a href="deleteimage.php?postid=' . $row['postid'] . '&image=' . $row['image']?>">Delete</a></td>
                </tr>
            <?php endforeach;?>
        </table>









    </div>

<?php
Include('footer.php');
?>