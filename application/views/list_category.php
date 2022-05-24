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
       <div>
          <div>
            <i></i>
                 
                 <div style="color:red;float:center"><?php  echo $this->session->flashdata('login') ?></div>  
            <span>list Of category(s)</span>
          </div>
          <br>
            <div>         
                    <button type="button" style="float:right;"><a href="<?php echo base_url()?>task_app/add_category">Add New Category</a></button>

            </div>
        </div>
        	
      <div class="portlet-body">
      <table class="inner">
      <thead>
      <tr>
        <!-- <h>Postt No.</th>        -->
        <th style="border-left: 2px solid black;">Task Name</th>       
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
              
      </tr>
      <?php 
  			} 
  		}?>
    
      </tbody>
      </table>
      	<center>
      		<?php
        	if($total_pages)
        	{
        		echo 'pages : ';
			for($i= 1;$i<=$total_pages;$i++)
			 {
				if($i == $page) 
				{ 
					echo $i.' ';

				}
				else
				{ 
				  echo '<a href="'.base_url().'task_app/view_category?page='.$i.'">'.$i.' </a>';
				}
			  }
			}
            ?>
         </center>
    </div>
</div>
</body>
</html>
<script type='text/javascript'>
	function addview()
    {
     	var search = document.getElementById('search').value;
    	var base_url= window.location.host;
      window.open(base_url+'/wh_no_2/task_app/search_post?search='+search);
    }
</script>