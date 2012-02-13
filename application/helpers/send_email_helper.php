<?php
	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$CI =& get_instance();
		$CI->load->library('email');
		$CI->email->from($CI->config->item('webmaster_email', 'tank_auth'), $CI->config->item('website_name', 'tank_auth'));
		$CI->email->reply_to($CI->config->item('webmaster_email', 'tank_auth'), $CI->config->item('website_name', 'tank_auth'));
		$CI->email->to($email);
		$CI->email->subject(sprintf($CI->lang->line('auth_subject_'.$type), $CI->config->item('website_name', 'tank_auth')));
		$CI->email->message($CI->load->view('email/'.$type.'-html', $data, TRUE));
		$CI->email->set_alt_message($CI->load->view('email/'.$type.'-txt', $data, TRUE));
		$CI->email->send();
	}
?>
