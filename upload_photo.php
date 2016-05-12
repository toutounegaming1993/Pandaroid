<?php
$titre = isset($_POST["titre"]) ? $_POST["titre"]:"";
$lieu = isset($_POST["lieu"]) ? $_POST["lieu"]:"";
include_once('fonctions.php');
date_default_timezone_set('Europe/Paris');
if (isset($_POST['valider']) AND $_POST['valider'] == 'Valider') {
	
	// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
	
	if ((isset($_POST['titre']) AND !empty($_POST['titre'])) AND (isset($_POST['lieu']) AND !empty($_POST['lieu']))){
		
		$maxsize=$_POST['MAX_TAILLE_FICHIER'];
		$image=$_FILES['photo']['name'];
		$image_tmp=$_FILES['photo']['tmp_name'];
		$dossier = $_SESSION['url'];
		$ext_image = substr($image, strrpos($image, '.') + 1);
		
		// on renomme le fichier
		$date = date("ymdhis");
		$nouveau_nom = $date . "." . $ext_image;
		
		if ($_FILES['photo']['error'] > 0) $erreur = "Erreur lors du transfert";
		else{
			if ($_FILES['photo']['size'] > $maxsize) $erreur = "Le fichier est trop gros";
			else
			{
				$formats = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
				$verif = strtolower(  substr(  strrchr($_FILES['photo']['name'], '.')  ,1)  );
				if ( in_array($verif,$formats) )
					{
						
						move_uploaded_file($image_tmp, "$dossier/$nouveau_nom");
						$sql = "INSERT INTO photos (Nom, Titre, Lieu, Proprietaire, Date) VALUES(";
						$sql .= "'$nouveau_nom','$titre','$lieu', ".$_SESSION['id'].",'$date')";
						$bdd->query($sql);
						creer_min("$dossier/$nouveau_nom",$nouveau_nom,200,200);
					}
			}		
		}
	}
	else {
		$erreur = 'Attention: un des champs est vide';
	}
}

?>
<!DOCTYPE html>

<html>

    <head>
		<?php include_once('fonctions.php');?>
		<link rel="stylesheet" href="PandaRoid.css" />
		<script type="text/javascript" src="PandaRoid.js"></script>
		<link rel="stylesheet" href="lightbox2-master/dist/css/lightbox.min.css">
		<link rel="shortcut icon" href="tetedepanda.ico"/>
		<!-- ADAPTER LA TAILLE A TOUS LES ECRANS !-->
		<meta name="viewport" content="width=device-width" />
        <meta charset="utf-8" />
		<script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>
		<title>Pandaroid</title>
		
    </head>

	<div id="nav">
		<ul>
			<img src="Image/tetecadree.jpg" alt="tete"/>
			<li id="links"><a href="PandaRoid.php">ACCUEIL</a></li>
			<li id="links"><a href="profil.php"><?php 
			$prenom = strtoupper($_SESSION['prenom']);
			echo $prenom; 
			?></a></li>
			<li id="links"><a href="PandaRoid.php">PARTAGER UNE PHOTO</a></li>
			<li id="links"><a href="album.php">ALBUMS</a></li>
			<li id="links"><a href="amis.php">AMIS</a></li>
			<?php 
			if($_SESSION['admin']=='1'){
				echo "<li id='links'><a href='admin.php'>ADMIN</a></li>";
			}
			?>
			<li id="lastlink"><a href="log_out.php">DECONNEXION</a></li>
		
		<div id="recherche_p">
			<form action="/search" id="searchthis" method="get">
				<input id="search" name="q" type="text" placeholder="Rechercher" />
				<input id="search-btn" src="Image/recherche1.png" type=image value=submit align="middle"/>
			</form>
		</div>
		</ul>
		
		
	</div>
	
	<header class="header">
		<div id="banniere">
			<img src="Image/bannierepandacadre.png"  alt= "banniere PandaRoid"/>
		</div>
	</header>
	
    <body>
		<div id="fond">
			<div id = "Contenu">
			
			<form id = "uploadformerror" action="upload_photo.php" method="post" enctype="multipart/form-data" runat="server" >
					<img id="sortir" src="Image/croix.png" alt="fermer" onClick="annuler0()"/>
					<div id="ajout">
					Ajouter votre photo
					</div>
					
					<input type="hidden" name="MAX_TAILLE_FICHIER" value="10485760" />		
					<input onchange="readURLerror(this);"  type="file" name="photo"><br><br>
					<img  id="image" src="#" /><br><br>
					<input type="text" name="titre" placeholder="Titre de la photo"><br><br>
					<input type="text" name="lieu" placeholder="Lieu de la photo"><br><br>
					<input id="upphotovalid" type="submit" name= "valider" value="Valider"  >
					<div id="erreur"><?php
			if (isset($erreur)) echo '<br />',$erreur;
			?>
			</div>	
					
			</form>
			<!--<div "titre_image">
				<h4>Tire Image</h4>
			</div>	
			<div id ="date">
				<p>Date image</p>
			</div>
			
			<div id= "contenu_footer">
				<div id ="boutons_vote">
					<table>
						<tr>
						<td><img src ="Image/upvote.png" alt= "Upvote"/></td>
						<td><img src ="Image/downvote.png" alt= "Downvote"/></td>
					</table>
				</div>
				 <div id="social">
					<table>
						<td><img src="Image/facebook.png"  alt= "Facebook"/></td>
						<td><img src="Image/twitter.png"  alt= "Twitter"/></td>
					</table>
				</div>
			</div>-->
		
				
			</div>
		</div>
	</body>
	
	
	<footer>
		<div id="footer">
			PandaRoid Copyright
		</div>
	</footer>
	
	
</html>

		

