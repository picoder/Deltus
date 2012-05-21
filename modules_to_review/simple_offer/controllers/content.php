<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends DV_Controller {
	
	public function _remap($method)
	{
		$this->index();
	}
	
	public function index()
	{
		$this->division_builder->set_cur_seg();
		
		$this->load->config('simple_offer/simple_offer');
		// Setting permissions
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			# form with list
			case $this->config->item('edit_so_url'): 
			// access without permission
			break;
			case $this->config->item('add_so_url'):
			// access without permission
			break;
			case $this->config->item('update_so_url'):
			// access without permission
			break;
			case $this->config->item('delete_so_url'):
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
			case $this->config->item('edit_so_url'):
			$this->edit();
			break;
			
			case $this->config->item('add_so_url'):
			$this->add();
			break;
			
			case $this->config->item('update_so_url'):
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
			
			case $this->config->item('delete_by_link_so_url'):
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
	
	public function edit() # form with list
	{
		$this->load->library('simple_offer/simple_offer_lib');
		if($this->input->post('operation_delete'))
		{
			foreach($this->input->post('so_items_checked') as $so_id)
			{
				$this->simple_offer_lib->delete_so_object($so_id);	
			}
			redirect(base_url().$this->config->item('backend_url').'/simple-offer-content/edit');
		}
		
		$this->load->helper(array('form'));
		$so_ids = 'all';
		$data['so_items'] = $this->simple_offer_lib->so_items($so_ids);	
		$this->load->view('simple_offer/simple_offers_list_form', $data);
	}
	
	public function delete($id)
	{
		$this->load->library('simple_offer/simple_offer_lib');
		$this->simple_offer_lib->delete_so_object($id);
		redirect(base_url().$this->config->item('backend_url').'/simple-offer-content/edit');
	}
	
	public function update($id)
	{
		$this->load->helper(array('form'));
		
		if(empty($_POST))
		{	
			$this->matchbook->add_head_snippet('simple_offer/parts/ajaxfilemanager_init_head');
			$this->matchbook->add_head_snippet('simple_offer/parts/validate_jquery_head');
			$so = new Simpleofferdm();
			$so->where('id', $id)->get();
			if($so->result_count() < 1)
			{
				die('This id does not exist');	
			}
			
			$g = $so->gallerydm->get();
			
			$data = array('so' => $so, 'gallery_id' => $g->id);
			
			$this->load->view('simple_offer/update_form_queue', $data);
		}
		else
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('offer_link', 'Link', 'required|min_length[2]');
			
			if ( ! $this->form_validation->run())
			{
				$this->matchbook->add_head_snippet('simple_offer/parts/ajaxfilemanager_init_head');
				$this->matchbook->add_head_snippet('simple_offer/parts/validate_jquery_head');
				
				$so = new Simpleofferdm();
				$so->where('id', $id)->get();
				
				if($so->result_count() < 1)
				{
					die('This id does not exist');	
				}
				
				$data = array('so' => $so);
				
				$this->load->view('simple_offer/error_update_form_queue', $data);	
			}
			else
			{	
				$so = new Simpleofferdm();
				$so->where('id', intval($this->input->post('offer_id')))->get();
				$so->name = $this->input->post('offer_name');
				$so->label = $this->input->post('offer_label');
				$so->link = $this->input->post('offer_link');
				$so->description = $this->input->post('offer_description');
				$so->content= $this->input->post('offer_content');
				$so->status = intval($this->input->post('offer_status'));
				$so->modified = date("c"); // only modified
				
				$so->so_model = $this->input->post('offer_model');
				$so->so_color = $this->input->post('offer_color');
				$so->so_capacity = $this->input->post('offer_capacity');
				$so->so_registered = $this->input->post('offer_registered');
				$so->so_production = $this->input->post('offer_production');
				$so->so_power = $this->input->post('offer_power');
				$so->so_price = $this->input->post('offer_price');
				$so->so_engine = $this->input->post('offer_engine'); 
				
				if($so->save())
				{
					//success
					$this->success_page();
				}
				else
				{
					//fail
					$this->fail_page();
				}
					
			}
		}
	}
	
	public function add()
	{
		$this->load->library('gallery/gallery_lib');
		$this->load->helper(array('form'));
		
		if(empty($_POST))
		{	
			$this->matchbook->add_head_snippet('simple_offer/parts/ajaxfilemanager_init_head');
			
			// to validate form
			$this->matchbook->add_head_snippet('simple_offer/parts/validate_jquery_head');
			
			$this->gallery_lib->init_plupload();
			
			$this->load->view('simple_offer/add_form_queue');
		}
		else
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('offer_link', 'Link', 'required|min_length[2]');
			
			if ( ! $this->form_validation->run())
			{
				$this->matchbook->add_head_snippet('simple_offer/parts/ajaxfilemanager_init_head');
				$this->matchbook->add_head_snippet('simple_offer/parts/validate_jquery_head');
				
				$this->gallery_lib->after_validation_fails();
				
				$this->load->view('simple_offer/error_add_form_queue');
			}
			else
			{
				$so = new Simpleofferdm();
				$so->name = $this->input->post('offer_name');
				$so->label = $this->input->post('offer_label');
				$so->link = $this->input->post('offer_link');
				$so->description = $this->input->post('offer_description');
				$so->content= $this->input->post('offer_content');
				$so->status = intval($this->input->post('offer_status'));
				$so->created = date('c');
				$so->modified = date('c'); 
				
				$so->so_model = $this->input->post('offer_model');
				$so->so_color = $this->input->post('offer_color');
				$so->so_capacity = $this->input->post('offer_capacity');
				$so->so_registered = $this->input->post('offer_registered');
				$so->so_production = $this->input->post('offer_production');
				$so->so_power = $this->input->post('offer_power');
				$so->so_price = $this->input->post('offer_price');
				$so->so_engine = $this->input->post('offer_engine'); 
				
				$so->save();
				
				$ga = new Gallerydm();
				$ga->created = date('c');
				$ga->modified = date('c');
				$ga->name = $this->input->post('offer_name').'_gallery';
				$ga->save($so); //saving with relationship
				//success
				$this->gallery_lib->after_add_validation_passes($ga->id);
				$this->success_page();		
			}	
		}
	}
	
	public function add_socategory()
	{
		$this->load->helper(array('form'));
		
		if(empty($_POST))
		{
			$this->load->view('simple_offer/add_socategory');
		}
		else
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('soca_link', 'Link', 'required|min_length[4]');
			if ( ! $this->form_validation->run())
			{
				$this->load->view('simple_offer/error_add_socategory');
			}
			else
			{
				# get data of parent category and category name
				$soca = new Socategorydm();
				$soca->name = $this->input->post('soca_name');
				$soca->parent_id = $this->input->post('soca_parent_id');
				$soca->label = $this->input->post('soca_label');
				$soca->link = $this->input->post('soca_link');
				# TODO functionality of additional fields in extra table
				$this->load->library('simple_offer/socategory_lib');
				$this->socategory_lib->add($soca);
			}
			
		}
		
		
		
		# get data of additional fields and its type to create relate table of category if needed
	}
	
	
}

/* End of file content.php */
/* Location: ./modules/simple_offer/controllers/content.php */