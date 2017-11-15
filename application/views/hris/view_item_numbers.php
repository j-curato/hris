<!DOCTYPE html>
<html>
<?php $this->load->view('hris/view_html_head');?>
<body>

<div class="modal fade bs-example-modal-lg add-position-item-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #343D46;">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">&times;</span></button>
			<h2 style="padding:10px; color: #fff;">Item Number Adding Form</h2>
			<address></address>
			<form class="form-horizontal position-item-form" id="position-item-form" style="background-color: #e2e2e2;" method="post" enctype="multipart/form-data">
			  <fieldset>

			    <div class="alert alert-dismissable alert-success alert-addItem-success">
			      <button type="button" class="close" data-dismiss="alert">×</button>
			      <center><h4>Item Number successfully saved.</h4></center>
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
			        <input type="text" class="form-control" name="item[location]" id="inputLocation" placeholder="Location" value="" style="width:260px;height:40px;" required>
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
    <a href="" class="btn btn-primary active add-item-btn <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-plus"></i> Add Item No.</a>
    <a href="<?php //echo base_url('main_controller/edit_par/'.$val->ID); ?>" class="btn btn-warning btn-edit-category <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-edit"></i> Edit Item Number</a>
    <a href="<?php //echo base_url('main_controller/delete_par/'.$val->ID); ?>" class="btn btn-danger btn-delete-cat <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-trash"></i> Delete Item Number</a>
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
					 <li role="presentation" class="active"><a href="">Total Number of Items <span class="badge" id="badgeCat_total"><?php echo $item_total; ?></span></a></li>
				  </ul>
		</div>
    <hr>
    <!--<div id="flash"></div>-->
	  <table class="table table-striped table-hover table-item-contents" id="table-item-contents">
		  <thead style="background-color: #343D46; color: #fff;" id="notify_section">
		
			 <tr>
			 	<p id="notify_section"></p>

			 </tr>

		
		    <tr>
		      <th><input type="checkbox" class="cat-checkbox" id="radio_check_all" value="" style="width:18px; height:18px;"></th>
		      <th style="display:none;">ID</th>
		      <th>Position Title</th>
		      <th>Item Name</th>
		      <th>Location</th>
		      <th>Status</th>
		      <th style="display:none;">Created at</th>
		    </tr>

		  </thead>
	  <tbody>
	  	
	  <?php  

	  if( isset( $item_list ) ) {

	  	  foreach ($item_list as $key => $val) { ?>

	    <tr class="tbl-cat-row">
	    		<td><input type='checkbox' <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?> style='width:30px; height:20px;' class='item-id-checkbox' id='radio_check_all' value="<?php echo $val->id; ?>"></td>
	    		<td style='display:none;'><?php echo $val->id; ?></td>
	    		<td><?php echo $val->position_title; ?></td>
	    		<td><?php echo $val->item_name; ?></td>
	    		<td><?php echo $val->location; ?></td>
	    		<td><?php echo $val->status; ?></td>
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