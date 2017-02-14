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
    <h3>Bild uppladdning</h3>
    <h6>Välj fil på raden vid det inlägg du vill lägga till en bild, du bara kan bara ha en bild per inlägg</h6>
    <?php
    $username = $_SESSION['name'];


    $sql = "SELECT title, postid FROM post WHERE username=$username";
    $result = db_select($sql);
//nedanför så har vi formuläret, har ett dolt fält med postid nummret för att veta vilken post det handlar om
    ?>

    <?php foreach ($result as $row): ?>
        <form method="post" action="fileupload.php" enctype="multipart/form-data">
            Select File: <input type="file" name="file" size="10">
            <?= $row['title'] ?>
            <input type="hidden" name="postid" value="<?= $row['postid'] ?>">
            <input type="submit" name="upload" value="Upload">
        </form>
    <?php endforeach;?>


    <?php

    if(isset($_POST['upload']))
    {
        $postid = $_POST['postid'];


        //hämtar data o sparar bild i tmp
        $file = rand(1000,100000)."-".$_FILES['file']['name'];
        $file_loc = $_FILES['file']['tmp_name'];
        $folder="images/";


// döper om filnamnet så att det är i småboktsväer
        $new_file_name = strtolower($file);
// tar bort vissa tecken från filnamnet

        $final_file=str_replace(' ','-',$new_file_name);
//sparar bild
        if(move_uploaded_file($file_loc,$folder.$final_file)) {
            $sql = "UPDATE post SET image = '$final_file' WHERE postid='$postid'";
            $result = db_query($sql);
            if ($result === false) {
                // Could not delete user...
                echo "Något blev fel";
            } else {
                echo "Bild uppladdad";
            }
        }
    }
    ?>
</div>
<?php
Include('footer.php');
?>