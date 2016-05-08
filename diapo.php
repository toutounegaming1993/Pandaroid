<?php
session_start();

function diapo($bdd){
	$mon_id=$_SESSION['id'];
	$amigas=liste_amis($bdd);
	if($amigas!=null)
		$amigass=join(',',$amigas);
	else
		$amigass=$mon_id;
	$sql = "SELECT * FROM photos ";
	$sql .= " WHERE Proprietaire LIKE ".$_SESSION['id']." ";
	$sql .= " OR Proprietaire IN ($amigass) ";
	$sql .= " ORDER BY Date DESC LIMIT 10 ";
	$resultat = $bdd->query($sql);

		while($diap=$resultat->fetch())
	{
		if($diap['Proprietaire']==$mon_id){
			$extension_pos=strrpos($diap['Nom'], '.'); 
			//$mini_nom=substr($diap['Nom'],0,$extension_pos).'.;
			echo '<a class="image_lien" data-lightbox="diapo" data-title="'.$diap['Titre'].' | '.$diap['Lieu'].' | '.$diap['Date'].'"  href="Images/'.$_SESSION['id'].'/'.$diap['Nom'].'"><img class="image_diapo" src="min/'.$_SESSION['id'].'/'.'mini'.'_'.''.$diap['Nom'].'"></a>';
		}
			
		else{
			echo '<a class="image_lien" data-lightbox="diapo"  data-title="'.$diap['Titre'].' | '.$diap['Lieu'].' | '.$diap['Date'].'" href="Images/'.$diap['Proprietaire'].'/'.$diap['Nom'].'"><img class="image_diapo" src="min/'.$diap['Proprietaire'].'/'.'mini'.'_'.''.$diap['Nom'].'"></a>';
		}
	}
				
}

$db_login 	= "root";
$db_pass	= "root";
$dbname 	= "pandaroid";
$bdd = new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8",$db_login, $db_pass);
function liste_amis($bdd){
	$amigos=array();
	$mon_id=$_SESSION['id'];
	$sql = "SELECT * FROM amis ";
	$sql .="WHERE (membre1_id ='$mon_id') OR (membre2_id ='$mon_id')";
	$resultat = $bdd->query($sql);
	while($amis=$resultat->fetch())
	{
		if($amis['membre1_id'] !=$mon_id)
			$amigos[]=$amis['membre1_id'];
		else if($amis['membre2_id'] !=$mon_id) 
			$amigos[]=$amis['membre2_id'];
	}
	return $amigos;
}

?>

