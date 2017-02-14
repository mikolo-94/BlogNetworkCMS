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
        $postid = $_GET['postid'];



        $sql = "SELECT title, text, username, image FROM post WHERE postid=$postid";
        $result = db_select($sql);
        ?>
        <?php foreach ($result as $row): ?>

            <h3><?= $row['title'] ?></h3>



               <p><?= $row['text'] ?></p>
                <img src="images/<?= $row['image'] ?>" alt="<?= $row['title'] ?>" style="max-width:400px">
                <h6><?= $row['username'] ?></h6>


        <?php endforeach;?>





    </div>
    <div id="info">

        <?php


        //Hämtar det den ska och skriver ut de första 100 teckna på presentatation

        $sql = "SELECT fullname, presentation, pageid FROM page WHERE username='$username'";
        $result = db_select($sql);

        ?>
        <?php foreach ($result as $row): ?>





            <p><?= substr($row['presentation'],0,100) ?>...</p>

            <h6><?= $row['fullname'] ?></h6>
            <h6><?= '<a href="page.php?pageid=' . $row['pageid'] . '&username=' . $username?>">Besök profil</a></h6>

        <?php endforeach;?>

        <ul>


            <li><a href="index.php">Hem</a></li>

            <li><a href="login.php">Logga in</a></li>
            <li><a href="register.php">Skapa din egen blogg</a></li>



        </ul>
    </div>
<?php
Include('footer.php');
?>