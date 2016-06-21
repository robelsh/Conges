<!-- Page d'accueil de l'interface administrateur -->
<!-- Affiche la date d'aujourd'hui, et les membres actuellement en congé -->
<!-- ******************************************** -->


<?php 
	if (isset($_SESSION['authent']) && $_SESSION['authent']==true){
      		include ('../bdd/bdd.php');
		echo "<div id=content> <h1>Bienvenue dans l'interface Administrateur</h1> <br/> <h3>";
		//préparation de la requête de récupération des membres.
		$resultats = $instancePDO->query("SELECT IDENTIFIANT,NOM,PRENOM FROM EMPLOYE"); 
		$resultats->setFetchMode(PDO::FETCH_OBJ);

		//préparation de la requête de récupération des congés.
		$conges = $instancePDO->query("SELECT ANNEE,DATE FROM CONGES"); 
		$conges->setFetchMode(PDO::FETCH_OBJ);

		//Affiche la date du jour en français.
		$jour = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
		$mois = array("","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
		$dateDuJour = $jour[date("w")]." ".date("d")." ".$mois[date("n")]." ".date("Y");
		echo "Nous sommes le ". $dateDuJour."<br/>";
		echo "</h3><br/> <p> Actuellement en congé : </p>";
		$mois2 = array("","01","02","03","04","05","06","07","08","09","10","11","12");

		$date = date("Y")."-".$mois2[date("n")]."-".date("d");
		
		
		while( $resultat = $resultats->fetch() )
		{
			while ( $d = $conges->fetch() ) 
			{
				//si la date de congé correspond à la date d'aujourd'hui.
				if ($date == $d->DATE){
					//On affiche le membre actuellement en congé.
					echo '<br/>'.$resultat->NOM.'  ';
		    			echo ' '.$resultat->PRENOM;
					break;
				}

			}
		}
		echo "</div>";
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
