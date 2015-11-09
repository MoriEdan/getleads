<?php

include("pulse.config.php");

class PulsePro {
	private $style;
	private $votes_table;
	
	function __construct($style=''){
		$this->style = empty($style) ? 'like' : $style;
		$this->votes_table = 'pulse_pro_votes';
		$this->countTable = 'pulse_pro_init_counts';
	}

	/**
	echo PulsePro::css()
	outputs the required css
	@return str
	@scope public
	**/
	public static function css(){
		return "<link rel='stylesheet' href='".PULSE_DIR."/assets/css/pulse.css'>\n";
	}

	/**
	echo PulsePro::javascript()
	outputs the required javascript
	@return str
	@scope public
	**/
	public static function javascript(){
		return "<script type=\"text/javascript\" src='".PULSE_DIR."/assets/js/jquery-2.1.1.min.js'></script>
		<script type=\"text/javascript\" src='".PULSE_DIR."/assets/js/pulse.core.js'></script>";
	}

	/**
	Counts the number of upvotes of a given item
	@param item_name int
	@return int
	@scope public
	**/
	public function countUpVotes($item_name) {
		$query = "SELECT * FROM {$this->votes_table} WHERE `item_name`= '$item_name' AND `vote_value`>0";
		$result = mysql_query($query);
		$votes = 0;
		while($row = mysql_fetch_assoc($result)){
			$votes+=$row['vote_value'];
		}
		return (int) $votes;
	}

	/**
	Counts the number of down votes of a given item
	@param item_name int
	@return POSITIVE int
	@scope public
	**/
	public function countDownVotes($item_name) {
		$query = "SELECT * FROM {$this->votes_table} WHERE `item_name`= '$item_name' AND `vote_value`<0";
		$result = mysql_query($query);
		$votes = 0;
		while($row = mysql_fetch_assoc($result)){
			$votes+=$row['vote_value'];
		}
		return (int) -$votes; // returns a POSITIVE integer
	}
	
	/**
	Votes on an item
	@param	item_name int
		dir int - direction of voting (-1,0,1)
	@return bool
	@scope public
	**/
	public function vote($item_name, $dir){
		$ip = $_SERVER['REMOTE_ADDR'];
		if($this->votedBefore($item_name)){ //has voted before
			$q = "UPDATE {$this->votes_table} SET vote_value = {$dir} WHERE `ip` = '{$ip}' AND `item_name` = '{$item_name}'";
		} elseif(!$this->votedBefore($item_name)){ // hasn't voted before
			$q = "INSERT INTO {$this->votes_table} (`vote_value`, `item_name`, `ip`) VALUES({$dir}, '{$item_name}', '{$ip}')";
		}
		/*echo $q; die();*/
		$r = mysql_query($q);
		if(mysql_affected_rows()==1){
			return true;
		} else {
			return false;
		}
	}
	
	/**
	Creates the buttons for voting of a given item
	@param item_name
	@return str html of the buttons
	**/
	public function buttons($item_name, $initCount=0){
		// deal with counts
		if($initCount!==0){
			if($this->countExists($item_name)){ // initial count is already set
				// update count
				$q = "UPDATE  {$this->countTable} SET  `count` =  {$initCount} WHERE  `item_name` = '{$item_name}'";
			} else { // count is not set
				$q = "INSERT INTO {$this->countTable} (`item_name`, `count`) VALUES ('{$item_name}', {$initCount})";
			}
				$r = mysql_query($q);
				if(mysql_affected_rows()==1){
					// okay
				} else {
					// not okay
				}
			}
		
		// prepare buttons
		$voteCount = $this->voteResult($item_name);
		if($this->upVotedBefore($item_name)){
			$upvoted = 'voted';
		}
		if($this->downVotedBefore($item_name)){
			$downvoted = 'voted';
		}
		if($this->style=='like') {
			$html = <<<EOF
<div class="$this->style">
<div class="result">$voteCount</div>
<input onclick="$(this).vote('$item_name')" type='button' class="p_button up $upvoted" title='click to vote, click again to unvote'/>
</div>
EOF;
		} elseif($this->style=="inline"){
		$html = <<<EOF
<span class="$this->style">
<input onclick="$(this).vote('$item_name')" type='button' class="p_button up $upvoted" title='click to vote, click again to unvote'/>
<input onclick="$(this).vote('$item_name')" type='button' class="p_button down $downvoted" title='click to vote, click again to unvote'/>
<span class="result">$voteCount</span>
</span>
EOF;
	}else{
		$html = <<<EOF
<div class="$this->style">
<input onclick="$(this).vote('$item_name')" type='button' class="p_button up $upvoted" title='click to vote, click again to unvote'/>
<div class="result">$voteCount</div>
<input onclick="$(this).vote('$item_name')" type='button' class="p_button down $downvoted" title='click to vote, click again to unvote'/>
</div>
EOF;
	}
	return $html;
	}

