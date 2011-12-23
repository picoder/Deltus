<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_lib
{
	public $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	# Add filename to tempimages table
	# If this image won't be linked with gallery system we must delete it
	# In case user doesn't click submit or ends work with gallery
	public function add_tempfile($filename)
	{
		$this->CI->load->library('tank_auth/tank_auth');
		$ti = new Tempimagedm();
		$ti->tempfilename = $filename;
		$ti->created = date('c');
		$u = new Userdm();
		$u->where('id', $this->CI->tank_auth->get_user_id())->get();
		$ti->save($u);	
	}
	
	public function delete_tempfile()
	{
		
	}
	
	public function get_last_gallery()
	{
		$g = new Gallerydm;
		$last_id = 0;
		$g->select_max('id')->get();
		if($g->id)
		{
			 $last_id = $g->id;
		}
		return $last_id;
	}
	
	public function create_img_form_item($img_filename, $gallery_dirname)
	{
		$item = '<div class="v_f gallery_item v">';
		
		$dot_pos = strripos($img_filename, '.');
		$name = substr($img_filename, 0, $dot_pos);
		$ext = substr($img_filename, $dot_pos + 1);
		
		$item .= '<div class="l left_1"><label for="'.$img_filename.'"/>'.$img_filename.'</label></div>';
		
		if($ext == 'jpg' OR $ext == 'gif' OR $ext == 'png' OR $ext == 'jpeg' OR $ext == 'GIF' OR $ext == 'PNG' OR $ext == 'JPEG' OR $ext == 'JPG')
		{
			$img = '<div class="l left_2"><img src="'.base_url().'uploads/galleries/'.$gallery_dirname.'/miniatures/'.$name.'_thumb.'.$ext.'" alt="'.$img_filename.'" /></div>';
		}
		else
		{
			$img = '<div class="l left_2">Brak miniatury</div>';
		}
		
		$item .= $img;
		
		$item .= '<div class="e o"><div class="last_col_inner"><input type="checkbox" name="images[]" value="'.$img_filename.'" id="'.$img_filename.'"/></div></div>';
		
		$item .= '</div>';
		return $item;	
	}
	
	public function files_in_gallery($gallery_dirname)
	{
		$this->CI->load->helper(array('directory'));
		if( ! is_dir('uploads/galleries/'.$gallery_dirname))
		{
			die('uploads/galleries/'.$gallery_dirname.' does not exist');	
		}
		$map = directory_map('uploads/galleries/'.$gallery_dirname, 1);
		
		$images = array();
		foreach($map as $item)
		{
			if(is_file('uploads/galleries/'.$gallery_dirname.'/'.$item))
			{
				$images[] = $item;
			}
		}
		return $images;
	}
	
	# deletes image and its thumbnail
	public function delete_gallery_item($img_filename, $gallery_dirname)
	{
		if(file_exists('uploads/galleries/'.$gallery_dirname.'/'.$img_filename))
		{
			$org = unlink('uploads/galleries/'.$gallery_dirname.'/'.$img_filename);
		}
		else
		{
			die($img_filename.' does not exist');
		}
		
		$dot_pos = strripos($img_filename, '.');
		$name = substr($img_filename, 0, $dot_pos);
		$ext = substr($img_filename, $dot_pos + 1);
		
		#connected with formats sets in plupload header file in filters
		if($ext == 'jpg' OR $ext == 'gif' OR $ext == 'png' OR $ext == 'jpeg' OR $ext == 'GIF' OR $ext == 'PNG' OR $ext == 'JPEG' OR $ext == 'JPG')
		{
			if(file_exists('uploads/galleries/'.$gallery_dirname.'/miniatures/'.$name.'_thumb.'.$ext))
			{
				$thumb = unlink('uploads/galleries/'.$gallery_dirname.'/miniatures/'.$name.'_thumb.'.$ext);
			}
			else
			{
				die($name.'_thumb'.$ext.' does not exist');
			}
		}
		
		if($org AND $thumb)
		{
			return TRUE;
		}
		else
		{ 
			return FALSE;
		}	
	}
	
	# param $gallery_id dirs have the same name like id of gallery in database
	public function gallery_items_form_part($gallery_id)
	{
		$form_part = '<div class="v v_f table_edit_header">
		<div class="l left_1">Nazwa</div><div class="l left_2">Miniatura</div><div class="e o t_right">Usuń</div>
		</div>';
		$images = $this->files_in_gallery($gallery_id);
		if(empty($images))
		{
			return FALSE;
		}
		foreach($images as $image)
		{
			$form_part .= $this->create_img_form_item($image, $gallery_id);
		}	
		return $form_part;
	}
	
	public function init_plupload()
	{
		$this->CI->matchbook->add_head_snippet('gallery/parts/plupload_head_queue');
	}
	
	public function after_validation_fails()
	{
		$this->CI->matchbook->add_head_snippet('gallery/parts/plupload_head_queue');
		
		if($files_counter = $this->CI->input->post('uploader_count'))
		{
			// delete files sending on serwer through pluploud
			for($i = 0; $i < $files_counter; $i++)
			{
				if(file_exists('uploads/galleries/'.$this->CI->input->post('uploader_'.$i.'_tmpname')))
				{
					unlink('uploads/galleries/'.$this->CI->input->post('uploader_'.$i.'_tmpname'));
				}
			}
		}
	}
	
	public function add_files_to_gallery($gallery_folder)
	{
		$this->CI->load->library('image_lib');
		
		for($i = 0; $i < $this->CI->input->post('uploader_count'); $i++)
		{
			if(file_exists('uploads/galleries/'.$this->CI->input->post('uploader_'.$i.'_tmpname')))
			{
				if (copy('uploads/galleries/'.$this->CI->input->post('uploader_'.$i.'_tmpname'),'uploads/galleries/'.$gallery_folder.'/'.$this->CI->input->post('uploader_'.$i.'_name'))) 
				{
					
					unlink('uploads/galleries/'.$this->CI->input->post('uploader_'.$i.'_tmpname'));
					
					$ext = substr($this->CI->input->post('uploader_'.$i.'_tmpname'), strpos($this->CI->input->post('uploader_'.$i.'_tmpname'),'.') + 1);
					if($ext == 'jpg' OR $ext == 'gif' OR $ext == 'png' OR $ext == 'jpeg' OR $ext == 'GIF' OR $ext == 'PNG' OR $ext == 'JPEG' OR $ext == 'JPG')
					{
						$config = array();
						if($this->CI->input->post('uploader_'.$i.'_name') == 'pati.jpg')
						{
							$config['image_library'] = 'gd2';
							$config['source_image'] = 'uploads/galleries/'.$gallery_folder.'/'.$this->CI->input->post('uploader_'.$i.'_name');
							$config['create_thumb'] = TRUE;
							$config['maintain_ratio'] = TRUE;
							$config['width'] = 134;
							$config['height'] = 100;
							$config['new_image'] = 'uploads/galleries/'.$gallery_folder.'/widget/'.$this->CI->input->post('uploader_'.$i.'_name');
							
							$this->CI->image_lib->initialize($config); 
												
							if ( ! $this->CI->image_lib->resize())
							{
								die($this->CI->image_lib->display_errors());
							}
						}
						if($this->CI->input->post('uploader_'.$i.'_name') == 'l.jpg' OR $this->CI->input->post('uploader_'.$i.'_name') == 'r.jpg')
						{
							$config['image_library'] = 'gd2';
							$config['source_image'] = 'uploads/galleries/'.$gallery_folder.'/'.$this->CI->input->post('uploader_'.$i.'_name');
							$config['create_thumb'] = TRUE;
							$config['maintain_ratio'] = TRUE;
							$config['width'] = 220;
							$config['height'] = 140;
							$config['new_image'] = 'uploads/galleries/'.$gallery_folder.'/widget/'.$this->CI->input->post('uploader_'.$i.'_name');
							
							$this->CI->image_lib->initialize($config); 
												
							if ( ! $this->CI->image_lib->resize())
							{
								die($this->CI->image_lib->display_errors());
							}
						}
						$config = array();
						$config['image_library'] = 'gd2';
						$config['source_image'] = 'uploads/galleries/'.$gallery_folder.'/'.$this->CI->input->post('uploader_'.$i.'_name');
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 75;
						$config['height'] = 50;
						$config['new_image'] = 'uploads/galleries/'.$gallery_folder.'/miniatures/'.$this->CI->input->post('uploader_'.$i.'_name');
						
						
						$this->CI->image_lib->initialize($config); 
												
						if ( ! $this->CI->image_lib->resize())
						{
							die($this->CI->image_lib->display_errors());
						}
					}
					# deleting entry in tempimages table after success
					$this->CI->load->library('tank_auth/tank_auth');
					$u = new Userdm();
					$u->where('id', $this->CI->tank_auth->get_user_id())->get();
					$u->tempimagedm->get();
					foreach($u->tempimagedm as $file)
					{
						$file->delete();	
					}
					
				}						
			}
		}
	}
	
	public function after_add_validation_passes($gallery_id)
	{			
		$new_gallery_folder = strval($gallery_id);
		
		# we must delete dir with the same name if exists
		if(file_exists('uploads/galleries/'.$new_gallery_folder))
		{
			# to delete dir with its content
			$this->CI->load->helper('directory');
			delete_dir_with_files('uploads/galleries/'.$new_gallery_folder);
		}
		
		// we must create dir for gallery before gallery item in databse because of id numeration
		if(mkdir('uploads/galleries/'.$new_gallery_folder) AND mkdir('uploads/galleries/'.$new_gallery_folder.'/miniatures') AND mkdir('uploads/galleries/'.$new_gallery_folder.'/widget'))
		{
			// for future
		}
		else
		{
			die('System cannot create directory for gallery');
		}
		
		$this->add_files_to_gallery($new_gallery_folder);		
	}
	
}

/* End of file gallery_lib.php */
/* Location: ./modules/role/libraries/gallery_lib.php */