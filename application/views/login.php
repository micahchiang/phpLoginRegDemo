<?php
?>
<html>
<head>
	<title>login page</title>
</head>
<body>
	<div id = 'wrapper'>
		<h3>Welcome!</h3>
		<div id = 'login'>
			<h4>Been here before? Login below!</h4>
			<form action = "/users/login" method = "post">
				<label>Email:</label><input type = "text" name = "email">
				<label>Password:</label><input type = "password" name = "password">
				<input type = "submit" value = "login">
			</form>	
		</div>
		<div id = 'register'>
			<h4>First time here? Register below!</h4>
			<form action = "/users/register" method = "post">
				<label>Username:</label><input type = "text" name = "username">
				<label>Email:</label><input type = "text" name = "email">
				<label>Password:</label><input type = "password" name = "password">
				<p>*Password must be at least 8 characters</p>
				<label>Confirm Password:</label><input type = "password" name = "confirmPassword">
				<input type = "submit" value = "register">
			</form>
			<?= $this->session->flashdata('errors') ?>
		</div>
	</div>
</body>
</html>