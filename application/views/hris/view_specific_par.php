<!DOCTYPE html>
<html>
<?php $this->load->view('parms/view_html_head'); ?>
<body>
<span class="welcome_logged_user label label-primary" style="padding:10px;"><?php echo "Logged in user: ".$this->session->userdata('username');; ?></span>
<hr>
<div class="well">
<span class="label label-warning"><a href="<?php echo base_url('main_controller/main_menu/'); ?>" style="color:#fff;">Back to Main Menu</a></span>
<address></address>
 <div class="list-group">

  <a href="#" class="list-group-item">
    <h4 class="list-group-item-heading"><strong>Title of Activity:</strong> <?php echo $par_details[0]->title_of_activity; ?></h4>
    <p class="list-group-item-text"></p>
  </a>

  <a href="#" class="list-group-item">
    <h4 class="list-group-item-heading"><strong>Date:</strong> <?php echo $par_details[0]->date; ?></h4>
    <p class="list-group-item-text"></p>
  </a>

  <a href="#" class="list-group-item">
    <h4 class="list-group-item-heading"><strong>Venue:</strong> <?php echo $par_details[0]->venue; ?></h4>
    <p class="list-group-item-text"></p>
  </a>

  <a href="#" class="list-group-item">
    <h4 class="list-group-item-heading"><strong>Sponsors:</strong> <?php echo $par_details[0]->sponsors; ?></h4>
    <p class="list-group-item-text"></p>
  </a>

   <a href="#" class="list-group-item">
    <h4 class="list-group-item-heading"><strong>Sponsors:</strong> <?php echo $par_details[0]->category; ?></h4>
    <p class="list-group-item-text"></p>
  </a>

   <a href="#" class="list-group-item">
    <h4 class="list-group-item-heading"><strong>Filename:</strong> <?php echo $par_details[0]->scanned_file; ?></h4>
    <p class="list-group-item-text"></p>
  </a>

</div>
</div>
</body>
<?php $this->load->view("parms/view_footer_script"); ?>
</html>
