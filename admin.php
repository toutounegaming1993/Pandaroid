<?php

$email_ins = isset($_POST["email_ins"]) ? $_POST["email_ins"]:"";
$mdp_ins = isset($_POST["mdp_ins"]) ? $_POST["mdp_ins"]:"";
$nom = isset($_POST["nom"]) ? $_POST["nom"]:"";
$prenom = isset($_POST["prenom"]) ? $_POST["prenom"]:"";
$verif=0;
include_once('bdd.php');
if (isset($_POST['valider2']) AND $_POST['valider2'] == 'Valider') {
	// on teste l'existence de nos variables. On teste également si elles ne sont pas vides
	if ((isset($_POST['nom']) AND !empty($_POST['nom'])) AND (isset($_POST['prenom']) AND !empty($_POST['prenom'])) AND (isset($_POST['email_ins']) AND !empty($_POST['email_ins'])) AND (isset($_POST['mdp_ins']) AND !empty($_POST['mdp_ins'])) AND (isset($_POST['mdp2']) AND !empty($_POST['mdp2'])) ) {
	// on teste les deux mots de passe
	if ($_POST['mdp_ins'] != $_POST['mdp2']) {
		$erreur2 = 'Les deux mots de passe ne correspondent pas';
	}
	elseif(!preg_match("~^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$~i",$email_ins)){
		$erreur2 = 'Adresse e-mail invalide';
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
					$mdp_enc=sha1('supahot'.$mdp_ins);
					$sql = "INSERT INTO membre (nom, prenom, email, mdp) VALUES(";
					$sql .= "'$nom','$prenom','$email_ins','$mdp_enc')";
					$bdd->query($sql);
					$id=$bdd->lastInsertId();
			
					$dossier="Images/$id/";
					mkdir($dossier, 0777, true);
					mkdir("min/$id/", 0777, true);
					header('admin.php');
					$erreur2="$prenom $nom a bien été ajouté à PandaRoid";
				}
				else
				{
					$erreur2='Un membre possède déjà cet e-mail';
					
				}	
			}
		catch(Exception $e) {
				echo $e->getMessage();
				return;	
			}

		}
	}
	else {
	$erreur2 = 'Attention: au moins un des champs est vide';
	}

}
?>

<!DOCTYPE html>

<html>

    <head>
		<link rel="stylesheet" href="PandaRoid.css" />
		<link rel="stylesheet" href="lightbox2-master/dist/css/lightbox.min.css">
		<link rel="shortcut icon" href="tetedepanda.ico"/>
		<!-- ADAPTER LA TAILLE A TOUS LES ECRANS !-->
		<meta name="viewport" content="width=device-width" />
        <meta charset="utf-8" />
		<script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>
		<script type="text/javascript" src="PandaRoid.js"></script>
		
		<?php include_once('fonctions.php');?>
			
        <title>PandaRoid</title>
    </head>

	<div id="nav">
		<ul>
			<img src="Image/tetecadree.jpg" alt="tete"/>
			<li id="links"><a href="pandaroid.php">ACCUEIL</a></li>
			<li id="links"><a href="profil.php"><?php 
			$prenom = strtoupper($_SESSION['prenom']);
			echo $prenom; 
			?></a></li>
			<li id="links"><a href="admin2.php">PARTAGER UNE PHOTO</a></li>
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
		<div id="fond">
			<div id="contenu">
				
				<form id = "uploadform" class="hidden" action="upload_photo.php" method="post" enctype="multipart/form-data" runat="server" >
					<img id="sortir" src="Image/croix.png" alt="fermer" onClick="annuler()"/>
					<div id="ajout">
					Ajouter votre photo
					</div>
					
					<input type="hidden" name="MAX_TAILLE_FICHIER" value="10485760" />		
					<input onchange="readURL(this);"  type="file" name="photo"><br><br>
					<img  id="image" src="#" /><br><br>
					<input type="text" name="titre" placeholder="Titre de la photo"><br><br>
					<input type="text" name="lieu" placeholder="Lieu de la photo"><br><br>
					<input id="upphotovalid" type="submit" name= "valider" value="Valider"  >
					
				</form>
				
				<table>
				<tr>
				Les Membres du sites:</br></br>
				<?php
				
					liste_membre_admin($bdd);
				?>
				</tr>
				</table>
				</br>Autres options</br></br>
				Ajouter un Membre à PandaRoid:
				<form id = "form_admin" action="admin.php" method="post">
					
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
		</div>
		</div>
		
		<script src="lightbox2-master/dist/js/lightbox-plus-jquery.min.js"></script>
		
	
	</body>
	
	
	<footer>
		<div id="footer">
			MAI LAM + DUHESME COPYRIGHT MODAFUKA NERF DAT BITCH PLZZZ YOLO BBOY IN DA PLACE 
		</div>
	</footer>
	
	
</html>