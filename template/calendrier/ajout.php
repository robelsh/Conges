<?php if (isset($_SESSION['authent']) && $_SESSION['authent']==true){ ?>
<div id="content">
<?php 
	require ('../bdd/bdd.php');

	//requete pour récupérer les employer
	$employe = $instancePDO->query("SELECT * FROM EMPLOYE");

	//requete pour récupérer les congés déjà existante
	$requete = $instancePDO->query("SELECT * FROM CONGES");
	$identifiant = 0;

	//initialisation à 1 car ce sont des journées complète
	$matin = 1;
	$apres = 1; 

	//récupération des informations pour la date de début
	$jour_debut = $_POST['jour_debut']; //récupère le jour de période commune de debut.
	$mois_debut = $_POST['mois_debut']; //récupère le mois de période commune de debut.
	$annee = $_GET['annee']; // stoque l'année
	$date_debut = $annee.'-'.$mois_debut.'-'.$jour_debut; //date de début.
	$date = $date_debut;
	$date_debut = strtotime($date);

	//récupération des informations pour la date de fin.
	$jour_fin = $_POST['jour_fin']; //récupère le jour de période commune de fin.
	$mois_fin = $_POST['mois_fin']; //récupère le mois de période commune de fin.
	$date_fin = strtotime($annee.'-'.$mois_fin.'-'.$jour_fin); //date de fin.

	$dif_jour = ($date_fin-$date_debut)/86400; //86400 équivaut à un jour, soit 24h * 60min * 3600sec

	if ($date_fin < $date_debut) {
		echo "vous avez entré une date de fin inférieur à celle du début";
	}

	//récupère l'identifiant le plus elevé des congés.
	$req_id = $instancePDO->query('SELECT * FROM CONGES');
	while ($c = $req_id->fetch(PDO::FETCH_OBJ)) {
		
		if ($c->ID_CONGE > $identifiant){
			$identifiant = $c->ID_CONGE;
		}
	}

	
	//Insertion des jours de congés communs dans la base de donnée.
	for ($i=0;$i<$dif_jour;$i ++) {
		while ($d = $requete->fetch(PDO::FETCH_OBJ)){
			//si un jour de la période est déjà enregistré
			if(strtotime($date) == strtotime($d->DATE)) {
				//il écrase le jour déjà enregistré.
				$req=$instancePDO->query('DELETE FROM CONGES WHERE DATE="'.$d->DATE.'"');
				break;
			}
		}
		$employe = $instancePDO->query("SELECT * FROM EMPLOYE");
		while ($b = $employe->fetch(PDO::FETCH_OBJ)){
			$id = $b->IDENTIFIANT;
			$insertion = $instancePDO->query("INSERT INTO CONGES (ID_CONGE,DATE,MATIN,APRES,IDENTIFIANT,ANNEE) VALUES ('$identifiant','$date','$matin','$apres','$id','$annee')");
			$identifiant = $identifiant +1;
		}

		$date = strtotime($date); //On convertit la date en timestamp.
		$date = $date + 86400; //On ajoute 1 jour à la date.
		$date = date('Y-m-d',$date); //on convertit la date au format date.
	}
?>
	<!-- Retour à la page d'ajout de congés -->
	<script type="text/javascript">
		history.go(-1);
	</script>  
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
