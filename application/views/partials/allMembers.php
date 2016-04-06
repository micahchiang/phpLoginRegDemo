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