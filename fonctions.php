<?php
session_start();
include_once('bdd.php');	
function non_amis($bdd){
	
	$sql = "SELECT * FROM membre ";
	$sql .= " WHERE id NOT LIKE ".$_SESSION['id']." ";
	$resultat = $bdd->query($sql);
	while($non_amis=$resultat->fetch())
	{
		$membre_id=$non_amis['id'];
		$nom=$non_amis['nom'];
		$prenom=$non_amis['prenom'];
		echo "<a href='profil.php?membre=$membre_id' data-toggle='tooltip' title='Accéder au profil'class='b_social'>$prenom $nom</a>";
	}
				
}
function liste_membre_admin($bdd)
{
	$mon_id=$_SESSION['id'];
	$admin=$_SESSION['admin'];
	$sql = "SELECT * FROM membre ";
	$resultat = $bdd->query($sql);
	while($membre=$resultat->fetch())
	{
		$membre_id=$membre['id'];
		$nom=$membre['nom'];
		$prenom=$membre['prenom'];
		echo "<a href='profil.php?membre=$membre_id&admin=$admin' data-toggle='tooltip' title='Accéder au profil' class='b_social'>$prenom $nom</a>";
		
	}
}
function amis($bdd){
	$mon_id=$_SESSION['id'];
	$sql = "SELECT * FROM amis ";
	$sql .="WHERE (membre1_id ='$mon_id') OR (membre2_id ='$mon_id')";
	$resultat = $bdd->query($sql);
	while($amis=$resultat->fetch())
	{	
		$membre1_id=$amis['membre1_id'];
		$membre2_id=$amis['membre2_id'];
		if($membre1_id == $mon_id){
			$membre=$membre2_id;
		}
		else{
			$membre=$membre1_id;
		}
		$nom_req = "SELECT * FROM membre ";
		$nom_req .="WHERE id LIKE '$membre' ";
		$resu = $bdd->query($nom_req);
		while($nom=$resu->fetch())
		{
			$n=$nom['nom'];
			$pre=$nom['prenom'];
			
		}
		echo "<a href='profil.php?membre=$membre' data-toggle='tooltip' title='Accéder au profil' class='b_social'>$pre $n</a>";
	}
}
function retourner_nom_amis($bdd,$amis){
	$sql = "SELECT * FROM membre ";
	$sql .="WHERE id LIKE '$amis' ";
	$resultat = $bdd->query($sql);
	while($amis=$resultat->fetch())
	{	
			$n=$amis['nom'];
			$pre=$amis['prenom'];
	}
	return "$pre $n";
}
function afficher_album($bdd)
{
	$sql = "SELECT * FROM album ";
	$resultat = $bdd->query($sql);
	while($album=$resultat->fetch())
	{	
		$album_nom=$album['Nom'];
		$album_id=$album['id'];
		
		echo "<a href='album.php?album=$album_id'>$album_nom</a>";
	}
}
function afficher_contenu_album($album,$bdd){
	$mon_id=$_SESSION['id'];
	$sql = "SELECT * FROM photo_album ";
	$sql .="WHERE album_id ='$album'";
	$resultat = $bdd->query($sql);
	$x=0;
	
	while($alb=$resultat->fetch())
	{
		$photo=$alb['photo_id'];
		$photo_req = "SELECT * FROM photos ";
		$photo_req .="WHERE id LIKE '$photo' ";
		$resu = $bdd->query($photo_req);
		if($x==0){  
			echo "<tr>";
		}elseif($x%5==0){
			echo"</tr><tr>";
		}
		while($nomm=$resu->fetch())
		{
			
		$nom=retourner_nom_amis($bdd,$nomm['Proprietaire']);
		$nom=strtoupper($nom);
			$nom_photo=$nomm['Nom'];
			echo '<td><a class="image_lien" data-lightbox="diapo"  data-title="'.$nom.' | '.$nomm['Titre'].' | '.$nomm['Lieu'].' | '.$nomm['Date'].'" href="Images/'.$nomm['Proprietaire'].'/'.$nomm['Nom'].'"><span class="nom_proprietaire">'.$nom.'</span><img class="image_diapo" src="min/'.$nomm['Proprietaire'].'/'.'mini'.'_'.''.$nomm['Nom'].'"></a></td>';

			 	
		}
		
		$x++;
	}

}
function req_amis($bdd){
	$mon_id=$_SESSION['id'];
	$sql = "SELECT * FROM req_amis ";
	$sql .="WHERE recepteur ='$mon_id' ";
	$resultat = $bdd->query($sql);
	while($req_amis=$resultat->fetch())
		{	
			$membre=$req_amis['demandeur'];
			
			$nom_req = "SELECT * FROM membre ";
			$nom_req .="WHERE id LIKE '$membre' ";
			$resu = $bdd->query($nom_req);
			while($nom=$resu->fetch())
			{
				$no=$nom['nom'];
				$pren=$nom['prenom'];
				
			}
			echo "<a href='profil.php?membre=$membre' class='b_social' >$pren $no</a>";
	}
}
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
	$sql .= " ORDER BY Date DESC  ";
	$resultat = $bdd->query($sql);
		$x=0;
		while($diap=$resultat->fetch())
			{	
				
				$nom=retourner_nom_amis($bdd,$diap['Proprietaire']);
				$nom=strtoupper($nom);
				if($diap['publique']==1)
				{
					if($x==0){      
						echo "<tr>";

					}elseif($x%5==0){
					echo"</tr><tr>";
					}
					echo '<td><a class="image_lien" data-lightbox="diapo"  data-title="'.$nom.' | '.$diap['Titre'].' | '.$diap['Lieu'].' | '.$diap['Date'].'" href="Images/'.$diap['Proprietaire'].'/'.$diap['Nom'].'"><span class="nom_proprietaire">'.$nom.'</span><img class="image_diapo" src="min/'.$diap['Proprietaire'].'/'.'mini'.'_'.''.$diap['Nom'].'"></a></td>';
					$x++; 
				}
						
			}
				
}

