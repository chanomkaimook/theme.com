<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	public $langs;

	// for check authentications
	public $auth = true;

	public $site_configs = array();
	public $my_path = array();

	public function __construct()
	{
		parent::__construct();

		$this->_hmvc_fixes();

		// $this->load->model('api_model');
		// if (empty($this->input->get_post('domain'))) {
		// 	exit;
		// }

		// $site = $this->api_model->find_api_key($this->input->get_post('domain'));
		// //   echo '<pre>'; print_r($site); exit;
		// if ($site) {
		// 	$this->site_configs = $site;
		// }
		// echo '<pre>'; print_r($this->site_configs);
		// echo '<pre>'; print_r($_POST); exit;

		//
		// path
		$this->my_path = $this->uri->uri_string();

		//
		//	set language
		if ($_COOKIE['langadmin'] == NULL) {
			$this->langs = "thai";
		} else {
			$this->langs = $_COOKIE['langadmin'];
		}

		$this->lang->load('main', $this->langs);
		$this->lang->load('menu', $this->langs);
	}

	/**
	 * middle ware
	 *
	 * @param integer|null $level 1 = check login only not check permit
	 * @return void
	 */
	public function middleware(int $level = null)
	{
		$this->is_alive_in();

		if ($level and $level == 1) {
			$this->is_logged_in();
		} else {
			$this->is_logged_in();

			$this->is_permit_in();
		}
	}

	public function is_logged_in()
	{
		$result = false;

		// Load Authorization Library
		$this->load->library('authorization_token');
		// check from library auth session and API
		$this->auth = $this->authorization_token->validateToken();
		// die;
		if (isset($this->auth['status']) and $this->auth['status'] === true) {
			$result = true;
		}

		if ($result == false) {
			// User is token expire in.  Do something.
			session_destroy();

			redirect(site_url('login/ctl_login'));
		}
	}

	public function is_permit_in()
	{
		$this->load->helper('My_permit');

		$result = get_permitPath($this->my_path);

		if ($result == false) {
			redirect(site_url('error_permit'));
		}
	}

	public function is_alive_in()
	{
		$this->load->helper('My_permit');
		$result = check_userlive();

		if ($result == false) {
			session_destroy();
			
			redirect(site_url('login/ctl_login'));
		}
	}

	function _hmvc_fixes()
	{
		//fix callback form_validation		
		//https://bitbucket.org/wiredesignz/codeigniter-modular-extensions-hmvc
		$this->load->library('form_validation');
		$this->form_validation->CI = &$this;
	}
}
