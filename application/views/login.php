<?php
// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";

?>
<div class="col-sm-6 col-md-4 col-md-offset-4">
<?php

// if an email was verified
if($action=='email_verified'){
	echo "<div class='alert alert-success'>";
		echo "<strong>Your email was verified. Thank you!</strong> Please login.";
	echo "</div>";
}

// get 'action' value in url parameter to display corresponding prompt messages
$action=isset($_GET['action']) ? $_GET['action'] : "";

// tell the user he is not yet logged in
if($action =='not_yet_logged_in'){
	echo "<div class=\"alert alert-danger margin-top-40\" role=\"alert\">Please login.</div>";
}

// tell the user to login
else if($action=='please_login'){
	echo "<div class='alert alert-info'>";
		echo "<strong>Please login to access that page.</strong>";
	echo "</div>";
}

// tell the user if access denied
if($access_denied){
	echo "<div class=\"alert alert-danger margin-top-40\" role=\"alert\">";
		echo "Access Denied.<br /><br />";
		echo "Your username or password maybe incorrect";
	echo "</div>";
}
?>

	<!-- actual HTML login form -->
	<div class="account-wall">
		<div id="my-tab-content" class="tab-content">
			<div class="tab-pane active" id="login">
				<img class="profile-img" src="images/login-icon.png">
				<form class="form-signin" action="" method="post">
					<input type="text" name="email" class="form-control" placeholder="Email" required autofocus />
					<input type="password" name="password" class="form-control" placeholder="Password" required />
					<input type="submit" class="btn btn-lg btn-primary btn-block" value="Log In" />
				</form>
			</div>

			<!-- give user other options -->
			<div style='text-align:center;'>
				<a href='<?php echo $home_url; ?>register'>Sign up</a> • <a href='<?php echo $home_url; ?>forgot_password'>Forgot password?</a>
			</div>

		</div>
	</div>
</div>