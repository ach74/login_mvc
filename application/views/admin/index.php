<div class='col-md-12'>
	<?php
	// get parameter values, and to prevent undefined index notice
	$action = isset($_GET['action']) ? $_GET['action'] : "";

	// tell the user he's already logged in
	if($action=='already_logged_in'){
		?>
		<div class='alert alert-info'>
			<strong>You</strong> are already logged in.
		</div>
		<?php
	}else if($action=='logged_in_as_admin'){
		?>
		<div class='alert alert-info'>
			<strong>You</strong> are logged in as admin.
		</div>
		<?php
	}
	?>
	<div class='alert alert-info'>
		Contents of your admin section will be here.
	</div>
</div>