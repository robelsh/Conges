<?php
	session_start();
	if (isset($_SESSION['authent']) && $_SESSION['authent']==true){ 
		include ('../../bdd/bdd.php');
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$solde = 4;
		$default_mdp = "isen";
		$id = $nom.$prenom;
		$req = $instancePDO->query("INSERT INTO EMPLOYE (IDENTIFIANT,NOM,PRENOM,SOLDE,MOTDEPASSE) VALUES ('$id','$nom','$prenom','$solde','$default_mdp')");
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
