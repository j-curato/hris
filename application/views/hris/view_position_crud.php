<!DOCTYPE html>
<html>
<?php $this->load->view('hris/view_html_head');?>
<body>

<div class="modal fade bs-example-modal-lg add-cat-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #343D46;">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">&times;</span></button>
			<h2 style="padding:10px; color: #fff;">Position Adding Form</h2>
			<address></address>
			<form class="form-horizontal position-form" id="position-form" style="background-color: #e2e2e2;" method="post" enctype="multipart/form-data">
			  <fieldset>

			    <div class="alert alert-dismissable alert-success alert-add-success">
			      <button type="button" class="close" data-dismiss="alert">×</button>
			      <center><h4>Category successfully saved.</h4></center>
			    </div>
			    
			    <address></address>
			   <!--<input type="text" name="cat_id" class="cat_id" id="cat_id" value="<?php //echo (isset($par_details) ? $par_details[0]->ID : ""); ?>">-->
	
			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Position Title</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayPos[position_title]" id="inputPositionTitle" placeholder="Position Title" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Description</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayPos[description]" id="inputPositionDescription" placeholder="E.g. Trade and Industry Specialist" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Salary Grade</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayPos[salary_grade]" id="inputSalaryGrade" placeholder="Salary Grade" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Education</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayPos[education]" id="inputEducation" placeholder="Education" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div id="loading">
                  <img id="loading-image" style="display:none;" src="<?php  echo base_url("scanned_docs/loading2.gif"); ?>" alt="Loading..." />
                </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Experience</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayPos[experience]" id="inputExperience" placeholder="Experience" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Training</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayPos[training]" id="inputTraining" placeholder="Training" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Eligibility</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayPos[eligibility]" id="inputEligibility" placeholder="Eligibility" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>
		   
			     <div class="form-group">
			      <div class="col-lg-10 col-lg-offset-2">
			        <button class="btn btn-primary submit-position">Submit</button>
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

<div class="modal fade bs-example-modal-lg edit-cat-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #343D46;">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">&times;</span></button>
			<h2 style="padding:10px; color: #fff;">Edit Position Form</h2>
			<address></address>
			<form class="form-horizontal applicant-position-update" id="position-form-edit" style="background-color: #e2e2e2;" method="post" enctype="multipart/form-data">
			  <fieldset>

			    <div class="alert alert-dismissable alert-success alert-success-position-details alert-edit-success">
			      <button type="button" class="close" data-dismiss="alert">×</button>
			      <center><h4>Position details successfully updated.</h4></center>
			    </div>
			    
			   <address></address>
			   <input type="hidden" name="arrPos[ID]" class="posID-edit" id="posID-edit" value="" />
	
			    <div class="form-group">
			      <label for="inputCategory" class="col-lg-2 control-label">Position Title</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrPos[position_title]" id="editPos-id" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputCategory" class="col-lg-2 control-label">Description</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrPos[description]" id="editDesc-id" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputCategory" class="col-lg-2 control-label">Salary Grade</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrPos[salary_grade]" id="editSalary-id" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputCategory" class="col-lg-2 control-label">Education</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrPos[education]" id="editEdu-id" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputCategory" class="col-lg-2 control-label">Experience</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrPos[experience]" id="editExp-id" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputCategory" class="col-lg-2 control-label">Training</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrPos[training]" id="editTraining-id" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputCategory" class="col-lg-2 control-label">Eligibility</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrPos[eligibility]" id="editElig-id" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>
			  
			     <div class="form-group">
			      <div class="col-lg-10 col-lg-offset-2">
			        <button type="submit" class="btn btn-primary update-applicant-position">Update</button>
			        <button class="btn btn-default">Cancel</button>
			      </div>
			    </div>
			   
			  </fieldset>
			</form>
    </div>
  </div>
</div>
 <!-- End Modal Edit Form -->

<?php 

	$user_level = $this->session->userdata("user_level"); 
	$admin_text = "Administrator"; 

?>

<div class="well">
<span class="welcome_logged_user btn-default" style="padding:10px; letter-spacing:1px;"><i class="glyphicon glyphicon-user"></i> <?php echo "Logged in user: ".$this->session->userdata("username"); ?></span>
<span class="welcome_logged_user btn-default" style="padding:10px; letter-spacing:1px;"><i class="glyphicon glyphicon-eye-open"></i> <?php echo "Access Level: ".$this->session->userdata("user_level"); ?></span>

