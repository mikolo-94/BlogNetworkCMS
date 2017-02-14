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
    <h3>Uppdatera din sida</h3>
    <?php
    $username = $_SESSION['name'];
    //ändrar följande sida

    $sql = "SELECT presentation, title, fullname FROM page WHERE username=$username";
    $result = db_select($sql);
    ?>

    <form method="post">
        <table>
            <?php foreach ($result as $row): ?>

            <tr>
                <td><label>Titel</label></td>
                <td><input type="text" name="title" value="<?= $row['title'] ?>"></td>
            </tr>
                <tr>
                    <td><label>Namn</label></td>
                    <td><input type="text" name="fullname" value="<?= $row['fullname'] ?>"></td>
                </tr>
            <tr>
                <td><label>Presentation</label></td>
                <td><textarea name="presentation"><?= $row['presentation'] ?></textarea></td>
            </tr>

            <tr>
                <td><input type="submit" value="Uppdatera" name="submit"></td>
            </tr>

            <?php endforeach;?>
        </table>





    </form>



    <?php
    If(isset($_POST['submit']))  {


        $title = $_POST['title'];
        $fullname = $_POST['fullname'];
        $presentation = $_POST['presentation'];


        $title = db_quote($title);
        $fullname = db_quote($fullname);
        $presentation = db_quote($presentation);


        $sql = "UPDATE page SET title=$title, fullname=$fullname, presentation=$presentation WHERE username=$username";
        $result = db_query($sql);
        if ($result === false) {
            // Något blev fel
            echo "Något blev fel";
        } else {
            echo "Sidan är uppdaterad";
        }
    }
    ?>



</div>

<?php
Include('footer.php');
?>