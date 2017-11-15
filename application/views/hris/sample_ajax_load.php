
// HTML code
<style type="text/css">
input[type="text"]
{
    font-size:24px;
}
</style>
<div class="movie-div">
	<form method="post" name="movie-form" id="movie-form" action="">
		<label id="content">Movie Title</label>
		<input type="text" name="movie[contents]" id="contents" style="width:260px;height:40px;"/>
		<p></p>
		<label id="genre">Genre</label>
		<input type="text" name="movie[genre]" id="genre input-genre"  style="width:260px;height:40px;"/>
		<p></p>
		<input type="submit" value="Save movie" name="submit" class="comment_button"/>
	</form>
</div>
<!--<div id="flash"></div>
<div id="display"></div>-->
<div id="ajax-content-container">
 

 <table class="table table-bordered table-condensed table-striped" id="tbl-data-1" border="1">
     <thead style="background-color: #343D46; color: #fff;">
	    <tr>
	      <th>#</th>
	      <th>Title</th>
	      <th>Genre</th>
	      <th>Date Created</th>
	    </tr>
	 </thead>
    <?php //foreach ($node_list as $key=>$value): ?>
    <tbody>
      <tr class="contents-row">
        <!--<td><input type="checkbox" class="radio_check_all par-id-checkbox" id="radio_check_all par-id-checkbox" value="<?php echo $value->ID; ?>" style="width:18px; height:18px;"></td>
        <td><?php //echo $value->contents; ?></td>
        <td><?php //echo $value->Genre; ?></td>
        <td><?php// echo $value->date_created; ?></td>-->
      </tr>
    <?php //endforeach; ?>
    </tbody>
  </table>






</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript" >
$(function() {

get_par_data();

$(".comment_button").click(function(e) {

e.preventDefault();
//alert($("#movie-form").serialize());

var title = $("#contents").val();
//var genre = $("#genre").val();

//var dataString = {'contents': title, 'genre': genre};

if(title=='')
{
alert("Please Enter Some Text");
}
else
{
$("#flash").show();
$("#flash").fadeIn(400).html('<img src="<?php echo base_url(); ?>asset/img/loading14.gif" align="absmiddle">');

$.ajax({
type: "POST",
url: "<?php echo base_url(); ?>main_controller/insert_sample_data",
data: $("#movie-form").serialize(),
dataType: "json",
cache: false,
success: function(data){

document.getElementById("movie-form").reset();
document.getElementById('contents').focus();
//$("#flash").hide();

if(data){

	console.log(data.content[0].contents);
	console.log(data.content[0].Genre);
	console.log(data.content[0].date_created);
	console.log(data.content.length);
                var len = data.content.length;
                var txt = "";
                if(len > 0){
                    for(var i=0;i<len;i++){
                        //if(data.content[i].contents && data.content[i].Genre){
                            txt += "<tr class='contents-row'><td><input type='checkbox' class='radio_check_all par-id-checkbox' id='radio_check_all par-id-checkbox' value="+data.content[i].ID+"></td><td>"+data.content[i].contents+"</td><td>"+data.content[i].Genre+"</td><td>"+data.content[i].date_created+"</td></tr>";
                        //}
                    }
                    if(txt != ""){
                        $("#tbl-data-1").prepend(txt);
                    }
                }
             }   



},
error: function(jqXHR, textStatus, errorThrown){
            alert('error: ' + textStatus + ': ' + errorThrown);
  }
});
} return false;
});
});

function get_par_data(){

	$.post('<?php echo base_url(); ?>main_controller/get_par_data','',function(data){
		
		if(data){

				console.log(data.content.length);
                var len = data.content.length;
                var txt = "";
                if(len > 0){
                    for(var i=0;i<len;i++){
                        //if(data.content[i].contents && data.content[i].Genre){
                            txt += "<tr class='contents-row'><td><input type='checkbox' class='radio_check_all par-id-checkbox' id='radio_check_all par-id-checkbox' value="+data.content[i].ID+"></td><td>"+data.content[i].contents+"</td><td>"+data.content[i].Genre+"</td><td>"+data.content[i].date_created+"</td></tr>";
                        //}
                    }
                    if(txt != ""){
                        $("#tbl-data-1").append(txt);
                    }
                }
             }
	},"json");

}
</script>