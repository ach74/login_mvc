	<!-- search product function -->
	<div class="col-md-3 pull-left padding-zero">
		<form role="search" action='search_users.php'>
			<div class="input-group">

				<!-- maintain search term in the text box -->
				<input type="text" class="form-control" placeholder="Type user email address..." name="s" id="srch-term" required <?php echo isset($search_term) ? "value='$search_term'" : ""; ?> />
				<div class="input-group-btn">
					<button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				</div>
			</div>
		</form>
	</div>

	<!-- create user form -->
	<a href='create_user.php' class="btn btn-primary pull-right margin-bottom-1em">
		<span class="glyphicon glyphicon-plus"></span> Create User
	</a>

	<?php
// display the table if the number of users retrieved was greater than zero
	if($num>0){

		echo "<table class='table table-hover table-responsive table-bordered'>";

		// table headers
		echo "<tr>";
		echo "<th>Firstname</th>";
		echo "<th>Lastname</th>";
		echo "<th>Email</th>";
		echo "<th>Contact Number</th>";
		echo "<th>Access Level</th>";
		echo "<th>Actions</th>";
		echo "</tr>";

		// loop through the user records
        //while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$row = $stmt->result_array();
		for ($i=0; $i < count($row); $i++) { 

        				// display user details
            echo "<tr>";
				echo "<td>".$row[$i]['firstname']."</td>";
				echo "<td>".$row[$i]['lastname']."</td>";
				echo "<td>".$row[$i]['email']."</td>";
				echo "<td>".$row[$i]['contact_number']."</td>";
				echo "<td>".$row[$i]['access_level']."</td>";

                echo "<td>";
                
					// edit button
					echo "<a href='update_user.php?id=".$row[$i]['id']."' class='btn btn-info' style='margin:0 1em 0 0;'>";
						echo "<span class='glyphicon glyphicon-edit'></span> Edit";
					echo "</a>";

					// change password
					echo "<a href='change_password.php?id=".$row[$i]['id']."' class='btn btn-primary' style='margin:0 1em 0 0;'>";
						echo "<span class='glyphicon glyphicon-edit'></span> Change Password";
					echo "</a>";

					// delete button, user with id # 1 cannot be deleted because it is the first admin
					if($row[$i]['id']!=1){
						echo "<a href='delete_user.php?id=".$row[$i]['id']."' class='btn btn-danger margin-left-1em'>";
							echo "<span class='glyphicon glyphicon-remove'></span> Delete";
						echo "</a>";
					}
                echo "</td>";
            echo "</tr>";
        }


    echo "</table>";
	
	// the number of rows retrieved on that page
	$total_rows=0;

	// user search results
	if(isset($search_term) && $page_url=="search_users.php?s={$search_term}&"){
		$total_rows = $user->countAll_BySearch($search_term);
	}

	// all users
	else if($page_url=="read_users.php?"){
		$total_rows = $this->user->countAll();
	}

	// actual paging buttons
	include_once 'paging.php';
	
}

// tell the user there are no selfies
else{
	echo "<div class=\"alert alert-danger\" role=\"alert\">";
	echo "<strong>No users found.</strong>";
	echo "</div>";
}
?>
