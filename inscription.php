<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="PandaRoidAcc.css" />
		<link rel="shortcut icon" href="tetedepanda.ico"/>
		<!-- ADAPTER LA TAILLE A TOUS LES ECRANS !-->
		<meta name="viewport" content="width=device-width" />
		<meta charset="utf-8" />
		<title>Inscription</title>
	</head>
	
	<body>
		<div id="contenu">
			<div id="image">
				<img src="Image/PandaLogo.jpg" alt="logo PandaRoid"/>
			</div>	
			<div id ="Tableauform">
					<!-- Bloc du formuliare nécessaire pour l'identification -->
				<img src="Image/PandaRoid.jpg" alt="PandaRoid" />	
				<p>
				Inscription
				</p>
				
				<form id = "form" action="ajout_membre.php" method="post">
					
					<input type="text" name="nom" placeholder="Nom"><br><br>
					<input type="text" name="prenom" placeholder="Prenom"><br><br>						
					<input type="text" name="email"  placeholder="adresse e-mail"><br><br>
					<input type="password" name="mdp" placeholder="Mot de passe"><br><br>
					<input type="password" name="mdp2" placeholder="Confirmer mdp"><br><br>
					<input type="submit" class="b_accueil" name= "valider" value="Valider"  >
					
				</form>
			</div>	
		<p><?php
			if (isset($erreur)) echo '<br />',$erreur;
		?></p>
		</div>		
	</body>
</html>
