<?php
session_start();
// om sessionen login_user inte är aktiv skickas användaren tillbaka till index.php
if(!$_SESSION["name"]) {
    header("Location: index.php");
    die; }
Include('db.php');
?>

<?php
$postid = $_GET['postid'];
//Raderar post

$sql = "DELETE FROM post WHERE postid=$postid";
$result = db_query($sql);
if($result === false)
{
    echo "Something went wrong";
}
else
{
    header("Location: personalposts.php");
}
?>
