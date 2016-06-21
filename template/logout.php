<?php 
//Déconnecte de l'espace membre en récupérant la session en cours pour ensuite la détruire.
	session_start();
   	session_destroy(); 
   	echo '<meta http-equiv="refresh" content="0;URL=../index.php">'; 
?> 
