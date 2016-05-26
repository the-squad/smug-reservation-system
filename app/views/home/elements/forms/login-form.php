<!-- Login card starts -->
<div class="floating-card col-md-6 col-xs-12 col-md-offset-3" id="login-card">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="closePopUpWindow(loginCard);"><span aria-hidden="true">&times;</span></button>
		<h2 class="text-center">LOG INTO YOUR ACCOUNT</h2>

		<div class="input-layout first-input">
			<input type="text" name="email" id="emailText">
			<label>Email</label>
			<label class="error-message" id="email-error-message">
				Enter a valid email address
			</label>
		</div>

		<div class="input-layout">
			<input type="password" name="password" id="passwordText">
			<label>Password</label>
			<label class="error-message" id="password-error-message">
				This password isn't correct
			</label>
		</div>
        <!--onclick="window.location.href='user/home.html'"-->
		<button class="filled action-button" id="loginButton">Confirm</button>
		<a class="col-md-6 col-md-offset-3 text-center col-xs-12" id="forget-password" href="forget-password.php">Forgot my password</a>
</div>
