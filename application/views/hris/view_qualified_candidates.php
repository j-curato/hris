<!DOCTYPE html>
<html>
<head>
	<title>List of Candidates</title>
	<link href="<?php echo base_url(); ?>asset/bootstrap/css/bootstrap.css" rel="stylesheet">
	
	<style type="text/css">
	
	h5{
		text-align: center;
		font-weight: bold;
	}

	</style>
</head>
<body onload="window.print();"> 

<h5>LIST OF CANDIDATES FOR VACANT POSITIONS</h5>
<h5> IN THE DEPARTMENT OF TRADE AND INDUSTRY - CARAGA</h5>
<h5> As of <?php echo date("F j, Y"); ?></h5>
  <table class="table table-bordered">

  	<th>Vacant Plantilla Positions/ Salary Grade and Location</th>
  	<th>Qualification Standards</th>
  	<th>#</th>
  	<th>Name of Candidates</th>
  	<th>Contact #s</th>
  	<th>Education</th>
  	<th>Relevant Experience</th>									
  	<th>Relevant Training</th>

  	<tbody>

         <?php
  
               for ( $i = 0; $i < count( $qualified_applicants ); $i++ ) { 

	               	
               	   if( count( $appExp ) == 0 ){
               	   	 $arrayWork[][] = NULL;
               	   }else{

	               	for ( $j = 0; $j < count( $appExp ); $j++ ) { 

	               		if( $qualified_applicants[$i]->id == $appExp[$j]->applicant_id ){

	               			$arrayWork[$appExp[$j]->applicant_id][$j] = $appExp[$j]->work.', '.$appExp[$j]->company_name.' - '.date("F j, Y", strtotime($appExp[$j]->start_date)).' - '.( !empty( $appExp[$j]->end_date ) ? date("F j, Y", strtotime($appExp[$j]->end_date)) : "Present" );

	               		}
	                  }
	               }	

	              if( count($appTraining) == 0 ){
	                	$arrayTraining[][] = NULL;
	                }else{

		               	for ( $k = 0; $k < count( $appTraining ); $k++ ) { 

		               		if( $qualified_applicants[$i]->id == $appTraining[$k]->applicant_id ){

		               			$arrayTraining[$appTraining[$k]->applicant_id][$k] = $appTraining[$k]->seminar.' - '.date("F j, Y", strtotime($appTraining[$k]->seminar_start_date)).' - '.( !empty( $appTraining[$k]->seminar_end_date ) ? date("F j, Y", strtotime($appTraining[$k]->seminar_end_date)) : "Present" );

		               		}

		               	}
	               }	
               	# code...
               } 


               $newFormattedWork = array();
			   $newFormattedTraining = array();

				foreach($arrayWork as $key => $value) {
				  $holderWork[] = $key;
				}

				foreach($arrayTraining as $key => $value) {
				  $holderTraining[] = $key;
				}

			    foreach($arrayWork as $key => $value){
			        $newFormattedWork[$key] = array_values($value); // array_values() will set the order in asc, starts with 0
			    }

			    foreach($arrayTraining as $key => $value){
			        $newFormattedTraining[$key] = array_values($value); // array_values() will set the order in asc, starts with 0
			    }
			   
				//var_dump($holderTraining);
				//var_dump($appTraining);
				//var_dump($newFormattedTraining);
				

		      if( isset( $qualified_applicants ) ) {

		  	  foreach ($qualified_applicants as $key => $val) { //echo $val->id; ?>

				    <tr class="tbl-cat-row">

				    	<?php if( ++$key == 1 ){ ?>
				    		<td>
				    			<?php echo $positionDetails[0]->description; ?>
				    		<br>
				    			<?php echo $positionDetails[0]->salary_grade; ?>
					    		<br>
					    		<?php 
					    			 for( $i = 0; $i < sizeof( $item_results ); $i++){
					    			 	echo $item_results[$i]->item_name.'</br>';
					    			} 
					    		?>
					    		Location: 
					    		<?php 
					    			 for( $i = 0; $i < sizeof( $item_results ); $i++){
					    			 	echo $item_results[$i]->location.'</br>';
					    			} 
					    		?>
				    		</td>
	        				<td>
	        				Education: <?php echo $positionDetails[0]->education; ?>
	        				<br>
	        				Experience: <?php echo $positionDetails[0]->experience; ?>
	        				<br>
	        				Training: <?php echo $positionDetails[0]->training; ?>
	        				<br>
	        				Eligibility: <?php echo $positionDetails[0]->eligibility; ?>
	        				</td>
	        				<td><?php echo $key; ?></td>
				    		<td><?php echo $val->first_name.' '.$val->last_name; ?></td>
				    		<td><?php echo $val->contact_number; ?></td>
				    		<td><?php echo $val->education_postgrad; ?></td>
				    		<td>
				    		 <?php 
				    		 	for( $k = 0; $k < count( $holderWork ); $k++){
				    		 		if( $holderWork[$k] == $val->id ){

				    		 			for ($i=0; $i < count($newFormattedWork[$val->id]); $i++) { 
				    		 				echo $newFormattedWork[$val->id][$i].'; ';
				    		 			}
				    		 			
				    		 		}
				    		 	}
				    		 ?>
				    		</td>
				    		<td>
					    		<?php 
					    		 	for( $k = 0; $k < count( $holderTraining ); $k++){
					    		 		if( $holderTraining[$k] == $val->id ){

					    		 			for ($i=0; $i < count($newFormattedTraining[$val->id]); $i++) { 
					    		 				echo $newFormattedTraining[$val->id][$i].'; ';
					    		 			}
					    		 			
					    		 		}
					    		 	}
					    		 ?>
				    		 </td>
				    	
	        			<?php }else{ ?>	
	        				<td></td>
	        				<td></td>
	        			    <td><?php echo $key; ?></td>
				    		<td><?php echo $val->first_name.' '.$val->last_name; ?></td>
				    		<td><?php echo $val->contact_number; ?></td>
				    		<td><?php echo $val->education_postgrad; ?></td>
				    		<td>
				    		<?php 
				    		 	for( $k = 0; $k < count($holderWork); $k++){
				    		 		if( $holderWork[$k] == $val->id ){

				    		 			for ($i=0; $i < count($newFormattedWork[$val->id]); $i++) { 
				    		 				echo $newFormattedWork[$val->id][$i].'; ';
				    		 			}
				    		 			
				    		 		}
				    		 	}
				    		 ?>
				    		</td>
				    		<td>
				    			<?php 
					    		 	for( $k = 0; $k < count( $holderTraining ); $k++){
					    		 		if( $holderTraining[$k] == $val->id ){

					    		 			for ($i=0; $i < count($newFormattedTraining[$val->id]); $i++) { 
					    		 				echo $newFormattedTraining[$val->id][$i].'; ';
					    		 			}
					    		 			
					    		 		}
					    		 	}
					    		 ?>
				    		</td>
				    	
	        			<?php } ?>
	        				
				    		
				    </tr>

	     <?php } } ?>

  	</tbody>


  </table>
</body>
</html>