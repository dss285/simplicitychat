<?php
			include_once("../class/chat.class.php");
			include_once("../class/inventory.class.php");
			include_once("../config/db.conn.php");
			$chat = new Chat($dbh, base64_decode($_POST['user']));
			$chat->assign("\*\*(.*)\*\*", "<b>$1</b>");
			$chat->assign("\[img\](.*)\[\/img\]","<img src='$1' class='img-responsive'>");
			
			$chat->emoji(3, "name", 'type(like jpg or png)'); // image name and type, in /imgs/app/ folder

			if(isset($_POST['message'])) {
			$inventory = new Inventory($dbh,base64_decode($_POST['user']));
			$chat->send_message($_POST['message'],base64_decode($_POST['channel']), $inventory);
			echo json_encode(true);
			}
?>