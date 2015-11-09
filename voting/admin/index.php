<?php
include("includes/check_login.inc");
include("libs/admin.functions.php");
$top_votes = top_voted_items();
?>
<?php require_once("includes/header.inc");?>
<div id='wrapper'>
<h2>Top 5 Most Voted Items</h2>
<div class="clear"></div>
<table class='widget_table' summary="Top 5 Voted Items">
    <thead>
    	<tr>
		<th scope="col">Item Name</th>
		<th scope="col" class='vote-stat'>Cancelled Votes</th>
		<th scope="col" class='vote-stat'>Percent</th>
		<th scope="col" class='right'>Action</th>
        </tr>
    </thead>
    <tbody>
    	<?php foreach($top_votes as $el): ?>
    	<tr>
        	<td class='item_name'>
        		<a href="#" title="More info" class="item_info"></a>
        		<span class="item_name_span"><?php echo $el['item_name'];?></span>
        		<div class="item_dialog">
        			Total Votes: <span class="count"><?php echo getUpVotes($el['item_name']) + getDownVotes($el['item_name']); ?></span><br/>
        			Initial Count: <span class="count"><?php echo getCount($el['item_name']); ?></span><br/>
        			Up Votes: <span class="count"><?php echo getUpVotes($el['item_name']); ?></span><br/>
        			Down Votes: <span class="count"><?php echo getDownVotes($el['item_name']); ?></span><br/>
        			Cancelled Votes: <span class="count"><?php echo cancelledVotes($el['item_name']); ?></span><br/>
        		</div>
        	</td>
            <td class='centered'><?php echo cancelledVotes($el['item_name']); ?></td>
            <td class='centered'>
			<?php
			//prepare the title of the .weight div
			$title = likePercent($el['item_name'])."% like it";
			?>
			<div class="pollpercent" title="<?php echo $title; ?>">
				<div class='weight' data-lp="<?php echo likePercent($el['item_name']); ?>"></div>
			</div>
		</td>
		<td class='right action_td'>
			<?php if($pulse->isClosed($el['item_name'])): ?>
			<a href='javascript://' class="action vote_status enable">Enable</a>
			<?php else: ?>
			<a href='javascript://' class="action vote_status disable">Disable</a>
			<?php endif; ?>
		</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h2>Ban IP</h2>
	<input type="text" class='text long ip' placeholder="Enter IP address here..." />
	<button class="action_button ban">Create Ban</button>
<table class='widget_table ban-ip' summary="Banned IPs">
    <thead>
    	<tr>
		<th scope="col">IP</th>
		<th scope="col" class='centered'>Banned On</th>
		<th scope="col" class='right'>Action</th>
        </tr>
    </thead>
    <tbody>
<?php 
	$bans = get_banned_ips();
	foreach($bans as $ban):
?>
        <tr>
			<td class='ip'><?php echo $ban['ip']; ?></td>
			<td class='centered'><?php echo date("F j, Y", strtotime($ban['created'])); ?></td>
			<td class='right action_td'>
				<a href='javascript://' class="action ban remove">Remove Ban</a>
			</td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>
<h2>Search items</h2>
	<div id="SearchBox">
		<input type="text" id="grayText" disabled="disabled" autocomplete="off" value="" class='text long'/>
		<input type="text" autocomplete="off" id="search" value="" name="q" class='text long search'/>
		<button class="action_button">Search</button>
	</div>
	<table class='widget_table search_results' summary="Search Results">
    <thead>
    	<tr>
        	<th scope="col">Item Name</th>
            <th scope="col" class='vote-stat'>Cancelled Votes</th>
            <th scope="col" class='vote-stat'>Percent</th>
            <th scope="col" class='right'>Action</th>
        </tr>
    </thead>
    <tbody>
    
    </tbody>
    </table>
</div>
</body>
</html>
