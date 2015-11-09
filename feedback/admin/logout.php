<?php
include("../pulse.config.php");
include("libs/access.class.php");
$user = new flexibleAccess();
$user->logout('login.php');
?>