	/**
	Counts resultant votes (i.e. upVotes - downVotes)
	@param item_name
	@return int
	**/
	public function voteResult($item_name){
		$result = (int) $this->countUpVotes($item_name) - $this->countDownVotes($item_name) + $this->getCount($item_name);
		if($result>=1000){
			$result = round($result/1000,1)."K";
		}
		return $result;
	}
	
	/**
	Checks whether a user has already voted
	@return bool; true if voted before, false if not
	@param item_name int
	@scope public
	**/
	public function votedBefore($item_name){
		$ip = $_SERVER['REMOTE_ADDR'];
		$query = "SELECT * FROM {$this->votes_table} WHERE `ip` = '$ip' AND `item_name` = '$item_name'";
		$result = mysql_query($query);
		if(mysql_num_rows($result)>0){ // already voted
			return true;
		} elseif(mysql_num_rows($result)==0){ // haven't voted
			return false;
		}
	}
	
	/**
	Checks whether up-voted before on an item
	@return bool; true if up-voted before, false otherwise
	@param item_name str
	@scope private
	**/
	private function upVotedBefore($item_name) {
		$ip = $_SERVER['REMOTE_ADDR'];
		$query = "SELECT * FROM {$this->votes_table} WHERE `ip` = '$ip' AND `item_name` = '$item_name' AND `vote_value` = 1";
		$result = mysql_query($query);
		if(mysql_num_rows($result)>0){ // already voted
			return true;
		} elseif(mysql_num_rows($result)==0){ // haven't voted
			return false;
		}
	}
	
	/**
	Checks whether down-voted before on an item
	@return bool; true if up-voted before, false otherwise
	@param item_name str
	@scope private
	**/
	private function downVotedBefore($item_name) {
		$ip = $_SERVER['REMOTE_ADDR'];
		$query = "SELECT * FROM {$this->votes_table} WHERE `ip` = '$ip' AND `item_name` = '$item_name' AND `vote_value` = -1";
		$result = mysql_query($query);
		if(mysql_num_rows($result)>0){ // already voted
			return true;
		} elseif(mysql_num_rows($result)==0){ // haven't voted
			return false;
		}
	}
	
	/**
	Checks whether voting on the item is closed or not.
	@return bool; true if closed, false otherwise
	@param item_name str
	@scope public
	**/
	public function isClosed($item_name){
		$item_name = filter_var($item_name);
		$q = "SELECT * FROM pulse_pro_closed_items WHERE `item_name` = '{$item_name}'";
		$r = mysql_query($q);
		if(mysql_num_rows($r)==1){
			return true;
		} else {
			return false;
		}
	}
	
	/**
	Checks whether an IP is banned or not
	@return bool; true if banned, false else
	@param ip
	@scope public
	**/
	public function isBanned($ip){
		$ip = filter_var($ip);
		$q = "SELECT * FROM pulse_pro_bans WHERE `ip` = '{$ip}'";
		$r = mysql_query($q);
		if(mysql_num_rows($r)>0){
			return true;
		} else {
			return false;
		}
	}
	
	/**
	Checks if initial count for an item is already set
	@return bool; true if set, false else
	@param item_name
	**/
	public function countExists($item_name){
		$q = "SELECT * FROM {$this->countTable} WHERE `item_name` = '{$item_name}'";
		$r = mysql_query($q);
		if(mysql_num_rows($r)>0){
			return true;
		} else {
			return false;
		}
	}
	
	/**
	Gets initial count for an item, if set
	**/
	public function getCount($item_name){
		if($this->countExists($item_name)){
			$q = "SELECT * FROM {$this->countTable} WHERE `item_name` = '{$item_name}'";
			$r = mysql_query($q);
			if(mysql_num_rows($r)>0){
				$row = mysql_fetch_assoc($r);
				return $row['count'];
			} else {
				return 0;
			}
		}			
	}
}
?>
