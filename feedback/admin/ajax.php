<?php 
if(!$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'){
	die("No direct access to files is allowed");  
}
include("libs/admin.functions.php");
$dir = $_POST['dir'];
$result['direction'] = $dir;
if($dir=="remove_ban"){ // remove IP ban
	$ip = filter_var($_POST['ip']);
	if(empty($ip)){
		$result['error'] = "parameters_missing";
	} else {
		$q = "DELETE FROM pulse_pro_bans WHERE ip = '{$ip}'";
		$r = mysql_query($q);
		if(mysql_affected_rows()==1){
			$result['msg'] = "ban_removed";
		} else{ // probably not found or some other error
			$result['error'] = "database_error";
		}
	}
} elseif($dir=="create_ban"){ // create IP ban
	$ban_ip = filter_var($_POST['ban_ip']);
	if(empty($ban_ip)){
		$result['error'] = "parameters_missing";
	} else {
		$q = "SELECT * FROM pulse_pro_bans WHERE ip = '{$ban_ip}'";
		$r = mysql_query($q);
		if(mysql_num_rows($r)>0){ //ban already esists
			$result['error'] = 'already_exists';
		} else { // new ban
			$q = "INSERT INTO pulse_pro_bans (ip) VALUES ('{$ban_ip}')";
			$r = mysql_query($q);
			if(mysql_affected_rows()==1){
				$result['msg'] = 'ban_created';
			} else { 
				$result['error'] = 'database_error';
			}
		}
	}
} elseif($dir=='enable' || $dir=='disable'){ // change voting status
	$item_name = filter_var($_POST['item_name']);
	$result['item_name'] = $item_name;
	if(empty($item_name)){
		$result['error'] = "parameters_missing";
	} else {
		if($dir=='enable'){
			$q = "DELETE FROM pulse_pro_closed_items WHERE item_name = '{$item_name}'";
		} elseif($dir=='disable'){
			$q = "INSERT INTO pulse_pro_closed_items (item_name) VALUES ('{$item_name}')";
		}
		$r = mysql_query($q);
		if(mysql_affected_rows()==1){
			$result['msg'] = 'status_changed';
		} else {
			$result['error'] = 'database_error';
		}
	}
} elseif($dir=='search_suggest'){
	$search_text = urldecode(filter_var(trim($_POST['search_text'])));
	$result['search_text'] = $search_text;
	$q = "SELECT * FROM pulse_pro_votes WHERE `item_name` LIKE '{$search_text}%'";
	$r = mysql_query($q);
	if(mysql_num_rows($r)>0) $row = mysql_fetch_assoc($r);
	$result['suggestion'] = $row['item_name'];
} elseif($dir=='ajax_search'){
	$result['search_text'] = $search_text = filter_var($_POST['search_text']);
	$q = "SELECT * FROM pulse_pro_votes WHERE item_name LIKE '{$search_text}%'";
	$r = mysql_query($q);
	if($row = mysql_fetch_assoc($r)){
		$result['search_result']['item_name'] = $row['item_name'];
		$result['search_result']['cancelledVotes'] = cancelledVotes($row['item_name']);
		$result['search_result']['upvotes'] = $pulse->countUpvotes($row['item_name']);
		$result['search_result']['downvotes'] = $pulse->countDownvotes($row['item_name']);
		$result['search_result']['totalvotes'] = $pulse->countDownvotes($row['item_name']) + $pulse->countUpvotes($row['item_name']);
		$result['search_result']['count'] = $pulse->getCount($row['item_name']);
		$result['search_result']['percent'] = likePercent($row['item_name']);
		$result['search_result']['isClosed'] = $pulse->isClosed($row['item_name']) ? true : false;
	} else {
		$result['msg'] = 'no_result';
	}
}

echo json_encode($result);
?>
