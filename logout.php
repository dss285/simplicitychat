<?php
session_start();

include_once("config/db.conn.php");
$upd = $dbh->prepare("UPDATE users SET online=0 WHERE id=:id");
$upd->bindValue(':id',$_SESSION['user']);
$upd->execute();
session_destroy();
header("Location: index.php");
?>