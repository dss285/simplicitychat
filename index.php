<?php
include_once("config/db.conn.php");
if(isset($_SESSION['user'])) {
	header("Location: profile.php");
}
if(isset($_POST['type'])) {
	
	include_once("class/users.class.php");
	$users = new User($dbh);
	switch($_POST['type']) {
		case "register":
			if(isset($_POST['username'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['passwordR'])) {
				if($_POST['password'] == $_POST['passwordR']) {
					$register = $users->register($_POST['username'],$_POST['password'],$_POST['email']);
					if($register == true) {
						$message = "Success";
					}
				}
			}
			break;
		case "login":
			if(isset($_POST['username'])&&isset($_POST['password'])) {
				$login = $users->login($_POST['username'], $_POST['password']);
				print_r($login);
				if($login == true) {
					if(!filter_var($_POST['username'],FILTER_VALIDATE_EMAIL)===false) {
						$sql = "SELECT * FROM users WHERE email=:username LIMIT 1";
					} else {
						$sql = "SELECT * FROM users WHERE username=:username LIMIT 1";
					}
					$sel = $dbh->prepare($sql);
					$sel->bindValue(":username", $_POST['username']);
					$sel->execute();
					$row = $sel->fetchAll();
					$_SESSION['user'] = $row[0]['id'];
					$upd = $dbh->prepare("UPDATE users SET online=1 WHERE id=:id");
					$upd->bindValue(":id", $row[0]['id']);
					$upd->execute();
					header("Location: profile.php");
					die();
				}
			}
			break;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<?php include_once('incs/meta.php'); ?>
	<link rel="stylesheet" type="text/css" href="loginStyle1.css">
</head>
<body>
<script type="text/javascript">
	$(document).ready(function(){
	    $("#regButton").click(function(){
	        $("#registerform").fadeToggle(400);
	    });
	    $("#close").click(function(){
	        $("#registerform").fadeToggle(400);
	    });
	});


</script>
<div class="container-fluid navbarMain">
	<div class="row">
		<div>
		  <div class="col-xs-12 col-sm-12 col-md-4 "><img src="images/app/logo.png" class="img-responsive"></div>
		  <div class="col-md-5"></div>
		  <div class="col-md-3 login-navBar form-group">
			<form method="POST" action="index.php">
		  	<input type="text" class="form-control" id="usr" name="username" placeholder="Username" style="max-width: 202px;">
		  	<input type="password" class="form-control" id="usr" name="password" placeholder="Password" style="max-width: 202px;">
		  	<input type="submit" value="Login" class="form-control btn btn-success">
			<input type="hidden" name="type" value="login">
			</form>
		  </div>
		  
		</div>
	</div>
</div>
<div class="container">
<div class="row">

</div>
	<div class="row">


		<div class="col-xs-12 col-sm-12 col-md-12 mainSurface">
			<div class="col-md-2"><?php echo (isset($message) ? $message : "");?></div>
			<div class="col-md-12 registerButton" id="regButton">
				<p style="text-align: center; font-size: 500%;">Register</p>
				
				
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-7 c" style="border-right:1px solid #444;">


Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget mollis dolor. Duis molestie lectus et lectus gravida aliquet et sed nisi. Fusce a dapibus magna. Mauris urna lectus, vehicula lacinia interdum in, vulputate pharetra quam. Quisque commodo turpis sapien, nec convallis augue cursus pellentesque. Duis nec hendrerit turpis. Nam at magna consequat, vestibulum felis sit amet, tempus odio. Sed nec gravida dolor. Vivamus a odio in neque laoreet mollis. Fusce sollicitudin mi ac interdum laoreet. Proin laoreet, justo id bibendum venenatis, ligula lectus hendrerit sapien, ac placerat neque leo nec erat. Praesent non nibh feugiat, ornare justo quis, consequat ligula. Vivamus rutrum ex at ipsum aliquet pellentesque. In egestas, sapien id dapibus ultricies, eros risus maximus nisi, eu mattis lacus orci eu dui. Etiam ultrices massa efficitur nulla bibendum tincidunt. 
					</div>
					<div class="col-md-4 c" style="border-left:1px solid #444;margin-left:-1px;">
						<img src="images/app/items/ahegao.jpg" class="img-responsive">
					</div>
<div class="col-md-12">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget mollis dolor. Duis molestie lectus et lectus gravida aliquet et sed nisi. Fusce a dapibus magna. Mauris urna lectus, vehicula lacinia interdum in, vulputate pharetra quam. Quisque commodo turpis sapien, nec convallis augue cursus pellentesque. Duis nec hendrerit turpis. Nam at magna consequat, vestibulum felis sit amet, tempus odio. Sed nec gravida dolor. Vivamus a odio in neque laoreet mollis. Fusce sollicitudin mi ac interdum laoreet. Proin laoreet, justo id bibendum venenatis, ligula lectus hendrerit sapien, ac placerat neque leo nec erat. Praesent non nibh feugiat, ornare justo quis, consequat ligula. Vivamus rutrum ex at ipsum aliquet pellentesque. In egestas, sapien id dapibus ultricies, eros risus maximus nisi, eu mattis lacus orci eu dui. Etiam ultrices massa efficitur nulla bibendum tincidunt. 
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget mollis dolor. Duis molestie lectus et lectus gravida aliquet et sed nisi. Fusce a dapibus magna. Mauris urna lectus, vehicula lacinia interdum in, vulputate pharetra quam. Quisque commodo turpis sapien, nec convallis augue cursus pellentesque. Duis nec hendrerit turpis. Nam at magna consequat, vestibulum felis sit amet, tempus odio. Sed nec gravida dolor. Vivamus a odio in neque laoreet mollis. Fusce sollicitudin mi ac interdum laoreet. Proin laoreet, justo id bibendum venenatis, ligula lectus hendrerit sapien, ac placerat neque leo nec erat. Praesent non nibh feugiat, ornare justo quis, consequat ligula. Vivamus rutrum ex at ipsum aliquet pellentesque. In egestas, sapien id dapibus ultricies, eros risus maximus nisi, eu mattis lacus orci eu dui. Etiam ultrices massa efficitur nulla bibendum tincidunt. 

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget mollis dolor. Duis molestie lectus et lectus gravida aliquet et sed nisi. Fusce a dapibus magna. Mauris urna lectus, vehicula lacinia interdum in, vulputate pharetra quam. Quisque commodo turpis sapien, nec convallis augue cursus pellentesque. Duis nec hendrerit turpis. Nam at magna consequat, vestibulum felis sit amet, tempus odio. Sed nec gravida dolor. Vivamus a odio in neque laoreet mollis. Fusce sollicitudin mi ac interdum laoreet. Proin laoreet, justo id bibendum venenatis, ligula lectus hendrerit sapien, ac placerat neque leo nec erat. Praesent non nibh feugiat, ornare justo quis, consequat ligula. Vivamus rutrum ex at ipsum aliquet pellentesque. In egestas, sapien id dapibus ultricies, eros risus maximus nisi, eu mattis lacus orci eu dui. Etiam ultrices massa efficitur nulla bibendum tincidunt. 
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget mollis dolor. Duis molestie lectus et lectus gravida aliquet et sed nisi. Fusce a dapibus magna. Mauris urna lectus, vehicula lacinia interdum in, vulputate pharetra quam. Quisque commodo turpis sapien, nec convallis augue cursus pellentesque. Duis nec hendrerit turpis. Nam at magna consequat, vestibulum felis sit amet, tempus odio. Sed nec gravida dolor. Vivamus a odio in neque laoreet mollis. Fusce sollicitudin mi ac interdum laoreet. Proin laoreet, justo id bibendum venenatis, ligula lectus hendrerit sapien, ac placerat neque leo nec erat. Praesent non nibh feugiat, ornare justo quis, consequat ligula. Vivamus rutrum ex at ipsum aliquet pellentesque. In egestas, sapien id dapibus ultricies, eros risus maximus nisi, eu mattis lacus orci eu dui. Etiam ultrices massa efficitur nulla bibendum tincidunt. 
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget mollis dolor. Duis molestie lectus et lectus gravida aliquet et sed nisi. Fusce a dapibus magna. Mauris urna lectus, vehicula lacinia interdum in, vulputate pharetra quam. Quisque commodo turpis sapien, nec convallis augue cursus pellentesque. Duis nec hendrerit turpis. Nam at magna consequat, vestibulum felis sit amet, tempus odio. Sed nec gravida dolor. Vivamus a odio in neque laoreet mollis. Fusce sollicitudin mi ac interdum laoreet. Proin laoreet, justo id bibendum venenatis, ligula lectus hendrerit sapien, ac placerat neque leo nec erat. Praesent non nibh feugiat, ornare justo quis, consequat ligula. Vivamus rutrum ex at ipsum aliquet pellentesque. In egestas, sapien id dapibus ultricies, eros risus maximus nisi, eu mattis lacus orci eu dui. Etiam ultrices massa efficitur nulla bibendum tincidunt. 
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget mollis dolor. Duis molestie lectus et lectus gravida aliquet et sed nisi. Fusce a dapibus magna. Mauris urna lectus, vehicula lacinia interdum in, vulputate pharetra quam. Quisque commodo turpis sapien, nec convallis augue cursus pellentesque. Duis nec hendrerit turpis. Nam at magna consequat, vestibulum felis sit amet, tempus odio. Sed nec gravida dolor. Vivamus a odio in neque laoreet mollis. Fusce sollicitudin mi ac interdum laoreet. Proin laoreet, justo id bibendum venenatis, ligula lectus hendrerit sapien, ac placerat neque leo nec erat. Praesent non nibh feugiat, ornare justo quis, consequat ligula. Vivamus rutrum ex at ipsum aliquet pellentesque. In egestas, sapien id dapibus ultricies, eros risus maximus nisi, eu mattis lacus orci eu dui. Etiam ultrices massa efficitur nulla bibendum tincidunt. 
</div>					
				</div>
			</div>
		</div>


	</div>
	
	
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12 footerBar">Websiteproject 2018 by: <br>
				<p>Tommi Puurunen</p>
		<p>Topi-Veikko Tuusa</p>
		</div>

	</div>
</div>


	<div class="container-fluid register-form" id="registerform" style="background-color: rgba(105, 100, 100, 0.7490196078431373); width: 100%; height: 100%; position: fixed;">
		<form method="POST" action="index.php">
		<div class="col-md-12"><h1 style="text-align: center;">Register</h1></div>
		<div class="col-md-3"></div>
		<div class="col-md-6" style="background-color: white; height: 80%;">
			<div id="close">
				<p style="cursor: pointer;">&times;</p>
			</div>

			<div>
			    <div>
			      <span class="input-group-addon">Username</span>
			      <input id="msg" type="text" class="form-control" name="username">
			    </div>

			    <div>
			      <span class="input-group-addon">E-mail</span>
			      <input id="msg" type="text" class="form-control" name="email">
			    </div>

			    <div class="input-group" style="margin-top: 20px;">
			      <span class="input-group-addon">Password</span>
			      <input id="msg" type="Password" class="form-control" name="password">

			      <span class="input-group-addon">Verify Password</span>
			      <input id="msg" type="Password" class="form-control" name="passwordR">
			    </div>
			    <input type="submit" value="Register" class="btn btn-success" style="float: right; margin-top: 20px;">
				<input type="hidden" name="type" value="register">
				</form>
			</div>
		</div>
		<div class="col-md-3"></div>
		
	</div>

</body>
</html>