<!DOCTYPE html>
<html>
<?php $this->load->view('hris/view_html_head');?>
<body>

<!-- Modal PAR Adding Form -->

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
			<h2 style="padding:10px; color: #fff;">PAR Category Edit Form</h2>
			<address></address>
			<form class="form-horizontal cat-form-edit" id="cat-form-edit" style="background-color: #e2e2e2;" method="post" enctype="multipart/form-data">
			  <fieldset>

			    <div class="alert alert-dismissable alert-success alert-edit-success">
			      <button type="button" class="close" data-dismiss="alert">×</button>
			      <center><h4>Category successfully updated.</h4></center>
			    </div>
			    
			   <address></address>
			   <input type="hidden" name="arrayCat[ID]" class="cat_id-edit" id="cat_id-edit" value="" />
	
			    <div class="form-group">
			      <label for="inputCategory" class="col-lg-2 control-label">Category Name</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayCat[category_name]" id="inputCategory-edit" value="<?php echo (isset($par_details) ? $par_details[0]->title_of_activity : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>
			  
			     <div class="form-group">
			      <div class="col-lg-10 col-lg-offset-2">
			        <button type="submit" class="btn btn-primary update-cat">Update</button>
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
   
   <hr> 
		<div class="row">
		  <div class="col-lg-6">
		    <div class="input-group">
		     <input type="text" class="form-control search-form-position" id="auto_search_position_form" placeholder="Search by Position" style="width:260px;height:40px;">
		     <span class="input-group-btn">
		        <button class="btn btn-default btn-search-candidates" type="button" style="position: absolute; margin-top: -20px; height: 40px;"><i class="glyphicon glyphicon-search"></i></button>
		     </span>
		    </div><!-- /input-group -->
		  </div><!-- /.col-lg-6 -->
		 
		</div>

    <hr>

    <h4>Number of Qualified Candidates: <span id="total_candidates">0</span></h4>
    <!--<div id="flash"></div>-->
	  <table class="table table-striped table-hover table-candidate-contents" id="table-candidate-contents">

		  <thead style="background-color: #343D46; color: #fff;" id="notify_section">
		
			 <tr>
			 	<p id="notify_section"></p>

			 </tr>

			 <tr>
				  <ul class="nav nav-pills" role="tablist" style="float:right;">
					 <a href="" target="_blank" class="btn btn-success active" id="print-candidates-btn"><i class="glyphicon glyphicon-print"></i> Print Candidates</a>
				  </ul>
			  </tr>
			 
		    
		    <tr>
		      <th>#</th>
		      <th>Name of Candidates</th>
		      <th>Contact #s</th>
		      <th>Education</th>
		      <th>Relevant Experience</th>
		      <th>Relevant Training</th>
		    </tr>

		  </thead>
	  <tbody>
	  	
	  
	    <tr class="tbl-cat-row">
	    		
	    </tr>


	  </tbody>
     </table> 

	</div>
</body>
<?php 

	$data["theme_name"] = $this->session->userdata("theme_name"); 
	$this->load->view("hris/view_footer_script", $data); 

?>
</html>