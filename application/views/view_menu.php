<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php $this->load->view('view_html_head');?>

<body>

<h1>NBA CRUD TEST</h1>

<div class="menu">
  <a href="<?php echo base_url('sample/add_update_player'); ?>" class="btn btn-default">Add Player</a>
  <a href="<?php echo base_url('sample/add_update_player/'.'update'); ?>" class="btn btn-success">Edit Player</a>
  <a href="#" class="btn btn-info">View Player</a>
  <a href="#" class="btn btn-danger">Delete Player</a>
</div>
<hr>
<div class="main" style="padding:10px;">
  <?php 
    if(isset($add_boolean)){
      $this->load->view("view_add_update");
    } elseif (isset($edit_boolean)) {
      $this->load->view("view_drop_down_players");
    }
  ?>
</div>

<?php $this->load->view("view_footer_script"); ?>

</body>

</html>
