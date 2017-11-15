<link href="<?php echo base_url() ?>asset/bootstrap/css/bootstrap.css" rel="stylesheet">
<?php if (!isset($ajax_req)): ?>
<button class="show-gallery"> View only Gallery </button>
<button class="show-images"> View only Images </button>
<button class="show-articles"> View only Articles </button>
<?php endif; ?>
 
<div id="ajax-content-container">
  <table class="table table-bordered table-condensed table-striped">
    <tr>
      <th>Title</th>
      <th>Type</th>
    </tr>
    <?php foreach ($node_list as $key=>$value): ?>
      <tr>
        <td><?php print $value->title; ?></td>
        <td width="10%"><?php print ucfirst($value->type); ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>

<script src="<?php echo base_url(); ?>asset/js/jquery-1.11.1.min.js"></script>
 
<script type="text/javascript">

$(document).ready(function () {
  ajax_articles();
  ajax_images();
  ajax_gallery();
});
 
function ajax_articles() {
  $('.show-articles').click(function () {
    $.ajax({
      url: "<?php echo base_url(); ?>ajax_demo/give_more_data",
      type: "POST",
      data: "type=article",
      dataType: "html",
      success: function(data) {
        $('#ajax-content-container').html(data);
      }
    })
  });
   
}
 
function ajax_images() {
  $('.show-images').click(function () {
    $.ajax({
      url: "<?php echo base_url(); ?>ajax_demo/give_more_data",
      type: "POST",
      data: "type=image",
      dataType: "html",
      success: function(data) {
        $('#ajax-content-container').fadeIn().html(data);
      }
    })
  });
}
 
function ajax_gallery() {
  $('.show-gallery').click(function () {
    $.ajax({
      url: "<?php echo base_url(); ?>ajax_demo/give_more_data",
      type: "POST",
      data: "type=gallery",
      dataType: "html",
      success: function(data) {
        $('#ajax-content-container').html(data);
      }
    })
  });
}

</script>