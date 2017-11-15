<div class="modal fade bs-example-modal-lg add-seminar-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #343D46;">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">&times;</span></button>
			<h2 style="padding:10px; color: #fff; text-align: center;">Applicant Seminar & Training Form</h2>
			<address></address>
			<form class="form-horizontal applicant-seminar-form" id="applicant-seminar-form" style="background-color: #e2e2e2;" method="post" enctype="multipart/form-data">
			  <fieldset>

			    <div class="alert alert-dismissable alert-success alert-add-success">
			      <button type="button" class="close" data-dismiss="alert">×</button>
			      <center><h4>Seminar/Training saved.</h4></center>
			    </div>
			    
			   <address></address>
	
			    <input type="hidden" name="applicant[applicant_id]" id="appSeminarID" value="<?php echo (isset($applicantID) ? $applicantID : "" ); ?>">
			
			    <div class="form-group">
			      <label for="inputLastName" class="col-lg-2 control-label">Seminar/Training Title</label>
			      <div class="col-lg-10">
			        <!--<input type="text" class="form-control" name="par[date]" id="inputDate" placeholder="Start Date - End Date " value="<?php echo (isset($par_details) ? date('Y-m-d', strtotime($par_details[0]->date)) : ""); ?>" style="width:260px;height:40px;" required>-->
			        <input type="text" class="form-control" name="applicant[seminar]" id="seminarID" placeholder="Seminar/Training" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>
			    <div class="form-group">
			      <label for="inputFirstName" class="col-lg-2 control-label">Venue</label>
			      <div class="col-lg-10">
			         <textarea class="form-control" name="applicant[venue]" id="venueID" style="width:260px;" placeholder="Venue"></textarea>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputMiddleName" class="col-lg-2 control-label">Start Date</label>
			      <div class="col-lg-10">
			        <input type="date" class="form-control" name="applicant[seminar_start_date]" id="startDateID" placeholder="Start Date" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputMiddleName" class="col-lg-2 control-label">End Date</label>
			      <div class="col-lg-10">
			        <input type="date" class="form-control" name="applicant[seminar_end_date]" id="endDateID" placeholder="End Date" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			   
			     <div class="form-group">
			      <div class="col-lg-10 col-lg-offset-2">
			        <button class="btn btn-primary <?php echo (isset($appSeminar) ? "save-appSeminar" : "submit-seminarTraining" ); ?>">Submit</button>
			        <button class="btn btn-default btn-refresh">Refresh Page</button>
			      </div>
			    </div>
			   
			  </fieldset>
			</form>
    </div>
  </div>
</div>
