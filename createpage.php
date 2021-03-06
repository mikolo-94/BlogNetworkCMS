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
    <h3>Skapa presentatation</h3>
    <h6>OBS! Enbart för skapandet, vill du redigera din presentatation kolla på sidan redigera sida</h6>
    <form method="post">
        <table>
            <tr>
                <td><label>Titel</label></td>
                <td><input type="text" name="title"></td>
            </tr>
            <tr>
                <td><label>Namn</label></td>
                <td><input type="text" name="fullname"></td>
            </tr>
            <tr>
                <td><label>Presentation</label></td>
                <td><textarea name="presentation"></textarea></td>
                <td><input type="submit" value="Skapa" name="submit"></td>
            </tr>
        </table>
    </form>
    <?php

    If(isset($_POST['submit'])) {

//skapar sida
        $title = $_POST['title'];
        $username = $_SESSION["name"];
        $fullname = $_POST['fullname'];
        $presentation = $_POST['presentation'];

        $title = db_quote($title);
        $fullname = db_quote($fullname);
        $presentation = db_quote($presentation);

        // Create the sql-query:
        $sql = "INSERT INTO page (title, username, fullname, presentation) VALUES ($title, $username, $fullname, $presentation)";
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