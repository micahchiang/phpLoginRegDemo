<?php
?>
<html>
<head>
	<title>login page</title>
	<link rel="stylesheet" type="text/css" href="/assets/loginStyles.css">
</head>
<body>
	<div id = 'wrapper'>
		<h3>Welcome!</h3>
		<div id = 'login' class = "boxes">
			<h4>Been here before? Login below!</h4>
			<form action = "/users/login" method = "post">
				<label>Email:</label><input type = "text" name = "email">
				<label>Password:</label><input type = "password" name = "password">
				<label>Remember Me</label><input type = "checkbox" name = "rememberMe">
				<input type = "submit" value = "login">
			</form>	
			<?= $this->session->flashdata('loginError') ?>
		</div>
		<div id = 'register' class = "boxes">
			<h4>First time here? Register below!</h4>
			<form action = "/users/register" method = "post">
				<label>Username:</label><input type = "text" name = "username">
				<label>Email:</label><input type = "text" name = "email">
				<label>Password:</label><input type = "password" name = "password">
				<p>*Password must be at least 8 characters</p>
				<label>Confirm Password:</label><input type = "password" name = "confirmPassword">
				<label>Remember Me</label><input type = "checkbox" name = "rememberMe">
				<input type = "submit" value = "register">
			</form>
			<?= $this->session->flashdata('errors') ?>
			<?= $this->session->flashdata('stronger') ?>
		</div>
	</div>
</body>
</html>