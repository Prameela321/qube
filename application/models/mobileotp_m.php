<?php

class mobileotp_m extends CI_Model{

		
		public function insert_data($table,$data)
		{
			// $this->db = $this->load->database('default',TRUE);
			return $this->db->insert($table,$data);
		}
		public function update_data($table,$data,$id)
		{
			$this->db->where('id',$id);
			if($this->db->update($table,$data))
				return true;
			else
				return false;
		}
		public function delete_post($table,$id)
		{
			$this->db->where('id',$id);
			if($this->db->delete($table))
				return true;
			else
				return false;
		}
		public function user_info($data)
		{
			
			$res = $this->db->select(' ')
				->from('users')
				->where('username',$data['user_name'])
				->where('password',$data['password'])
				->get()->row_array();
			  		
			 if(!empty($res))
			 {
			 	return $res;
			 }
			 else
			 	return false;
		}
		public function check_user($phone)
		{
			
			$res = $this->db->select(' ')
				->from('users')
				->where('username',$phone)
				// ->where('password',$data['password'])
				->get()->row_array();
			  		
			 if(!empty($res))
			 {
			 	return $res;
			 }
			 else
			 	return false;
		}
		public function get_task_edit($id)
		{
			
			$res = $this->db->select(' ')
				->from('task_details')
				->where('id',$id)
				// ->where('password',$data['password'])
				->get()->row();
			  		
			 if(!empty($res))
			 {
			 	return $res;
			 }
			 else
			 	return false;
		}
		public function get_user_task($limit=false,$offset=false)
		{
			$this->db->select('');
			$this->db->from('task_details');
			if($limit || $offset)
			{
					$this->db->limit($limit,$offset);
		    }
			$res = $this->db->get()->result();
			 // echo "last_query - ".$this->db->last_query();exit;

			if(!empty($res))
				return $res;
			else
				false;
		}
		public function get_category($limit=false,$offset=false)
		{
			$this->db->select('');
			$this->db->from('category');
			if($limit || $offset)
			{
					$this->db->limit($limit,$offset);
		    }
			$res = $this->db->get()->result();
			 // echo "last_query - ".$this->db->last_query();exit;

			if(!empty($res))
				return $res;
			else
				false;
		}

		public function get_search_post($search)
		{
			$this->db->select('');
			$this->db->from('task_details');			
			$this->db->where('category',$search);
			
		    
			$res = $this->db->get()->result();
			 // echo "last_query - ".$this->db->last_query();exit;
				// echo '<pre>';
				// print_r($res);exit;
			if(!empty($res))
				return $res;
			else
				false;
		}
}
?>hp