<!DOCTYPE html>
<html>

	<head>
		<link rel="stylesheet" href="PandaRoidAcc.css" />
		<link rel="shortcut icon" href="tetedepanda.ico"/>
		<!-- ADAPTER LA TAILLE A TOUS LES ECRANS !-->
		<meta name="viewport" content="width=device-width" />
		<meta charset="utf-8" />
		<title>Connexion</title>
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
				Connexion
				</p>
				
				<form id = "form" action="Connection.php" method="post">
							
					<input type="text" name="email"  placeholder="Addresse e-mail"><br><br>
					<input type="password" name="mdp" placeholder="Mot de passe"><br><br>
					<input class="b_accueil" type="submit" name= "valider" value="Se Connecter" >
					
					<label class = "erreur" ><?php if (isset($erreur)) echo '<br />',$erreur;?></label>
				</form>
				
				<p>
				Inscription
				</p>
				
				<form id = "form" method="post">
				
				<input class="b_accueil" type="button" onclick="self.location.href='ajout_membre.php'" value="S'inscrire"  >
				</form>
				<div id= "erreur>
				
				</div>
				
			</div>
		
		
	</div>
		
	</body>
	
	<footer>
		<div id="footer">
		LA FAMILLE MON GARS OUI OUI LA FAMILLE
		</div>
	</footer>
</html>