<!-- Suppression de membre, efface toutes les informations concernant le membre selectionné-->


<?php
	if (isset($_SESSION['authent']) && $_SESSION['authent']==true){ 
		//connecte à la base de donnée.
		require ("../bdd/bdd.php");
		//récupère l'identifiant du membre.
		$id = $_GET['id'];
		//Efface les congés du membre.
		$requete = $instancePDO->query('DELETE FROM CONGES WHERE IDENTIFIANT="'.$id.'"');
		//Efface le membre de la base de donnée.
		$req = $instancePDO->query('DELETE FROM EMPLOYE WHERE IDENTIFIANT="'.$id.'"');
		//Redirection vers la liste des membres.
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

