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
        <h3>Uppdatera ditt inlägg</h3>
        <?php
        $postid = $_GET['postid'];


        $sql = "SELECT title, text FROM post WHERE postid=$postid";
        $result = db_select($sql);
        ?>

        <form method="post">
            <table>
                <?php foreach ($result as $row): ?>
                <tr>
                    <td><labe>Titel</labe></td>
                    <td><input type="text" name="title" value="<?= $row['title'] ?>"></td>
                </tr>
                <tr>
                    <td><label>Text</label></td>
                    <td><textarea name="text"><?= $row['text'] ?></textarea></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Uppdatera" name="submit"></td>
                </tr>


            </table>



            <?php endforeach;?>

        </form>



        <?php
        If(isset($_POST['submit']))  {


        $title = $_POST['title'];
        $text = $_POST['text'];
        $postid = $_GET['postid'];

        $title = db_quote($title);
        $text = db_quote($text);
        $postid = db_quote($postid);

        $sql = "UPDATE post SET title=$title, text=$text WHERE postid=$postid";
        $result = db_query($sql);
            if ($result === false) {
                // Något blev fel
                echo "Något blev fel";
            } else {
                echo "Posten är uppdaterad";
            }
        }
        ?>



    </div>

    <div id="footer">

    </div>
</div>
</body>
</html>