<!-- Ce code permet l'ajout de jour de congés. Il teste si il existe déjà dans la base de donnée un jour déjà existant, puis il vérifie si c'est une matinée ou une après-midi. Il teste également si le jour entré est férié, dans ce cas l'utilisateur est redirigé. -->

<?php
	if (isset($_SESSION['authent']) && $_SESSION['authent']==true){ 
?>
<div id="content">
<?php 
	require ('../bdd/bdd.php');

	//Test si les cases ont été cochées.
	if (isset($_POST['matin'])){
		//si la case matin est cochée, matin = 1.
		$matin = 1;
	}
	
	//sinon matin = 0.
	else { $matin = 0; }

	if (isset($_POST['apres'])) {
		//si la case matin est cochée, apres = 1.
		$apres = 1;
	}	
	
	//sinon apres = 0.
	else { $apres = 0; }

	$verif = 0;
	$id = $_GET['id']; //récupère l'identifiant du membre.
	$jour = $_POST['jour']; //le jour de congé.
	$mois = $_POST['mois']; //le mois de congé.
	$annee = date('Y'); // stoque l'année en cour.
	$date = $annee.'-'.$mois.'-'.$jour;
	$identifiant = 0;
	
	//récupération du solde de l'employé.
	$req_solde = $instancePDO->query('SELECT SOLDE FROM EMPLOYE WHERE IDENTIFIANT = "'.$id.'"');
	while ($s = $req_solde->fetch(PDO::FETCH_OBJ)) {
		$solde = $s->SOLDE;
	}

	if ( $matin == 1 && $apres == 1 ) {
		if ($solde < 1 ) {
			$verif = 1;
			echo $id;
?>
			<!--Si on a pas assez de solde --> 
			n'a pas assez de Solde 
			<a href = "template.php?content=membres/conge.php&identifiant=<?php echo $id; ?>" > Page précédente </a>
<?php
		}

		else { $verif = 0; }
	}

	else if ( ($matin == 1 && $apres == 0) || ($matin == 0 && $apres == 1)) {
		if ($solde < 0.5 ) {
			$verif = 1;
			echo $id;
?>
			<!--Si on a pas assez de solde --> 
			n'a pas assez de Solde 
			<a href = "template.php?content=membres/conge.php&identifiant=<?php echo $id; ?>" > Page précédente </a>
<?php
		}

		else { $verif = 0; }
	}


	//récupération de l'identifiant de congé le plus élevé afin de générer l'identifiant suivant.
	$req_id = $instancePDO->query('SELECT * FROM CONGES');
	while ($c = $req_id->fetch(PDO::FETCH_OBJ)) {
		
		if ($c->ID_CONGE > $identifiant){
			$identifiant = $c->ID_CONGE;
		}
	}
	
	$identifiant = $identifiant +1;

	//préparation et execution de la requete permetant de vérifier si le jour enregistrer est férié.
	$requete = $instancePDO->query('SELECT DATE_FERIE FROM JOUR_FERIE');
	while ($d = $requete->fetch(PDO::FETCH_OBJ)) {
		$date_ferie = $d->DATE_FERIE;
		if (strtotime($date_ferie) == strtotime($date)) {
			$verif = 1;
?>
			<!--Si on a choisi un jour férié, on est redirigé vers la page d'ajout de congé -->
			Vous avez selectionné un jour férié 
			<a href = "template.php?content=membres/conge.php&identifiant=<?php echo $id; ?>" > Page précédente </a>
<?php
			break;
		}
	}

	//préparation et execution de la requete permetant de vérifier si une période de congé existe déjà, sinon il enregistre une nouvelle période.
	$req = $instancePDO->query('SELECT * FROM CONGES WHERE IDENTIFIANT ="'.$id.'"');
	while ($d = $req->fetch(PDO::FETCH_OBJ)) {
			//Si le membre a dejà un conge cette journée
			if (strtotime($date) == strtotime($d->DATE)) {
				//durant toute la journée
				if ($d->MATIN == $matin && $d->APRES == $apres && $matin == $apres){
					//pas possible d'avoir de congés
					$verif = 1;
					echo '<meta http-equiv="refresh" content="secondes;URL=../../template/template.php?content=membres/membres.php">';
					break;
				}

				//si il existe déjà une matinée
				if ($d->MATIN == $matin && $matin == 1){
					//pas possible d'avoir de congés
					$verif = 1;
					echo '<meta http-equiv="refresh" content="secondes;URL=../../template/template.php?content=membres/membres.php">';
					break;
				}

				//si il existe déjà une après midi
				if ($d->MATIN == $apres && $apres == 1){
					//pas possible d'avoir de congés
					$verif = 1;
					echo '<meta http-equiv="refresh" content="secondes;URL=../../template/template.php?content=membres/membres.php">';
					break;
				}

				//si il n'y a pas de matiné programmé ce jour là
				else if ($d->MATIN != $matin && $matin == 1) {
					//si il n'y a pas de matinée
					$verif = 1;
					$solde = $solde -1; //on décrémente le solde de 1.
					//mise à jour du solde.
					$up_solde = $instancePDO->query('UPDATE EMPLOYE SET SOLDE="'.$solde.'" WHERE IDENTIFIANT="'.$id.'"');
					$insertion = $instancePDO->query('UPDATE CONGES SET MATIN="'.$matin.'" WHERE DATE="'.$date.'"');
					echo '<meta http-equiv="refresh" content="secondes;URL=../../template/template.php?content=membres/membres.php">';
					break;
				}
			
				else if  ($d->APRES != $apres && $apres == 1) {
					//si il n'y a pas d'après midi
					$verif = 1; //variable de vérification = 1.
					$solde = $solde -0.5; //on décrémente le solde de 0.5. 
					//mise à jour du solde.
					$up_solde = $instancePDO->query('UPDATE EMPLOYE SET SOLDE="'.$solde.'" WHERE IDENTIFIANT="'.$id.'"');
					$insertion = $instancePDO->query('UPDATE CONGES SET APRES="'.$apres.'" WHERE DATE="'.$date.'"');
					echo '<meta http-equiv="refresh" content="secondes;URL=../../template/template.php?content=membres/membres.php">';
					break;
				}
			}
	}

	if( $verif != 1){
		//si l'employe a un jour de plus de congé, on décrémente son solde de 1.
		if ( $matin == 1 && $apres == 1)
		{
			$solde = $solde -1;
			$up_solde = $instancePDO->query('UPDATE EMPLOYE SET SOLDE="'.$solde.'" WHERE IDENTIFIANT="'.$id.'"');
		}

		else if ( ($matin == 0 && $apres == 1) || ($matin == 1 && $apres == 0))
		{
			$solde = $solde -0.5;
			$up_solde = $instancePDO->query('UPDATE EMPLOYE SET SOLDE="'.$solde.'" WHERE IDENTIFIANT="'.$id.'"');
		}

		$insertion = $instancePDO->query("INSERT INTO CONGES (ID_CONGE,DATE,MATIN,APRES,IDENTIFIANT,ANNEE) VALUES ('$identifiant','$date','$matin','$apres','$id','$annee')");
		echo '<meta http-equiv="refresh" content="secondes;URL=../../template/template.php?content=membres/membres.php">';
	}
?>
</div>
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

