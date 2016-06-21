<?php
	include "../config/config.php";
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr" dir="ltr"> 
  <head>
        <meta charset="UTF-8"/>
        <link href="<?php echo $site;?>/style/css.css" rel="stylesheet" type="text/css"/>
	<script type = "text/javascript" src = "<?php echo $site;?>/javascript/jquery.js"> </script> 
	<script type = "text/javascript" src = "<?php echo $site;?>/javascript/javascript.js"> </script> 
	
        <title>
          	Espace Administrateur
        </title>
    </head>
    <body>

<?php
	//Test si la personne est identifiée, un test est effectué à chaque page php pour plus de sécurité, de ce fait l'accès est totalement impossible
	session_start(); // obligatoire 
	if (isset($_SESSION['authent']) && $_SESSION['authent']==true){ 

  		include("menu.php");

		include ($_GET['content']);

  		include("footer.php");
	}

	else {
		echo("Vous n'avez pas accès à cette page car vous n'êtes pas connecté");
?>
	<form action="<?php echo $site; ?>/index.php">
		   <input class="bouton" type="submit" value="Retour à la page de connexion"  /> 
	</form>
<?php
	}
?> 

    </body>
</html>
