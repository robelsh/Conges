<!-- Il s'agit du calendrier un ans après l'année en cour. En modifiant l'incrémentation on peut modifier on changer les année à afficher dans le calendrier -->

<?php
	if (isset($_SESSION['authent']) && $_SESSION['authent']==true){
		$a = $_GET['annee'];
		$annee = $a -1;
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
