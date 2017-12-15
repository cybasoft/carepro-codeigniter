<style type="text/css">
	<!--
	.shout_box {
		width: 280px;
		overflow: hidden;
		position: fixed;
		bottom:-20px;
		right: 0;
		z-index: 9;;
	}
	.shout_box .box-body{
		padding:5px !important;
	}
	.shout_box .message_box {
		background: #FFFFFF;
		height: 200px;
		overflow: auto;
		border: 1px solid #CCC;
		width:280px;
	}
	.shout_msg {
		margin-bottom: 10px;
		display: block;
		border-bottom: 1px solid #f2f2f2;
		padding: 0 5px 5px 5px;
		font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
		color: #7C7C7C;
	}
	.message_box{
		background: #005580;
	}
	.message_box:last-child {
		border-bottom: none;
	}
	.shout_box_title{
		font-weight: bold;
		padding:2px 2px 0 3px;
	}
	time {
		font: 11px 'lucida grande', tahoma, verdana, arial, sans-serif;
		font-weight: normal;
		float: right;
		color: #D5D5D5;
	}
	#show-chat, #hide-chat,.close-chat{
		margin-top:-14px;
		font-size: 9px !important;
	}
	.shout_box .box-header{
		height:23px;
	}
	-->
</style>
<div class="shout_box hide no-print">
	<div class="box box-solid box-warning">
		<div class="box-header">
			<div class="pull-left shout_box_title">
				{broadcast}-<?php echo ucwords($this->users->thisUser('username')); ?>
			</div>
			<div class="pull-right box-tools broadcast">
				<button id="show-chat" class="btn btn-success btn-xs"><i class="fa fa-minus"></i></button>
				<button id="hide-chat" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>
				<button class="btn btn-danger btn-xs close-chat" data-widget="remove"><i class="fa fa-times"></i></button>
			</div>
		</div>
		<div class="toggle_chat" id="broadcast">
			<div class="box-body">
				<div class="message_box"></div>
			</div>
			<div class="box-footer">
				<input name="shout_message" id="shout_message"
					   class="form-control" type="text"
					   placeholder="Type Message Hit Enter"
					   maxlength="100" required=""/>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$('.shout_box').removeClass('hide');
		// load messages every 1000 milliseconds from server.
		load_data = {'fetch': 1};
		window.setInterval(function () {
			$.post('<?php echo site_url('broadcast/shout'); ?>', load_data, function (data) {
				$('.message_box').html(data);
				var scrolltoh = $('.message_box')[0].scrollHeight;
				$('.message_box').scrollTop(scrolltoh);
			});
		}, 1000);

		//method to trigger when user hits enter key
		$("#shout_message").keypress(function (evt) {
			if (evt.which == 13) {
				var iusername = $('#shout_username').val();
				var imessage = $('#shout_message').val();
				post_data = {'username': iusername, 'message': imessage};

				//send data to "shout.php" using jQuery $.post()
				$.post('<?php echo site_url('broadcast/shout'); ?>', post_data, function (data) {

					//append data into messagebox with jQuery fade effect!
					$(data).hide().appendTo('.message_box').fadeIn();

					//keep scrolled to bottom of chat!
					var scrolltoh = $('.message_box')[0].scrollHeight;
					$('.message_box').scrollTop(scrolltoh);

					//reset value of message box
					$('#shout_message').val('').removeClass('alert-danger');

				}).fail(function (err) {

					$('#shout_message').addClass('alert-danger');
					//alert HTTP server error
					//alert(err.statusText);
				});
			}
		});

		if ($.cookie('broadcast')=="b22"){
			$('.toggle_chat').show();
			$('#hide-chat').hide();
			$('#show-chat').show();
		}
		else{
			$('.toggle_chat').hide();
			$('#show-chat').hide();
			$('#hide-chat').show();
		}

		$("#hide-chat").click(function () {
			$(".toggle_chat").slideDown('slow');
			$('#hide-chat').hide();
			$('#show-chat').show();
			$.cookie('broadcast', 'b22', { expires: 7 });
		});
		$("#show-chat").click(function () {
			$(".toggle_chat").slideUp('slow');
			$('#show-chat').hide();
			$('#hide-chat').show();
			$.removeCookie('broadcast');
		});
		$(".close-chat").click(function () {
			$(".toggle_chat").hide();
			$.removeCookie('broadcast');
		});
	});
</script>
