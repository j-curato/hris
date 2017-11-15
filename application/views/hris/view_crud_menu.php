<!DOCTYPE html>
<html>
<?php $this->load->view('hris/view_html_head');?>
<body>

<!-- Modal PAR Adding Form -->
<?php $this->load->view('hris/work_experience_modal');?>
<?php $this->load->view('hris/seminar_trainings_modal');?>
<?php $this->load->view('hris/upload_photo_modal');?>

<div class="modal fade bs-example-modal-lg add-par-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #343D46;">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">&times;</span></button>
			<h2 style="padding:10px; color: #fff; text-align: center;">Applicant Form</h2>
			<address></address>
			<form class="form-horizontal applicant-form" id="applicant-form" style="background-color: #e2e2e2;" method="post" enctype="multipart/form-data">
			  <fieldset>

			    <div class="alert alert-dismissable alert-success alert-add-success">
			      <button type="button" class="close" data-dismiss="alert">×</button>
			      <center><h4>Applicant Record saved.</h4></center>
			    </div>
			    
			   <address></address>
	
			<div class="col-md-6">
			    
			    <div class="form-group">
			      <label for="inputDate" class="col-lg-2 control-label">Date Received</label>
			      <div class="col-lg-10">
			        <!--<input type="text" class="form-control" name="par[title_of_activity]" id="inputActivity" placeholder="Activity" value="<?php echo (isset($par_details) ? $par_details[0]->title_of_activity : ""); ?>" style="width:260px;height:40px;" onchange="check_title_repeat();" required>-->
			        <input type="date" class="form-control" name="applicant[date_received]" id="inputDateReceive" style="width:260px;height:40px;" placeholder="Date received" value="" onchange="check_title_repeat();" required>
			      </div>
			    </div>
			
			    <div class="form-group">
			      <label for="inputLastName" class="col-lg-2 control-label">Last Name</label>
			      <div class="col-lg-10">
			        <!--<input type="text" class="form-control" name="par[date]" id="inputDate" placeholder="Start Date - End Date " value="<?php echo (isset($par_details) ? date('Y-m-d', strtotime($par_details[0]->date)) : ""); ?>" style="width:260px;height:40px;" required>-->
			        <input type="text" class="form-control" name="applicant[last_name]" id="inputLastName" placeholder="Last Name" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="inputFirstName" class="col-lg-2 control-label">First Name</label>
			      <div class="col-lg-10">
			        <!--<input type="text" class="form-control" name="par[venue]" id="inputVenue" placeholder="Location" value="<?php echo (isset($par_details) ? $par_details[0]->venue : ""); ?>" style="width:260px;height:40px;" required>-->
			        <input type="text" class="form-control" name="applicant[first_name]" id="inputFirstName" placeholder="First Name" value="<?php echo (isset($par_details) ? $par_details[0]->venue : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputMiddleName" class="col-lg-2 control-label">Middle Name</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[middle_name]" id="inputMiddleName" placeholder="Middle Name" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Age</label>
			      <div class="col-lg-10">
			      <select class="form-control" style="width:150px;height:40px;" name="applicant[age]">
			         <option value="0">Select age</option>
			        <?php for($i=18; $i<=60; $i++){ ?>
			         <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			        <?php } ?>
			        </select>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Status</label>
			      <div class="col-lg-10">
			      <select class="form-control" style="width:150px;height:40px;" name="applicant[status]"> 
			         <option value="0">Select status</option>
			         <option value="Single">Single</option>
			         <option value="Married">Married</option>
			         <option value="Widowed">Widowed</option>
			        </select>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Sex</label>
			      <div class="col-lg-10">
			      <select class="form-control" style="width:150px;height:40px;" name="applicant[sex]"> 
			         <option value="0">Select sex</option>
			         <option value="Male">Male</option>
			         <option value="Female">Female</option>
			        </select>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Address</label>
			      <div class="col-lg-10">
			        <textarea class="form-control" name="applicant[address]" style="width:260px;" placeholder="BLDG/STREET NO./STREET NAME"></textarea>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Municipality</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[municipality]" id="inputMunicipality" placeholder="Municipality" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Province</label>
			      <div class="col-lg-10">
			      <?php //$arrayProvince = ['Select a Province', 'Agusan del Norte', 'Agusan del Sur', 'Province of Dinagat Island', 'Surigao del Norte', 'Surigao del Sur']; ?>
			      <?php //echo form_dropdown("applicant[province]", $arrayProvince, "", 'class="form-control" id="province-id" style=width:260px;height:40px; required'); ?>
			      <input type='text' list='listid' class="form-control" name="applicant[province]" placeholder="Select a Province" style="width:260px;height:40px;" required>
					 <datalist id='listid'>
					   <option label='ADN' value='Agusan del Norte'>
					   <option label='ADS' value='Agusan del Sur'>
					   <option label='PDI' value='Province of Dinagat Island'>
					   <option label='SDN' value='Surigao del Norte'>
					   <option label='SDS' value='Surigao del Sur'>
				     </datalist>
			      </div>
			    </div>

			  </div><!-- end 1st column -->
			  <div class="col-md-6">

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Contact Number</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[contact_number]" id="inputContactNum" placeholder="Contact #" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Desired Position</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[desired_position]" id="inputDesiredPosition" placeholder="Desired Position" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Position Qualified</label>
			      <div class="col-lg-10">
			          <select class="form-control" style="width:200px;height:40px;" name="applicant[position_qualified]" id="inputPositionQualified">
				          <option value="0">Select a Position</option>
				        <?php for($i = 0; $i < sizeof( $positionsList ); $i++){ ?>
				           <option value="<?php echo $positionsList[$i]->ID ?>"><?php echo $positionsList[$i]->position_title; ?></option>
				        <?php } ?>
				      </select>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">School Attended</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[school_attended]" id="inputSchoolAttended" placeholder="School Attended" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Education Undergrad</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[education_undergrad]" id="inputEducationUndergrad" placeholder="Education Undergrad" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Year Graduated</label>
			      <div class="col-lg-10">
				      <select class="form-control" style="width:130px;height:40px;" name="applicant[year_graduated]">
				          <option value="0">Select year</option>
				        <?php $year = date('Y'); for($i=1960; $i<=$year; $i++){ ?>
				           <option value="<?php echo $i ?>"><?php echo $i; ?></option>
				        <?php } ?>
				       </select>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Education PostGrad</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[education_postgrad]" id="inputEduPostgrad" placeholder="Education PostGrad" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">School Attended Postgrad</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[school_attended_postgrad]" id="inputSchoolAttended" placeholder="School Attended" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Eligibility</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[eligibility]" id="inputEligibility" placeholder="Eligibility" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    </div> <!-- 2nd column -->

			     <div class="form-group">
			      <div class="col-lg-10 col-lg-offset-2">
			        <button class="btn btn-primary submit-applicant">Submit</button>
			        <button class="btn btn-default">Cancel</button>
			      </div>
			    </div>
			   
			  </fieldset>
			</form>
    </div>
  </div>
