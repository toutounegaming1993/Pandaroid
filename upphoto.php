<!DOCTYPE html>

<html>

    <head>
		<link rel="stylesheet" href="PandaRoid.css" />
		<link rel="shortcut icon" href="tetedepanda.ico"/>
		<!-- ADAPTER LA TAILLE A TOUS LES ECRANS !-->
		<meta name="viewport" content="width=device-width" />
        <meta charset="utf-8" />
		<script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>
		<title>Pandaroid</title>
		<script type="text/javascript">
			   function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
					$('#image').attr('src', e.target.result);
				   }
					reader.readAsDataURL(input.files[0]);
				   }
				}
		</script>
    </head>

	<div id="nav">
		<ul>
			<img src="Image/tetecadree.jpg" alt="tete"/>
			<li id="links"><a href="pandaroid.php">ACCUEIL</a></li>
			<li id="links"><a href="profil.php"><?php 
			$prenom = strtoupper($_SESSION['prenom']);
			echo $prenom; 
			?></a></li>
			<li id="links"><a href="upload_photo.php">PARTAGER UNE PHOTO</a></li>
			<li id="links"><a href="diapo.php">ALBUMS</a></li>
			<li id="links"><a href="amis.php">AMIS</a></li>
			<li id="links"><a href="#5">PARAMETRES</a></li>
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
			<form id = "form" action="upload_photo.php" method="post" enctype="multipart/form-data" runat="server" >
					<input type="hidden" name="MAX_TAILLE_FICHIER" value="10485760" />		
					<input onchange="readURL(this);"  type="file" name="photo"><br><br>
						<img alt="Votre Image s'affiche ici" id="image" src="#" /><br><br>
					<input type="text" name="titre" placeholder="titre de la photo"><br><br>
					<input type="text" name="lieu" placeholder="Lieu de la photo">
					<input type="submit" name= "valider" value="Valider"  >
					
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
		
			<p><?php
			if (isset($erreur)) echo '<br />',$erreur;
		?></p>		
			</div>
		</div>
	</body>
	
	
	<footer>
		<div id="footer">
			MAI LAM + DUHESME COPYRIGHT MODAFUKA NERF DAT BITCH PLZZZ YOLO BBOY IN DA PLACE 
		</div>
	</footer>
	
	
</html>
