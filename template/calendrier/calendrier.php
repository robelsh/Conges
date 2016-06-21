<!--             Section calendrier, génère le calendrier              -->
<!-- Base du code : Source du calendrier : Grafikart Type: Open source -->
<!-- ***************************************************************** -->

<div id = "content">
	<br/>
    <div id="body">
    	<?php
			require ("../bdd/bdd.php");
			require('date.php');
			$date = new Date();
			//Récupère les jours fériés de l'année en cour.
			$events = $date->getEvents($instancePDO);
			//Récupère les jours de congés de l'année en cour.
			$conge = $date->getConge($instancePDO);
			//Récupère les jours de l'année pour la génération du calendrier.
			$dates = $date->getAll($annee); 
			$verif = 0;
	?>
	
    	<div class="period">
		<!-- Selection de la date -->
            	<div class="months">
		<a class="chxannee" href="../template/template.php?content=calendrier/calendrierprec.php&annee=<?php echo $annee; ?>"> < </a>
		<div class="year"> <?php echo $annee; ?> </div>
		<a class="chxannee" href="../template/template.php?content=calendrier/calendriersuiv.php&annee=<?php echo $annee; ?>"> > </a>

		<!-- Affichage des mois -->
            		<ul> 
			<?php foreach($date->mois as $id=>$mois): ?>
                    	<li> <a href="#" id="linkMonth<?php echo $id+1; ?>"><?php echo substr($mois,0,3); ?> </a></li>
                		<?php endforeach; ?>
                	</ul>
				</div>
                <div class="clear"></div>
                <?php $dates = current($dates); ?>

                <?php foreach($dates as $mois=>$jours): ?>
                	<div class="month" id="month<?php echo $mois; ?>">
                    	<table>
                        	<thead>
                            	<tr>
					<!-- Affichage des jours -->
                                	<?php foreach($date->jours as $j): ?>
                                    	<th> <?php echo substr($j,0,3); ?> </th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>
                            <tbody>
                            	<tr>
                            		<?php $end = end($jours); foreach($jours as $j=>$semaine): ?>
					<?php $time = strtotime("$annee-$mois-$j"); ?>
                                	<?php if($j == 1 && $semaine!=1): ?>
                                        	<td colspan="<?php echo $semaine-1; ?>" class="padding"></td>
                                        <?php endif; ?>
                                        
                                    	<td> 
					<div class="relative"> 
						<div class="day"> <?php echo $j; ?> </div>
                                        </div>
					<!-- Affiche les congés et les jours férié -->
                                        	<ul class="events"> 
						<?php if(isset($events[$time])): foreach($events[$time] as $e): ?>
							<li> <?php echo $e; ?> </li>
						<?php endforeach; endif; ?>
						<div id="conge">
						<?php if(isset($conge[$time])): 
							$verif = 1;
							foreach($conge[$time] as $c): ?>
							<li> <?php echo $c; ?> </li>
						<?php endforeach; endif; ?>        
						</div>                     		
                                            </ul>
                                        </td>
                                        <?php if($semaine==7): ?>
                                </tr><tr>
                                		<?php endif; ?>
                                <?php endforeach; ?>
                                <?php if($end != 7): ?>
                                	<td colspan="<?php echo 7-$end; ?>"></td>
                                <?php endif; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
        </div>
		<div class="clear">
		</div>
	</div>
	<?php 
		if ($verif != 1):
	?>
	<br/>
	<!-- Lien vers l'ajout de périodes communes -->
	<a class = "periodecom" href="template.php?content=calendrier/ajoutperiodecom.php&annee=<?php echo $annee; ?>">Nouvelles périodes</a> 
	<?php endif; ?>
</div>