</div>



<!-- End Modal PAR Adding modal form -->


<!-- Start modal PAR Edit Form -->

<div class="modal fade bs-example-modal-lg edit-applicant-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #343D46;">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">&times;</span></button>
			<h2 style="padding:10px; color: #fff;">Edit Applicant Details</h2>
			<address></address>
			<form class="form-horizontal applicant-form-edit" id="applicant-form-edit" style="background-color: #e2e2e2;" method="post" enctype="multipart/form-data">
			  <fieldset>

			    <div class="alert alert-dismissable alert-success alert-edit-success">
			      <button type="button" class="close" data-dismiss="alert">×</button>
			      <center><h4>Data successfully updated.</h4></center>
			    </div>
			    
			   <address></address>

			  <input type="hidden" name="applicant[id]" id="applicantID" value="">

			  <div class="col-md-6">		   
			   <!-- Start -->
			   <div class="form-group">
			      <label for="inputDate" class="col-lg-2 control-label">Date Received</label>
			      <div class="col-lg-10">
			        <!--<input type="text" class="form-control" name="par[title_of_activity]" id="inputActivity" placeholder="Activity" value="<?php echo (isset($par_details) ? $par_details[0]->title_of_activity : ""); ?>" style="width:260px;height:40px;" onchange="check_title_repeat();" required>-->
			        <input type="date" class="form-control" name="applicant[date_received]" id="editDateReceive" style="width:260px;height:40px;" placeholder="Date received" value="" onchange="check_title_repeat();" required>
			      </div>
			    </div>
			
			    <div class="form-group">
			      <label for="inputLastName" class="col-lg-2 control-label">Last Name</label>
			      <div class="col-lg-10">
			        <!--<input type="text" class="form-control" name="par[date]" id="inputDate" placeholder="Start Date - End Date " value="<?php echo (isset($par_details) ? date('Y-m-d', strtotime($par_details[0]->date)) : ""); ?>" style="width:260px;height:40px;" required>-->
			        <input type="text" class="form-control" name="applicant[last_name]" id="editLastName" placeholder="Last Name" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="inputFirstName" class="col-lg-2 control-label">First Name</label>
			      <div class="col-lg-10">
			        <!--<input type="text" class="form-control" name="par[venue]" id="inputVenue" placeholder="Location" value="<?php echo (isset($par_details) ? $par_details[0]->venue : ""); ?>" style="width:260px;height:40px;" required>-->
			        <input type="text" class="form-control" name="applicant[first_name]" id="editFirstName" placeholder="First Name" value="<?php echo (isset($par_details) ? $par_details[0]->venue : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputMiddleName" class="col-lg-2 control-label">Middle Name</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[middle_name]" id="editMiddleName" placeholder="Middle Name" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Age</label>
			      <div class="col-lg-10">
			      <select class="form-control" style="width:150px;height:40px;" name="applicant[age]" id="editAge">
			         <option value="0">Select age</option>
			        <?php for($i=18; $i<=60; $i++){ ?>
			         <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			        <?php } ?>
			        </select>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Status</label>
			      <div class="col-lg-10">
			      <select class="form-control" style="width:150px;height:40px;" name="applicant[status]" id="editStatus"> 
			         <option value="0">Select status</option>
			         <option value="Single">Single</option>
			         <option value="Married">Married</option>
			         <option value="Widowed">Widowed</option>
			        </select>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Sex</label>
			      <div class="col-lg-10">
			      <select class="form-control" style="width:150px;height:40px;" name="applicant[sex]" id="editSex"> 
			         <option value="0">Select sex</option>
			         <option value="Male">Male</option>
			         <option value="Female">Female</option>
			        </select>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Address</label>
			      <div class="col-lg-10">
			        <textarea class="form-control" name="applicant[address]" id="editAddress" style="width:260px;" placeholder="BLDG/STREET NO./STREET NAME"></textarea>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Municipality</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[municipality]" id="editMunicipality" placeholder="Municipality" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Province</label>
			      <div class="col-lg-10">
			      <?php //$arrayProvince = ['Select a Province', 'Agusan del Norte', 'Agusan del Sur', 'Province of Dinagat Island', 'Surigao del Norte', 'Surigao del Sur']; ?>
			      <?php //echo form_dropdown("applicant[province]", $arrayProvince, "", 'class="form-control" id="editProvince" style=width:260px;height:40px; required'); ?>
			      
			      <input type='text' list='listid' id="editProvince" class="form-control" name="applicant[province]" placeholder="Select a Province" style="width:260px;height:40px;" required>
					 <datalist id='listid'>
					   <option label='ADN' value='Agusan del Norte'>
					   <option label='ADS' value='Agusan del Sur'>
					   <option label='PDI' value='Province of Dinagat Island'>
					   <option label='SDN' value='Surigao del Norte'>
					   <option label='SDS' value='Surigao del Sur'>
				     </datalist>
			      </div>
			    </div>

			  </div><!-- end 1st column -->

			  <div class="col-md-6">

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Contact Number</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[contact_number]" id="editContactNum" placeholder="Contact #" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Desired Position</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[desired_position]" id="editDesiredPosition" placeholder="Desired Position" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Position Qualified</label>
			      <div class="col-lg-10">
			          <select class="form-control" style="width:200px;height:40px;" name="applicant[position_qualified]" id="editPositionQualified">
				          <option value="0">Select a Position</option>
				        <?php for($i = 0; $i < sizeof( $positionsList ); $i++){ ?>
				           <option value="<?php echo $positionsList[$i]->ID; ?>"><?php echo $positionsList[$i]->position_title; ?></option>
				        <?php } ?>
				      </select>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">School Attended</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[school_attended]" id="editSchoolAttended" placeholder="School Attended" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Education Undergrad</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[education_undergrad]" id="editEducationUndergrad" placeholder="Education Undergrad" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Year Graduated</label>
			      <div class="col-lg-10">
				      <select class="form-control" style="width:130px;height:40px;" name="applicant[year_graduated]" id="editYear">
				          <option value="0">Select year</option>
				        <?php $year = date('Y'); for($i=1960; $i<=$year; $i++){ ?>
				           <option value="<?php echo $i ?>"><?php echo $i; ?></option>
				        <?php } ?>
				       </select>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Education PostGrad</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[education_postgrad]" id="editEduPostgrad" placeholder="Education PostGrad" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">School Attended Postgrad</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[school_attended_postgrad]" id="editSchoolAttendedPost" placeholder="School Attended" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Eligibility</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="applicant[eligibility]" id="editEligibility" placeholder="Eligibility" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div><!-- end -->
			    </div> <!-- end 2nd column -->

			     <div class="form-group">
			      <div class="col-lg-10 col-lg-offset-2">
			        <button type="submit" class="btn btn-primary update-applicant">Update</button>
			        <button class="btn btn-default">Cancel</button>
			      </div>
			    </div>
			   
			  </fieldset>
			</form>
    </div>
  </div>
