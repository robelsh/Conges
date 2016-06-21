
    <div id="body">
    	<?php
			require ("../bdd/bdd.php");
			require('calendrier/date.php');
			$date = new Date();
			$annee = date('Y');
			$events = $date->getEvents($instancePDO);
			$conge = $date->getCongeMembre($identifiant,$instancePDO);
			$dates = $date->getAll($annee);
	?>
	
    	<div class="period">
        	<div class="year"> <?php echo $annee; ?> </div>
		
            	<div class="months">
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
                                        	<ul class="events"> 
						<?php if(isset($events[$time])): foreach($events[$time] as $e): ?>
							<li> <?php echo $e; ?> </li>
						<?php endforeach; endif; ?>
						<div id="conge">
						<?php if(isset($conge[$time])): foreach($conge[$time] as $c): ?>
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
</div>
