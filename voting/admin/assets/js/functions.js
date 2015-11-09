$(function(){
	$(".pollpercent").tipsy({gravity:'west'});
	

	$(".weight").each(function(){
		interval = 1000; // the time (in ms) to animate the results
		lp = $(this).attr("data-lp");
		$(this).css({width:"0%"}).animate({width:lp+"%"}, interval);
	});
	
	$(".action_button.ban").live('click', function(){ // create ban
		$(this).attr("disabled", "disabled");
		$(this).after("<span class='spinner'>&nbsp;</span>");
		$this = $(this);
		$.ajax({
			url: "ajax.php",
			data: "dir=create_ban&ban_ip="+encodeURIComponent($('.text.ip').val()),
			type: "post",
			dataType: "json",
			error: function(){
				alert('Error connecting to database. Please try again');
				$this.next("span.spinner").remove();
				$this.removeAttr("disabled");
			},
			success: function(obj){
				if('error' in obj){
					switch(obj.error){
						case "parameters_missing":
							$this.next("span.spinner").remove();
							$this.after("<span class='error'>Please enter an IP</span>");
							$this.next("span.error").fadeOut(3000);
							$('.text.ip').focus();
							break;
						case "already_exists":
							$this.next("span.spinner").remove();
							$this.after("<span class='error'>IP already banned</span>");
							$this.next("span.error").fadeOut(3000);
							$('.text.ip').attr("value", "");
							break;
						case "database_error":
							alert('Error connecting to database. Please try again');
							$this.next("span.spinner").remove();
							break;
					}
				} else if('msg' in obj && obj.msg == 'ban_created') {
					$this.next("span.spinner").remove();
					// prepare the date of ban timestamp
					// @TODO Find a better method!
					now = new Date();
					months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
					ban_time = months[now.getMonth()]+" "+now.getDate()+", "+now.getFullYear();
					
					el = $("<tr></tr>").html('<td class=\'ip\'>'+$('.text.ip').val()+'</td><td class=\'centered\'>'+ban_time+'</td><td class=\'right action_td\'><a href=\'javascript://\' class=\'action ban remove\'>Remove Ban</a></td>'); // too much code @TODO Find a way around
					el.prependTo('.widget_table.ban-ip');
					$('.text.ip').val("");
				}
				$this.removeAttr("disabled");
			}
		});
	});
	
	$(".action.ban.remove").live('click', function(){ // remove ban
		$this = $(this);
		ip = $(this).parent().siblings("td.ip").text();
		$this.after("<span class='spinner'>Please wait...</span>");
		$this.hide();
		$.ajax({
			url: "ajax.php",
			type: "post",
			dataType: "json",
			data: "dir=remove_ban&ip="+ip,
			error: function(){
				alert("Error connecting to database. Please try again");
				$this.show();
				$this.next("span.spinner").remove();
			},
			success: function(obj){
				if('error' in obj){
					switch(obj.error){
						case "parameters_missing":
							alert("No IP address is sent. Aborting");
							$this.show();
							$this.next("span.spinner").remove();
						case "database_error":
							alert("There's a problem connecting to database. Please try again.");
							$this.show();
							$this.next("span.spinner").remove();
					}
				} else if('msg' in obj && obj.msg == "ban_removed"){

					$this.parent().parent().fadeOut();
				}
			}
		});
	});
	
	$(".action.vote_status").live('click', function(){
		$this = $(this);
		item_name = $this.parent().siblings("td.item_name").children(".item_name_span").text();
		$this.after("<span class='spinner'>Please wait...</span>");
		$this.hide();
		dir = $this.hasClass('enable') ? 'enable' : ($this.hasClass('disable') ? 'disable' : '');
		$.ajax({
			url: "ajax.php",
			type: "post",
			dataType: "json",
			data: "dir="+dir+"&item_name="+item_name,
			error: function(){
				alert("Error connecting to database. Please try again");
				$this.show();
				$this.next("span.spinner").remove();
			},
			success: function(obj){
				if('error' in obj){
					switch(obj.error){
						case "parameters_missing":
							alert("No item name is sent. Aborting");
							$this.show();
							$this.next("span.spinner").remove();
						case "database_error":
							alert("There's a problem connecting to database. Please try again.");
							$this.show();
							$this.next("span.spinner").remove();
					}
				} else if('msg' in obj && obj.msg == 'status_changed'){
					if(dir=='enable'){
						$this.removeClass('enable').addClass('disable');
						$this.html('Disable');
						$this.show();
						$this.next("span.spinner").remove();
					} else if(dir=='disable'){
						$this.removeClass('disable').addClass('enable');
						$this.html('Enable');
						$this.show();
						$this.next("span.spinner").remove();
					}
				}
			}
		});
	});
	
	$("#search").keyup(function(e){
		$this = $(this);
		$searchBtn = $('#SearchBox .action_button');
		search_text = $this.val();
		$('#grayText').val('');
		if(search_text){ // @TODO: don't make ajax calls if right-arrow is pressed
			$.ajax({
				url: "ajax.php",
				type: "post",
				dataType: "json",
				data: "dir=search_suggest&search_text="+encodeURIComponent($this.val()),
				error: function(){
					// pass
				},
				success: function(obj){
					if('suggestion' in obj) {
						if(obj.suggestion!=null){
							$('#grayText').val(obj.suggestion);
							if(e.keyCode === 39){ // right arrow key pressed
								$('#grayText').val('');
								$this.val(obj.suggestion);
							} else if(e.keyCode === 13 || e.keyCode === 27) { // enter pressed
								ajaxSearch(obj.suggestion);
							}
						} else {
							$searchBtn.attr("disabled", "");
							$searchBtn.next('span.spinner').remove();
							$searchBtn.after("<span class='error'>No item found</span>");
							$searchBtn.next("span.error").fadeOut(3000);
						}
					}
				}
			});
		}
	});
	
	$("#SearchBox .action_button").click(function(){
		ajaxSearch($('#search').val());
	});
	
	function ajaxSearch(searchText) {
		if(searchText){
			$('#SearchBox .action_button').attr("disabled", "disabled");
			$('#SearchBox .action_button').after("<span class='spinner'>&nbsp;</span>");
			$.ajax({
				url: "ajax.php",
				type: "post",
				dataType: "json",
				data: "dir=ajax_search&search_text="+searchText,
				error: function(){
					alert("Error connecting to database. Please try again");
					$('#SearchBox .action_button').attr("disabled", "");
					$('#SearchBox .action_button').next('span.spinner').remove();
				},
				success: function(obj){
					$('#SearchBox .action_button').attr("disabled", "");
					$('#SearchBox .action_button').next('span.spinner').remove();
					if('search_result' in obj){
						if(obj.search_result.isClosed===true){
							link = "<a href='javascript://' class='action vote_status enable'>Enable</a>";
						} else {
							link = "<a href='javascript://' class='action vote_status disable'>Disable</a>";
						}
						var count = (obj.search_result.count==null) ? 0 : obj.search_result.count;
						$("table.search_results tbody").html("<tr>\
							<td class='item_name'>\
							<a href='#' title='More info' class='item_info'></a>\
								<span class='item_name_span'>"+obj.search_result.item_name+"</span>\
								<div class='item_dialog'>\
									Total Votes: <span class='count'>"+obj.search_result.totalvotes+"</span><br/>\
									Initial Count: <span class='count'>"+count+"</span><br/>\
									Up Votes: <span class='count'>"+obj.search_result.upvotes+"</span><br/>\
									Down Votes: <span class='count'>"+obj.search_result.downvotes+"</span><br/>\
									Cancelled Votes: <span class='count'>"+obj.search_result.cancelledVotes+"</span><br/>\
								</div>\
							</td>\
							<td class='centered'>"+obj.search_result.cancelledVotes+"</td>\
							<td class='centered'>\
							<div class='pollpercent'>\
								<div class='weight' style='width:"+obj.search_result.percent+"%'></div>\
							</div>\
							</td>\
							<td class='right action_td'>"+link+"</td>\
							</tr>");
					}
				}
			});
		}
	}
	$("a.item_info").live('click', function(){
		var info = $(this).parent().children(".item_dialog").html();
		$.prompt(info);
		return false;
	});
});
