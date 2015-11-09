<?php
include("includes/check_login.inc");
include("libs/admin.functions.php");
require_once("includes/header.inc");

// handle form submission
if(isset($_POST['cpassword_submit'])){ // form is submitted
	//check if all fields are okay
	if(empty($_POST['c-password']) || empty($_POST['n-password']) || empty($_POST['re-n-password'])){
		$error_msg = "<li>Please fill in all the fields</li>";
	} else { // all fields are okay
		$current_pass = filter_var($_POST['c-password']);
		$new_pass = filter_var($_POST['n-password']);
		$re_new_pass = filter_var($_POST['re-n-password']);
		// check if current password matches
		$q = "SELECT * FROM pulse_pro_admin_users WHERE password = MD5('{$current_pass}')";
		$r = mysql_query($q);
		if(mysql_num_rows($r)>0){ // pass okay
			// check if re-entered pass matches with new one
			if($new_pass!==$re_new_pass){ // doesn't match
				$error_msg = "<li>Re-entered password doesn't match with the new one. Please try again.</li>";
			} else { // all iz well
				$q = "UPDATE pulse_pro_admin_users SET password = MD5('{$new_pass}') WHERE username = 'admin'";
				$r = mysql_query($q);
				if(mysql_affected_rows()==1){
					$success_msg = "<li>Password changed!</li>";
				} else {
					$error_msg = "<li>Failed to change password: ".mysql_error().". Please try again.</li>";
				}
			}
		} else {
			$error_msg = "<li>Current password is incorrect.</li>";
		}
	}
}
?>
<div id='wrapper'>
<div class='login-form'>
<?php if(!empty($error_msg)): ?>
<div class="error">
	<ul><?php echo $error_msg; ?></ul>
</div>
<?php endif; ?>
<?php if(!empty($success_msg)): ?>
<div class="success">
	<ul><?php echo $success_msg; ?></ul>
</div>
<?php endif; ?>
<form action="settings.php" method="post">
	<div class="infoWrapper">
				<div class="infoTitle">Current Password:</div>
				<div class="infoContent">
					<input type="password" id="c-password" value="" maxlength="32" class="text" name="c-password">
				</div>
	</div>
	<div class="infoWrapper">
				<div class="infoTitle"> Enter new password:</div>
				<div class="infoContent">
					<input type="password" id="password" name='n-password' value="" maxlength="32" class="text">
				</div>
	</div>
	<div class="infoWrapper">
				<div class="infoTitle"> Re-enter new password:</div>
				<div class="infoContent">
					<input type="password" id="password" name='re-n-password' value="" maxlength="32" class="text">
				</div>
	</div>
	<div class="infoWrapper">
		<div class="infoTitle">&nbsp;</div>
		<div class="infoContent">
			<input type="hidden" name="cpassword_submit" />
			<input type="submit" value='Change' />
		</div>
	</div>
</form>
</div>
</div>
</body>
</html>
