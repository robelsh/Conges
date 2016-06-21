<?php
session_start();
if (isset($_SESSION['authent']) && $_SESSION['authent']==true){ 
	$nbr_conge = 0; //Permettra d'identifier le nombre de congé d'une personne
	$r = array(); //Stocke les congés de la personne selectionnée.
	$i = 0; //Initialisation du compteur.
	$identifiant = $_GET['identifiant'];

	require ("../../bdd/bdd.php");
	require('../calendrier/date.php');

	$req = $instancePDO->query('SELECT ID_CONGE, DATE, MATIN, APRES FROM CONGES WHERE IDENTIFIANT="'.$identifiant.'"');

	//Récupération du solde de l'employé selectionné.
	$requete = $instancePDO->query('SELECT SOLDE FROM EMPLOYE WHERE IDENTIFIANT="'.$identifiant.'"');
	$b = $requete->fetch(PDO::FETCH_OBJ);
	$solde = $b->SOLDE;

	//Récupère le nombre de congés du membre.
	while ($d = $req->fetch(PDO::FETCH_OBJ)) {
		$nbr_conge = $nbr_conge+1;
		$r[$i]=$d->DATE;
		$s = $d->MATIN + $d->APRES;
		$i = $i+1;
	}
	
	//On parcourt le tableau avec les congés stockés, le jour coché est identifié grâce au compteur. 
	for ($i=0; $i<$nbr_conge;$i++)
	{
		//test si la case est cochée, puis suppression de la période de congé cochée.
		if ($_POST['id'.$i.''] == "on")
		{
			$suppr_conge = $instancePDO->query('DELETE FROM CONGES WHERE DATE="'.$r[$i].'"');

			//si on supprime une journée entière.
			if ( $s == 2 )
			{
				//incrémentation de 1 du solde si on supprime une journée entière.
				$solde = $solde + 1;
				$update_solde = $instancePDO->query('UPDATE EMPLOYE SET SOLDE="'.$solde.'" WHERE IDENTIFIANT="'.$identifiant.'"');
			}

			if ( $s == 1 ) 
			{
				//incrémentation de 0.5 du solde si on supprime une demi-journée.
				$solde = $solde + (0.5);
				$update_solde = $instancePDO->query('UPDATE EMPLOYE SET SOLDE="'.$solde.'" WHERE IDENTIFIANT="'.$identifiant.'"');
			}

			echo $r[$i];
		}

		else {
			//rien
		}
	}
	//redirection
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