function mes_photos($bdd){
	$mon_id=$_SESSION['id'];
	$sql = "SELECT * FROM photos ";
	$sql .= " WHERE Proprietaire LIKE ".$_SESSION['id']." ";
	$sql .= " ORDER BY Date DESC ";
	$resultat = $bdd->query($sql);
	echo'<table>';
		$x=0;
		while($diap=$resultat->fetch()){
			$nom=retourner_nom_amis($bdd,$diap['Proprietaire']);
			$photo_nom=$diap['Nom'];
			$photo_id=$diap['id'];
			if($x==0){      
				echo "<tr>";

			}elseif($x%5==0){
					echo"</tr><tr>";
			}
			echo '<td><a class="image_lien" data-lightbox="diapo"  data-title="'.$nom.' | '.$diap['Titre'].' | '.$diap['Lieu'].' | '.$diap['Date'].'" href="Images/'.$diap['Proprietaire'].'/'.$diap['Nom'].'"><span class="nom_proprietaire">'.$nom.'</span><img class="image_diapo" src="min/'.$diap['Proprietaire'].'/'.'mini'.'_'.''.$diap['Nom'].'"></a>';
			echo "</br>";
			echo'<form id = "form_image" method="post">';
			if($diap['publique']==0)
				echo"<a href='actions.php?action=publier&membre=$mon_id&photo_id=$photo_nom' class='b_social'>Publier</a><br><br>";
			else
				echo"<a href='actions.php?action=priver&membre=$mon_id&photo_id=$photo_nom' class='b_social'>Rendre Privé</a><br><br>";
			echo"<a href='actions.php?action=supprimer&membre=$mon_id&photo_id=$photo_nom' class='b_social'>Supprimer</a>";	
				
			echo "</br></br>";

		
			echo"<div id='b_info' >Informations</div><br><br>";
			echo"<p id='exif'>";
				
			
			info_exif($bdd,$photo_nom);
			echo "</p>";
			echo'</form>'; 
			echo '</td>';
			$x++; 
			if (isset($_POST['valider2']) AND $_POST['valider2'] == 'Valider'){
			// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
			if ((isset($_POST['album']) AND !empty($_POST['album']) AND($_POST['album']!=0) ))
			{
				$album=$_POST['album'];
				$sql = "INSERT INTO photo_album (album_id, photo_id) VALUES(";
				$sql .= "'$album','$photo_id')";
				$bdd->query($sql);
			}
		}
		}
		echo'</tr>';
		echo'</table>';
	
}

