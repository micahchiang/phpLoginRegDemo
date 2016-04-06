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

	<a id = 'getMembers' href = "#">All Members</a>
	<a id ='updatePassword' href = "#">Update Password</a>

	<div id = 'infoBox'>
		<table>
			<tbody>
				<?php
					foreach($members as $member)
					{
				?>
						<tr>
							<td><?= $member['username']?></td>
						</tr>
				<?php 
						}
				?>			
			</tbody>
		</table>
	</div>
	</div>
</body>
</html>