
<?php 
$attributes = array('class'=>'drop_players_class', 'id'=>'drop_players_id');
echo form_open("sample/players_dropdown", $attributes); 
?>

<?php 
//$array_default = array('0'=>'Select Players');
var_dump($team_dropdown);
$position_dropdown = array('0' => 'Select Position');
$players_dropdown = array('0' => 'Select a Name');
?>
<?php echo form_dropdown("team_dropdown", $team_dropdown, '','class=form-control id=team-dropdown style=width:220px; margin-top:30px; onchange=javascript:populate_position_dropdown();'); ?>
<address></address>
<?php echo form_dropdown("position _dropdown", $position_dropdown, '', 'class=form-control id=position-dropdown style=width:220px; margin-top:30px; onchange=javascript:populate_players_dropdown();'); ?>
<address></address>
<?php echo form_dropdown("players_dropdown", $players_dropdown, '', 'class=form-control id=player-dropdown style=width:220px; margin-top:30px; '); ?>


