$(function(){
	var url = "http://getleads.ch/voting"; // NO trailing slash; Same as PULSE_DIR in pulse.config.php
	$.fn.vote = function(item_name){
		$this = $(this);
		current_vote = $this.siblings('.result').html();
		dir = null; //voting direction
		isCancel = $this.hasClass('voted') ? 1 : 0; // whether cancelling the vote
		if(!isCancel) {
			dir = $this.hasClass('up') ? 1 : ($this.hasClass('down') ? -1 : null); // if not cancelling the vote, determine the direction
			$this.addClass('voted');
			$this.siblings('.p_button').removeClass('voted'); //remove the voted class from the other arrow
		} if(isCancel){
			dir = 0;
			$this.removeClass('voted');
		}
		$this.siblings('.result').html("<span class='loader'>&nbsp;</span>"); //show the loader
		$.ajax({
			type: "POST",
			data: "dir="+dir+"&item_name="+item_name,
			url: url+"/votes.php",
			dataType: 'json',
			error: function(a,b){
				alert('Cannot connect to the database. Please try again later.');
				$this.siblings('.result').html(current_vote);
			},
			success: function(obj){
				if('error' in obj){
					switch(obj.error){
						case 'database_error':
							alert('Cannot connect with the database. Please try again');
							$this.siblings('.result').html(current_vote);
							normalizeStyles()
							break;
						case 'invalid_params':
							alert('Invalid parameters supplied. Cannot vote');
							$this.siblings('.result').html(current_vote);
							normalizeStyles()
							break;
						case 'voting_closed':
							alert('Voting has been closed on this item.');
							$this.siblings('.result').html(current_vote);
							normalizeStyles()
							break;
						case 'ip_banned':
							alert('Sorry, your IP address has been banned from voting.');
							$this.siblings('.result').html(current_vote);
							normalizeStyles()
							break;
					}
				} else if('success' in obj){
					$this.siblings('.result').html(obj.new_result);
				}
			}
		});
	}
	
	function normalizeStyles(){
		if(!isCancel) {
			$this.removeClass('voted');
			/*$this.siblings('.p_button').addClass('voted'); //add the voted class to the other arrow*/
		} if(isCancel){
			dir = 0;
			$this.addClass('voted');
		}
	}
});
