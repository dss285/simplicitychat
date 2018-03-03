<?php
class User {
	public $conn;
	function __construct($dbh) {
		$this->conn = $dbh;
	}
	public function login($user, $passwd) {
		if(empty($user)||empty($passwd)) {
			return false;
		}
		if(!filter_var($user,FILTER_VALIDATE_EMAIL)===false) {
			$sql = "SELECT * FROM users WHERE email=:usr";
		} else {
			$sql = "SELECT * FROM users WHERE username=:usr";
		}
		$sel = $this->conn->prepare($sql);
		$sel->bindValue(":usr",$user);
		$sel->execute();
		foreach($sel as $row) {
				if(password_verify($passwd, $row['password'])) {
					return true;
				}
				else {
					return false;
				}
		}
		echo $sel->rowCount();
	}
	public function register($user,$password,$email) {
		if(empty($user)||empty($password)||empty($email)) {
			return false;
		}
		$sel = $this->conn->prepare("SELECT COUNT(*) FROM username=:username");
		$sel->bindValue(':username', $username);
		$sel->execute();
		if($sel->fetchColumn() < 1) {
			$ins = $this->conn->prepare("INSERT INTO users (username, password, email) VALUES(:usr,:pswd,:email)");
			$ins->bindValue(":usr",$user);
			$ins->bindValue(":pswd",password_hash($password,PASSWORD_DEFAULT));
			$ins->bindValue(":email",$email);
			$ins->execute();
			return true;
		} else {
		return false;	
		}
	}
}
?>