function get_album($bdd){
	$mon_id=$_SESSION['id'];
	$sql = "SELECT * FROM album ";
	$sql .= "WHERE Proprietaire LIKE '$mon_id' ";
	$resultat = $bdd->query($sql);
	while($diap=$resultat->fetch()){
		$a_nom=$diap['Nom'];
		echo '<option value='.$diap['id'].'>'.$diap['Nom'].'</option>';
	}

	
}
function photo_amis($bdd,$id_amis){
	$sql = "SELECT * FROM photos ";
	$sql .= " WHERE Proprietaire LIKE '$id_amis' ";
	$sql .= " AND publique LIKE '1' ";
	$sql .= " ORDER BY Date DESC ";
	$resultat = $bdd->query($sql);
	echo'<table>';
	echo'<tr>';
	$x=0;
	while($diap=$resultat->fetch()){
		if($x==0){      
				echo "<tr>";

			}elseif($x%5==0){
					echo"</tr><tr>";
			}
	$nom=retourner_nom_amis($bdd,$diap['Proprietaire']);
	$photo_id=$diap['id'];
	echo '<td><a class="image_lien" data-lightbox="diapo"  data-title="'.$nom.' | '.$diap['Titre'].' | '.$diap['Lieu'].' | '.$diap['Date'].'" href="Images/'.$diap['Proprietaire'].'/'.$diap['Nom'].'"><span class="nom_proprietaire">'.$nom.'</span><img class="image_diapo" src="min/'.$diap['Proprietaire'].'/'.'mini'.'_'.''.$diap['Nom'].'"></a></td>';
	$x++;
	}
echo'</tr>';
echo'</table>';		
}
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

/* Reccuperation des infos exif */
function info_exif($bdd,$img)
{	
	$dossier=$_SESSION['url'];
	$tab_exf=array();
	$focale=null;
	$marque=null;
	$modele=null;
	$vit_obt=null;
	$iso=null;
	$date=null;
	$largeur=null;
	$hauteur=null;
	/* Je verifie si mon image est de type jpeg ou de type tiff*/
	$formats = array( 'jpg' , 'jpeg' , 'tif' , 'tiff' );
	$verif = strtolower(  substr(  strrchr( $dossier.$img, '.')  ,1)  );
	if ( in_array($verif,$formats) )
	{

	  /* Je verifie si mon image contient des infos exif*/
		if($exif = exif_read_data($dossier.$img,0, true))
		{
			
			/* On reccupere nos valeur dans un tableau */
			foreach ($exif as $key => $section) 
			{       
				foreach ($section as $name => $val) 
				{
					
					if($name=='FocalLength') // Si les données de la distance focale existent
						{
							$focale = round($val, 0); // j'arrondis la valeur
							$focale = $focale." mm"; // Je rajoute l'unité millimètre
						}
					if($name=='Make') // Marque de l'appareil
						$marque = $val;
					if($name=='Model')// Modèle de l'appareil
							$modele = $val;
					if($name=='ExposureTime')// Vitesse d'obturation
							$vit_obt = $val;
					if($name=='ISOSpeedRatings') // Valeur iso
							$iso = $val;
					if(($name=='DateTimeOriginal') OR($name=='DateTime')){
						
						$date = $val; // Date de la prise de vue (heure de l'appareil)
						
					}
					if ($name=='Width'){
						$largeur = $val;
						
					}
						
					if ($name=='Height')
						$hauteur = $val;						
				
				}
				
			}
			

			if(($largeur) AND ($hauteur)){
				$resolution =$largeur.'*'.$hauteur;
				echo "<span style='font-weight: bold;'>Resolution :</span><br />";
				echo "$resolution<br />";
			}
			if(($marque) OR ($modele))
				echo "<span style='font-weight: bold;'>Appareil :</span><br />";
			if($marque)
				echo "	Marque : $marque<br />";
			if($modele)
				echo	"Modèle : $modele<br />";
			if(($focale) OR  ($vit_obt) OR $iso)
				echo	"<span style='font-weight: bold;'>Caractéristiques :</span><br />";
			if($focale)		 
				echo	"Focale : $focale<br />";
			if($vit_obt)
				echo	"Vitesse d'obturation : $vit_obt<br />";
			if($iso)
				echo	"Iso : $iso<br />";
			if($date)
				echo	"Prise le : $date";
			


		}

	}
	else{
			$extension = strtolower(  substr(  strrchr($img, '.')  ,1)  );
			
			switch($extension){
				case 'jpeg':$image = imagecreatefromjpeg($dossier.$img); break;
				case 'jpg': $image = imagecreatefromjpeg($dossier.$img); break;
				case 'png': $image = imagecreatefrompng($dossier.$img); break;
				case 'gif': $image = imagecreatefromgif($dossier.$img); break;
				default : echo 'error';die();
			}
			$largeur = imagesx($image);
			$hauteur = imagesy($image);
			$resolution =$largeur.'*'.$hauteur;
			
		}
}


