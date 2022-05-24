<?php
?>
<!DOCTYPE hmtl>
	<html>
 	   <head>
       </head>
		<body>
			<form method="post" action="<?php echo base_url()?>task_app/edit_task">
				<center>
					<fieldset style="position:relative;top:-0px;left:0px;width:150px;">

					<h3>Edit Task</h3>									
						<table cellspacing='15'  width ="0px">
							<tr>
								<td>Name</td>
								<td> <input type="text" name="name" value="<?php echo $post_edit->name ?>"></td>
							</tr>
							<tr>
								<td>Description</td>
								<td> <input type="text" name="description" value="<?php echo $post_edit->description ?>"></td>
							</tr>
							<tr>
								<td>category</td>
								<td><select name="category_select">
									   <?php foreach ($all_category as $categorytags) { 
									   if($categorytags->id == $post_edit->category) { ?>
									   <option  selected ="selected" value="<?php echo $categorytags->id;?>">
									   <?php echo $categorytags->name;?>
									   </option>
									   <?php }
									   else { ?>
									   	<option  value="<?php echo $categorytags->id;?>">
									   <?php echo $categorytags->name;?>
									   </option> 
									<?php } } ?>
								</select></td>
							</tr>
							<tr>
								<td>attachment</td>
								<td> <input type="file" name="userfile" value="<?php echo $post_edit->attachment_url ?>"></td>
							</tr>
						</table>				
									<input type="submit" name="upload">
								</fieldset>
				</center>
			</form>
		</body>
</html>