<?php
include_once("config/db.conn.php");
include_once("class/inventory.class.php");
$inventory = new Inventory($dbh, $_SESSION['user']);
$items = $inventory->addItems();
?>
<div class="messages">
	<div class="row item_inv">
			<?php
				$inventory->parseItems($items);
			?>
	</div>
</div>