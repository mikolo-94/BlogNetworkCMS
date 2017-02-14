<?php

error_reporting(E_ALL);

session_start();
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
    <h3>
        Skapa konto
    </h3>
    <form method="post">
        <table>
            <tr>
                <td>
                    <label>Användarnamn</label>
                </td>
                <td>
                    <input type="text" name="username">
                </td>
            </tr>
            <tr>
                <td>
                    <label>Lösenord</label>
                </td>
                <td>
                    <input type="password" name="password">
                </td>
            </tr>
            <tr>
                <td><input type="submit" value="Register" name="submit"></td>
            </tr>
        </table>
        </form>






        <?php
        If(isset($_POST['submit'])) {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $username = db_quote($username);
            $password = db_quote($password);

            //Väljer ut användarnmanet navändaren matade in och jämför med db om det redan är registrerat, är det inte
            //det så registreras kontot annars får användaren välja ett nytt
            $sql = "SELECT username FROM user WHERE username=$username";

            $result = db_select($sql);
            //kollar så att de inte finns något användarnamn redan reggat, om de inte finns körs insert.


                if ($result) {
                    echo "Användarnamnet är upptaget";
                } else {
                    $sql = "INSERT INTO user (username, password) VALUES ($username, $password)";
                    // Run the query
                    $result = db_query($sql);

                    echo "Ditt konto är skapat, logga in vid inloggningsidan</a>";



            }
        }

        ?>




    </div>
    <div id="info">
        <ul>


            <li><a href="index.php">Hem</a></li>

            <li><a href="login.php">Logga in</a></li>




        </ul>
    </div>
<?php
Include('footer.php');
?>