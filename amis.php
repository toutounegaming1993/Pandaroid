<!DOCTYPE html>
<html>

    <head>
		<link rel="stylesheet" href="PandaRoid.css" />
		<link rel="shortcut icon" href="tetedepanda.ico"/>
		<!-- ADAPTER LA TAILLE A TOUS LES ECRANS !-->
		<script type='text/javascript' src='//code.jquery.com/jquery-1.9.1.js'></script>
		<script type="text/javascript">
		<?php include_once('fonctions.php');?>
</script>
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
			<li id="links"><a href="upload_photo.php">PARTAGER UNE PHOTO</a></li>
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
			<form id = "form" action="amis.php" method="post" enctype="multipart/form-data" runat="server" >
				Les membres du site:<br>
				<?php
					non_amis($bdd);
				?>
				<br><br>Les membres du site qui sont vos amis:
				<?php
					amis($bdd);
				?>
				<br><br>Vos demandes d'amis:
				<?php
				req_amis($bdd)
				?>
			</form>
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