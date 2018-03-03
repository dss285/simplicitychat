

<div class="row">
<?php
include_once("../config/db.conn.php");
include_once("../class/inventory.class.php");
$inv = new Inventory($dbh, $_SESSION['user']);
$res = $inv->lootbox();

foreach($res as $row) {
				echo '<div class="col-md-12 col-xs-12 col-sm-12 lootbox_item" style="background-image:url('.$row['image'].'); background-size:100%;">';
				echo "<h1>".$row['title']."</h1>";
				
				echo "<p>".$row['description']."</p>";
				echo '</div>';
}
?>
</div>