<!DOCTYPE html>
<html>
<?php $this->load->view('hris/view_html_head');?>
<body style="background-color: #242628;">
	<div class="" style="background-color: #202020;">
	<?php if(!isset($boolean_login_form)){ ?>
		<h2 style="background-color: #202020; color:#fff; padding:20px;">DTI - Caraga Information System Hub<img src="<?php echo base_url('asset/img/dti-logo_1.jpg'); ?>" style="position:absolute;left:95%;top:3.5%;"></h2>
	<?php } else{ ?>
		<h2 style="background-color: #202020; color:#fff; padding:20px;">DTI - Caraga Human Resource Information System 1.0<img src="<?php echo base_url('asset/img/dti-logo_1.jpg'); ?>" 
		style="position:absolute;left:95%;top:3.5%;"></h2>
	<?php } ?>
	</div>
	<?php if(!isset($boolean_login_form)){ ?>


	<div class="container" style="padding: 100px;"> 

		<div class="sys_6" style="border-radius: 10px; padding: 5px 5px 3px 3px; width: 300px; height: auto; background-color: #f0f0f0; display: inline-block; white-space: nowrap; border: 1px solid #B8B8B8;">
			<center><a href="<?php echo base_url("main_controller/parms_login"); ?>" title="Post Activity Report Management System"><p style="color: #000;">Post Activity Report Management System</p><p>(PARMS 2.0)</p></a></center>
		</div>

		<div class="sys_6" style="border-radius: 10px; padding: 5px 5px 3px 3px; width: 300px; height: auto; background-color: #f0f0f0; display: inline-block; white-space: nowrap; border: 1px solid #B8B8B8;">
			<center><a href="<?php echo base_url("main_controller/parms_login"); ?>" title="Human Resource Information System"><p style="color: #000;">Human Resource Infomation System</p><p>(HRIS 1.0)</p></a></center>
		</div>

		<div class="sys_6" style="border-radius: 10px; padding: 5px 5px 3px 3px; width: 300px; height: auto; background-color: #f0f0f0; display: inline-block; white-space: nowrap; border: 1px solid #B8B8B8;">
			<center><a href="<?php echo base_url("main_controller/parms_login"); ?>" title="Post Activity Report Management System"><p style="color: #000;">System 3 Management System</p></a></center>
		</div>
		<p></p>
		<div class="sys_6" style="border-radius: 10px; padding: 5px 5px 3px 3px; width: 300px; height: auto; background-color: #f0f0f0; display: inline-block; white-space: nowrap; border: 1px solid #B8B8B8;">
			<center><a href="<?php echo base_url("main_controller/parms_login"); ?>" title="Post Activity Report Management System"><p style="color: #000;">System 4 Management System</p></a></center>
		</div>

		<div class="sys_6" style="border-radius: 10px; padding: 5px 5px 3px 3px; width: 300px; height: auto; background-color: #f0f0f0; display: inline-block; white-space: nowrap; border: 1px solid #B8B8B8;">
			<center><a href="<?php echo base_url("main_controller/parms_login"); ?>" title="Post Activity Report Management System"><p style="color: #000;">System 5 Management System</p></a></center>
		</div>

		<div class="sys_6" style="border-radius: 10px; padding: 5px 5px 3px 3px; width: 300px; height: auto; background-color: #f0f0f0; display: inline-block; white-space: nowrap; border: 1px solid #B8B8B8;">
			<center><a href="<?php echo base_url("main_controller/parms_login"); ?>" title="Post Activity Report Management System"><p style="color: #000;">System 6 Management System</p></a></center>
		</div>
		<p></p>
		<div class="sys_6" style="border-radius: 10px; padding: 5px 5px 3px 3px; width: 300px; height: auto; background-color: #f0f0f0; display: inline-block; white-space: nowrap; border: 1px solid #B8B8B8;">
			<center><a href="<?php echo base_url("main_controller/parms_login"); ?>" title="Post Activity Report Management System"><p style="color: #000;">System 7 Management System</p></a></center>
		</div>

		<div class="sys_6" style="border-radius: 10px; padding: 5px 5px 3px 3px; width: 300px; height: auto; background-color: #f0f0f0; display: inline-block; white-space: nowrap; border: 1px solid #B8B8B8;">
			<center><a href="<?php echo base_url("main_controller/parms_login"); ?>" title="Post Activity Report Management System"><p style="color: #000;">System 8 Management System</p></a></center>
		</div>

		<div class="sys_6" style="border-radius: 10px; padding: 5px 5px 3px 3px; width: 300px; height: auto; background-color: #f0f0f0; display: inline-block; white-space: nowrap; border: 1px solid #B8B8B8;">
			<center><a href="<?php echo base_url("main_controller/parms_login"); ?>" title="Post Activity Report Management System"><p style="color: #000;">System 9 Management System</p></a></center>
		</div>

	</div>



		<?php } else{ 
			$this->load->view("hris/view_hris_login_form");
		} ?>

</body>
<center><footer style="color: #fff;">Department of Trade and Industry - Caraga Copyright &copy 2015. All Rights Reserved.</footer></center>

<?php 

$this->load->view("hris/view_footer_script"); ?>

</html>
