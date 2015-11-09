<?php
include("libs/access.class.php");
?>
<?php
// check if already looged in
$user = new flexibleAccess();
if($user->is_loaded()) {
	echo "You're already logged in. Visit <a href='index.php'>Dashboard</a> or <a href='logout.php'>Log out</a>.";
	die();
}

//login 
if(isset($_POST['login_submit'])) {
	if(empty($_POST['username'])){
		$error_msg .= "<li>Please enter your username</li>";
	}
	elseif(empty($_POST['password'])) {
		$error_msg .= "<li>Please enter your password</li>";
	}
	else { //all fields are submitted correctly
		//sanitise the variables
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		$username = filter_var($username);
		$password = filter_var($password);
		//var_dump($user); die();
		if($user->login($username,$password)) {
			header("location:index.php");
		} else {
			$error_msg = "<li>Username and password combination not found.</li>";
		}
	}
}

?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>PulsePro Admin</title>
<script type='text/javascript' src=''></script>
<script type='text/javascript'>

</script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans|Oswald' rel='stylesheet' type='text/css'/>
<link rel='stylesheet' href='assets/css/pulse.admin.css'></link>
<style type='text/css'>

</style>
</head>
<body>
<div id="header">
	<h1>PulsePro Admin</h1>
	<div class="clear"></div>
</div>
<div id='wrapper'>
<div class='login-form'>
<?php if(!empty($error_msg)): ?>
<div class="error">
	<ul><?php echo $error_msg; ?></ul>
</div>
<?php endif; ?>
<form action="login.php" method="post">
	<div class="infoWrapper">
				<div class="infoTitle">Username:</div>
				<div class="infoContent">
					<input type="text" id="username" value="" maxlength="32" class="text" name="username">
				</div>
	</div>
	<div class="infoWrapper">
				<div class="infoTitle">Password:</div>
				<div class="infoContent">
					<input type="password" id="password" name='password' value="" maxlength="32" class="text">
				</div>
	</div>
	<div class="infoWrapper">
		<div class="infoTitle">&nbsp;</div>
		<div class="infoContent">
			<input type="hidden" name="login_submit" />
			<input type="submit" value='Log in' />
		</div>
	</div>
</form>
</div>
</div>
</body>
</html>
