<?php
include_once("config/db.conn.php");
if(!isset($_SESSION['user'])) {
	header("Location: index.php");
} else {

	include_once("class/profile.class.php");
	$profile = new profile($dbh, $_SESSION['user']);
	$profileInfo = $profile->getUserinfo();
}
if(isset($_POST['confirm'])) {
	
	if(password_verify($_POST['confirm'], $profileInfo['password'])) {
		if(!empty($_POST['newpassword'])) {
			if($_POST['newpassword'] === $_POST['newpasswordR']) {
				$password = $_POST['newpassword'];
			} else {
			$password = null;	
			}
		} else {
			$password = null;	
		}
		$email = (!empty($_POST['newemail'])) ? $_POST['newemail']:null;
		$mobile = (!empty($_POST['newmobile'])) ? $_POST['newmobile']:null;
		$bio = (!empty($_POST['bio'])) ? $_POST['bio']:null;
		$profile->updateSettings($password,$email,$mobile,$bio);
	}
	
}
if(isset($_POST['submit'])) {
	$check = getimagesize($_FILES['profilePic']['tmp_name']);
	if($check !== false) {
		$data = "data:".$_FILES['profilePic']['type'].";base64,".base64_encode(file_get_contents($_FILES['profilePic']['tmp_name']));
		$profilepic = $profile->updateProfilePic($data);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once('incs/meta.php'); ?>
</head>
<body>

	<?php include_once('incs/navbar.php'); ?>

<!-- STUFF IN THIS IS FOR USER IMAGE / EMAIL / BIO STUFF -->
	<div class="container-fluid contentArea">
	<div class="row">
		<div class="col-md-12"><br><p><p class="profileOwnerText"><?php echo $profileInfo['username'];?>'s profile</p></p></div>
	</div>
		<div class="row">
			<div class="col-md-12">
				<?php echo ($profileInfo['profilepic'] == null) ? '<img src="./cmdtvt2.png" class="img-responsive profileAvatar" id="openProfilePic">':'<img src="'.$profileInfo['profilepic'].'" class="img-responsive profileAvatar" id="openProfilePic">'; ?>
			</div>
		</div>
		<div class="row">

			<div class="col-md-12 profileInfo">
				<div class="profileItem"><p>USERNAME: <?php echo $profileInfo['username'];?></p></div>
				<div class="profileItem"><p>PHONE: <?php echo $profileInfo['phonenumber'];?></p></div>
				<div class="profileItem"><p>EMAIL: <?php echo $profileInfo['email'];?></p></div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-12 profileBio">
					<p><?php echo($profileInfo['bio']==null) ? "EMPTY":$profileInfo['bio'];?></p>
			</div>
		</div>
			<div class="row">
				<div class="col-md-12">
					<?php include_once('incs/inventory.php'); ?>
				</div>
		</div>
		</div>

	<?php include_once('incs/footer.php'); ?>
	<?php include_once('incs/activechats.php'); ?>
	

</body>
</html>