<?php
class my_controller extends CI_Controller{
	public $data;
	public $module;
	public $controller;
	public $method;
	
	public $request = NULL;
	protected $list_per_page = 30;
	protected $links_per_page = 5;
	
	protected $messages = array();
	
	
	public function _set_message($key, $message)
	{
		$this->messages[$key][] = $message;
		return $this;
	}
	
	public function _messages($key = NULL)
	{
		if ($key == NULL)
		{
			return '';
		}
		
		return array_key_exists($key, $this->messages)
			? implode("<br/>\n", $this->messages[$key])
			: '';
	}
	
	public function _paginator($key=NULL,$total_rows = 0,$is_ajax = false,$_page = 1,$_per_page = 10)
	{
		$paginator = array();
	
		if($is_ajax){
			$page = $_page;
			$per_page = $_per_page;
		} else {
			$page = $this->input->get('page',1);
			$per_page = $this->input->get('per_page',$this->list_per_page);
		}
		!(int)$page AND $page = 1;
		!(int)$per_page AND $per_page = $this->list_per_page;
		$offset = ($per_page * ($page - 1));
		
		$num_links = $this->links_per_page ? $this->links_per_page : 5;
		$num_pages = ceil($total_rows / $per_page);
		$is_link = ceil($total_rows / $per_page);
		if ($num_links > $num_pages)
		{
			$num_links = $num_pages;
		}
		
		if ($key == NULL)
		{
			if ($total_rows == 0 or $total_rows <= $per_page)
			{
				//return FALSE;
			}
			
			if ($page > $num_pages or $page <= 0)
			{
				//return FALSE;
			}
		}
		
		
		$current_page = $page;
		
		$q = '';
		$q_arr = array();
		
		if($this->input->get()){
                    foreach (($get = $this->input->get()) as $_key => $val)
                    {
                            if ($_key == 'page' or $_key == 'per_page') continue;
                            if (!empty($get[$_key]))
                            {
                                    if (is_array($val))
                                    if (empty($val[0])) continue;

                                    $q_arr[$_key] = $val;
                            }
                    }
                }
		
		$q = http_build_query($q_arr);
		
		$paginator['q'] = '&'.$q;
		$paginator['first_q'] = preg_replace('{\&}', '?', $q,1);
		$paginator['page'] 		= $page;
		$paginator['per_page'] 	= $per_page;
		$paginator['offset']	= $offset;
		$paginator['limit'] 	= array($per_page,$offset);
		$paginator['url'] 		= current_url();
		$paginator['num_links'] = $num_links;
		
		$paginator['cur_page'] = $current_page;
		$paginator['num_pages'] = $num_pages;
		$paginator['total_rows'] = $total_rows;
		$paginator['offset'] = $paginator['offset'];
		$paginator['has_first'] = $current_page == 1 ? TRUE : FALSE;
		$paginator['has_last'] = $has_last = ($current_page == (int)$num_pages) ? TRUE : FALSE;
		$paginator['has_next'] = $has_next = ($current_page < $num_pages) ? TRUE : FALSE;
		$paginator['has_prev'] = $current_page > 1 ? TRUE : FALSE;
		$paginator['prev'] = ($current_page - 1);
		$paginator['last'] = $last = $num_pages;
		$paginator['next'] = ($current_page + 1);
		$batch =0;
		if($num_links > 0){
			$batch = @ceil($page / $num_links);
		}
		$end = ($batch * $num_links);
		
		$end > $num_pages AND $end = $num_pages;
		$start = $end - $num_links + 1;
		if($is_link > 1)
		{
			for ($i = $start; $i <= $end; $i++)
			{
			$paginator['links'][] = $i;
			}
		}
		
		
		if(NULL === $key)
		{
			return $paginator;
		}
	
		return array_key_exists($key, $paginator) ?  $paginator[$key]: FALSE;
	}

}

/**
 * Returns the CI object.
 *
 * Example: ci()->db->get('table');
 *
 * @staticvar	object	$ci
 * @return		object
 */
function ci()
	{
		return get_instance();
	}