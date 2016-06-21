<?php
	if (isset($_SESSION['authent']) && $_SESSION['authent']==true){ //Test si la personne est authentifiée
		include ('../bdd/bdd.php');
		//récupération des informations du membre selectionné
		$identifiant = $_GET['id'];
		$req = $instancePDO->query('SELECT NOM,PRENOM,SOLDE,MOTDEPASSE FROM EMPLOYE WHERE IDENTIFIANT ="'.$identifiant.'"');

		while ($d = $req->fetch(PDO::FETCH_OBJ)) {
			$nom = $d->NOM;
			$prenom = $d->PRENOM;
			$solde = $d->SOLDE;
			$mdp = $d->MOTDEPASSE;
		}		
?> 
<div id="content"> <br/>

<!-Formulaire de modification d'un membre -->
<form name="infomembre" action = "membres/modifier.php?id=<?php echo $identifiant; ?>" method = "post" onsubmit="if(verif_modif()) return true; else return false;">

        	Nom :
   	 		<input class="formulaire" id="indent1" type = "text" name = "nom" placeholder = "<?php echo $nom; ?>" />

   		Prénom :
   	 		<input class="formulaire" type = "text"  name = "prenom" placeholder = "<?php echo $prenom; ?>" />
            <br/><br/>
		Mot de passe :	
			<input id="indent2" class="formulaire" type = "text"  name = "mdp" placeholder = "<?php echo $mdp; ?>" />
	    <br/>

		Solde :
			<input class="formulaire" type = "text" name = "solde" placeholder = "<?php echo $solde; ?>" />
	    <br/><br/>
        	<input class="bouton"  type = "submit" value = "Enregistrer"/>
    		<input class="bouton" type="reset" value="Annuler"  /> <br/><br/>
</form>
<!--Lien pour ajouter un nouveau congé -->
<form action = "template.php?content=membres/conge.php&identifiant=<?php echo $identifiant; ?>" method="post">	
        	<input class="bouton"  type = "submit" value = "Nouveau congé"/>
</form> 
<!--Lien pour supprimer un congé -->
<form action = "template.php?content=membres/supprimer_conge.php&identifiant=<?php echo $identifiant; ?>" method="post">	
        	<input class="bouton"  type = "submit" value = "Supprimer une période de congé"/>
</form>
<!--Affichage du calendrier du membre selectionné -->
<?php include ("calendriermembre.php"); ?>
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
