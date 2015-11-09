<?php
include("libs/access.class.php");
$user = new flexibleAccess();
if(!$user->is_loaded()) {
	header("location:login.php");
}
?>