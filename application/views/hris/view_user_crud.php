<!DOCTYPE html>
<html>
<?php $this->load->view('hris/view_html_head');?>
<body>

<!-- Modal User Adding Form -->

<div class="modal fade bs-example-modal-lg add-user-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #343D46;">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">&times;</span></button>
			<h2 style="padding:10px; color: #fff;">User Adding Form</h2>
			<address></address>
			<form class="form-horizontal user-form" id="user-form" style="background-color: #e2e2e2;" method="post" enctype="multipart/form-data">
			  <fieldset>

			    <div class="alert alert-dismissable alert-success alert-addUser-success">
			      <button type="button" class="close" data-dismiss="alert">×</button>
			      <center><h4>User successfully saved.</h4></center>
			    </div>
			    
			    <address></address>
			   <!--<input type="text" name="cat_id" class="cat_id" id="cat_id" value="<?php //echo (isset($par_details) ? $par_details[0]->ID : ""); ?>">-->
	

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">First Name</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayUser[fname]" id="inputFirstname" placeholder="First Name" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Last Name</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayUser[lname]" id="inputLastname" placeholder="Last Name" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Position</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayUser[position]" id="inputPosition" placeholder="Position" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Access Level</label>
			      <div class="col-lg-10">
			        <!--<input type="text" class="form-control" name="arrayUser[privilege]" id="inputAccessLevel" placeholder="Access Level" value="" style="width:260px;height:40px;" required>-->
			         <?php 
			         	$user_access = array( "0" => "Select User Access Level", "1" => "Administrator", "2" => "Observer" );
			         	echo form_dropdown("arrayUser[privilege]", $user_access, "", 'class="form-control" id="inputAccessLevel" style=width:260px;height:40px; required'); 
			         ?>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Username</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayUser[username]" id="inputUsername" placeholder="Username" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			     <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Password</label>
			      <div class="col-lg-10">
			        <input type="password" class="form-control" name="arrayUser[password]" id="inputPassword" placeholder="" value="" style="width:260px;height:40px;font-size: 1.5em;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Confirm Password</label>
			      <div class="col-lg-10">
			        <input type="password" class="form-control" name="cpassword[cpassword]" id="inputCpassword" placeholder="" value="" style="width:260px;height:40px;font-size: 1.5em;" required>
			      </div>
			    </div>

			    <input type="hidden" class="form-control" name="arrayUser[status]" id="inputStatus" placeholder="" value="0">

			    
			     <div class="form-group">
			      <div class="col-lg-10 col-lg-offset-2">
			        <button class="btn btn-primary submit-user">Submit</button>
			        <button class="btn btn-default">Cancel</button>
			      </div>
			    </div>
			   
			  </fieldset>
			</form>
    </div>
  </div>
</div>



<!-- End Modal User Adding modal form -->


<!-- Start modal User Edit Form -->

<div class="modal fade bs-example-modal-lg edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="background-color: #343D46;">
     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #fff;">&times;</span></button>
			<h2 style="padding:10px; color: #fff;">User Edit Form</h2>
			<address></address>
			<form class="form-horizontal user-form-edit" id="user-form-edit" style="background-color: #e2e2e2;" method="post" enctype="multipart/form-data">
			  <fieldset>

			    <div class="alert alert-dismissable alert-success alert-edit-success">
			      <button type="button" class="close" data-dismiss="alert">×</button>
			      <center><h4>User successfully updated.</h4></center>
			    </div>
			    
			   <address></address>
			   <input type="hidden" name="arrayUser[ID]" class="user_id-edit" id="user_id-edit" value="" />
	
			     <div class="form-group">
			      <label for="inputFname" class="col-lg-2 control-label">First Name</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayUser[fname]" id="inputFirstname-edit" placeholder="First Name" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Last Name</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayUser[lname]" id="inputLastname-edit" placeholder="Last Name" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>
	   
			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Username</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayUser[username]" id="inputUsername-edit" placeholder="Username" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Position</label>
			      <div class="col-lg-10">
			        <input type="text" class="form-control" name="arrayUser[position]" id="inputPosition-edit" placeholder="Position" value="" style="width:260px;height:40px;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Access Level</label>
			      <div class="col-lg-10">
			        <!--<input type="text" class="form-control" name="arrayUser[privilege]" id="inputAccessLevel" placeholder="Access Level" value="" style="width:260px;height:40px;" required>-->
			         <?php 
			         	$user_access = array( "0" => "Select User Access Level", "1" => "Administrator", "2" => "Observer" );
			         	echo form_dropdown("arrayUser[privilege]", $user_access, "", 'class="form-control" id="inputAccessLevel-edit" style=width:260px;height:40px; required'); 
			         ?>
			      </div>
			    </div>


			     <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label">Password</label>
			      <div class="col-lg-10">
			    	<a href="<?php //echo base_url('main_controller/delete_par/'.$val->ID); ?>" class="btn btn-danger btn-change-pswrd"><i class="glyphicon glyphicon-lock"></i> Change Password</a>
			      </div>
			    </div>

			     <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label password-label">Current Password</label>
			      <div class="col-lg-10">
			        <input type="password" class="form-control password-form" name="arrayOldpassword[oldpassword]" id="CurrentPassword" placeholder="" value="" onchange="javascript:check_current_password();" style="width:260px;height:40px;font-size: 1.5em;" required>
			      </div>
			    </div>

			    <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label password-label">New Password</label>
			      <div class="col-lg-10">
			        <input type="password" class="form-control password-form" name="arrayNpassword[npassword]" id="NewPassword" placeholder="" value="" style="width:260px;height:40px;font-size: 1.5em;" required>
			      </div>
			    </div>

			     <div class="form-group">
			      <label for="inputActivity" class="col-lg-2 control-label password-label">Confirm Password</label>
			      <div class="col-lg-10">
			        <input type="password" class="form-control password-form" name="arrayCpassword[cpassword]" id="ConfirmPassword" placeholder="" value="" style="width:260px;height:40px;font-size: 1.5em;" required>
			      </div>
			    </div>

			  
			     <div class="form-group">
			      <div class="col-lg-10 col-lg-offset-2">
			        <button type="submit" class="btn btn-primary update-user">Update</button>
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
<span class="welcome_logged_user btn-default" style="padding:10px; letter-spacing:1px;"><i class="glyphicon glyphicon-user"></i> <?php echo "Logged in user: ".$this->session->userdata("username"); ?></span>
<span class="welcome_logged_user btn-default" style="padding:10px; letter-spacing:1px;"><i class="glyphicon glyphicon-eye-open"></i> <?php echo "Access Level: ".$this->session->userdata("user_level"); ?></span>

