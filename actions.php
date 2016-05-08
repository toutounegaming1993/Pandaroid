<?php
include_once('fonctions.php');

$action= $_GET['action'];

$photo_id= $_GET['photo_id'];

$membre=$_GET['membre'];

$mon_id=$_SESSION['id'];

$dossier=$_SESSION['url'];

if($action == 'envoie'){
	$bdd->query("INSERT INTO req_amis(demandeur, recepteur) VALUES ('$mon_id','$membre')");
}
else if($action == 'annuler'){
	$bdd->query("DELETE FROM req_amis WHERE demandeur='$mon_id' AND recepteur='$membre'");
}
else if($action == 'accepter'){
	$bdd->query("DELETE FROM req_amis WHERE demandeur='$membre' AND recepteur='$mon_id'");
	$bdd->query("INSERT INTO amis(membre1_id, membre2_id) VALUES ('$membre','$mon_id')");
}
else if($action == 'enlever'){
	$bdd->query("DELETE FROM amis WHERE (membre1_id='$membre' AND membre2_id='$mon_id') OR (membre1_id='$mon_id' AND membre2_id='$membre')");
}
else if($action == 'publier'){
	
	$bdd->query("UPDATE photos SET publique='1' WHERE Nom LIKE '$photo_id'");
}
else if($action == 'priver'){
	
	$bdd->query("UPDATE photos SET publique='0' WHERE Nom LIKE '$photo_id'");
}
else if($action == 'supprimer'){
	$bdd->query("DELETE FROM photos WHERE Nom LIKE '$photo_id'");
	unlink("$dossier/$photo_id");
	unlink('min/'.$_SESSION['id'].'/'.'mini'.'_'."$photo_id");
}
else if($action=='supprimermbr'){
	$bdd->query("DELETE FROM membre WHERE id LIKE '$membre'");
	rmdir("min/$membre");
	rmdir("Images/$membre");
	$membre=$mon_id;
}

header('location: profil.php?membre='.$membre);
?>
