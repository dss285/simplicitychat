<script>
$(document).ready(function(){
    $("#openSettings").click(function(){
        $("#settingsForm").toggle();
    });
});

$(document).ready(function(){
    $("#close").click(function(){
        $("#settingsForm").toggle();
    });
});
</script>

	<div class="container-fluid register-form" id="settingsForm" style="background-color: rgba(105, 100, 100, 0.7490196078431373); width: 100%; height: 100%; position: fixed; z-index: 5; display: none;">
		<div class="col-md-3"></div>
		<div class="col-md-6" style="background-color: white; height: 80%;">
			<div id="close">
				<p style="cursor: pointer;">CLOSE</p>
			</div>
			<div><p>CMDTVT's Settings</p></div>
			<div class="form-group">
			  <label for="email">Bio:</label>
			  <textarea class="form-control" rows="6"></textarea>

			  <label for="email">Email address:</label>
			  <input type="email" class="form-control" id="email">

			  <label for="email">Phonenumber:</label>
			  <input type="text" class="form-control" id="phone">
			</div>

			<div class="form-group">
			  <label for="email">Password</label>
			  <input type="password" class="form-control" id="passowrd1">
			  <label for="email">New password</label>
			  <input type="password" class="form-control" id="password2">
			  <label for="email">Verify password:</label>
			  <input type="password" class="form-control" id="password2verify">
			</div>

			<button class="btn btn-success">Submit</button>

		</div>
		<div class="col-md-3"></div>
		
	</div>