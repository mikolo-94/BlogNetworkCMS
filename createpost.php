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
    <h3>Skapa inlägg</h3>
    <h5>OBS! Du måste skapa en sida innan du skapar inlägg</h5>
    <form method="post">
        <table>
            <tr>
                <td><label>Titel</label></td>
                <td><input type="text" name="title"></td>
            </tr>
            <tr>
                <td><label>Text</label></td>
                <td><textarea name="text"></textarea></td>
            </tr>
            <tr>
                <td><input type="submit" value="Skapa" name="submit"></td>
            </tr>


        </table>
    </form>
    <?php
    If(isset($_POST['submit'])) {


        $title = $_POST['title'];
        $username = $_SESSION["name"];
        $text = $_POST['text'];


        $title = db_quote($title);
        $text = db_quote($text);





        // skapar post



        $sql = "INSERT INTO post (title, text, username) VALUES ($title, $text, $username)";
        $result = db_query($sql);
        if ($result === false) {
            // Could not delete user...
            echo "Något blev fel";
        } else {
            echo "Post skapad";
        }

    }
    ?>
</div>
<?php
Include('footer.php');
?>