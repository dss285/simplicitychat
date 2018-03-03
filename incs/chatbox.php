			<?php
			include_once("../class/chat.class.php");
			include_once("../class/profile.class.php");
			include_once("../config/db.conn.php");
			$channel = $_SESSION['channel'];
			$chat = new Chat($dbh, $_SESSION['user']);
			$messages = $chat->get_messages($channel);
				foreach($messages as $message) {
					$profile = new Profile($dbh, $message['userid']);
					$info = $profile->getUserInfo();
			?>
			
				<div class="row">
					
					<div class="col-xs-12 col-sm-12 col-md-12 chatMessage">
					<?php 
					if($message['userid']==$_SESSION['user']) {
					?>
					<form action="chat.php?channel=<?=$_SESSION['channel']?>" method="post" id="del">
					<input type="hidden" value="<?php echo $message['id']; ?>" name="rid">
					<input type="submit" value="&times;" class="btn">
					</form>
					<?php
					}
					?>	
						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4"><img src="<?php echo $info['profilepic'];?>" class="img-responsive chatImage"></div>
							<div class="col-xs-8 col-sm-8 col-md-8"><?php echo $message['message'];?></div>
						</div>
					</div>


				</div>
				<?php
						}
				?>