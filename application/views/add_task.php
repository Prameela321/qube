<?php
?>
<!DOCTYPE hmtl>
	<html>
 	   <head>
       </head>
		<body>
			<form method="post" enctype="multipart/form-data" action="<?php echo base_url()?>task_app/add_task">
				<center>
					<fieldset style="position:relative;top:-0px;left:0px;width:150px;">

					<h3>Add Task</h3>									
						<table cellspacing='15'  width ="0px">
							<tr>
								<td>Name</td>
								<td> <input type="text" name="name"></td>
							</tr>
							<tr>
								<td>Description</td>
								<td> <input type="text" name="description"></td>
							</tr>
							<tr>
								<td>category</td>
								<td><select name="category_select">
									   <?php foreach ($all_category as $skilltags) {  ?>
									   <option value="<?php echo $skilltags->id;?>">
									   <?php echo $skilltags->name;?>
									   </option>
									   <?php } ?>
								</select></td>
							</tr>
							<tr>
								<td>attachment</td>
								<td> <input type="file" name="userfile"></td>
							</tr>
						</table>				
									<input type="submit" name="upload">
								
								</fieldset>
				</center>
			</form>
		</body>
</html>