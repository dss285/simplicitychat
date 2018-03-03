<?php
include_once("../class/chat.class.php");
include_once("../class/profile.class.php");
include_once("../config/db.conn.php");
$channel = $_SESSION['channel'];
$chat = new Chat($dbh, $_SESSION['user']);
$people = $chat->get_participants($channel);

foreach($people as $person) {
	$profile = new Profile($dbh, $person['userid']);
	$info = $profile->getUserInfo();
?>
					<div class="col-xs-6 col-sm-6 col-md-6 item">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12" style="<?php echo ($info['online'] == 1) ? "color:lightgreen;":"color:darkred;"?>"><?php echo $info['username'];?></div>
							<div class="col-xs-12 col-sm-12 col-md-12">
								<img src="<?php echo $info['profilepic'];?>" class="img-responsive chatImage">
							</div>
						</div>
					</div>
<?php
			}
$chat->updateOnline($_SESSION['user']);
$chat->inactiveCheck();
?>