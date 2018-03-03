<?php
class Chat {
	private $conn, $id;
	public $bbc = array();
	public $emojis = array();
	public function __construct($dbh, $tid) {
		$this->conn = $dbh;
		$this->id = $tid;
	}
	public function assign($reg, $to) {
		$this->bbc[$reg] = $to;
	}
	public function emoji($reg, $to, $gif) {
		$this->emojis[$reg] = array($reg, $to, $gif);
	}
	public function parser($msg, $inv=null) {
		$msg = htmlentities($msg);
		foreach($this->bbc as $key => $value) {
			$pattern = '/'.$key.'/s';
			$msg = preg_replace($pattern, $value, $msg);
		}
		foreach($this->emojis as $key) {
			$msg = ($inv->checkifHasItem($key[0])) ? preg_replace("/\:(".$key[1].")\:/s", "<img src='http://137.74.119.216/project/games/chattipalsta/images/app/items/".$key[1].".".$key[2]."' class='emoji'>", $msg) :$msg;
		}

		return $msg;
	}
	public function get_channelInfo($cninfo) {
		$sel = $this->conn->prepare("SELECT * FROM channels WHERE id=:id LIMIT 1");
		$sel->bindValue(":id", $cninfo);
		$sel->execute();
		$res = $sel->fetchAll();
		return $res[0];
	}
	public function get_messages($channelid) {
		$sel = $this->conn->prepare("SELECT * FROM messages WHERE channelid=:channelid ORDER BY id DESC");
		$sel->bindValue(":channelid",$channelid);
		$sel->execute();
		$res = $sel->fetchAll();
		return $res;
	}
	public function get_participants($channelid) {
		$sel = $this->conn->prepare("SELECT * FROM channel_people WHERE channelid = :channelid");
		$sel->bindValue(":channelid",$channelid);
		$sel->execute();
		$res = $sel->fetchAll();
		return $res;
	}
	public function updateOnline($user) {
		$update_time = $this->conn->prepare("UPDATE users SET online_time=:time WHERE id=:id");
		$update_time->bindValue(":time",time());
		$update_time->bindValue(":id",$user);
		$update_time->execute();
	}
	public function inactiveCheck() {
		$sel = $this->conn->prepare("SELECT id, online_time, online FROM users");
		$sel->execute();
		foreach($sel as $row) {
				if(time()-(int)$row['online_time'] >= 900) {
					$update = $this->conn->prepare("UPDATE users SET online=0 WHERE id=:id");
					$update->bindValue(":id",$row['id']);
					$update->execute();
				} else {
					$update = $this->conn->prepare("UPDATE users SET online=1 WHERE id=:id");
					$update->bindValue(":id",$row['id']);
					$update->execute();
				}
		}
	}
	public function send_message($message, $channel, $inv) {
		$message = $this->parser($message, $inv);
		$send = $this->conn->prepare("INSERT INTO messages (message,userid,channelid) VALUES(:message,:userid,:channelid)");
		$send->bindValue(":message",$message);
		$send->bindValue(":userid",$this->id);
		$send->bindValue(":channelid",$channel);
		$send->execute();
	}
	public function delete_message($message) {
		$del = $this->conn->prepare("DELETE FROM messages WHERE id=:id AND userid=:usr");
		$del->bindValue(":id", $message);
		$del->bindValue(":usr", $this->id);
		$del->execute();
	}
}
?>