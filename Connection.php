<?php
$email = isset($_POST["email"]) ? $_POST["email"]:"";
$email_ins = isset($_POST["email_ins"]) ? $_POST["email_ins"]:"";
$mdp = isset($_POST["mdp"]) ? $_POST["mdp"]:"";
$mdp_ins = isset($_POST["mdp_ins"]) ? $_POST["mdp_ins"]:"";
$nom = isset($_POST["nom"]) ? $_POST["nom"]:"";
$prenom = isset($_POST["prenom"]) ? $_POST["prenom"]:"";
include_once('bdd.php');
$verif=0;		

// on teste si le visiteur a soumis le formulaire
if (isset($_POST['valider']) AND $_POST['valider'] == 'Se Connecter') {
	// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
	if ((isset($_POST['email']) AND !empty($_POST['email'])) AND (isset($_POST['mdp']) AND !empty($_POST['mdp'])) ) {
		try
			{
				$mdp_enc=sha1('supahot'.$mdp);
				$sql = "SELECT * FROM membre";
				$sql .= " WHERE email LIKE '%$email%' ";
				$sql .= " AND mdp LIKE '%$mdp_enc%' ";
				$resultat = $bdd->query($sql);
				
				while($mail=$resultat->fetch()){
					if (($mail["email"] == $email)AND($mail["mdp"] == $mdp_enc))
						{
							$verif=1;
							session_start();
							$_SESSION['email']=$email;
							$_SESSION['id']=$mail["id"];
							$_SESSION['prenom']=$mail["prenom"];
							$_SESSION['nom']=$mail["nom"];
							$id=$_SESSION['id'];
							$_SESSION['admin']=$mail["admin"];
							$_SESSION['url']="Images/$id/";
							header("Location: PandaRoid.php" );
							/* Redirige le client vers le site PHP */ 
							exit();
						}	
				}
				if($verif==0)
				{
					
					$erreur = 'e-mail ou mot de passe non correct';
				}	
			}
		catch(Exception $e) {
				echo $e->getMessage();
				return;	
			}
	}
	else {
	$erreur = 'Au moins un des champs est vide.';
	}

}

// on teste si le visiteur a soumis le formulaire
if (isset($_POST['valider2']) AND $_POST['valider2'] == 'Valider') {
	// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
	if ((isset($_POST['nom']) AND !empty($_POST['nom'])) AND (isset($_POST['prenom']) AND !empty($_POST['prenom'])) AND (isset($_POST['email_ins']) AND !empty($_POST['email_ins'])) AND (isset($_POST['mdp_ins']) AND !empty($_POST['mdp_ins'])) AND (isset($_POST['mdp2']) AND !empty($_POST['mdp2'])) ) {
	// on teste les deux mots de passe
	if ($_POST['mdp_ins'] != $_POST['mdp2']) {
		$erreur2 = 'Les deux mots de passe ne correspondent pas';
	}
	elseif(!preg_match("~^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$~i",$email_ins)){
		$erreur2 = 'Addresse e-mail invalide';
	}
	else {
		
		try
			{
				$sql = "SELECT * FROM membre";
				$sql .= " WHERE email LIKE '%$email_ins%' ";
				$resultat = $bdd->query($sql);
				while($mail=$resultat->fetch()){
					if ($mail["email"] == $email_ins)
						{
							$verif=1;
						}
					else{
						$id=$mail["id"];
					}
				}
				if($verif==0)
				{
					session_start();
					$mdp_enc=sha1('supahot'.$mdp_ins);
					$_SESSION['email']=$email_ins;
					$sql = "INSERT INTO membre (nom, prenom, email, mdp) VALUES(";
					$sql .= "'$nom','$prenom','$email_ins','$mdp_enc')";
					$bdd->query($sql);
					$_SESSION['id']=$bdd->lastInsertId();
					$id=$_SESSION['id'];
					$_SESSION['url']="Images/$id/";
					$_SESSION['prenom']=$prenom;
					$_SESSION['nom']=$nom;
					$_SESSION['admin']='0';
					mkdir($_SESSION['url'], 0777, true);
					mkdir("min/$id/", 0777, true);
					header("Location: PandaRoid.php" ); 
					/* Redirige le client vers le site PHP */ 
					exit();
				}
				else
				{
					$erreur2 = 'Un membre possède déjà cet email.';
				}	
			}
		catch(Exception $e) {
				echo $e->getMessage();
				return;	
			}

		}
	}
	else {
	$erreur2 = 'Au moins un des champs est vide.';
	}

}

?>
<!DOCTYPE html>
<html>

	<head>
		<link rel="stylesheet" href="PandaRoidAcc.css" />
		<script type="text/javascript" src="PandaRoidAcc.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<link rel="shortcut icon" href="tetedepanda.ico"/>
		<!-- ADAPTER LA TAILLE A TOUS LES ECRANS !-->
		<meta name="viewport" content="width=device-width" />
		<meta charset="utf-8" />
		<title>Connexion</title>
	</head>
	
	<body onLoad="loading()">
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
					<input id="connexion" type="submit" name= "valider" value="Se Connecter" >
					
					<label class = "erreur" ><?php if (isset($erreur)) echo '<br />',$erreur;?></label>
				</form>
				
				<p>
				Inscription
				</p>
				
				<form id = "form" method="post">
				
				<input id="inscription" type="button" onClick="popup()" value="S'inscrire"  >
				</form>
			</div>
			<div id="popup">
				<img id="sortir" src="Image/croix.png" alt="fermer" onClick="annuler()"/>
				<div id="popuptitre">
				Inscription
				</div>
				
				<p>
				Veuillez renseignez vos informations
				</p>
				
				<form id = "popupup" action="Connection.php" method="post">
					
					<input type="text" name="nom" placeholder="Nom"><br><br>
					<input type="text" name="prenom" placeholder="Prenom"><br><br>						
					<input type="text" name="email_ins"  placeholder="Adresse e-mail"><br><br>
					<input type="password" name="mdp_ins" placeholder="Mot de passe"><br><br>
					<input type="password" name="mdp2" placeholder="Confirmer mot de passe"><br><br>
					<input id="submit" type="submit" name= "valider2" value="Valider" >
					
					<label class = "erreur" ><?php if (isset($erreur2)) echo '<br />',$erreur2;?></label>
					
				</form>
			</div>
		
	</div>
		
	</body>
	
	<footer>
		<div id="footer">
		LA FAMILLE MON GARS OUI OUI LA FAMILLE
		</div>
	</footer>
</html>