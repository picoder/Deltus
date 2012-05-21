<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends DV_Controller 
{
	public function __construct()
    {
		parent::__construct(); # we must call it to run paren condtructor - it won't run default
    }
		
	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{
		$this->division_builder->set_cur_seg(); 
		
		$this->load->config('page/page');
		// Setting permissions
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			case $this->config->item('edit_page_url'):
			// access without permission
			break;
			case $this->config->item('add_page_url'):
			// access without permission
			break;
			case $this->config->item('update_page_url'):
			// access without permission
			break;
			case $this->config->item('delete_page_url'):
			// access without permission
			break;
			default:
			// access without permission
			break;
		}
		
		// Checking permissions
		if($this->check_permission('permissions/permissions','start/start/no_access'))
		{
			// Additional steps if no permission
			return;
		}
		
		// Running methods (if we have right permission)
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			case $this->config->item('edit_page_url'):
			$this->edit();
			break;
			
			case $this->config->item('add_page_url'):
			$this->add();
			break;
			
			case $this->config->item('update_page_url'):
			$id = intval($this->uri->segment($this->division_builder->get_cur_seg() + 1));
			if($id <= 0)
			{
				$this->_no_page();	
			}
			else
			{
				$this->update($id);
			}
			break;
			
			case $this->config->item('delete_by_link_page_url'):
			$id = intval($this->uri->segment($this->division_builder->get_cur_seg() + 1));
			if($id <= 0)
			{
				$this->_no_page();	
			}
			else
			{
				$this->delete($id);
			}
			break;
			case 'test':
			$this->success_page();
			break;
			default:
			$this->_no_page();
			break;
		}
			
	}
	
	public function edit() //list
	{
		$this->load->library('page/page_lib');
		if($this->input->post('operation_delete'))
		{
			foreach($this->input->post('items_checked') as $id)
			{
				$this->page_lib->delete_object($id);	
			}
			redirect(base_url().$this->config->item('backend_url').'/page-content/edit');
		}
		
		$this->load->helper(array('form'));
		$ids = 'all';
		$data['items'] = $this->page_lib->items($ids);	
		$this->load->view('page/page_list_form', $data);
	}
	
	public function delete($id)
	{
		$this->load->library('page/page_lib');
		$this->page_lib->delete_object($id);
		redirect(base_url().$this->config->item('backend_url').'/page-content/edit');
	}
	
	public function update($id)
	{
		$this->load->helper(array('form'));
		
		if(empty($_POST))
		{	
			$this->matchbook->add_head_snippet('page/parts/ajaxfilemanager_init_head');
			$this->matchbook->add_head_snippet('page/parts/validate_jquery_head');
			$page = new Pagedm();
			$page->where('id', $id)->get();
			if($page->result_count() < 1)
			{
				die('This id does not exist');	
			}
			
			$g = $page->gallerydm->get();
			
			$data = array('so' => $page, 'gallery_id' => $g->id);
			
			$this->load->view('page/update_form_queue', $data);
		}
		else
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('page_link', 'Link', 'required|min_length[2]');
			
			if ( ! $this->form_validation->run())
			{
				$this->matchbook->add_head_snippet('page/parts/ajaxfilemanager_init_head');
				$this->matchbook->add_head_snippet('page/parts/validate_jquery_head');
				
				$page = new Pagedm();
				$page->where('id', $id)->get();
				
				if($page->result_count() < 1)
				{
					die('This id does not exist');	
				}
				
				$data = array('page' => $page);
				
				$this->load->view('page/error_update_form_queue', $data);	
			}
			else
			{	
				$page = new Pagedm();
				$page->where('id', intval($this->input->post('page_id')))->get();
				$page->name = $this->input->post('page_name');
				$page->label = $this->input->post('page_label');
				$page->link = $this->input->post('page_link');
				$page->description = $this->input->post('page_description');
				$page->content= $this->input->post('page_content');
				$page->status = intval($this->input->post('page_status'));
				$page->modified = date("c"); // only modified
				
				$page->save();	
				//success
				$this->success_page();
			}
		}
	}
	
	public function add()
	{
		$this->load->library('gallery/gallery_lib');
		$this->load->helper(array('form'));
		
		if(empty($_POST))
		{	
			$this->matchbook->add_head_snippet('page/parts/ajaxfilemanager_init_head');
			
			// to validate form
			$this->matchbook->add_head_snippet('page/parts/validate_jquery_head');
			
			$this->gallery_lib->init_plupload();
			
			$this->load->view('page/add_form_queue');
		}
		else
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('page_link', 'Link', 'required|min_length[2]');
			
			if ( ! $this->form_validation->run())
			{
				$this->matchbook->add_head_snippet('page/parts/ajaxfilemanager_init_head');
				$this->matchbook->add_head_snippet('page/parts/validate_jquery_head');
				
				$this->gallery_lib->after_validation_fails();
				
				$this->load->view('page/error_add_form_queue');
			}
			else
			{	
				$page = new Pagedm();
				$page->name = $this->input->post('page_name');
				$page->label = $this->input->post('page_label');
				$page->link = $this->input->post('page_link');
				$page->description = $this->input->post('page_description');
				$page->content= $this->input->post('page_content');
				$page->status = intval($this->input->post('page_status'));
				$page->created = date('c');
				$page->modified = date('c'); 
				
				$page->save();
				
				$g = new Gallerydm();
				$g->created = date('c');
				$g->modified = date('c');
				$g->name = $this->input->post('page_name').'_gallery';
				$g->save($page); //saving with relationship
				//success
				$this->gallery_lib->after_add_validation_passes($g->id);
				$this->success_page();		
			}	
		}
	}
	
	protected function success_page($message = false)
	{
		$data['message'] = $message;
		$this->load->view('page/success_page', $data);
	}
	
	
}

/* End of file content.php */
/* Location: ./modules/page/controllers/page.php */