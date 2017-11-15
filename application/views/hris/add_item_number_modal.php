<div class="modal fade bs-example-modal-lg add-position-item-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #343D46;">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">&times;</span></button>
			<h2 style="padding:10px; color: #fff;">Item Number Adding Form</h2>
			<address></address>
			<form class="form-horizontal position-item-form" id="position-item-form" style="background-color: #e2e2e2;" method="post" enctype="multipart/form-data">
			  <fieldset>

			    <div class="alert alert-dismissable alert-success alert-add-success">
			      <button type="button" class="close" data-dismiss="alert">×</button>
			      <center><h4>Category successfully saved.</h4></center>
			    </div>
			    
			    <address></address>
			   <!--<input type="text" name="cat_id" class="cat_id" id="cat_id" value="<?php //echo (isset($par_details) ? $par_details[0]->ID : ""); ?>">-->
	
			    <div class="form-group">
			      <label for="inputSponsors" class="col-lg-2 control-label">Position Title</label>
			      <div class="col-lg-10">
			          <select class="form-control" style="width:200px;height:40px;" name="item[position_id]" id="inputPositionID">
				          <option value="0">Select a Position</option>
				        <?php for($i = 0; $i < sizeof( $position_list ); $i++){ ?>
				           <option value="<?php echo $position_list[$i]->ID ?>"><?php echo $position_list[$i]->position_title; ?></option>
				        <?php } ?>
				      </select>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Item Name</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="item[item_name]" id="inputPositionDescription" placeholder="E.g. Trade and Industry Specialist" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Location</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="item[location]" id="inputSalaryGrade" placeholder="Salary Grade" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>
		   
			     <div class="form-group">
			      <div class="col-lg-10 col-lg-offset-2">
			        <button class="btn btn-primary submit-item-number">Submit</button>
			        <button class="btn btn-default">Cancel</button>
			      </div>
			    </div>
			   
			  </fieldset>
			</form>
    </div>
  </div>
</div>