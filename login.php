<?php


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
    Logga in
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
            <td><input type="submit" value="Login" name="submit"></td>
        </tr>
    </table>



</form>

<?php
If(isset($_POST['submit'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = db_quote($username);
    $password = db_quote($password);



    // Kör sql
    $sql = "SELECT username, password FROM user WHERE username=$username AND password=$password";
    $result = db_select($sql);
    //sparar så att jag jämför där username och password stämmer på samma rad

    if (empty($_POST['username']) && $_POST['password']) { //om fältet user är tomt ges felmeddelande
        echo "Du måste ange ett användarnamn";
    } elseif (empty($_POST['password']) && $_POST['username']) { //om fältet password är tomt ges felmeddeelande
        echo "Du måste ange ett lösenord";
    } else {echo "fel inlogg";
    }


    foreach ($result as $row) {

       //om fälten inte stämmer överens på samma rad..
        if ($row) {
            $_SESSION["name"] = $username;
            header("Location: backend.php");
            echo "inloggad";
        } else {
            echo "fel inlogg";
            }
        }

    }


?>




</div>


<?php
Include('footer.php');
?>