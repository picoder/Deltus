<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Socategory extends DV_Controller {
	
	public function __construct()
    {
		parent::__construct(); # we must call it to run parent condtructor - it won't run default
    }
	
	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{
		$this->division_builder->set_cur_seg();
		
		$this->load->config('simple_offer/socategory');
		// Setting permissions
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			case $this->config->item('edit_soca_url'):
			// access without permission
			break;
			case $this->config->item('add_soca_url'):
			// access without permission
			break;
			case $this->config->item('update_soca_url'):
			// access without permission
			break;
			case $this->config->item('delete_soca_url'):
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
			case $this->config->item('edit_soca_url'):
			$this->edit();
			break;
			
			case $this->config->item('add_soca_url'):
			$this->add();
			break;
			
			case $this->config->item('update_soca_url'):
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
			
			case $this->config->item('delete_soca_url'):
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
			default:
			$this->_no_page();
			break;
		}
			
	}
	
	
	public function add()
	{
		$this->load->helper(array('form'));
		$this->load->library('simple_offer/socategory_lib');
		
		if(empty($_POST))
		{
			$soca = new Socategorydm();
			$socas = $soca->get();
			$this->socategory_lib->set_socas($socas);
			$this->load->view('simple_offer/socategory/add', array('formpart_parent_soca' => $this->socategory_lib->formpart_parent_soca($socas)));
		}
		else
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('soca_name', 'Nazwa', 'required|min_length[4]');
			$this->form_validation->set_rules('soca_label', 'Etykieta', 'required|min_length[4]');
			$this->form_validation->set_rules('soca_link', 'Link', 'required|min_length[4]');
			if ( ! $this->form_validation->run())
			{
				$soca = new Socategorydm();
				$socas = $soca->get();
				$this->socategory_lib->set_socas($socas);
				$this->load->view('simple_offer/socategory/error_add', array('formpart_parent_soca' => $this->socategory_lib->formpart_parent_soca($socas)));
			}
			else
			{
				# get data of parent category and category name
				
				$soca = new Socategorydm();
				$soca->name = $this->input->post('soca_name');
				$soca->tree = $this->input->post('soca_tree');
				$soca->label = $this->input->post('soca_label');
				$soca->link = $this->input->post('soca_link');
				# TODO functionality of additional fields in extra table
				
				$this->socategory_lib->add($soca);

				$this->socategory_lib->menu_socategory();

			}
			
		}
		
		
		
		# get data of additional fields and its type to create relate table of category if needed
	}
	
	public function delete($id)
	{
		$this->load->library('simple_offer/socategory_lib');
		$this->socategory_lib->delete($id);
		redirect(base_url().$this->division_builder->get_dv_url().'/lab-content/soca/add');
	}
	
	protected function success_page($message = false)
	{
		$data['message'] = $message;
		$this->load->view('simple_offer/success_page', $data);
	}
	
	
}
