<!DOCTYPE html>
<html>
<head>
	<title>LOOTBOX</title>
	<?php 
	include_once('incs/meta.php');
	include_once('config/db.conn.php');
	if(!isset($_SESSION['user'])) {
	header("Location: index.php");
	}
	include_once('class/inventory.class.php');
	$inventory = new Inventory($dbh, $_SESSION['user']);
	?>
</head>
<?php if($inventory->checkifHasItem(1)) { ?>
<script type="text/javascript">
    function openBox() {
        document.getElementById("lootBox").src = "boxopen.gif";
        document.getElementById("lootBox").classList.remove('shakedyshakedy');
		$(".card1").delay(6000).load("incs/givelootbox.php").hide().fadeIn();
		$(".card2").delay(6500).load("incs/givelootbox.php").hide().fadeIn();
		$(".card3").delay(7000).load("incs/givelootbox.php").hide().fadeIn();
		$(".holder").load("incs/dellootbox.php");
    }


</script>
<?php
}
?>


<body>
<div class="holder">

</div>
<div class="container-fluid boxGifHolder">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<img src="boxdrop.gif" class="img-responsive boxGif <?=($inventory->checkifHasItem(1)) ? "":""?>" id="lootBox" onclick="openBox(); this.onclick=null;" <?=(!$inventory->checkifHasItem(1)) ? 'style="opacity:0.45"':""?>>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 card1">

		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 card2">

		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 card3">

		</div>
	</div>
</div>

</body>
</html>