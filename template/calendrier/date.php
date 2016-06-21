<?php
/* classe qui permet la récupération des jours fériés, des congés de tous les membres, des congés d'un membre spécifique ainsi que les jours de l'année pour la création du calendrier */
/* Base du code : Source : Grafikart Type : Open source */
/* **************************************************** */
class Date {
	// Déclaration des jours de la semaine et des mois
	var $jours = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
	var $mois = array('Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre');

	function getEvents($instancePDO){
		//préparation de la requête
		$req = $instancePDO->query('SELECT ID_JOURFERIE,DATE_FERIE FROM JOUR_FERIE');
		$r = array();
		//Récupération des jours fériés
		while ($d = $req->fetch(PDO::FETCH_OBJ)) {
			$r[strtotime($d->DATE_FERIE)][$d->ID_JOURFERIE] = "Jour Férié";
		}
		return $r;
	}

	
	function getConge($instancePDO){
		//requête récupérant les jours de congé
		$req = $instancePDO->query('SELECT IDENTIFIANT,ID_CONGE,DATE,MATIN,APRES FROM CONGES');
		//requête récupérant les noms et prénoms
		$requete = $instancePDO->query('SELECT IDENTIFIANT,NOM,PRENOM FROM EMPLOYE');
		$r = array(); //tableau stockant les jours de congé et les noms/prénoms
		$c = array(); //tableau stockant les noms et prénoms correspondant aux identifiants

		//récupération des noms et prénoms
		while ($b = $requete->fetch(PDO::FETCH_OBJ)) {
			$c[$b->IDENTIFIANT] = $b->NOM.' '.$b->PRENOM;
		}

		//récupération des journées de congé
		while ($d = $req->fetch(PDO::FETCH_OBJ)) {
			if($d->MATIN == 0 && $d->APRES == 0 || $d->MATIN == 1 && $d->APRES == 1){
				$r[strtotime($d->DATE)][$d->ID_CONGE] = $c[$d->IDENTIFIANT].' : journée entière';
			}
	
			else if($d->MATIN == 1 && $d->APRES == 0) {
				$r[strtotime($d->DATE)][$d->ID_CONGE] = $c[$d->IDENTIFIANT].' : matin';
			}

			else if ($d->MATIN == 0 && $d->APRES == 1){
				$r[strtotime($d->DATE)][$d->ID_CONGE] = $c[$d->IDENTIFIANT].' : après midi';
			}
		}
		return $r;
	}

	function getCongeMembre($id,$instancePDO){
		//requête récupérant les jours de congé
		$req = $instancePDO->query('SELECT IDENTIFIANT,ID_CONGE,DATE,MATIN,APRES FROM CONGES WHERE IDENTIFIANT ="'.$id.'"');
		//requete récupérant les noms et prénoms
		$requete = $instancePDO->query('SELECT IDENTIFIANT,NOM,PRENOM FROM EMPLOYE WHERE IDENTIFIANT ="'.$id.'"');
		$r = array(); //tableau stoquant les jours de congé et les noms/prenoms
		$c = array(); //tableau stoquant les nom et prenom corespondant aux identifiants

		//récupération des noms et prénoms
		while ($b = $requete->fetch(PDO::FETCH_OBJ)) {
			$c[$b->IDENTIFIANT] = $b->NOM.' '.$b->PRENOM;
		}

		//récupération des journées de congé
		while ($d = $req->fetch(PDO::FETCH_OBJ)) {
			if(($d->MATIN == 0 && $d->APRES == 0) || ($d->MATIN == 1 && $d->APRES == 1)){
				$r[strtotime($d->DATE)][$d->ID_CONGE] = $c[$d->IDENTIFIANT].': journée entière';
			}
	
			else if($d->MATIN == 1 && $d->APRES == 0) {
				$r[strtotime($d->DATE)][$d->ID_CONGE] = $c[$d->IDENTIFIANT].'Congé : matin';
			}

			else if ($d->MATIN == 0 && $d->APRES == 1){
				$r[strtotime($d->DATE)][$d->ID_CONGE] = $c[$d->IDENTIFIANT].'Congé : après midi';
			}
		}
		return $r;
	}

	function getAll($annee) {
		
		$r = array();
		
		$date = new DateTime($annee.'-01-01');
		while($date->format('Y') <= $annee) {
			// y : stocke les années
			$y = $date->format('Y');
			// m : stocke les mois
			$m = $date->format('n');
			// d : stocke les jour
			$d = $date->format('j');
			// w : stocke les semaines
			$w = str_replace('0','7',$date->format('w'));
			$r[$y][$m][$d] = $w;
			$date->add(new DateInterval('P1D'));
		}
		return $r;
	}
}
?>
