<?php
	session_start();
	if (isset($_SESSION['authent']) && $_SESSION['authent']==true){ 
		include ('../../bdd/bdd.php');
		//récupère les informations entrées.
		$id = $_GET['id'];
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$solde = $_POST['solde'];
		$mdp = $_POST['mdp'];

		//mise à jour de la base de donnée avec les nouvelles informations.
		$req = $instancePDO->query('UPDATE EMPLOYE SET NOM="'.$nom.'", PRENOM="'.$prenom.'", SOLDE="'.$solde.'", MOTDEPASSE="'.$mdp.'" WHERE IDENTIFIANT="'.$id.'"');
		header ('location: ../../template/template.php?content=membres/membres.php');
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