<a href="<?php echo base_url('main_controller/logout'); ?>" style="text-decoration: underline; font-weight: bold; float: right; font-size: 12px;"><i class="glyphicon glyphicon-remove"></i> Logout</a>

<a href="<?php echo base_url('main_controller/main_menu'); ?>" class="<?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>" style="width: 90px; text-decoration: underline; font-weight: bold; font-size: 12px; float:right;"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
</div>

    <div class="well table-holder">
    <!--<a href="<?php echo base_url(); ?>main_controller/parms_form" class="btn btn-primary add-par-btn"><i class="glyphicon glyphicon-plus"></i> Add PAR</a>-->
    <a href="" class="btn btn-primary active add-cat-btn <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-plus"></i> Add Position</a>
    <a href="<?php //echo base_url('main_controller/edit_par/'.$val->ID); ?>" class="btn btn-warning btn-edit-position <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-edit"></i> Edit Position</a>
    <a href="<?php //echo base_url('main_controller/delete_par/'.$val->ID); ?>" class="btn btn-danger btn-delete-cat <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-trash"></i> Delete Position</a>
   <hr> 
		<div class="row">
		  <div class="col-lg-6">
		    <div class="input-group">
		     <input type="text" class="form-control search-form-position" id="auto_search_position_form" placeholder="Search by Position" style="width:260px;height:40px;">
		     <span class="input-group-btn">
		        <button class="btn btn-default btn-search-position" type="button" style="position: absolute; margin-top: -20px; height: 40px;"><i class="glyphicon glyphicon-search"></i></button>
		     </span>
		    </div><!-- /input-group -->
		  </div><!-- /.col-lg-6 -->

			<ul class="nav nav-pills" role="tablist" style="float:right;">
				<li role="presentation" class="active"><a href="">Total Number of Categories <span class="badge" id="badgeCat_total"><?php echo $position_total; ?></span></a></li>
			</ul>	
	
		</div>
    <hr>
    <!--<div id="flash"></div>-->
	  <table class="table table-striped table-hover table-position-contents" id="table-position-contents">
		  <thead style="background-color: #343D46; color: #fff;" id="notify_section">
		
			 <tr>
			 	<p id="notify_section"></p>
			 </tr>
		    
		    <tr>
		      <th><input type="checkbox" class="cat-checkbox" id="radio_check_all" value="" style="width:18px; height:18px;"></th>
		      <th style="display:none;">ID</th>
		      <th>Position Title</th>
		      <th>Description</th>
		      <th>Salary Grade</th>
		      <th>Education</th>
		      <th>Experience</th>
		      <th>Training</th>
		      <th>Eligibility</th>
		      <th style="display:none;">Created at</th>
		    </tr>

		  </thead>
	  <tbody>
	  	
	  <?php  

	  if( isset( $position_list ) ) {

	  	  foreach ($position_list as $key => $val) { ?>

	    <tr class="tbl-cat-row">
	    		<td><input type='checkbox' <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?> style='width:30px; height:20px;' class='cat-id-checkbox' id='radio_check_all' value="<?php echo $val->ID; ?>"></td>
	    		<td style='display:none;'><?php echo $val->ID; ?></td>
	    		<td><?php echo $val->position_title; ?></td>
	    		<td><?php echo $val->description; ?></td>
	    		<td><?php echo $val->salary_grade; ?></td>
	    		<td><?php echo $val->education; ?></td>
	    		<td><?php echo $val->experience; ?></td>
	    		<td><?php echo $val->training; ?></td>
	    		<td><?php echo $val->eligibility; ?></td>
	    		<td style="display:none;"><?php echo $val->created_at; ?></td>
	    </tr>

	  <?php } } ?>

	  </tbody>
     </table> 

	       <nav>
	       
			  <ul class="pagination" id="pagination_id">
			       <?php echo $this->pagination->create_links(); ?> 
			  </ul>

	       </nav>
	</div>
</body>
<?php 

	$data["theme_name"] = $this->session->userdata("theme_name"); 
	$this->load->view("hris/view_footer_script", $data); 

?>
</html>