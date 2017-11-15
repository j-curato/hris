<?php $this->load->view('parms/view_html_head');?>
<span class="welcome_logged_user label label-primary" style="padding:10px;"><?php echo "Logged in user: ".$this->session->userdata('username'); ?></span>
<hr>
<h2 style="padding:10px;"><?php echo (isset($par_details[0]->ID) ? "Post Activity Report Edit Form" : "Post Activity Report Adding Form"); ?></h2>
<address></address>

<form class="form-horizontal par-form" id="par-form" style="background-color: #e2e2e2;" method="post" enctype="multipart/form-data">
  <fieldset>
    <div class="alert alert-dismissable alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <center><h4><?php echo (isset($par_details) ? "Data successfully updated." : "Data successfully saved."); ?></h4></center>
    </div>
    <address></address>
   <input type="hidden" name="par_id" class="par_id" id="par_id" value="<?php echo (isset($par_details) ? $par_details[0]->ID : ""); ?>">
    <span class="label label-warning"><a href="<?php echo base_url('main_controller/main_menu/'); ?>" style="color:#fff;">Back to Main Menu</a></span>
    <div class="form-group">
      <label for="inputActivity" class="col-lg-2 control-label">Title of Activity</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="par[title_of_activity]" id="inputActivity" placeholder="Activity" value="<?php echo (isset($par_details) ? $par_details[0]->title_of_activity : ""); ?>" style="width:260px;height:40px;">
      </div>
    </div>
    <div class="form-group">
      <label for="inputDate" class="col-lg-2 control-label">Date/Duration</label>
      <div class="col-lg-10">
        <input type="date" class="form-control" name="par[date]" id="inputDate" placeholder="Password" value="<?php echo (isset($par_details) ? date('Y-m-d', strtotime($par_details[0]->date)) : ""); ?>" style="width:260px;height:40px;">
      </div>
    </div>
    <div class="form-group">
      <label for="inputVenue" class="col-lg-2 control-label">Venue</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="par[venue]" id="inputVenue" placeholder="Location" value="<?php echo (isset($par_details) ? $par_details[0]->venue : ""); ?>" style="width:260px;height:40px;">
      </div>
    </div>
    <div class="form-group">
      <label for="inputSponsors" class="col-lg-2 control-label">Sponsors</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" name="par[sponsors]" id="inputSponsors" placeholder="Sponsors" value="<?php echo (isset($par_details) ? $par_details[0]->sponsors : ""); ?>" style="width:260px;height:40px;">
      </div>
    </div>
    <div class="form-group">
      <label for="select" class="col-lg-2 control-label">Category</label>
      <div class="col-lg-10">
       <?php
        $categories = array(
              '0' => 'Select a team',
              '1' => 'Category-1',
              '2' => 'Category-2',
              '3' => 'Category-3',
              '4' => 'Category-4',
              '5' => 'Category-5',
              '6' => 'Category-6',
              '7' => 'Category-7'
              );
          echo form_dropdown("par[category]", $categories,(isset($par_details[0]->ID)) ? $par_details[0]->category : "", 'class="form-control" id="category-id" style=width:260px;height:40px;'); ?>
      </div>
    </div>
    <div class="form-group">
    <label for="userfile" class="col-lg-2 control-label">File</label>
      <div class="col-lg-10">
        <?php if( isset( $par_details )){ ?>
          <input type="file" class="form-control" name="userfile" id="userfile" value="" onChange="Handlechange();" style="display: none;width:260px;height:40px;"/>
          <input type="text" id="filename" class="form-control" readonly="true" value="<?php echo (isset($par_details) ? $par_details[0]->scanned_file : ""); ?>" style="width:260px;height:40px;"/> 
          <a href="#" class="btn btn-warning" id="fakeBrowse" onclick="HandleBrowseClick();">Change</a>
        <?php } else{ ?>
          <input type="file" class="form-control" name="userfile" id="userfile" value="" style="width:260px;height:40px;"/>
        <?php } ?>
      </div>	
    </div>
     <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="submit" class="btn btn-primary submit-par"><?php echo (isset($par_details) ? "Update" : "Submit"); ?></button>
        <button class="btn btn-default">Cancel</button>
      </div>
    </div>
   
  </fieldset>
</form>

<?php $this->load->view("parms/view_footer_script"); ?>