<?php
if(session_status() == PHP_SESSION_NONE) {
	session_start();
}
include_once("config.main.php");

try {
	$dbh = new PDO("mysql:dbname=chatP;host=localhost", $user, $passwd);
} catch(PDOException $e) {
	echo ($dev_mode == true) ? "Error:".$e.".":"Error Connecting Database";
}
?>