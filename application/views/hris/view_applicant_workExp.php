<!DOCTYPE html>
<html>
<?php $this->load->view('hris/view_html_head'); ?>
<body>

<?php $this->load->view('hris/work_experience_modal'); ?>

<?php $this->load->view('hris/edit_applicant_modal'); ?>

<?php $user_level = $this->session->userdata("user_level"); $admin_text = "Administrator"; ?>

<div class="well">
<span class="welcome_logged_user btn-default" style="padding:10px; letter-spacing:1px;"><i class="glyphicon glyphicon-user"></i> <?php echo "Logged in user: ".$this->session->userdata("username"); ?></span>
<span class="user_fname" style="display:none;"><?php echo $this->session->userdata("fname"); ?></span>
<span class="welcome_logged_user_level btn-default" style="padding:10px; letter-spacing:1px;"><i class="glyphicon glyphicon-eye-open"></i> <?php echo "Access Level: ".$this->session->userdata("user_level"); ?></span>

<a href="<?php echo base_url('main_controller/logout'); ?>" style="text-decoration: underline; font-weight: bold; float: right; font-size: 12px;"><i class="glyphicon glyphicon-remove"></i> Logout</a>
<a href="<?php echo base_url(); ?>/hris/main_controller/main_menu/" class="<?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>" style="width: 110px; text-decoration: underline; font-weight: bold; font-size: 12px; float:right;"><i class="glyphicon glyphicon-chevron-left"></i> Back</a>
</div>
    <div class="well table-holder">
    <?php if( isset( $appProfilePic[0] ) ){ ?>
    	<img style="width:345px; height:230px;>"src="<?php echo base_url("scanned_docs/".$appProfilePic[0]->photo_url); ?>">
    <?php }else{ ?>
    	<p>No Profile Pic</p>
    <?php } ?>
	<span style="font-family: Helvetica; font-size: 30px;"><?php echo ( isset( $appList ) ? $appList[0]->first_name.' '.$appList[0]->last_name : "No record to show" ) ; ?></span>
<hr>
   
	    <!--<a href="<?php echo base_url(); ?>main_controller/parms_form" class="btn btn-primary add-par-btn"><i class="glyphicon glyphicon-plus"></i> Add PAR</a>-->
	    <a href="" class="btn btn-default add-workExp-btn <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-plus"></i> Add Work Experience</a>
	    <a href="<?php //echo base_url('main_controller/edit_par/'.$val->ID); ?>" class="btn btn-default btn-edit-applicant <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-edit"></i> Edit Details</a>
	    <a href="<?php //echo base_url('main_controller/delete_par/'.$val->ID); ?>" class="btn btn-default btn-delete-applicant-work <?php echo (($user_level == $admin_text) ? "" : "disable_link"); ?>"><i class="glyphicon glyphicon-trash"></i> Delete</a>
	   
		
<hr>
    <!--<div id="flash"></div>-->
	 <table class="table-appWork-contents display" id="table-appWork-contents" cellspacing="0" width="100%">
		  <thead style="background-color: #343D46; color: #fff;" id="notify_section">
		      <th>#</th>
		      <th>Company Name</th>
		      <th>Work/Position</th>
		      <th>Start Date</th>
		      <th>End Date</th>
		      <th style="display:none;">Date Created</th>
		      <th style="display:none;">Start Date Hidden</th>
		      <th style="display:none;">End Date Hidden</th>
		      <th style="display:none;">Applicant ID Hidden</th>

		  </thead>
	  <tbody>

	 <?php  if(isset($appWorkExp)){

	  	  	  foreach ($appWorkExp as $key => $val) {  
	  	  	  	
	  	  	  ?>

			    <tr class="tbl-appWork-row">
			    	<td><input type='checkbox' style='width:30px; height:20px;' class='radio_check_all par-id-checkbox' id='applicantWorkID' value="<?php echo $val->id; ?>"></td>	
			    	<td><?php echo $val->company_name; ?></td>	
			    	<td><?php echo $val->work; ?></td>	
			    	<td><?php echo date("F j, Y", strtotime($val->start_date)); ?></td>	
			    	<td><?php if ( !empty( $val->end_date ) ) {
					      echo date("F j, Y", strtotime( $val->end_date ));
						}else{
							echo "Present";
						} ?>
					</td>	
			    	<td style="display:none;"><?php echo $val->created_at; ?></td>	
			    	<td style="display:none;"><?php echo $val->start_date; ?></td>	
			    	<td style="display:none;"><?php echo $val->end_date; ?></td>	
			    	<td style="display:none;"><?php echo $val->id; ?></td>	
			    		
			    </tr>

	    <?php } } ?>

	  </tbody>
     </table> 

	</div>
</body>
<center><footer style="color: #000; font-weight: bold;">Department of Trade and Industry - Caraga Copyright &copy 2015. All Rights Reserved.</footer></center>

<?php 

	$data["theme_name"] = $theme_name;
	$this->load->view("hris/view_footer_script",$data); 

?>

</html>

