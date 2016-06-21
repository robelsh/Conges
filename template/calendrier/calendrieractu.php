<!-- il s'agit du calendrier de l'année en cour -->

<?php
	if (isset($_SESSION['authent']) && $_SESSION['authent']==true){
		$annee = date('Y');
		require ("calendrier.php");
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
