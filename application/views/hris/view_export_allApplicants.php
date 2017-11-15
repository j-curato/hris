<?php 
header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename=applicant.xls');
header('Pragma: no-cache');
header('Expires: 0');
?>
<!DOCTYPE html>
<html>
<body>
	 <table>
		  <thead>
	
		    <tr>
		      <th>Date Received</th>
		      <th>First Name</th>
		      <th>Last Name</th>		      
		      <th>Middle Name</th>
		      <th>Age</th>
		      <th>Status</th>
		      <th>Sex</th>
		      <th>Address</th>
		      <th>Municipality</th>
		      <th>Province</th>
		      <th>Contact Number</th>
		      <th>Desired Position</th>
		      <th>Position Qualified</th>
		      <th>School Attended</th>
		      <th>Education Undergrad</th>
		      <th>Year Graduated</th>
		      <th>Education Postgrad</th>
		      <th>School Attended Postgrad</th>
		      <th>Eligibility</th>
		    </tr>
		  </thead>
	  <tbody>

	        <?php  

	  	  	  foreach ($applicantList as $key => $val) {  
	  	  	  	
	  	  	  ?>

			    <tr> 		
			    		<td><?php echo date("F j, Y", strtotime($val->date_received)); ?></td>
			    		<td><?php echo $val->first_name; ?></td>
			    		<td><?php echo $val->last_name; ?></td>
			    		<td><?php echo $val->middle_name; ?></td>
			    		<td><?php echo $val->age; ?></td>
			    		<td><?php echo $val->status; ?></td>
			    		<td><?php echo $val->sex; ?></td>
			    		<td><?php echo $val->address; ?></td>
			    		<td><?php echo $val->municipality; ?></td>
			    		<td><?php echo $val->province; ?></td>
			    		<td><?php echo $val->contact_number; ?></td>
			    		<td><?php echo $val->desired_position; ?></td>
			    		<td><?php echo $val->position_title; ?></td>
			    		<td><?php echo $val->school_attended; ?></td>
			    		<td><?php echo $val->education_undergrad; ?></td>
			    		<td><?php echo $val->year_graduated; ?></td>
			    		<td><?php echo $val->education_postgrad; ?></td>
			    		<td><?php echo $val->school_attended_postgrad; ?></td>
			    		<td><?php echo $val->eligibility; ?></td>    		
			    </tr>

	    <?php }  ?>

	  </tbody>
     </table> 
</body>

</html>

