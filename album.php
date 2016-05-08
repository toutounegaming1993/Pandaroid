<?php
$nom_album = isset($_POST["Nom_album"]) ? $_POST["Nom_album"]:"";
 include_once('fonctions.php');
include_once('bdd.php');
date_default_timezone_set('Europe/Paris');
$verif=0;
$mon_id=$_SESSION['id'];
		// on teste si le visiteur a soumis le formulaire
if (isset($_POST['valider']) AND $_POST['valider'] == 'Valider') {
	// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
	if (isset($_POST['Nom_album']) AND !empty($_POST['Nom_album'])) 
	{
		$req = "SELECT * FROM album ";
		$req .= "WHERE Nom LIKE '%$nom_album%' ";
		$req .= "AND Proprietaire LIKE '$mon_id' ";
		$resultat=$bdd->query($req);
		
		while($nom=$resultat->fetch()){
			$nomb=strtolower($nom["Nom"]);
			$nom_album=strtolower($nom_album);
			if($nomb == $nom_album){
			
			$verif=1;
			}
		}
		$erreur= $verif;
		if($verif==0){
			try
			{
				
				$date = date("ymdhis");
				$sql = "INSERT INTO album (Nom, Date, Proprietaire) VALUES(";
				$sql .= "'$nom_album','$date','$mon_id')";
				$bdd->query($sql);
				mkdir("album/$mon_id/$nom_album", 0777, true);
			}
		catch(Exception $e) {
				echo $e->getMessage();
				return;	
			}
		}
		else{
			$erreur = 'Nom déja pris';
		}
	}
	else {
	$erreur = 'Au moins un des champs est vide.';
	}
}
?>
<html>
	<head>
		
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
			<li id="links"><a href="diapo.php">ALBUMS</a></li>
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
	<body>
		<div id="fond">
			<div id = "Contenu">
				
				 <form id = "form" action="Album.php" method="post">
							
					<input type="text" name="Nom_album"  placeholder="Nom de l'album"><br><br>
					<input id="" type="submit" name= "valider" value="Valider" >
					
					<label class = "erreur" ><?php if (isset($erreur)) echo '<br />',$erreur;?></label>
				</form>
				 
			</div>	
	<script src="lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>	
	</body>	
</html>