/* Création de miniatures */
function creer_min($chemin_img,$nom_img,$largeur_min,$hauteur_min) {
	$extension = strtolower(  substr(  strrchr($nom_img, '.')  ,1)  );
	/* On prend l'image que l'on souhaite miniaturiser*/
	switch($extension){
	case 'jpeg':$image = imagecreatefromjpeg($chemin_img); break;
    case 'jpg': $image = imagecreatefromjpeg($chemin_img); break;
    case 'png': $image = imagecreatefrompng($chemin_img); break;
    case 'gif': $image = imagecreatefromgif($chemin_img); break;
	default : echo 'error';die();
	}
    
	$nouv_lar = $largeur_min;
	$nouv_haut = $hauteur_min;
    $largeur = imagesx($image);
    $hauteur = imagesy($image);
    /* On accorde la hauteur de la miniature par rapport a sa largeur  */

		$ratio = $hauteur / $largeur;
		$nratio = $nouv_haut / $nouv_lar; 

		  if($ratio > $nratio)
		  {
			$inter = intval($largeur * $nouv_haut / $hauteur);
			if ($inter < $nouv_lar)
			{
			  $nouv_haut = intval($hauteur * $nouv_lar / $largeur);
			} 
			else
			{
			  $nouv_lar = $inter;
			}
		  }
		  else
		  {
			$inter = intval($hauteur * $nouv_lar / $largeur);
			if ($inter < $nouv_haut)
			{
			  $nouv_lar = intval($largeur * $nouv_haut / $hauteur);
			} 
			else
			{
			  $nouv_haut = $inter;
			}
		  } 	
    
    /* On crée une image virtuelle avec les dimension de notre miniature */
    $image_vir = imagecreatetruecolor($nouv_lar,$nouv_haut);
    /* On copie l'image dans l'image virtuelle   */
    imagecopyresized($image_vir,$image,0,0,0,0,$nouv_lar,$nouv_haut,$largeur,$hauteur);
	 $viewimage = imagecreatetruecolor($largeur_min, $hauteur_min);
	imagecopy($viewimage, $image_vir, 0, 0, 0, 0, $nouv_lar,$nouv_haut);
    /* On cree l'image et on la place dans le repertoire voulu */
    imagejpeg($viewimage, 'min/'.$_SESSION['id'].'/'.'mini'.'_'."$nom_img");
}
			
?>