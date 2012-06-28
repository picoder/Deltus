<?php
    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Backend_pm extends DV_Controller
    {

        public function __construct()
        {
            parent::__construct();
            # we must call it to run paren condtructor - it won't run default

            # First loading default module configs
            $this -> load -> config('backend/backend');
            $this -> load -> helper(array(
                'form',
                'url'
            ));
            $this -> load -> library('form_validation');
            $this -> load -> library('tank_auth/tank_auth');
            // For HMVC
            $this -> lang -> load($langfile = 'tank_auth', $this -> config -> item('lang'), $return = FALSE, $add_suffix = TRUE, $alt_path = '', $_module = 'tank_auth');
            //For HMVC
            $this -> load -> config('tank_auth/division_clutch');
        }

        public function _remap($method)
        {
            $this -> index();
        }

        public function index()
        {
            $this -> division_builder -> set_cur_seg();

            if ($message = $this -> session -> flashdata('message'))
            {
                $this -> load -> view('tank_auth/auth/general_message', array('message' => $message));
            }
            else
            {
                # Setting permissions
                switch($this->uri->segment($this->division_builder->get_cur_seg()))
                {
                    case $this->config->item('backend_pm_login_url') :
                        $this -> set_permission('BACKEND.BACKEND_PM.LOGIN');
                        break;
                    case $this->config->item('backend_pm_logout_url') :
                        $this -> set_permission('BACKEND.BACKEND_PM.LOGOUT');
                        break;
                    case $this->config->item('backend_pm_forgot_url') :
                        $this -> set_permission('BACKEND.BACKEND_PM.FORGOT');
                        break;
                    case $this->config->item('backend_pm_reset_url') :
                        $this -> set_permission('BACKEND.BACKEND_PM.RESET');
                        break;

                    default :
                        $this -> set_permission('BACKEND.BACKEND_PM.LOGIN');
                        break;
                }

                $this -> main_permission();

                # Setting permissions
                switch($this->uri->segment($this->division_builder->get_cur_seg()))
                {
                    case $this->config->item('backend_pm_login_url') :
                        $this -> division_builder -> set_path($this -> config -> item('backend_pm_login_url'));
                        $this -> login();
                        break;
                    case $this->config->item('backend_pm_logout_url') :
                        $this -> division_builder -> set_path($this -> config -> item('backend_pm_logout_url'));
                        $this -> logout();
                        break;
                    case $this->config->item('backend_pm_forgot_url') :
                        $this -> forgot_password();
                        break;
                    case $this->config->item('backend_pm_reset_url') :
                        $this -> reset_password();
                        break;

                    default :
                        $this -> division_builder -> set_path($this -> config -> item('backend_pm_login_url'));
                        $this -> login();
                        break;
                }
            }

        }

        public function login()
        {

            if ($this -> tank_auth -> is_logged_in())
            {
                $this -> _show_message('Your role cannot access backend. First you must logout and next login as a backend user.');
            }
            else
            {
                $data['login_by_username'] = ($this -> config -> item('login_by_username', 'tank_auth') AND $this -> config -> item('use_username', 'tank_auth'));
                $data['login_by_email'] = $this -> config -> item('login_by_email', 'tank_auth');

                $this -> form_validation -> set_rules('login', 'Login', 'trim|required|xss_clean');
                $this -> form_validation -> set_rules('password', 'Password', 'trim|required|xss_clean');
                $this -> form_validation -> set_rules('remember', 'Remember me', 'integer');

                // Get login for counting attempts to login
                if ($this -> config -> item('login_count_attempts', 'tank_auth') AND ($login = $this -> input -> post('login')))
                {
                    $login = $this -> security -> xss_clean($login);
                }
                else
                {
                    $login = '';
                }

                $data['use_recaptcha'] = $this -> config -> item('use_recaptcha', 'tank_auth');
                if ($this -> tank_auth -> is_max_login_attempts_exceeded($login))
                {
                    if ($data['use_recaptcha'])
                        $this -> form_validation -> set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
                    else
                        $this -> form_validation -> set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
                }
                $data['errors'] = array();

                if ($this -> form_validation -> run())
                {
                    // validation ok
                    if ($this -> tank_auth -> login($this -> form_validation -> set_value('login'), $this -> form_validation -> set_value('password'), $this -> form_validation -> set_value('remember'), $data['login_by_username'], $data['login_by_email']))
                    {
                        // success
                        redirect($this -> config -> item('backend_url'));

                    }
                    else
                    {
                        $errors = $this -> tank_auth -> get_error_message();
                        if (isset($errors['banned']))
                        {
                            // banned user
                            $this -> _show_message($this -> lang -> line('auth_message_banned') . ' ' . $errors['banned']);

                        }
                        elseif (isset($errors['not_activated']))
                        {
                            // not activated user
                            // if user is not sctivated he must be frontend user
                            // backend users aren't activated with email

                            redirect('auth/' . $this -> config -> item('tank_auth.send_again'));

                        }
                        else
                        {
                            // fail
                            foreach ($errors as $k => $v)
                                $data['errors'][$k] = $this -> lang -> line($v);
                        }
                    }
                }
                $data['show_captcha'] = FALSE;
                if ($this -> tank_auth -> is_max_login_attempts_exceeded($login))
                {
                    $data['show_captcha'] = TRUE;
                    if ($data['use_recaptcha'])
                    {
                        $data['recaptcha_html'] = $this -> _create_recaptcha();
                    }
                    else
                    {
                        $data['captcha_html'] = $this -> _create_captcha();
                    }
                }
                $this -> load -> view('tank_auth/auth/login_form', $data);
            }

        }

        /**
         * Generate reset code (to change password) and send it to user
         *
         * @return void
         */
        function forgot_password()
        {
            if ($this -> tank_auth -> is_logged_in())
            {
                // logged in
                redirect($this -> division_builder -> get_dv_url() . '/' . $this -> config -> item('tank_auth.login'));

            }
            elseif ($this -> tank_auth -> is_logged_in(FALSE))
            {
                // logged in, not activated
                redirect('auth/' . $this -> config -> item('tank_auth.send_again'));

            }
            else
            {
                $this -> form_validation -> set_rules('login', 'Email or login', 'trim|required|xss_clean');

                $data['errors'] = array();

                if ($this -> form_validation -> run())
                {
                    // validation ok
                    if (!is_null($data = $this -> tank_auth -> forgot_password($this -> form_validation -> set_value('login'))))
                    {

                        $data['site_name'] = $this -> config -> item('website_name', 'tank_auth');

                        // Send email with password activation link
                        $this -> _send_email('forgot_password', $data['email'], $data);

                        $this -> _show_message($this -> lang -> line('auth_message_new_password_sent'));

                    }
                    else
                    {
                        $errors = $this -> tank_auth -> get_error_message();
                        foreach ($errors as $k => $v)
                            $data['errors'][$k] = $this -> lang -> line($v);
                    }
                }
                $this -> load -> view('tank_auth/auth/forgot_password_form', $data);
            }
        }

        /**
         * Replace user password (forgotten) with a new one (set by user).
         * User is verified by user_id and authentication code in the URL.
         * Can be called by clicking on link in mail.
         *
         * @return void
         */
        function reset_password()
        {
            $user_id = $this -> uri -> segment(3);
            $new_pass_key = $this -> uri -> segment(4);

            $this -> form_validation -> set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length[' . $this -> config -> item('password_min_length', 'tank_auth') . ']|max_length[' . $this -> config -> item('password_max_length', 'tank_auth') . ']|alpha_dash');
            $this -> form_validation -> set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

            $data['errors'] = array();

            if ($this -> form_validation -> run())
            {
                // validation ok
                if (!is_null($data = $this -> tank_auth -> reset_password($user_id, $new_pass_key, $this -> form_validation -> set_value('new_password'))))
                {
                    // success

                    $data['site_name'] = $this -> config -> item('website_name', 'tank_auth');

                    // Send email with new password
                    $this -> _send_email('reset_password', $data['email'], $data);

                    $this -> _show_message($this -> lang -> line('auth_message_new_password_activated') . ' ' . anchor('/auth/login/', 'Login'));

                }
                else
                {
                    // fail
                    $this -> _show_message($this -> lang -> line('auth_message_new_password_failed'));
                }
            }
            else
            {
                // Try to activate user by password key (if not activated yet)
                if ($this -> config -> item('email_activation', 'tank_auth'))
                {
                    $this -> tank_auth -> activate_user($user_id, $new_pass_key, FALSE);
                }

                if (!$this -> tank_auth -> can_reset_password($user_id, $new_pass_key))
                {
                    $this -> _show_message($this -> lang -> line('auth_message_new_password_failed'));
                }
            }
            $this -> load -> view('tank_auth/auth/reset_password_form', $data);
        }

        public function logout()
        {
            if (!$this -> tank_auth -> is_logged_in())
            {
                redirect($this -> division_builder -> get_dv_url() . '/' . $this -> config -> item('tank_auth.login'));
            }
            $this -> tank_auth -> logout();

            $this -> _show_message($this -> lang -> line('auth_message_logged_out'));
        }

        function _show_message($message)
        {
            $this -> session -> set_flashdata('message', $message);
            redirect($this -> division_builder -> get_dv_url() . '/' . $this -> config -> item('backend_pm_index_url'));
        }

    }
