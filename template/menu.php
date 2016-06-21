<?php
	if (isset($_SESSION['authent']) && $_SESSION['authent']==true){
		include ("header.php");
?>
	<!--Menu : lien vers l'accueil-->
	<a id="accueil" href="../template/template.php?content=content.php">
		<div class="menu">Accueil</div>
	</a>

	<!--Menu : lien vers la liste des membres -->
	<a id="membres" href="../template/template.php?content=membres/membres.php">
		
		<div class="menu">Membres</div>
	</a>
	
	<!--Menu : lien vers le calendrier commun -->
	<a id="calendrier" href="../template/template.php?content=calendrier/calendrieractu.php">
		
		<div class="menu">Calendrier</div>
	</a>

	<!--Bouton de déconnexion -->
	<form id = "deconnexion" action = "logout.php" method="post">
		<input id = "deco" type = "submit" value="Déconnecter" >
	</form>

</header>
<?php
	}

	else {
		echo("Vous n'avez pas accès à cette page car vous n'êtes pas connecté");
?>
	<form action="../index.php">
		   <input class="bouton" type="submit" value="Retour à la page de connexion"  /> 
	</form>
<?php
	}
?>
