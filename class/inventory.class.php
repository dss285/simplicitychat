<?php
class Inventory {
	private $items, $conn, $iid;
	public function __construct($dbh=null, $id=null) {
		$this->conn = $dbh;
		$this->iid = $id;
	}
	function add($item) {
		$this->items[] = $item;
	}
	function addItems() {
		$sel = $this->conn->prepare("SELECT itemid FROM inventory WHERE userid=:id");
		$sel->bindValue(":id",$this->iid);
		$sel->execute();
		foreach($sel as $row) {
			$sel2 = $this->conn->prepare("SELECT * FROM items WHERE id=:id");
			$sel2->bindValue(":id",$row[0]);
			$sel2->execute();
			foreach($sel2 as $row2) {
				$this->add(array($row2));
			}
			
		}
		return $this->items;
	}
	function checkifHasItem($itemid) {
		$sel = $this->conn->prepare("SELECT COUNT(itemid) FROM inventory WHERE itemid=:id AND userid=:usr ORDER BY itemid DESC");
		$sel->bindValue(":id",$itemid);
		$sel->bindValue(":usr",$this->iid);
		$sel->execute();
		$res = $sel->fetchAll();
		if($res[0][0] < 1) {
			return false;
		} else {
			return true;
		}
	}
	function parseItems($items) {
		foreach($items as $item) {
			foreach($item as $ite) {
				echo '<div class="col-md-2 col-xs-6 col-sm-4 inventory_item" style="background-image:url('.$ite['image'].'); background-size:100%;">';
				echo "<h1>".$ite['title']."</h1>";
				
				echo "<p>".$ite['description']."</p>";
				echo '</div>';
			}
		}
	}
	public function lootbox() {
		$sel = $this->conn->prepare("SELECT id FROM items ORDER BY RAND() LIMIT 1");
		$sel->execute();
		$res = $sel->fetchAll();
		$res = $res[0][0];
		$ins = $this->conn->prepare("INSERT INTO inventory VALUES (:usr, :item)");
		$ins->bindValue(":usr",$this->iid);
		$ins->bindValue(":item",$res);
		$ins->execute();
		$sel2 = $this->conn->prepare("SELECT * FROM items WHERE id=:id");
		$sel2->bindValue(":id",$res);
		$sel2->execute();
		$res2 = $sel2->fetchAll();
		return $res2;
	}
	public function purchase($amount, $itemid) {
		$currency = $this->conn->prepare("SELECT * FROM users WHERE id=:usr");
		$currency->bindValue(":usr",$this->iid);
		$currency->execute();
		$res = $currency->fetchAll();
		$res = $res[0];
		if($res['currency'] >= $amount) {
			$ins = $this->conn->prepare("INSERT INTO inventory VALUES (:usr, :item)");
			$ins->bindValue(':usr',$itemid);
			$ins->bindValue(':item',$itemid);
			$ins->execute();
		}
	}
}
?>