</div>
 <!-- End Modal Edit Form -->

<?php $user_level = $this->session->userdata("user_level"); $admin_text = "Administrator"; ?>

<div class="well">
<span class="btn-default" style="padding:10px; letter-spacing:1px;"><i class="glyphicon glyphicon-font"></i> HRIS 1.0</span>
<span class="welcome_logged_user btn-default" style="padding:10px; letter-spacing:1px;"><i class="glyphicon glyphicon-user"></i> <?php echo "Logged in user: ".$this->session->userdata("username"); ?></span>
<span class="user_fname" style="display:none;"><?php echo $this->session->userdata("fname"); ?></span>
<span class="welcome_logged_user_level btn-default" style="padding:10px; letter-spacing:1px;"><i class="glyphicon glyphicon-eye-open"></i> <?php echo "Access Level: ".$this->session->userdata("user_level"); ?></span>

<a href="<?php echo base_url('main_controller/logout'); ?>" style="text-decoration: underline; font-weight: bold; float: right; font-size: 12px;"><span class="badge badge-danger">Logout</span></a>
<a href="<?php echo base_url('main_controller/list_of_candidates'); ?>" class="<?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>" style="width: 140px; text-decoration: underline; font-weight: bold; font-size: 12px; float:right;"><span class="badge badge-primary"> List of Candidates</span></a>
<a href="<?php echo base_url('main_controller/add_item_number'); ?>" class="<?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>" style="width: 140px; text-decoration: underline; font-weight: bold; font-size: 12px; float:right;"><span class="badge badge-success">Add Item Number</span></a>
<a href="<?php echo base_url('main_controller/add_position'); ?>" class="<?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>" style="width: 110px; text-decoration: underline; font-weight: bold; font-size: 12px; float:right;"><span class="badge badge-warning">Add Position</span></a>
<a href="<?php echo base_url('main_controller/view_users'); ?>" class="<?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>" style="width: 90px; text-decoration: underline; font-weight: bold; font-size: 12px; float:right;"><span class="badge badge-info">Add User</span></a>
</div>

    <div class="well table-holder">

    <div class="row">
		<ul class="nav nav-pills" role="tablist" style="float:right;">
			<li role="presentation" class="active"><a href="<?php echo base_url('main_controller/show_monthly_analytics'); ?>" target="_blank"> View Analytics  <i class="glyphicon glyphicon-stats"></i></a></li>
			<li role="presentation" class="active"><a href="" style="pointer-events: none;">Total Number of Applicants <span class="badge" id="badgePar_total"><?php echo $totalApplicant; ?></span></a></li>
	    </ul>	
	</div>  

