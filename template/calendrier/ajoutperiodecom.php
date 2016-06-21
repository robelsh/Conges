<?php if (isset($_SESSION['authent']) && $_SESSION['authent']==true){ 
	$annee = $_GET['annee']; //récupère l'année ou on veut poser la période de congé.
?>
<div id="content">
<form name ="saisie" action="../template/template.php?content=calendrier/ajout.php&annee=<?php echo $annee; ?>" method="post">
	<h1>Ajout de périodes communes</h1>
	<br/><br/>Début : <br/>
	<select name="jour_debut">
<?php
	//affichage des jours dans le menu déroulant, pour la date de fin.
	for($i=1;$i<32;$i++){
		if($i<10) echo "<option>0".$i."</option>";
		else echo "<option>".$i."</option>";
	}
?>
	</select>
	<select name ="mois_debut">
<?php
	//affichage des mois dans le menu déroulant, pour la date de début.
	for($j=1;$j<13;$j++){
		if($j<10) echo "<option>0".$j."</option>";
		else echo "<option>".$j."</option>";
	}
?>
	</select> <br/><br/>

	Fin : <br/>
	<select name="jour_fin">
<?php
	//affichage des jours dans le menu déroulant, pour la date de fin.
	for($i=1;$i<32;$i++){
		if($i<10) echo "<option>0".$i."</option>";
		else echo "<option>".$i."</option>";
	}
?>
	</select>
	<select name ="mois_fin">
<?php
	//affichage des mois dans le menu déroulant, pour la date de fin.
	for($j=1;$j<13;$j++){
		if($j<10) echo "<option>0".$j."</option>";
		else echo "<option>".$j."</option>";
	}
?>
	</select> <br/><br/>
<input class="bouton"  type = "submit" value = "Ajouter" />
<br/><br/><br/>
</form>
<a class = "periodecom" href ="template.php?content=calendrier/calendrieractu.php"> Finir la pose de période communes </a>
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
