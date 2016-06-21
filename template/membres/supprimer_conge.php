<!-- Suppression des périodes de congés coché. -->

<div id="content_conge">
<?php
	if (isset($_SESSION['authent']) && $_SESSION['authent']==true){ 
		//suppression de congé
		$identifiant = $_GET['identifiant'];
		require ("../bdd/bdd.php");
		require('calendrier/date.php');
		$req = $instancePDO->query('SELECT ID_CONGE,DATE,MATIN,APRES FROM CONGES WHERE IDENTIFIANT="'.$identifiant.'"');
?>

<form action = "membres/suppr.php?identifiant=<?php echo $identifiant; ?>" method = "post">

<?php 
	$i = 0;
	//Récupération des jours Congé
	while ($d = $req->fetch(PDO::FETCH_OBJ)) {
?>
<!--Affiche une checkbox avec la date du congé -->
	<input type="checkbox" name="id<?php echo $i; ?>" id="checkbox"/> 

<?php 
	//spécifie si le congé de la date dure toute la journée, ou une matinée, ou une après-midi.
	echo $d->DATE;
	if ($d->MATIN == 1 && $d->APRES == 0){
		echo " : Matinée";
	}
	else if ($d->APRES == 1 && $d->MATIN == 0){
		echo " : Après-midi";
	}

	else {
		echo " : Journée entière<br/>";
	}
	$i=$i+1;
} 
?>
	<br/>
	<input type="submit" value="Supprimer les congés sélectionnés"/>
</form>
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

