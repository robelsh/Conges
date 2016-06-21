<?php
//Connexion à la base de donnée.
		$user = "conge";
		$passwd = "conge";
		$dsn = 'mysql:host=localhost;dbname=conge';

		try
   		{
      			$instancePDO = new PDO($dsn, $user, $passwd);
			$instancePDO -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    		}

    		catch (PDOException $e) 
		{
      			echo 'Connexion échouée : '.$e->getMessage();
			echo '<br/>' ;
    		}

?>
