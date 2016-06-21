<!-- Section de gestion des membres : on peut ajouter, supprimer, modifier un membre. -->

<?php 
	if (isset($_SESSION['authent']) && $_SESSION['authent']==true){ //Test si la personne est authentifiée
		echo '<div id = "content"> <h1>Membres</h1>';
      		include ('../bdd/bdd.php');
		$resultats = $instancePDO->query("SELECT IDENTIFIANT,NOM,PRENOM FROM EMPLOYE"); //Récupère la liste des membres dans la base de donnée
		$resultats->setFetchMode(PDO::FETCH_OBJ);
		while( $resultat = $resultats->fetch() ) //Boucle d'affichage des membres, récupère les informations dans la base de donnée.
		{
			$id = $resultat->IDENTIFIANT; 
    		   	echo '<br/>'.$resultat->NOM.'  ';  //Affiche le nom du membre.
		    	echo ' '.$resultat->PRENOM;  //Affiche le prénom du membre.
?>
	<!-- formulaire pour la modification de membres -->
	<form class="inline" action = "template.php?content=membres/modifiermembre.php&id=<?php echo $id; ?>" method = "post">
        	<input name = "modifier" type = "submit" value = "Modifier"/>
        </form>

	<!-- formulaire pour la suppression de membres -->
	<form class="inline" action = "template.php?content=membres/supprimer_membre.php&id=<?php echo $id; ?>" method = "post" onsubmit = "if(suppr()) return true; else return false;">
        	<input name ="supprimer" type = "submit" value = "Supprimer" />
        </form>

<?php } ?>

	<br/><br/>
	
	<!-- formulaire pour l'ajout de membres -->
	<form action = "template.php?content=membres/ajoutmembre.php" method = "post">
        	<input class="bouton"  type = "submit" value = "Nouveau Membre"/>
        </form>

</div>
<?php   }

	else {
		echo("Vous n'avez pas accès à cette page car vous n'êtes pas connecté");
?>

	<form action="../index.php">
		   <input class="bouton" type="submit" value="Retour à la page de connexion"  /> 
	</form>

<?php
	}
?>
