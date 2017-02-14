<?php
session_start();

Include('db.php');
Include('header.php');
?>

<div id="menu">

    <?php
    $username = $_GET["username"];
    //Välljer title, postid ssom är skapade av den  användaren som har skriivt den aktuella posten
    $sql = "SELECT title, postid FROM post WHERE username='$username' ORDER BY created DESC LIMIT 5";
    $result = db_select($sql);

    ?>
    <h3>Senaste inlägg av <?php echo"$username" ?></h3>
    <table>
        <?php foreach ($result as $row): ?>
            <tr>

                <td><?= '<a href="post.php?postid=' . $row['postid'] . '&username=' . $username?>"><?= $row['title'] ?></a></td>

            </tr>
        <?php endforeach;?>
    </table>
</div>
<div id="content">
    <?php
    $pageid = $_GET['pageid'];



    $sql = "SELECT title, presentation, username FROM page WHERE pageid=$pageid";
    $result = db_select($sql);

    ?>
    <?php foreach ($result as $row): ?>

        <h3><?= $row['title'] ?></h3>



        <p><?= $row['presentation'] ?></p>

        <h6><?= $row['username'] ?></h6>


    <?php endforeach;?>





</div>
<div id="info">
    <ul>


        <li><a href="index.php">Hem</a></li>
        <li><a href="login.php">Logga in</a></li>
        <li><a href="register.php">Skapa din egen blogg</a></li>



    </ul>
</div>
<?php
Include('footer.php');
?>