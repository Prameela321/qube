<?php
?>
<!DOCTYPE hmtl>
<html>
<head>
	<style>
		a{
			text-decoration: none;
			color:black;
		}
		.outer {
    	width: 500px; 
    	height: 400px; 
    	margin: 50px auto 0 auto;
    	
		}
		/*.inner {
    	margin: 50px 50px 50px 50px;
    	padding: 10px;
    	display: block;
    	/*border : 2px solid black;*/
      /*}*/
      th
      {
      	border-top: 2px solid black;
      }
      th,td
      {
      		border-bottom: 2px solid black;
      		border-right: 2px solid black;
      }
	</style>
	<link rel="stylesheet" hef="<?php echo base_url()?>style/style.css">
</head>
<body>
<!-- <button class="btn purple btn-primary" type="button" onclick="addview()">Add New Post</button> -->
<div class ="outer">
        	
      <div class="portlet-body">
      <table class="inner">
      <thead>
      <tr>
        <!-- <h>Postt No.</th>        -->
        <th style="border-left: 2px solid black;">Task Name</th>       
        <th>Description</th> 
        <th>Category</th> 
        <th>Attachment</th>
        <th>Action</th> 
      </tr>
      </thead>
      <tbody>
      
      <?php if(!empty($post_details))
      {
      	// var_dump($post_details);exit;
      	foreach($post_details as $key =>  $row){ 
      		// var_dump($row->name);exit;
      		?>
      <tr>
            
              <td style="border-left: 2px solid black;"> <?php print_r($row->name); ?> </td>
              <td> <?php print_r($row->description); ?> </td>
              <td> <?php  print_r($row->category); ?></td>
              <td> <?php print_r($row->attachment_url); ?></td>
              <td><a href="<?php echo base_url()?>task_app/edit_task?id=<?php echo $row->id;?>">Edit</a>
              </td>
      </tr>
      <?php 
  			} 
  		}?>
    
      </tbody>
      </table>
      	
    </div>
</div>
</body>
</html>
<script type='text/javascript'>
	function addview()
    {
     	var search = document.getElementById('category_list').selectedOptions[0].value;
    	var base_url= "http://"+window.location.host;
      // console.log(base_url+'/wh_no_2/task_app/search_post?search='+search);
      window.open(base_url+'/wh_no_2/task_app/search_post?search='+search);
    }
</script>