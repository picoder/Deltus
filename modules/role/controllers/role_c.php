<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role_c extends DV_Controller {
	
	public function __construct()
    {
		parent::__construct(); # we must call it to run paren condtructor - it won't run default	
		
		# Using language settings
		$this->load->language('role_c');
		
		# Setting configs
		$this->load->config('role/role');
    }

	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{	
		$this->division_builder->set_cur_seg();
		
		# Setting permissions
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			case $this->config->item('add_role_url'):
			$this->set_permission('MODULE.ROLE.CONTENT.ADD');
			break;
			
			case $this->config->item('update_role_url'):
			$this->set_permission('MODULE.ROLE.CONTENT.UPDATE');
			break;
			
			case $this->config->item('delete_role_url'):
			$this->set_permission('MODULE.ROLE.CONTENT.DELETE');
			break;
			
			case $this->config->item('edit_role_url'):
			$this->set_permission('MODULE.ROLE.CONTENT.EDIT');
			break;
			
			case $this->config->item('edit_filter_role_url'):
			$this->set_permission('MODULE.ROLE.CONTENT.EDIT_FILTER');
			break;
			
			default:
			
			break;
		}
		
		# Checking permissions
		if($this->check_permission('permissions/permissions','permissions/permissions/default_no_permission'))
		{
			# Additional steps if no permission
			return;
		}
		
		# Running methods (if we have right permission)
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			case $this->config->item('add_role_url'):
			$this->division_builder->set_path($this->config->item('add_role_url'));
			$this->add();
			break;
			
			case $this->config->item('update_role_url'):
			$this->division_builder->set_path($this->config->item('update_role_url'));
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
			
			case $this->config->item('delete_role_url'):
				$this->division_builder->set_path($this->config->item('delete_role_url'));
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
			
			case $this->config->item('edit_role_url'):
			$this->division_builder->set_path($this->config->item('edit_role_url'));
			$page_url = intval($this->uri->segment($this->division_builder->get_cur_seg() + 1));
			$field_url = $this->uri->segment($this->division_builder->get_cur_seg() + 2);
			$asc_url = $this->uri->segment($this->division_builder->get_cur_seg() + 3);
			$filter_url = $this->uri->segment($this->division_builder->get_cur_seg() + 4);
			
			$this->edit($page_url, $field_url, $asc_url, $filter_url);
			break;
			
			default:
			$this->_no_page();
			break;
		}
		
	}
	
	public function add()
	{
		$this->load->helper(array('form'));
		
		if(empty($_POST))
		{
			$this->load->view('role/role_c_add');
		}
		else
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('role_name', $this->lang->line('role_add_form_role_name'), 'required|min_length[4]');
			
			if ( ! $this->form_validation->run())
			{
				$this->load->view('role/role_c_add_fail');
			}
			else
			{
				$r = new Roledm();
				$r->name = $this->input->post('role_name');
				$r->description = $this->input->post('role_description');
				$r->status = intval($this->input->post('role_status'));
				$r->created = date('c');
				$r->modified = date('c');
				
				if($r->save())
				{
					$this->_success_page();
				}
				else
				{
					$this->_fail_page();
				}
			}
		}
	}
	
	public function update($id)
	{
		$this->load->helper(array('form'));
		
		if(empty($_POST))
		{
			$r = new Roledm();
			$r->where('id', $id)->get();
			if($r->result_count() < 1)
			{
				$this->_no_db_result();
			}
			else
			{
				$this->load->view('role/role_c_update', array('r' => $r));
			}
		}
		else
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('role_name', $this->lang->line('role_add_form_role_name'), 'required|min_length[4]');
			
			if ( ! $this->form_validation->run())
			{
				$this->load->view('role/role_c_update_fail');
			}
			else
			{
				$r = new Roledm();
				$r->where('id', $id)->get();
				$r->name = $this->input->post('role_name');
				$r->description = $this->input->post('role_description');
				$r->status = intval($this->input->post('role_status'));
				$r->modified = date('c');
				
				if($r->save())
				{
					$this->_success_page();
				}
				else
				{
					$this->_fail_page();
				}
			}
		}
		
	}
	
	public function delete($id)
	{
		$this->load->library('role/role_lib');
		
		switch($this->role_lib->delete($id))
		{
			case -2:
			$this->_fail_page($this->lang->line('role_content_delete_user_exist'));
			break;
			case -1:
			$this->_no_db_result();
			break;
			case 0:	
			$this->_fail_page();
			break;
			case 1:
			$this->_success_page();
			break;
			default:
			$this->_fail_page();
			break;
		}
	}
	
	public function edit($page_url, $field_url, $asc_url, $filter_url)
	{
		
		$page;
		$field;
		$asc;
		
		if($page_url < 0)
		{
			$this->_no_page();	
			return;
		}
		else
		{
			if($page_url == 0)
			{
				$page = 1;	
			}
			else 
			{
				$page = $page_url;
			}
		}
		
		switch($field_url)
		{
			case $this->config->item('edit_role_url_name'):
			$field = 'name';
			break;
			
			case $this->config->item('edit_role_url_description'):
			$field = 'description';
			break;
			
			case $this->config->item('edit_role_url_status'):
			$field = 'status';
			break;
			
			case $this->config->item('edit_role_url_created'):
			$field = 'created';
			break;
			
			case $this->config->item('edit_role_url_modified'):
			$field = 'modified';
			break;
			
			# for join and special fields
			# special fields are constructed in-fly - they haven't relational field in database
			case $this->config->item('edit_role_url_users'):
			$field = 'userdm_count';
			break;
			
			default:
			$field = 'name';
			$field_url = $this->config->item('edit_role_url_name');
			break;	
		}
		
		switch($asc_url)
		{
			case $this->config->item('edit_role_url_asc'):
			$asc = 'asc';
			break;
			
			case $this->config->item('edit_role_url_desc'):
			$asc = 'desc';
			break;
			
			default:
			$asc = 'asc';	
			$asc_url = $this->config->item('edit_role_url_asc');
			break;	
		}

		$this->load->helper(array('form', 'array'));
		$this->load->library('role/role_lib');
		$url = $this->division_builder->get_path();
		array_pop($url);
		$url = implode('/', $url).'/';
		
		$filters = array();
		if($filter_url != '')
		{
			$filters = $this->role_lib->generate_filters($filter_url);
		}
		
		if($this->input->post('filter'))
		{
			$filters = $this->role_lib->generate_filters($this->input->post(), $filters);
			$filter_url = $this->role_lib->generate_filter_string($filters);
		}
		
		# DEBUG 
		echo('Filter_url: '.$filter_url.br());
		
		if( ! $this->input->post('validation_submit'))
		{	
			$this->load->view('role/role_c_edit', array(
			'items' => $this->role_lib->get_many($page, $this->config->item('edit_role_per_page'), $field, $asc, $filters),  
			'role_edit_base_url' => $url,
			'role_edit_filter_url' => $filter_url,
			'role_edit_field_url' => $field_url,
			'role_edit_asc_url' => $asc_url,
			));
			
		}
		else
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('role_delete', $this->lang->line('role_edit_form_role_delete'), 'xss_clean');
			
			if( ! $this->form_validation->run())
			{
				$this->load->view('role/role_c_edit_fail', array(
				'items' => $this->role_lib->get_many($page, $this->config->item('edit_role_per_page'), $field, $asc, $filters),  
				'role_edit_base_url' => $url,
				'role_edit_filter_url' => $filter_url,
				'role_edit_field_url' => $field_url,
				'role_edit_asc_url' => $asc_url,
				));
			}
			else
			{
				switch($this->role_lib->delete_many($this->input->post('role_delete')))
				{
					case -2:
					$this->_fail_page($this->lang->line('role_content_delete_user_exist'));
					break;
					case 0:	
					$this->_fail_page();
					break;
					case 1:
					$this->_success_page();
					break;
					default:
					
					$this->_fail_page();
					break;
				}
			}
		}
	}
	
}

//End