<!-- Formulaire pour choisir la date de congé -->

<?php
	if (isset($_SESSION['authent']) && $_SESSION['authent']==true){
		$identifiant = $_GET['identifiant'];
?>

<div id="content">
<form name ="saisie" action="../template/template.php?content=membres/ajoutconge.php&id=<?php echo $identifiant; ?>" method="post" onsubmit = "if(ajoutconge()) return true; else return false;">
	Jour : 
	<select name="jour">
<?php
	for($i=1;$i<32;$i++){
		if($i<10) echo "<option>0".$i."</option>";
		else echo "<option>".$i."</option>";
	}
?>
	</select>
	Mois :
	<select name ="mois">
<?php
	for($j=1;$j<13;$j++){
		if($j<10) echo "<option>0".$j."</option>";
		else echo "<option>".$j."</option>";
	}
?>
	</select> <br/>
	<input type="checkbox" name="matin"> Matin <br/>
	<input type="checkbox" name ="apres"> Après midi <br/>
	<input class="bouton"  type = "submit" value = "Ajouter" />
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
