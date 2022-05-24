<?php 
require ('textlocal.class.php');

class Mobile_otp extends CI_Controller{
	private $data = [];
	private $list_per_page = 2;
	
	public function __construct()
	{
		 parent::__construct();
		 
 		$this->load->model('mobileotp_m');
 		$this->load->library(array('form_validation','session'));
 		// database library autoloaded

	}

	public function index(){

			$this->load->view('user_view.php');
	}
	public function register(){

		if($this->input->post())
		{
			
			$this->form_validation->set_rules('phone','phone','trim|required|regex_match[/^[0-9]{10}$/]');
			// $this->form_validation->set_rules('type','type','required');

			
			$phone = $this->input->post('phone');
			$type = $this->input->post('type_select');

			$register_arr = array(
				'username' => $phone,
				'type' => $type);

			// echo '<pre>';
			// print_r($register_arr);exit;
			if($this->form_validation->run() == TRUE)
			{
				$exist_user = $this->mobileotp_m->check_user($phone);
				if(!$exist_user)
				{
					if($this->mobileotp_m->insert_data('users',$register_arr))
					{
						$this->session->set_flashdata('register','<div>Registered Successfully</div>');
						// $this->load->view('login.php');
						header('Location:'.base_url().'mobile_otp/login');
					}
			   }
			   else
			   {
			   		$this->session->set_flashdata('phone_duplicate','<div>User is already Registered with Phone</div');
			   		$this->load->view('register.php');
			   }
		   }
		   else
		   	$this->load->view('register.php');
			// $this->
			
		}
		else
		$this->load->view('register.php');
	}
	// public functon logout(){
	// 	$this->session_unset_user()
	// }
	public function login()
	{
		
		if($this->input->post())
		{
			
			$this->form_validation->set_rules('phone','phone','trim|required|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('password','password','required');
				
			$phone = $this->input->post('phone');
			$password = $this->input->post('password');

			$login_arr = array(
				'user_name' => $phone,
				'password' => $password);

			// echo '<pre>';
			// print_r($register_arr);exit;
			if($this->form_validation->run() == TRUE)
			{
				if($user_detail = $this->mobileotp_m->user_info($login_arr))
				{
					// $this->session->set_userdata(array(
					// 	'user' => $phone,
					//     'logged_in' => true));
					$this->session->set_flashdata('login','<div>Hi '.$this->session->userdata['user'].'</div>');
					
					// $this->data['post_details'] = $this->mobileotp_m->get_user_post();
					// $this->load->view('post_view.php',$this->data);
					header('Location:'.base_url().'mobile_otp/view_post');
				}
				else
				{
					// echo 'siodji';exit;
					$this->session->set_flashdata('login_error','<div>Phone or password Invalid</div');
					$this->load->view('login.php');

				}
		   }
		   else{
		   	$this->load->view('login.php');
		   }
			// $this->
			
		}
		else
		$this->load->view('login.php');
	}
	public function view_post()
	{
		$list_per_page = 2;
			
		$count =count($this->mobileotp_m->get_user_task());
		
        $this->data['page'] = $page = $this->input->get('page');  
        if(!$page)
          $this->data['page'] = $page = 1; 

        $this->data['total_pages'] = $total_pages = ceil($count/$list_per_page);
        $this->data['post_details'] = $this->mobileotp_m->get_user_task($list_per_page,($page-1)*$list_per_page);
        $this->data['category_list'] = $this->mobileotp_m->get_category();
        $this->data['search'] = $search = '';
       
		$this->load->view('list_tasks.php',$this->data);
	}

	public function view_category()
	{
		$list_per_page = 2;
			
		$count =count($this->mobileotp_m->get_category());
		
        $this->data['page'] = $page = $this->input->get('page');  
        if(!$page)
          $this->data['page'] = $page = 1; 

        $this->data['total_pages'] = $total_pages = ceil($count/$list_per_page);
        $this->data['post_details'] = $this->mobileotp_m->get_category($list_per_page,($page-1)*$list_per_page);
        $this->data['search'] = $search = '';
       
		$this->load->view('list_category.php',$this->data);
	}

	public function search_post()
	{
		// $list_per_page = 1;
		// echo 'inside search';exit;
		
		parse_str($_SERVER['QUERY_STRING'],$params);
		
			
		$this->data['search'] = $search = $params['search'];
		// echo '<pre>here ';
		// var_dump($params);
		$this->data['post_details'] = false;
		// echo '<pre>';
		// print_r($search);
        $this->data['post_details'] = $this->mobileotp_m->get_search_post($search);
         // echo "last_query - ".$this->db->last_query();exit; 
        // echo '<pre>';
        // var_dump($this->data);exit;
        if($this->data['post_details'])
        {

				$this->load->view('search_task.php',$this->data);
		}
		else
		{

			$this->session->set_flashdata('search_error','<div>No result Found</div>');
			header('Location:'.base_url().'index.php/mobile_otp/view_post');
		}
	}

	public function  add_category()
	{	
		// echo 'sdjos';
		if($this->input->post())
		{
			// echo 'skdjk';
			

			$this->form_validation->set_rules('name','name','required');
			

			$name = $this->input->post('name');
			

	      
				$post_arr = array(
					'name' => $name
				);
		   
			// echo '<pre>';
			// print_r($this->input->post());exit;
			if($this->form_validation->run() == TRUE)
			{
				if($this->mobileotp_m->insert_data('category',$post_arr))
				{
					$this->session->set_flashdata('task','<div>Category Added Successfully</div>');
					// $this->data['post_details'] = $this->mobileotp_m->get_user_post();
					header('Location:'.base_url().'mobile_otp/view_category');
				}
				else
				{
					$this->session->set_flashdata('not_register','<div>User not Registered</div');
				}
		   }
  
		}  
		else
		{
			$this->data['post_edit'] = 0;
			$this->data['is_edit'] = 1;
			$this->load->view('add_category.php',$this->data);
		}
	}
	public function  add_task()
	{	
		// echo 'sdjos';
		$this->data['all_category'] = $this->mobileotp_m->get_category();
		if($this->input->post())
		{
			
			$this->form_validation->set_rules('name','name','required');
			$this->form_validation->set_rules('description','description','required');
			// $this->form_validation->set_rules('category','category','trim|required');
			// $this->form_validation->set_rules('password','password','required');

			$name = $this->input->post('name');
			$description = $this->input->post('description');
			$category = $this->input->post('category_select');
			
			
	       if ($_FILES['userfile']['size'] > 0){
	          echo "<p>".$_FILES['userfile']['name']." => file input successfull</p>";

    
        
         	  if(!is_dir("attachment"))
                mkdir("attachment", 0777, TRUE);

              $target_dir =  "attachment/";
       
              $file_name = $_FILES['userfile']['name'];
              $file_tmp = $_FILES['userfile']['tmp_name'];
              if (move_uploaded_file($file_tmp, $target_dir.$file_name)) {
        
				$post_arr = array(
					'name' => $name,
					'description' => $description,
					'category' => $category,
			        'attachment_url' => base_url().$target_dir.$file_name
				);
		     }
		  }
			// echo '<pre>';
			// print_r($this->input->post());exit;
			if($this->form_validation->run() == TRUE)
			{
				if($this->mobileotp_m->insert_data('task_details',$post_arr))
				{
					$this->session->set_flashdata('task','<div>Task Added Successfully</div>');
					// $this->data['post_details'] = $this->mobileotp_m->get_user_post();
					header('Location:'.base_url().'mobile_otp/view_post');
				}
				else
				{
					$this->session->set_flashdata('not_register','<div>User not Registered</div');
				}
		   }
  
		}  
		else
		{
			
			$this->data['post_edit'] = 0;
			$this->data['is_edit'] = 1;
			$this->load->view('add_task.php',$this->data);
		}
	}
	public function  edit_task()
	{	
		$this->data['all_category'] = $this->mobileotp_m->get_category();
		if($this->input->post())
		{
			// echo 'skdjk';
			$this->form_validation->set_rules('name','name','required');
			$this->form_validation->set_rules('description','description','required');
			$this->form_validation->set_rules('category','category','trim|required');
			// $this->form_validation->set_rules('password','password','required');

			$name = $this->input->post('name');
			$description = $this->input->post('description');
			$category = $this->input->post('category_list');
			

	       if ($_FILES['userfile']['size'] > 0){
	          echo "<p>".$_FILES['userfile']['name']." => file input successfull</p>";

    
        
         	  if(!is_dir("attachment"))
                mkdir("attachment", 0777, TRUE);

              $target_dir =  "attachment/";
       
              $file_name = $_FILES['userfile']['name'];
              $file_tmp = $_FILES['userfile']['tmp_name'];
              if (move_uploaded_file($file_tmp, $target_dir.$file_name)) {
        
				$post_arr = array(
					'name' => $name,
					'description' => $description,
					'category' => $category,
			        'attachment_url' => base_url().$target_dir.$file_name
				);
		     }
		  }
			// echo '<pre>';
			// print_r($this->input->post());exit;
			if($this->form_validation->run() == TRUE)
			{
				if($this->mobileotp_m->insert_data('task_details',$post_arr))
				{
					$this->session->set_flashdata('task','<div>Task updated Successfully</div>');
					// $this->data['post_details'] = $this->mobileotp_m->get_user_post();
					header('Location:'.base_url().'mobile_otp/view_post');
				}
				else
				{
					$this->session->set_flashdata('not_register','<div>User not Registered</div');
				}
		   }
		}  
		else
		{

			$post_id = $this->input->get('id');
			$this->data['post_edit'] = $post_edit = $this->mobileotp_m->get_task_edit($post_id);
			$this->data['is_edit'] = 1;
			// echo '<pre>';
			// print_r($this->data);exit;
			$this->load->view('edit_task.php',$this->data);
		}
	}
	
	public function login_select()
	{
		$this->load->view('loginselect_view.php');
	}

    function processMobileVerification()
    {
        switch ($_POST["action"]) {
            case "send_otp":
                
                $mobile_number = $_POST['mobile_number'];
                $otp = rand(100000, 999999);
                $_SESSION['session_otp'] = $otp;
                $message = "Your One Time Password is " . $otp;
				// echo base_url();
			// Initialize handle
				// require_once 'C:\xampp4/htdocs/login_otp/vendor/autoload.php';
				// $messagebird = new MessageBird\Client('ENHZo5z8TJmug4WISidM6feGm');
				// $message = new MessageBird\Objects\Message;
				// $message->originator = '+919533751479';
				// $message->recipients = array('+919533751479');
				// $message->body = $message;
				// $response = $messagebird->messages->create($message);
				// echo json_encode($response);
    //             break;
            // require('textlocal.class.php');
			// $otp = rand(1000,9999);
		// 	$apiKey = urlencode('Mzc2NzMyNDI1NDVhNzk2NzYxNzE0ZTU4NTY0MjcxNjY');
		//     $numbers = array(919533751479);
		//     $sender = urlencode('Garry');
		// 	$message = rawurlencode($message);
	 //  	    $numbers = implode(',', $numbers);
	 
		// // Prepare data for POST request
		// $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
	 
		// // Send the POST request with cURL
		// $ch = curl_init('https://api.txtlocal.com/send/');
		// curl_setopt($ch, CURLOPT_POST, true);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// $response = curl_exec($ch);
		// curl_close($ch);
		
		// // Process your response here
		// echo $response;

		require_once 'C:\xampp4/htdocs/login_otp/vendor/autoload.php';
	use Messente\Api\Api\OmnimessageApi;
	use Messente\Api\Model\Omnimessage;
	use Messente\Api\Configuration;
	use Messente\Api\Model\SMS;

	$config = Configuration::getDefaultConfiguration()
	    ->setUsername('3d5e5fbf79b74264984bfdfe5c685207')
	    ->setPassword('e52e9b4eea18411d85d03bd0a15bc648');

	$apiInstance = new OmnimessageApi(
	    new GuzzleHttp\Client(),
	    $config
	);

	$omnimessage = new Omnimessage([
	    'to' => '<9533751479>',
	]);

	$sms = new SMS(
	    [
	        'text' => 'hello sms',
	        'sender' => '<sender name (optional)>',
	    ]
	);

	$omnimessage->setMessages([$sms]);

	try {
	    $result = $apiInstance->sendOmnimessage($omnimessage);
	    print_r($result);
	} catch (Exception $e) {
	    echo 'Exception when calling sendOmnimessage: ', $e->getMessage(), PHP_EOL;
	}

				break;
	            case "verify_otp":
	                $otp = $_POST['otp'];
	                
	                if ($otp == $_SESSION['session_otp']) {
	                    unset($_SESSION['session_otp']);
	                    echo json_encode(array("type"=>"success", "message"=>"Your mobile number is verified!"));
	                } else {
	                    echo json_encode(array("type"=>"error", "message"=>"Mobile number verification failed"));
	                }
	                break;
	        }
	    }
	}

	?>