<hr>
   
	    <!--<a href="<?php echo base_url(); ?>main_controller/parms_form" class="btn btn-primary add-par-btn"><i class="glyphicon glyphicon-plus"></i> Add PAR</a>-->
	    <a href="" class="btn btn-default add-applicant-btn <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-plus"></i> Add Applicant</a> 
	    <a href="" class="btn btn-default add-work-btn <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-plus"></i> Add Work Experience</a>
	    <a href="" class="btn btn-default add-seminar-btn <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-plus"></i> Add Seminar & Training</a>
	    <a href="<?php //echo base_url('main_controller/edit_par/'.$val->ID); ?>" class="btn btn-default btn-edit <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-edit"></i> Edit Applicant Details</a>
	    <a href="<?php //echo base_url('main_controller/delete_par/'.$val->ID); ?>" class="btn btn-default btn-delete <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-trash"></i> Delete</a>
	    <a href="<?php echo base_url('main_controller/exportToExcel/'); ?>" class="btn btn-success btn-export <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-export"></i> Export to Excel</a>	
	    <a href="" class="btn btn-success add-photo-btn <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-upload"></i> Upload a photo</a>
	    <a href="" class="btn btn-success add-photo-btn <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-pushpin"></i> Mark as processed</a>
	    
	    
		<?php 

		$theme_array = array( "0" => "Select a theme", "1" => "Default",
							  "2" => "Cosmo", "3" => "Cyborg",
							  "4" => "Darkly", "5" => "Flatly",
							  "6" => "Journal", "7" => "Lumen",
							  "8" => "Paper", "9" => "Readable",
							  "10" => "Sandstone", "11" => "Simplex",
							  "12" => "Slate", "13" => "Spacelab",
							  "14" => "Superhero", "15" => "United"
							 );

		 ?>

		<div class="btn-group" style="float:right;">   
				  <a href="#" class="btn btn-primary"><?php echo (($theme_name) ? $theme_name : "Select a theme"); ?></a>
				  <a href="#" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><span class="caret"></span></a>
				  <ul class="dropdown-menu">
				   <?php for( $i = 0;$i < sizeof($theme_array); $i++ ){ ?>
				    <li><a href="<?php echo base_url("main_controller/main_menu/".$theme_array[$i]); ?>"><?php echo $theme_array[$i]; ?></a></li>
				   <?php } ?>
				  </ul>
		</div>
