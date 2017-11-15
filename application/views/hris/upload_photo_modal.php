<div class="modal fade bs-example-modal-lg upload-photo-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #343D46;">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">&times;</span></button>
			<h2 style="padding:10px; color: #fff; text-align: center;">Applicant Seminar & Training Form</h2>
			<address></address>
			<form class="form-horizontal applicant-seminar-form" id="applicant-seminar-form" style="background-color: #e2e2e2;" method="post" enctype="multipart/form-data">
			  <fieldset>

			    <div class="alert alert-dismissable alert-success alert-add-success">
			      <button type="button" class="close" data-dismiss="alert">×</button>
			      <center><h4>Profile photo saved.</h4></center>
			    </div>
			    
			   <address></address>
	
			    <input type="hidden" name="applicant[applicant_id]" id="appProfileID" value="<?php echo (isset($appSeminar) ? $appSeminar[0]->applicant_id : "" ); ?>">
			
			    <div class="form-group">
				    <label for="userfile" class="col-lg-2 control-label">Select a photo</label>
				    <div class="col-lg-10">	      
				         <input type="file" class="form-control" name="userfile" id="userfile" value="" style="width:260px;height:40px;" required/> 
				    </div>	
			    </div>
			 			   
			     <div class="form-group">
			      <div class="col-lg-10 col-lg-offset-2">
			        <button class="btn btn-primary btn-upload-photo">Submit</button>
			        <button class="btn btn-default">Cancel</button>
			      </div>
			    </div>
			   
			  </fieldset>
			</form>
    </div>
  </div>
</div>
