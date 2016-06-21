/*Fonction de vérification si tous les champs sont remplis pour la modification de membre*/
function verif_modif() {
	var elem;
	elem = document.forms["infomembre"].length;
	
	for (i=0;i<elem;i++)
	{
		if(document.forms["infomembre"].elements[i].value == "") {
			alert("Il Faut saisir un " + document.forms["infomembre"].elements[i].name);
			return false;
		}
	}
	
	if ( document.forms["infomembre"].elements[0].value != "" && document.forms["infomembre"].elements[1].value != "" && document.forms["infomembre"].elements[2].value != "" && document.forms["infomembre"].elements[3].value != "" ){
			return true;
		}	
}


/*Fonction de vérification si une case est coché*/
function verif_periode() {
	//test si les cases sont cochées.
	if ( (document.saisie.matin.checked) == true || (document.saisie.apres.checked) == true ){
		return 1;
	}
	
	else { return 0; }
}


/*Fonction de confirmation de suppression d'un membre */

function suppr(){
	var reponse = confirm("Supprimer ce membre?")
	if(reponse) {
		return true;
	}
}

/*Fonction de confirmation d'ajout de congés */
function ajoutconge(){
	//vérification si au moins une case est cochée.
	var retour = verif_periode();
	//si c'est le cas..
	if ( retour == 1 ){
		var reponse = confirm("Ajouter cette période?")
		if(reponse) {
			return true;
		}
	}
	//sinon un avertissement apparait.
	else { alert ("Veuillez cocher au moin une période") };
}

/*Fonction permettant l'affichage du calendrier */

jQuery(function($){
	var date = new Date();
	var current = date.getMonth()+1;
	$('.month').hide(); //Cache tous les mois.
	$('#month'+current).show(); //Affiche uniquement le mois en cour.
	$('.months a#linkMonth'+current).addClass('active');
	$('.months a').click(function(){
		var month = $(this).attr('id').replace('linkMonth','');
		if(month != current){
			$('#month'+current).slideUp(); //Permet l'effet glissé quand on change de mois.
			$('#month'+month).slideDown();
			$('.months a').removeClass('active');
			$('.months a#linkMonth'+month).addClass('active');
			current = month;
		}
		return false;
	});
});



	
