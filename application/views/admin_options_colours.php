<?php
// views/admin_options_colours.php
?>

<div class="row">

	<?php $this->load->view('admin_options_colours_menu');?>

	<div class="span9">

		<div>
			<?php echo validation_errors(); ?>
		</div>

<?php
foreach($colours_list as $colour) {
?>
		<div id="colour_id_<?php echo $colour->colour_id;?>" class="input-append">
			<input class="input" type="text" name="colour_title_<?php echo $colour->colour_id;?>" id="colour_title_<?php echo $colour->colour_id;?>" value="<?php echo $colour->colour_title;?>">
			<button class="btn colour_update_btn" onclick="javascript:update_colour(<?php echo $colour->colour_id;?>);">update</button>
		</div>
<?php
}

?>

	</div>

</div>

<script>
function update_colour(colour_id) {

	colour_title = $("#colour_title_"+colour_id).val();
	
	// ajax update
	$.ajax({
		
		url: "<?php echo base_url();?>index.php/admin_ajax/ajax/action/update_option_colour/colour_id/"+colour_id+"/colour_title/"+colour_title,
		context: document.body

	}).done(function() {
		
		status_flash('record updated');

	});

}


</script>