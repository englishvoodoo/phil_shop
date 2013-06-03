<?php
// views/admin_footer.php
?>

<div class="row">
	<div class="span12">
		[footer]
	</div>
</div>

</div> <!-- end of container-fluid -->



<script>
$.ajaxSetup ({  
        cache: false  
});  
var ajax_load = "<img src='bootstrap-modal-master/img/ajax-loader.gif' alt='loading...' />";




</script>

<script>
function status_flash(msg) {
	// highlight the update

	$("#status_bar").html(msg);

	$('#status_bar').fadeIn('', function() {
	    // Animation complete
	 	$('#status_bar').fadeOut('slow');
	});
}	
</script>

<?php 
// catch any status updates
$status = $this->session->flashdata('status');

if($status == 'updated') {
?>
<script>
status_flash('record updated');
</script>
<?php
}
?>




</body>
</html>