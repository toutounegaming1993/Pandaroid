<?php  
session_start(); //On utilise la meme session
session_destroy(); //On la detruit
header("location: connection.php"); //On reviens a l'ecran d'accueil
exit();
?>