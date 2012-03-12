<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*
 * Done: User can't edit/delete himself
 * TODO: Handling exception from grocery_crud
 * Done: Username can't be dupliacated
 * Done: Email can't be duplicated
 *
 * 
 */

class User_crud extends DV_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('crud/grocery_crud');
        $this->grocery_crud->module = "tank_auth/user_crud";
		$this->load->library('theme/theme');		
        
    }
	
	public function _remap($method)
	{
		$this -> index();
	}
	
	public function index()
	{
		$this -> division_builder -> set_cur_seg();
				
				switch($this->uri->segment($this->division_builder->get_cur_seg()))
				{
					case 'crud-edit' :
						# $this -> set_permission('TANK_AUTH.USER_CRUD.CRUD_EDIT');
						break;
					case 'crud-update-password' :
						
						break;
				}
				
				# Checking permissions
				if ($this -> check_permission('permissions/permissions', 'permissions/permissions/default_no_permission'))
				{
					# Additional steps if no permission
					return;
				}
				
				switch($this->uri->segment($this->division_builder->get_cur_seg()))
				{
					case 'crud-edit' : # grocery_crud use 'edit' as keyword
					case 'crud-update-password' : # only for update password
    					if($this->division_builder->get_cur_seg() == 'crud-edit')
                        {
                            $this -> division_builder -> set_path('crud-edit');
                        }
                        if($this->division_builder->get_cur_seg() == 'crud-update-password')
                        {
                            $this -> division_builder -> set_path('crud-update-password');
                        }
						
						$this->edit();
						break;
                        
				}
		
	}
	
	protected function _output($output = null)
	{
		$this->load->view('tank_auth/user_crud_edit.php',$output);	
	}
	
	public function edit()
	{
	    try {
	        
	    
	    # $this->grocery_crud->set_rules('username', 'Username', 'is_unique[users.username]');
        # $this->grocery_crud->set_rules('username', 'Username', 'numeric');
        
       
        # var_dump($this->grocery_crud->CI);
        $this->grocery_crud->set_rules('username', 'Username', 'required|callback_username_check');
        $this->grocery_crud->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
        $this->grocery_crud->set_rules('password', 'Passsword', 'required|min_length[8]');
        $this->grocery_crud->set_rules('roles', 'Roles', 'required');
        
        
		$url_array = $this -> division_builder -> get_path();
        $url_all = implode('/', $url_array) . '/';
		array_pop($url_array);
   		$url = implode('/', $url_array) . '/';
		
		# $crud = new grocery_CRUD();
        
		$this->grocery_crud->set_table('users');
        
		$this->grocery_crud->columns('username', 'roles', 'email', 'activated', 'banned', 'last_login', 'created', 'modified');
		$this->grocery_crud->add_fields('username', 'roles', 'email', 'password', 'banned', 'created');
        
        $this->grocery_crud->change_field_type('created', 'hidden', 0);
        
        if($this->uri->segment($this->division_builder->get_cur_seg()) == 'crud-update-password')
        {
            $this->grocery_crud->edit_fields('password');
            $this->grocery_crud->callback_edit_field('password', array($this, 'callback_edit_password'));
            $this->grocery_crud->callback_before_update(array($this,'hash_password'));
        }
        else if($this->uri->segment($this->division_builder->get_cur_seg()) == 'crud-edit')
        {
            $this->grocery_crud->edit_fields('username', 'roles', 'email', 'banned');
            $this->grocery_crud->set_relation_n_n('roles', 'roles_users', 'roles', 'userdm_id', 'roledm_id', 'name');
            $this->grocery_crud->callback_before_update(array($this,'callback_before_update'));
        }

        $this->load->library('tank_auth/tank_auth');
        if($this->uri->segment(7) == $this->tank_auth->get_user_id())
        {
            if($this->uri->segment(6) == 'edit')
            {
                $this->grocery_crud->unset_edit();
            }
            
            if($this->uri->segment(6) == 'delete')
            {
                $this->grocery_crud->unset_delete();
            }
            
        }
		
		$this->grocery_crud->callback_before_insert(array($this,'callback_before_insert'));
        
        
		$this->grocery_crud->add_action('Smileys', 'http://www.nulledtemplates.com/images/ActiveDen-Extendable-Photo-Gallery-Rip_-evia_2.png', $url_all.'crud-update-password/index/edit');
       
        if($this->uri->segment($this->division_builder->get_cur_seg() + 2) == 'add')
        {
            
        }
        
		$output = $this->grocery_crud->render();
		$this->_output($output);
		}
catch(Exception $e){
            show_error($e->getMessage().' --- '.$e->getTraceAsString());
}
        
	}
	
    public function callback_edit_password($value, $id)
    {
       return '<input name="password" type="text" value="" maxlength="255">';
    }
    
	public function hash_password($post_array)
	{
		$this->load->library('tank_auth/tank_auth');
		$post_array['password'] = $this->tank_auth->use_hasher($post_array['password']);
    	return $post_array;
	}
    
   
    public function callback_before_insert($post_array)
    {
        $this->load->library('tank_auth/tank_auth');
        $post_array['password'] = $this->tank_auth->use_hasher($post_array['password']);
        $post_array['created'] = date('c');
        return $post_array;
    }
    
    public function callback_before_update($post_array)
    {
        
    }
   
    public function username_check($str)
    {
       
        $id = $this->uri->segment(7);
        if(!empty($id) && is_numeric($id))
        {
            $username_old = $this->db->where("id",$id)->get('users')->row()->username;
            $this->db->where("username !=", $username_old);
        }
        
        $num_row = $this->db->where('username',$str)->get('users')->num_rows();
        if ($num_row >= 1)
        {
            $this->form_validation->set_message('username_check', 'The %s field can not be the word '.$str);
            return FALSE;
        }
        else
        {
            return TRUE;
        }
   
     }
    
    public function email_check($str)
    {
        $id = $this->uri->segment(7);
        if(!empty($id) && is_numeric($id))
        {
            $email_old = $this->db->where("id",$id)->get('users')->row()->email;
            $this->db->where("email !=", $email_old);
        }
        
        $num_row = $this->db->where('email',$str)->get('users')->num_rows();
        if ($num_row >= 1)
        {
            $this->form_validation->set_message('email_check', 'The %s field can not be the word '.$str);
            return FALSE;
        }
        else
        {
            return TRUE;
        }
        
    }
}

//End
