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
            <li><a href="createpost.php">Skapa inlägg</a></li>
            <li><a href="editpage.php">Redigera sida</a></li>

            <li><a href="personalposts.php">Hantera inlägg</a></li>
            <li><a href="fileupload.php">Ladda upp bild</a></li>
            <li><a href="images.php">Hantera bilder</a></li>
            <li><a href="index.php">Hem</a></li>
            <li> <a href="logout.php">Logga ut</a></li>
        </ul>

    </div>
    <div id="content">



        <h3>Senaste inlägg</h3>
        <?php

        //Väljer info som jag kommer skriva ut för att hämta de senaste 5 inläggen, texten på inläggen är begränasade till 50 tecken
        $sql = "SELECT text,postid, username, title FROM post ORDER BY created DESC LIMIT 5 ";
        $result = db_select($sql);
        ?>

        <?php foreach ($result as $row): ?>
            <ul>

                <li><?= '<a href="post.php?postid=' . $row['postid'] . '&username=' . $row['username']?>"><?= $row['title'] ?></a></li>
                <li><?= substr($row['text'],0,50) ?></li>
            </ul>
        <?php endforeach;?>

        <?php
        //Hämtar datan som behövs för att skriva ut de senaste registerade användarna sorterade på nyast överst
        $sql = "SELECT username, created FROM user ORDER BY created DESC";
        $result = db_select($sql);

        ?>

        <h3>Nyaste användare</h3>
        <table>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['created'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div id="info">
        <ul>

            </ul>

    </div>
<?php
Include('footer.php');
?>