<?php
include("../PulsePro.class.php");
$pulse = new PulsePro();

function top_voted_items(){
	$query = "SELECT item_name, COUNT(item_name) AS ActionCount FROM pulse_pro_votes GROUP BY item_name ORDER BY ActionCount DESC LIMIT 0,5";
	$result = mysql_query($query);
	$dump = array();
	$arr = array();
	while($row = mysql_fetch_assoc($result)){
		$dump['item_name'] = $row['item_name'];
		$dump['vote_count'] = $row['ActionCount'];
		array_push($arr, $dump);
	}
	return $arr;
}

/**
Finds the percent of people who liked an item
**/
function likePercent($item_name) {
	global $pulse;
	$plusVotes = $pulse->countUpVotes($item_name);
	$totalVotes = $pulse->countUpVotes($item_name) + $pulse->countDownVotes($item_name);
	if($totalVotes!==0){
		$pct = ($plusVotes/$totalVotes)*100;
	} else {
		$pct = 0;
	}
	return round($pct,0);
}

/**
Gets an array of banned IPs
**/
function get_banned_ips(){
	$query = "SELECT * FROM pulse_pro_bans";
	$result = mysql_query($query);
	$arr = array();
	while($row = mysql_fetch_assoc($result)){
		array_push($arr, $row);
	}
	return $arr;
}

/**
Gets the number of canceled votes.
i.e. if a user votes and then clicks again to unvote
**/
function cancelledVotes($item_name) {
	$query = "SELECT COUNT(*) AS cancelledVotes FROM pulse_pro_votes WHERE `item_name` = '{$item_name}' AND `vote_value`=0";
	$result = mysql_query($query);
	$row = mysql_fetch_assoc($result);
	return (int) $row['cancelledVotes'];
}

/**
Get up-vote count of an item
**/
function getUpVotes($item_name){
	global $pulse;
	$plusVotes = $pulse->countUpVotes($item_name);
	return $plusVotes;
}

/**
Get down-vote count of an item
**/
function getDownVotes($item_name){
	global $pulse;
	return $pulse->countDownVotes($item_name);
}

/**
Get initial Count of an item
**/
function getCount($item_name) {
	global $pulse;
	return $pulse->getCount($item_name);
}

?>
