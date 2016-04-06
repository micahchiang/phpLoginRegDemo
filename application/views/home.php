<?
?>
<html>
<head>
	<title>Logged In View</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
   <script type = "text/javascript">
   		$(document).ready(function() {
   			$('#updatePassword').click(function(){
   				$.get('/users/updatePassword', function(res){
   					$('#infoBox').html(res);
   				});
   				return false;
   			});

   			$('#getMembers').click(function(){
   				$.get('/users/getMembers', function(res){
   					$('#infoBox').html(res);
   				});
   				return false;
   			})
   		})
   </script>
</head>
<body>
	<div id = 'wrapper'>
	<h4>Hello, <?= $user['username'] ?></h4>

	<a id ='updatePassword' href = "#">Update Password</a>
	<a id = 'getMembers' href = "#">All Members</a>

	<div id = 'infoBox'>
			<form action = '/users/changeUserPassword' method = 'post'>
				<label>New Password:</label><input type = "password" name = "newPassword">
				<label>Confirm New Password:</label><input type = "password" name = "confirmNewPassword">
				<input type = "submit" value = "update">
			</form>
	</div>
	<p><?= $this->session->flashdata('alert') ?></p>
	<p><?= $this->session->flashdata('errors')?></p>
	<p><?= $this->session->flashdata('success')?></p>
	</div>
</body>
</html>