<!-- Formulaire d'identification : On entre un identifiant et un mot de passe. 
Ces informations sont testées, si ces identifiants sont bons on peut se connecter.
********************************* -->

<div id=content>
	<div id=identification>
    	<h1> Identification </h1>
        <br/>
	<!-- Formulaire d'identification -->
        <form action = "<?php echo $site; ?>/template/login.php" method = "post">
        		Identifiant :
   	 		<input id = "identifiant" type = "text" placeholder = "identifiant" name = "identifiant" >
            <br/> <br/>
   			Mot de passe :
   	 		<input id = "motdepasse" type = "password" placeholder ="**********" name = "motdepasse" >
            <br/><br/>
        	<input class="bouton"  type = "submit" value = "Connecter"/>
    		<input class="bouton" type="reset" value="Annuler"  /> <br/>
        </form>
<br/><br/><br/>
    </div>

</div>