<a href="<?php echo base_url('main_controller/logout'); ?>" style="text-decoration: underline; font-weight: bold; float: right; font-size: 12px;"><i class="glyphicon glyphicon-remove"></i> Logout</a>
<a href="<?php echo base_url('main_controller/main_menu'); ?>" class="<?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>" style="width: 110px; text-decoration: underline; font-weight: bold; font-size: 12px; float:right;"><i class="glyphicon glyphicon-plus"></i> Add PAR</a>
<a href="<?php echo base_url('main_controller/add_category'); ?>" class="<?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>" style="width: 110px; text-decoration: underline; font-weight: bold; font-size: 12px; float:right;"><i class="glyphicon glyphicon-plus"></i> Add Category</a>
</div>

    <div class="well table-holder">
    <!--<a href="<?php echo base_url(); ?>main_controller/parms_form" class="btn btn-primary add-par-btn"><i class="glyphicon glyphicon-plus"></i> Add PAR</a>-->
    <a href="" class="btn btn-primary add-user-btn <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-plus"></i> Add User</a>
    <a href="<?php //echo base_url('main_controller/edit_par/'.$val->ID); ?>" class="btn btn-warning btn-edit-user <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-edit"></i> Edit User</a>
    <a href="<?php //echo base_url('main_controller/delete_par/'.$val->ID); ?>" class="btn btn-danger btn-delete-user <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-trash"></i> Delete User</a>
   <hr> 
		<div class="row">
		  <div class="col-lg-6">
		    <div class="input-group">
		     <input type="text" class="form-control search-form-user" id="auto_search_user_form" placeholder="Search by First Name" style="width:260px;height:40px;">
		     <span class="input-group-btn">
		        <button class="btn btn-default btn-search-user" type="button" style="position: absolute; margin-top: -20px; height: 40px;"><i class="glyphicon glyphicon-search"></i></button>
		     </span>
		    </div><!-- /input-group -->
		  </div><!-- /.col-lg-6 -->
		</div>
    <hr>
    <!--<div id="flash"></div>-->
	  <table class="table table-striped table-hover table-user-contents" id="table-user-contents">
		  <thead style="background-color: #343D46; color: #fff;" id="notify_section">
		
		 <tr>
		 	<p id="notify_section"></p>

		 </tr>

		  <tr>
			  <ul class="nav nav-pills" role="tablist" style="float:right;">
				 <li role="presentation" class="active"><a href="">Total Number of User <span class="badge" id="badgeUser_total"><?php echo $user_total; ?></span></a></li>
			  </ul>
		  </tr>
		    <tr>
		      <th><input type="checkbox" class="radio_check_all user-checkbox" id="radio_check_all user-checkbox" value="" style="width:18px; height:18px;"></th>
		      <th>First Name</th>
		      <th>Last Name</th>
		      <th>User Name</th>
		      <th>Position</th>
		      <th>Status</th>
		      <th>Access Level</th>
		    </tr>
		  </thead>
	  <tbody>
	  	
	  <?php  

	  if( isset( $user_list ) ) {

	  	  foreach ($user_list as $key => $val) { ?>

	    <tr class="tbl-user-row">
	    		<td><input type='checkbox' style='width:30px; height:20px;' class='radio_check_all user-id-checkbox' id='radio_check_all user-id-checkbox' value="<?php echo $val->ID; ?>"></td>	
	    		<td style="display:none;"><?php echo $val->ID; ?></td>
	    		<td><?php echo $val->fname; ?></td>
	    		<td><?php echo $val->lname; ?></td>
	    		<td><?php echo $val->username; ?></td>
	    		<td><?php echo $val->position; ?></td>
	    		<td><?php echo $val->status; ?></td>
	    		<td><?php echo $val->privilege; ?></td>
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
<center><footer style="color: #000;">Department of Trade and Industry - Caraga Copyright &copy 2015. All Rights Reserved.</footer></center>
<?php 

$data["theme_name"] = $this->session->userdata("theme_name");
$this->load->view("hris/view_footer_script", $data); ?>
</html>