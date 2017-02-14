<?php
session_start(); //startar session

Include('db.php');
Include('header.php');
?>

    <div id="menu">
        <?php

        //Väljer title, postid ssom är skapade av den  användaren som har skriivt den aktuella posten
        $sql = "SELECT pageid, username, title FROM page ORDER BY created DESC LIMIT 5";
        $result = db_select($sql);
        ?>

        <h3>Nyaste användare</h3>

                <ul>
                    <?php foreach ($result as $row): ?>

                    <li><?= '<a href="page.php?pageid=' . $row['pageid'] . '&username=' . $row['username']?>"><?= $row['username'] ?></a></li>
                    <?php endforeach;?>
                </ul>


    </div>

    <div id="content">

        <?php

        //Väljer title, postid ssom är skapade av den  användaren som har skriivt den aktuella posten
        $sql = "SELECT postid, username, title, text FROM post ORDER BY created DESC LIMIT 5";
        $result = db_select($sql);
        ?>

                <h1>Senaste inläggen</h1>
                <ul>
                    <?php foreach ($result as $row): ?>

                    <li><h4><?= '<a href="post.php?postid=' . $row['postid'] . '&username=' . $row['username']?>"><?= $row['title'] ?></a></h4></li>
                        <li><p><?= $row['text']?></p></li>
                        <li><h6>Författare: <?= $row['username']?></h6></li>


            <?php endforeach;?>
                </ul>
    </div>
    <div id="info">
        <ul>


                <li><h4>Menu</h4></li>
                <li><a href="login.php">Logga in</a></li>
            <li><a href="register.php">Skapa din egen blogg</a></li>



        </ul>

    </div>

<?php

Include('footer.php');
?>