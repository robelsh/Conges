<?php	
// On définit un login et un mot de passe de l'administrateur.
$login_valide = "conge";  
$pwd_valide = "conge";  
 
// on teste si nos variables sont définies
if (isset($_POST['identifiant']) && isset($_POST['motdepasse'])) { 
 
      	// on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
     	 if ($login_valide == $_POST['identifiant'] && $pwd_valide == $_POST['motdepasse']) { 
        	// dans ce cas, tout est ok, on peut démarrer notre session
 
           	// on la démarre
            	session_start (); 
            	// on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
	    	$_SESSION['authent']=true;
 
            	// on redirige notre visiteur vers une page de notre section membre
            	header ('location: template.php?content=content.php'); 
      	}
 
      	else { 
         	// Le visiteur n'a pas été reconnu comme étant membre de notre site. On utilise alors un petit javascript lui signalant ce fait
         	echo '<body onLoad="alert(\'Mauvais identifiants\')">'; 
         	// puis on le redirige vers la page d'accueil
         	echo '<meta http-equiv="refresh" content="0;URL=../index.php">'; 
      	}  
} 
 
else { 
      echo 'Entrez des identifiants';
}  

?>