<hr>
    <!--<div id="flash"></div>-->
	 <table class="table-applicant-contents display" id="table-applicant-contents" cellspacing="0" width="100%">
		  <thead style="background-color: #343D46; color: #fff;" id="notify_section">
		
		 <tr>
		 	<p id="notify_section"></p>

		 </tr>

		    <tr>
		      <th>#</th>
		      <th style="display:none;"></th>
		      <th>Date Received</th>
		      <th>First Name</th>
		      <th>Last Name</th>		      
		      <th style="display:none;">Middle Name</th>
		      <th style="display:none;">Age</th>
		      <th style="display:none;">Status</th>
		      <th style="display:none;">Sex</th>
		      <th style="display:none;">Address</th>
		      <th style="display:none;">Municipality</th>
		      <th style="display:none;">Province</th>
		      <th style="display:none;">Contact Number</th>
		      <th style="display:none;">Desired Position</th>
		      <th>Position Qualified</th>
		      <th style="display:none;">School Attended</th>
		      <th style="">Education Undergrad</th>
		      <th style="display:none;">Year Graduated</th>
		      <th style="">Education Postgrad</th>
		      <th style="display:none;">School Attended Postgrad</th>
		      <th style="display:none;">Eligibility</th>
		      <th style="display:none;"></th>
		      <th style="display:none;"></th>
		      <th style="display:none;">Work Experience</th>
		      <th style="display:none;">Seminar & Trainings</th>
		      <th style="display:none;">Position Qualified ID</th>
		    </tr>
		  </thead>
	  <tbody>

	        <?php  

	  	  	  foreach ($applicantList as $key => $val) {  
	  	  	  	
	  	  	  ?>

			    <tr class="tbl-applicant-row">
			    		<td><input type='checkbox' style='width:30px; height:20px;' class='radio_check_all par-id-checkbox' id='radio_check_all' value="<?php echo $val->id; ?>"></td>
			    		<td style="display:none;"><?php echo $val->created_at; ?></td>
			    		<td><?php echo date("F j, Y", strtotime($val->date_received)); ?></td>
			    		<td><?php echo $val->first_name; ?></td>
			    		<td><?php echo $val->last_name; ?></td>
			    		<td style="display:none;"><?php echo $val->middle_name; ?></td>
			    		<td style="display:none;"><?php echo $val->age; ?></td>
			    		<td style="display:none;"><?php echo $val->status; ?></td>
			    		<td style="display:none;"><?php echo $val->sex; ?></td>
			    		<td style="display:none;"><?php echo $val->address; ?></td>
			    		<td style="display:none;"><?php echo $val->municipality; ?></td>
			    		<td style="display:none;"><?php echo $val->province; ?></td>
			    		<td style="display:none;"><?php echo $val->contact_number; ?></td>
			    		<td style="display:none;"><?php echo $val->desired_position; ?></td>
			    		<td><?php echo $val->position_title; ?></td>
			    		<td style="display:none;"><?php echo $val->school_attended; ?></td>
			    		<td style=""><?php echo $val->education_undergrad; ?></td>
			    		<td style="display:none;"><?php echo $val->year_graduated; ?></td>
			    		<td style=""><?php echo $val->education_postgrad; ?></td>
			    		<td style="display:none;"><?php echo $val->school_attended_postgrad; ?></td>
			    		<td style="display:none;"><?php echo $val->eligibility; ?></td>
			    		<td style="display:none;"><?php echo $val->province; ?></td>
			    		<td style="display:none;"><?php echo $val->id; ?></td>
			    		<!--<td style="text-align:center; background-color:#25A602"><a href="" title="Add details"><i style="color:#fff;" class="glyphicon glyphicon-ok"></i></a></td>-->
			    		<?php

				    	    $this->db->from('tbl_work_experience')->where('applicant_id', $val->id);
							$queryWork = $this->db->count_all_results();

							$this->db->from('tbl_training_seminars')->where('applicant_id', $val->id);
							$querySeminar = $this->db->count_all_results();
			    		?>

			    		<?php if($queryWork){ ?>
			    			<td style="text-align:center; background-color:#25A602"><a href="<?php echo base_url("main_controller/showWorkExperience/".$val->id); ?>" title="Add details"><i style="color:#fff;" class="glyphicon glyphicon-eye-open"></i> View Experience</a></td>
			    		<?php }else{ ?>
			    			<td style="text-align:center; background-color:red;"><a href="<?php echo base_url("main_controller/showWorkExperience/".$val->id); ?>" title="Add details"><i style="color:#fff;" class=""></i>No Record</a></td>
			    		<?php } ?>
			    		
			    		<?php if($querySeminar){ ?>
			    			<td style="border-left: 1px solid #fff; text-align:center; background-color:#25A602"><a href="<?php echo base_url("main_controller/showSeminarTrainings/".$val->id); ?>" title="Add details"><i style="color:#fff;" class="glyphicon glyphicon-eye-open"></i> View Training</a></td>
			    		<?php }else{ ?>
			    			<td style="border-left: 1px solid #fff; text-align:center; background-color:red;"><a href="<?php echo base_url("main_controller/showSeminarTrainings/".$val->id); ?>" title="Add details"><i style="color:#fff;" class=""></i>No Record</a></td>
			    		<?php } ?>

			    		<td style="display:none;"><?php echo $val->position_qualified; ?></td>

			    </tr>

	    <?php }  ?>

	  </tbody>
     </table> 

	</div>
</body>
<center><footer style="font-weight: bold;">Department of Trade and Industry - Caraga Copyright &copy 2015. All Rights Reserved.</footer></center>

<?php 

	$data["theme_name"] = $theme_name;
	$this->load->view("hris/view_footer_script",$data); 

?>

</html>

