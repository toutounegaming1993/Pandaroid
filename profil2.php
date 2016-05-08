
<html>

    <head>
	<?php include_once('fonctions.php');?>
		<link rel="stylesheet" href="PandaRoid.css" />
		<link rel="stylesheet" href="lightbox2-master/dist/css/lightbox.min.css">
		<link rel="shortcut icon" href="tetedepanda.ico"/>
		<!-- ADAPTER LA TAILLE A TOUS LES ECRANS !-->
		<script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>
		<script type="text/javascript" src="PandaRoid.js"></script>
		<meta name="viewport" content="width=device-width" />
        <meta charset="utf-8" />
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
			<li id="links"><a href="profil2.php">PARTAGER UNE PHOTO</a></li>
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
		
		<form id = "uploadform"  action="upload_photo.php" method="post" enctype="multipart/form-data" runat="server" >
					<img id="sortir" src="Image/croix.png" alt="fermer" onClick="annuler4()"/>
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
		
		<?php
					
					if(isset($_GET['membre']) AND !empty($_GET['membre']))
						$membre=$_GET['membre'];
					else{
						$membre=$_SESSION['id'];	
					}
					if(isset($_GET['admin']) AND !empty($_GET['admin']))
						$admin=$_GET['admin'];
					else{
						$admin=$_SESSION['admin'];	
					}

					$sql = "SELECT * FROM membre";
					$sql .= " WHERE id LIKE '$membre' ";
					$resultat = $bdd->query($sql);
					while($non_amis=$resultat->fetch()){

						$nom=$non_amis['nom'];
						$prenom=$non_amis['prenom'];

						
					}
					$mon_id=$_SESSION['id'];
					if($membre!=$mon_id){
						if($admin=='1'){
						echo "<a href='actions.php?action=supprimermbr&membre=$membre' class='b_social'> Supprimer</a> |  " ;
						echo "<a href='actions.php?action=admin&membre=$membre' class='b_social'> Rendre administrateur</a> |  " ;
						}
						$res = $bdd->query("SELECT * FROM amis WHERE (membre1_id='$mon_id' AND membre2_id='$membre') OR(membre1_id='$membre' AND membre2_id='$mon_id')");
						$rows=$res->rowCount();
						if($rows==1){
							echo "<a href='#' class='b_social'> Vous êtes déjà amis</a> | <a href='actions.php?action=enlever&membre=$membre' class='b_social'> Retirer $prenom $nom de ma liste d'amis</a> " ;
							photo_amis($bdd,$membre);
						}
							
						else{
							$res_dem = $bdd->query("SELECT * FROM req_amis WHERE demandeur='$membre' AND recepteur='$mon_id'");
							$res_rec = $bdd->query("SELECT * FROM req_amis WHERE demandeur='$mon_id' AND recepteur='$membre'");
							if($res_dem->rowCount()==1){
								echo "<a href='actions.php?action=accepter&membre=$membre' class='b_social'> Accepter</a> | <a href='#' class='bouton'> Ignorer</a>";
							}
							else if($res_rec->rowCount()==1){
								echo "<a href='actions.php?action=annuler&membre=$membre' class='b_social'> Annuler la demande</a> ";
							}
							else{
								echo"<a href='actions.php?action=envoie&membre=$membre' class='b_social'> Envoyer une demande d'amis</a> ";
							}
								
						}
					}
					else
					{
						echo '<p> Mes photos: </p>';
						mes_photos($bdd);
					}
		
		?>
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
