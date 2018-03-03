<!DOCTYPE html>
<html>
	<?php   
	        include_once("incs/meta.php");
			include_once("class/chat.class.php");
			include_once("class/profile.class.php");
			include_once("class/inventory.class.php");
			include_once("config/db.conn.php");
			include_once("incs/mandatory.php");
			if(!isset($_SESSION['user'])) {
				header("Location: index.php");
			}
			if(isset($_GET['channel'])) {
				$_SESSION['channel'] = $_GET['channel'];
			} else {
				$_SESSION['channel'] = 1;
				
			}
			$channel = $_SESSION['channel'];
			$chat = new Chat($dbh, $_SESSION['user']);
			$people = $chat->get_participants($channel);
			$pass = false;
			foreach($people as $person) {
				if($pass !== true) {
					if($person['userid']==$_SESSION['user']) {
						$pass = true;
						break;
					} else {
						$pass = false;
					}
				}
			}
			$info = $chat->get_channelInfo($channel);
			
			if($pass == false) {
				header("Location: index.php");
			}			
			if(isset($_POST['rid'])) {
				$chat->delete_message($_POST['rid']);
			}
	?>
<body>
<?php
			include_once("incs/navbar.php");
?>
	<div class="container-fluid site" style="padding: 0px;">
<script src="http://malsup.github.com/jquery.form.js"></script> 
<script>
	$(document).ready(function() {
		$(".chatParticipants").load("incs/chatpeople.php");
		
		setInterval(function() {
		$.ajax({
        type: "GET",
        url: "incs/chatbox.php",
        data: { },
        success: function(data){
            $('.chatArea').html(data);
        }
		});
			},1500);
		setInterval(function() {
			$(".chatParticipants").load("incs/chatpeople.php");
			
			},15000);
		$('#form').css('visibility', 'visible');
		$('#myform').submit(function(e) {
			var formData = {
					'message'	: $('textarea[name=message]').val(),
					'channel'	: '<?php echo base64_encode($_SESSION['channel']); ?>',
					'user'		: '<?php echo base64_encode($_SESSION['user']); ?>'
			};
			$.ajax({
				type		: 'POST',
				url			: 'incs/sendmessage.php',
				data		: formData,
				dataType	: 'json',
							encode	: true
			}).done(function(data) {
				console.log(data)
				$('#message').val('')
			});
			e.preventDefault();
		});
		$('#del').ajaxForm(function(response) {
			
		});
});
			</script>
		<div class="row">
			<div class="col-md-10 chatArea">
			
			</div>
			<div class="row">
				<p class="chatName"><?php echo $info['name'];?></p>
				<div class="col-md-2 chatParticipants">
					<img src="images/app/loading.gif" class="img-responsive" style="position:absolute;top:50%;left:100%;">
				</div>
			</div>
		</div>
		
	</div>
					<div class="col-md-12 form-group">
				<form action="chat.php?channel=<?php echo $_SESSION['channel'];?>" method="POST" id="myform" > 
				<textarea class="form-control" name="message" id="message"></textarea>
				<input type="submit" value="Send!" class="form-control btn-success">
				</form>
				</div>
</body>
</html>