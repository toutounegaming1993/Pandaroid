<?php  
session_start(); //On utilise la meme session
session_destroy(); //On la detruit
header("location: connexion.php"); //On revient a l'ecran d'accueil
exit();
?>