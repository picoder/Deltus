<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends DV_Controller {

	# deleteing single gallery item from url is not possible till every image will be indexed in database
	
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
		 
		$this->load->config('gallery/gallery');
		// Setting permissions
		switch($this->uri->segment($this->division_builder->get_cur_seg()))
		{
			case $this->config->item('update_gallery_url'):
			
			break;
			case $this->config->item('delete_gallery_url'):
			
			break;
			default:

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
			case $this->config->item('update_gallery_url'):
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
			case $this->config->item('delete_gallery_url'):
			$id = intval($this->uri->segment($this->division_builder->get_cur_seg() + 1));
			if($id <= 0)
			{
				$this->_no_page();	
			}
			else
			{
				$this->delete_by_link($id);
			}
			break;
			default:
				$this->_no_page();	
			break;
		}
		
	}
	
	public function update($gallery_id)
	{
		$this->load->library('gallery/gallery_lib');
		
		if(empty($_POST))
		{
			$this->load->helper(array('form'));
		
			$this->gallery_lib->init_plupload();
		
			$data['gallery_items'] = $this->gallery_lib->gallery_items_form_part($gallery_id);
			$data['gallery_id'] = $gallery_id;
			$this->load->view('gallery/update_gallery_form', $data);
		}
		else
		{
			$this->load->helper(array('file'));
			
			$this->gallery_lib->add_files_to_gallery($gallery_id);
			
			foreach($this->input->post('images') as $image)
			{
				$this->gallery_lib->delete_gallery_item($image, $gallery_id);
			}
			$g = new Gallerydm();
			$g->where('id', $gallery_id)->get();
			$g->modified = date('c');
			$g->save();
			
			redirect(base_url().$this->config->item('backend_url').'/'.$this->config->item('gallery_content_url').'/update-gallery/'.$gallery_id);
		}
	}
	
	public function delete_by_link($gallery_id)
	{
		$so = new Gallerydm();
		$so->where('id', $gallery_id)->get();
		if($so->result_count() > 0)
		{
			$so->delete(); // it deletes also with its relations
		}
		else
		{
			echo 'This gallery does not exist';
			return;	
		}
		
		$this->load->helper(array('directory'));
		# if gallery id exists but folder of gallery may not exist
		try
		{
			delete_dir_with_files('uploads/galleries/'.$gallery_id.'/');
		}
		catch (InvalidArgumentException $e)
		{
			# continue because file does not exist	
		}
		catch (Exception $e)
		{
			die('We cannot remove this gallery');	
		}
		redirect(base_url().$this->config->item('backend_url').'/gallery-content/edit');
	}
	
	
}

/* End of file content.php */
/* Location: ./modules/gallery/controllers/content.php */