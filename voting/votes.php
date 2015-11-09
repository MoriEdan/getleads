<?php 
/**
Pulse Lite Voting Script
http://s.technabled.com/PulseVote
**/
if(!$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
		die("No direct access to files is allowed");  
	}
include("PulsePro.class.php");
$item_name = filter_var($_POST['item_name']);
$dir = filter_var($_POST['dir']);
if(empty($item_name) || !in_array($dir, array(0,-1,1))) { // parameters are empty
	$result['error'] = 'invalid_params';
} else { // params are okay
	$ip = $_SERVER['REMOTE_ADDR'];
	$pulse = new PulsePro();
	if($pulse->isClosed($item_name)){
		$result['error'] = 'voting_closed';
	} elseif($pulse->isBanned($ip)){
		$result['error'] = 'ip_banned';
	} elseif($pulse->vote($item_name, $dir)){ // voting successful
		$result['success'] = 'voted';
		$result['new_result'] = $pulse->voteResult($item_name);
	} else { // voting fails; db error
		$result['error'] = 'database_error';
		$result['error_text'] = mysql_error();
	}
}
echo json_encode($result);
?>
