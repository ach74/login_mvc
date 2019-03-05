<div class='col-md-12'>
	<?php
    // read all users from the database
	$stmt = $this->user->readAll($from_record_num, $records_per_page);

	//$num = $stmt->rowCount();
	$num = $stmt->num_rows();
	
	$page_url="read_users.php?";

    // include products table HTML template
	include_once "read_users_template.php";
	?>

</div>