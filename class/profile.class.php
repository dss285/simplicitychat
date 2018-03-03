<?php
class profile {
	private $conn, $name, $id, $friends;
	public function __construct($dbh, $tid) {
		 $this->conn = $dbh;
		 $this->id = $tid;
	}
	public function getUserinfo() {
		$sel = $this->conn->prepare("SELECT * FROM users WHERE id=:id LIMIT 1");
		$sel->bindValue(":id",$this->id);
		$sel->execute();
		$result = $sel->fetchAll();
		return $result[0];
	}
	public function updateProfilePic($url) {
		$upd = $this->conn->prepare("UPDATE users SET profilepic=:url WHERE id=:id");
		$upd->bindValue(":url", $url);
		$upd->bindValue(":id", $this->id);
		$upd->execute();
		return true;
	}
	public function updateSettings($newpassword=null, $newemail=null, $newmobile=null, $newbio=null) {
		if($newpassword !== null) {
			$upd_p = $this->conn->prepare("UPDATE users SET password=:password WHERE id=:id");
			$upd_p->bindValue(":password",password_hash($newpassword,PASSWORD_DEFAULT));
			$upd_p->bindValue(":id",$this->id);
			$upd_p->execute();
		}
		if(!$newemail !== null) {
			if(filter_var($newemail,FILTER_VALIDATE_EMAIL) === true) {
				$upd_e = $this->conn->prepare("UPDATE users SET email=:email WHERE id=:id");
				$upd_e->bindValue(":email",$newemail);
				$upd_e->bindValue(":id",$this->id);
				$upd_e->execute();
			}
		}
		if($newmobile !== null) {
				$upd_m = $this->conn->prepare("UPDATE users SET phonenumber=:phon WHERE id=:id");
				$upd_m->bindValue(":phon",$newmobile);
				$upd_m->bindValue(":id",$this->id);
				$upd_m->execute();
		}
		if($newbio !== null) {
			$upd_m = $this->conn->prepare("UPDATE users SET bio=:bio WHERE id=:id");
			$upd_m->bindValue(":bio",$newbio);
			$upd_m->bindValue(":id",$this->id);
			$upd_m->execute();
		}
	}
}
?>