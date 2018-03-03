<?php
			include_once("../class/chat.class.php");
			include_once("../class/profile.class.php");
			include_once("../config/db.conn.php");
			$chat = new Chat($dbh, $_GET['user']);
			$res = $chat->get_messages($_GET['channel']);
			
			echo json_encode();
?>