<?php
	if (isset($_SESSION['authent']) && $_SESSION['authent']==true){ //Test si la personne est authentifiée
?>
<div id="content"> <br/>
	<form action = "membres/ajout.php" method = "post">
        	Nom :
   	 		<input type = "text" name = "nom" >
            <br/> <br/>
   		Prénom :
   	 		<input type = "text"  name = "prenom" >
            <br/><br/>
        	<input class="bouton"  type = "submit" value = "Enregistrer"/>
    		<input class="bouton" type="reset" value="Annuler"  /> <br/>
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

