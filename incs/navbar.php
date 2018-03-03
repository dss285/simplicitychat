
<?php
	include_once("class/profile.class.php");
	$profile = new profile($dbh, $_SESSION['user']);
	$profileInfo = $profile->getUserinfo();
?>
<script>
$(document).ready(function(){
    $("#openProfilePic").click(function(){
        $("#profilePicForm").fadeToggle(400);
		});
	$("#openSettings").click(function() {
		$("#settingsForm").fadeToggle(400);
		});
	$("#close").click(function(){
       $("#settingsForm").fadeToggle(400);
	   });
	$("#close1").click(function(){
       $("#profilePicForm").fadeToggle(400);
	   });
});
$(document).ready(function(){

});
</script>
<div class="container-fluid navbarMain">
	<div class="row navbarL" style="height: 100%;">
		<div class="col-xs-12 col-sm-12 col-md-12 logoArea">LOGO HERE
			  <a href="profile.php"><img src="images/app/profile.png" class="img-responsive images"></a>
			  <a href="#settings"><img src="images/app/settings.png" class="img-responsive images" id="openSettings"></a>
			  <a href="chat.php"><img src="images/app/chat.png" class="img-responsive images"></a>
			  <a href="logout.php"><img src="images/app/logout.png" class="img-responsive images"></a>
			</ul>
		</div>
	</div>
</div>

	<div class="container-fluid register-form" id="profilePicForm" style="background-color: rgba(0, 0, 0, 0.7490196078431373); width: 100%; height: 100%; position: fixed; z-index: 6; display: none;top:0;right:0;padding-top:5%;">
		<div class="col-md-3"></div>
		<div class="col-md-6" style="background-color: white; height: 80%;">
			<div id="close1">
				<p style="cursor: pointer;">&times;</p>
			</div>
			<div><p>Update your profile picture</p></div>
			<form action="profile.php" method="POST" enctype="multipart/form-data">
				<div class="form-group">
				<input type="file" name="profilePic"class="form-control">
				</div>
				<input type="submit" class="btn btn-success" value="Submit" name="submit">
			</form>
		</div>
		<div class="col-md-3"></div>
		
	</div>

	<div class="container-fluid register-form" id="settingsForm" style="background-color: rgba(0, 0, 0, 0.7490196078431373); width: 100%; height: 100%; position: fixed; z-index: 6; display: none;top:0;right:0;padding-top:5%;">
		<div class="col-md-3"></div>
		<div class="col-md-6" style="background-color: white; height: 80%;">
			<div id="close">
				<p style="cursor: pointer;">&times;</p>
			</div>
			<div><p><?php echo $profileInfo['username'];?>'s Settings</p></div>
			<form action="profile.php" method="POST">
			<div class="form-group">
				<label for="email">Bio:</label>
				<textarea class="form-control" rows="6" name="bio"><?php echo($profileInfo['bio']==null) ? "Bio tänne":$profileInfo['bio'];?></textarea>
				<label for="email">Email address:</label>
				<input type="email" class="form-control" name="newemail" id="email" value="<?php echo $profileInfo['email']; ?>">
				<label for="email">Phonenumber:</label>
				<input type="text" class="form-control" name="newmobile"id="phone" placeholder="Phonenumber here" value="<?php echo ($profileInfo['phonenumber']!==null) ? $profileInfo['phonenumber']:""?>">
			</div>
				<div class="form-group">
					<label for="email">New password</label>
					<input type="password" class="form-control" name="newpassword" id="password2">
					<label for="email">Verify password:</label>
					<input type="password" class="form-control" name="newpasswordR" id="password2verify">
					<br>
					<br>
					<label for="email">Password</label><br>
					You need to confirm everything by typing your password and then submitting the form.
					<input type="password" class="form-control" id="passowrd1" name="confirm">
				</div>
				<input type="submit" class="btn btn-success" value="Submit">
			</form>
		</div>
		<div class="col-md-3"></div>
		
	</div>