<?php
session_start(); //startar session
if(session_destroy()) // Förstör alla sessioner så att användaren loggas ut
{
    header("Location: index.php"); // vidarbefodrar användaren till index sidan
}
?>