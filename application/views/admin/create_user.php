	<?php 
	echo $outPut;
	
	?>
	<!-- HTML form to create the user -->
	<form action='create_user.php' method='post' id='create-user'>

	    <table class='table table-hover table-responsive table-bordered'>

	        <tr>
	            <td class='width-30-percent'>Firstname</td>
	            <td><input type='text' name='firstname' class='form-control' required></td>
	        </tr>

	        <tr>
	            <td>Lastname</td>
	            <td><input type='text' name='lastname' class='form-control' required></td>
	        </tr>

			<tr>
	            <td>Contact Number</td>
	            <td><input type='text' name='contact_number' class='form-control' required></td>
	        </tr>

			<tr>
	            <td>Address</td>
	            <td><textarea name='address' class='form-control' required></textarea></td>
	        </tr>

			<tr>
	            <td>Access Level</td>
	            <td>
					<div class="btn-group" data-toggle="buttons">
						<label class="btn btn-default active">
							<input type="radio" name="access_level" value="Customer" checked> Customer
						</label>

						<label class="btn btn-default">
							<input type="radio" name="access_level" value="admin"> Admin
						</label>

					</div>
				</td>
	        </tr>

			<tr>
	            <td>Email</td>
	            <td><input type='email' name='email' class='form-control' required></td>
	        </tr>

			<tr>
	            <td>Password</td>
	            <td><input type='password' name='password' class='form-control' required id='passwordInput'></td>
	        </tr>

			<tr>
	            <td>Confirm Password</td>
	            <td>
					<input type='password' name='confirm_password' class='form-control' required id='confirmPasswordInput'>
					<p>
						<div class="" id="passwordStrength"></div>
					</p>
				</td>
	        </tr>

	        <tr>
	            <td></td>
	            <td>
					<button type="submit" class="btn btn-primary">
						<span class="glyphicon glyphicon-plus"></span> Create User
					</button>
	            </td>
	        </tr>

	    </table>
	</form>

<?php
echo "</div>";
?>
