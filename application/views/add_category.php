<?php
?>
<!DOCTYPE hmtl>
	<html>
 	   <head>
       </head>
		<body>
			<form method="post" enctype="multipart/form-data" action="<?php echo base_url()?>task_app/add_category">
				<center>
					<fieldset style="position:relative;top:-0px;left:0px;width:150px;">

					<h3>Add Category</h3>									
						<table cellspacing='15'  width ="0px">
							<tr>
								<td>Name</td>
								<td> <input type="text" name="name"></td>
							</tr>
							
						</table>				
									<input type="submit" name="upload">
								
								</fieldset>
				</center>
			</form>
		</body>
</html>