<?php
/* Création de miniatures */
function creer_min($chemin_img,$nom_img,$largeur_min) {
    /* On mit l'image que l'on souhaite miniaturiser*/
    $image = imagecreatefromjpeg($chemin_img);
    $largeur = imagesx($image);
    $hauteur = imagesy($image);
    /* On accorde la hauteur de la miniature par rapport a sa largeur  */
    $hauteur_min = floor($hauteur*($largeur_min/$largeur));
    /* On crée une image virtuelle avec les dimension de notre miniature */
    $image_vir = imagecreatetruecolor($largeur_min,$hauteur_min);
    /* On copie l'image dans l'image virtuelle   */
    imagecopyresized($image_vir,$image,0,0,0,0,$largeur_min,$hauteur_min,$largeur,$hauteur);
    /* On cree l'image et on la place dans le repertoire voulu */
    imagejpeg($image_vir, '/min/'.$nom_img);
}


?>