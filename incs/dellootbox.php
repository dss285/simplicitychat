<?php
include_once("../config/db.conn.php");
include_once("../incs/meta.php");
$del = $dbh->prepare("DELETE FROM inventory WHERE userid=:usr AND itemid=1 LIMIT 1");
$del->bindValue(":usr",$_SESSION['user']);
$del->execute();
?>