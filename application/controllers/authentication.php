<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->lang->load('tank_auth');
	}

	public function index()
	{
		if ($message = $this->session->flashdata('message')) {
			echo $message;
			//$this->load->view('auth/general_message', array('message' => $message));
		} else {
			redirect('/authentication/login');
		}
	}
	
	public function login() {
		if( $this->tank_auth->is_logged_in() ) {
			/* Logged in! */
			redirect( $this->config->item('landing_page', 'tank_auth') );
		} elseif( $this->tank_auth->is_logged_in(FALSE) ) {
			/* inactive */
			redirect('/authentication/resend_activation');
		} else { 
			/* proceeed with login attempt */
			$data['login_by_username'] = ( $this->config->item('login_by_username', 'tank_auth') AND $this->config->item('use_username', 'tank_auth') );
			$data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

			$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', 'Remember me', 'integer');

			// Get login for counting attempts to login
			if( $this->config->item('login_count_attempts', 'tank_auth') AND ( $login = $this->input->post('login') ) ) {
				$login = $this->security->xss_clean($login);
			} else {
				$login = '';
			}

			$data['use_recaptcha'] = $this->config->item('use_recaptcha', 'tank_auth');
			if( $this->tank_auth->is_max_login_attempts_exceeded($login) ) {
				if( $data['use_recaptcha'] ) {
					$this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
				} else {
					$this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
				}
			}

			$data['errors'] = array();
			if( $this->form_validation->run() ) { /* validation passed */
				if( $this->tank_auth->login( $this->form_validation->set_value('login'), $this->form_validation->set_value('password'), $this->form_validation->set_value('remember'), $data['login_by_username'], $data['login_by_email'] ) ) {
					/* Logged in! */
					redirect( $this->config->item('landing_page', 'tank_auth') );
				} else {
					/* we got problems */
					$errors = $this->tank_auth->get_error_message();
					if( isset( $errors['banned'] ) ) {
						$this->_show_message( $this->lang->line('auth_message_banned') . ' ' . $errors['banned'] );
					} elseif( isset( $errors['not_activated'] ) ) {
						/* inactive */
						redirect('/authentication/resend_activation');
					} else {
						foreach($errors as $k => $v) {
							$data['errors'][$k] = $this->lang->line($v);
						}
					}
				}
			}
			
			$data['show_captcha'] = FALSE;
			if( $this->tank_auth->is_max_login_attempts_exceeded($login) ) {
				$data['show_captcha'] = TRUE;
				if( $data['use_recaptcha'] ) {
					$data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$data['captcha_html'] = $this->_create_captcha();
				}
			}
			

			$this->template->load('authentication/login_form', $data);
		} 
	}
	
	function logout()
	{
		$this->tank_auth->logout();
		$this->_show_message($this->lang->line('auth_message_logged_out'));
	}
	public function forgot_password() {
		if( $this->tank_auth->is_logged_in() ) {
			/* Logged in! */
			redirect( $this->config->item('landing_page', 'tank_auth') );
		} elseif( $this->tank_auth->is_logged_in(FALSE) ) {
			/* inactive */
			redirect('/authentication/resend_activation');
		} else { 
			$this->form_validation->set_rules('login', 'Email or login', 'trim|required|xss_clean');

			$data['errors'] = array();

			if( $this->form_validation->run() ) {
				if( !is_null( $data = $this->tank_auth->forgot_password( $this->form_validation->set_value('login') ) ) ) {

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with password activation link
					$this->_send_email('forgot_password', $data['email'], $data);

					$this->_show_message($this->lang->line('auth_message_new_password_sent'));

				} else {
					$errors = $this->tank_auth->get_error_message();
						foreach($errors as $k => $v) {
							$data['errors'][$k] = $this->lang->line($v);
						}
				}
			}
			$this->template->load('auth/forgot_password_form', $data);
		}
	}
	public function register()
	{
		if( $this->tank_auth->is_logged_in() ) {
			/* Logged in! */
			redirect( $this->config->item('landing_page', 'tank_auth') );
		} elseif( $this->tank_auth->is_logged_in(FALSE) ) {
			/* inactive */
			redirect('/authentication/resend_activation');
		} elseif( !$this->config->item('allow_registration', 'tank_auth') ) {
			/* registration disabled */
			$this->_show_message( $this->lang->line('auth_message_registration_disabled') );
		} else {
			$use_username = $this->config->item('use_username', 'tank_auth');
			if( $use_username ) {
				$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']|alpha_dash');
			}
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');

			$captcha_registration = $this->config->item('captcha_registration', 'tank_auth');
			$use_recaptcha = $this->config->item('use_recaptcha', 'tank_auth');
			if( $captcha_registration ) {
				if( $use_recaptcha ) {
					$this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
				} else {
					$this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
				}
			}
			
			$data['errors'] = array();
			$email_activation = $this->config->item('email_activation', 'tank_auth');

			if( $this->form_validation->run() ) {
				if( !is_null( $data = $this->tank_auth->create_user( $use_username ? $this->form_validation->set_value('username') : '', $this->form_validation->set_value('email'), $this->form_validation->set_value('password'), $email_activation ) ) ) {
					/* user registered! */
					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					if( $email_activation ) {

						$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;
						$this->_send_email('activate', $data['email'], $data);
						unset($data['password']); // Clear password (just for any case)
						$this->_show_message($this->lang->line('auth_message_registration_completed_1'));

					} else {
						if( $this->config->item('email_account_details', 'tank_auth') ) {
							/* Welcome Email! */
							$this->_send_email('welcome', $data['email'], $data);
						}
						unset($data['password']); // Clear password (just for any case)
						$this->_show_message($this->lang->line('auth_message_registration_completed_2').' '.anchor('/auth/login/', 'Login'));
					}
				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach($errors as $k => $v) {
						$data['errors'][$k] = $this->lang->line($v);
					}
				}
			}
			if( $captcha_registration ) {
				if( $use_recaptcha ) {
					$data['recaptcha_html'] = $this->_create_recaptcha();
				} else {
					$data['captcha_html'] = $this->_create_captcha();
				}
			}
			$data['use_username'] = $use_username;
			$data['captcha_registration'] = $captcha_registration;
			$data['use_recaptcha'] = $use_recaptcha;
			
			 
			$this->template->load('authentication/registration_form', $data);
		}
	}
	public function resend_activation() {
		if( !$this->tank_auth->is_logged_in(FALSE) ) {
			redirect('/authentication/login');
		} else {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
			
			$data['errors'] = array();

			if( $this->form_validation->run() ) {
				if( !is_null( $data = $this->tank_auth->change_email( $this->form_validation->set_value('email') ) ) ) {
					$data['site_name']	= $this->config->item('website_name', 'tank_auth');
					$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

					$this->_send_email('activate', $data['email'], $data);

					$this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));
				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->template->load('authentication/resend_activation_form', $data);
		}
	}

	/**
	 * Show info message
	 * 
	 * THIS SHOULD BE REPLACED WITH FINISHED NOTIFICATIONS SYSTEM!!
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_message($message)
	{
		$this->session->set_flashdata('message', $message);
		redirect('/authentication');
	}


	/* 
	 * 
	 * CAPTCHA AND EMAIL FUNCTIONS
	 * 
	 * */



	/**
	 * Create CAPTCHA image to verify user as a human
	 *
	 * @return	string
	 */
	function _create_captcha()
	{
		$this->load->helper('captcha');

		$cap = create_captcha(array(
			'img_path'		=> './'.$this->config->item('captcha_path', 'tank_auth'),
			'img_url'		=> base_url().$this->config->item('captcha_path', 'tank_auth'),
			'font_path'		=> './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
			'font_size'		=> $this->config->item('captcha_font_size', 'tank_auth'),
			'img_width'		=> $this->config->item('captcha_width', 'tank_auth'),
			'img_height'	=> $this->config->item('captcha_height', 'tank_auth'),
			'show_grid'		=> $this->config->item('captcha_grid', 'tank_auth'),
			'expiration'	=> $this->config->item('captcha_expire', 'tank_auth'),
		));

		// Save captcha params in session
		$this->session->set_flashdata(array(
				'captcha_word' => $cap['word'],
				'captcha_time' => $cap['time'],
		));

		return $cap['image'];
	}

	/**
	 * Callback function. Check if CAPTCHA test is passed.
	 *
	 * @param	string
	 * @return	bool
	 */
	function _check_captcha($code)
	{
		$time = $this->session->flashdata('captcha_time');
		$word = $this->session->flashdata('captcha_word');

		list($usec, $sec) = explode(" ", microtime());
		$now = ((float)$usec + (float)$sec);

		if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
			return FALSE;

		} elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
				$code != $word) OR
				strtolower($code) != strtolower($word)) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Create reCAPTCHA JS and non-JS HTML to verify user as a human
	 *
	 * @return	string
	 */
	function _create_recaptcha()
	{
		$this->load->helper('recaptcha');

		// Add custom theme so we can get only image
		$options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

		// Get reCAPTCHA JS and non-JS HTML
		$html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'));

		return $options.$html;
	}

	/**
	 * Callback function. Check if reCAPTCHA test is passed.
	 *
	 * @return	bool
	 */
	function _check_recaptcha()
	{
		$this->load->helper('recaptcha');

		$resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'),
				$_SERVER['REMOTE_ADDR'],
				$_POST['recaptcha_challenge_field'],
				$_POST['recaptcha_response_field']);

		if (!$resp->is_valid) {
			$this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

}

