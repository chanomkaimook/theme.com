<?php (defined('BASEPATH')) or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	public $langs;

	// for check authentications
	public $auth = true;

	public $site_configs = array();
	public $my_path = array();

	public $segment_array = [];
	public $_module;
	public $_controller;
	public $_method;

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

		$this->segment_array = $this->uri->segment_array();
		if (!$this->segment_array[3]) {
			$this->segment_array[3] = "index";
		}
		$this->_module = $this->segment_array[1];
		$this->_controller = $this->segment_array[2];
		$this->_method = $this->segment_array[3];
		print_r($this->segment_array);
		echo "<br>==========";
	}

	/**
	 * function to check all permit on controller
	 *
	 * @param array|null $dataset
	 * @return void
	 */
	public function middleware(array $dataset = null)
	{
		$this->is_alive_in();

		$this->is_logged_in();

		$this->is_permit_in($dataset);
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

	/**
	 * check permit with controller
	 * 
	 * dataset is null = method in this class to not check permit
	 * 
	 * [access]		=> check permit with method in this array value only
	 * ->[method]	=> [permit name or role name]
	 * [need]		=> check permit to every method
	 * [except]		=> not check permit with method in this array value only
	 * choose one between access with except
	 *
	 * * [access]	=> 
	 * 		[method 1]	=> [
	 * 						quotation.view,
	 * 						quotation.approve,
	 * 						bill
	 * 					],
	 * * [need]     => [quotation.view,bill] 
	 * * [except]   => [method 2,method 3]
	 * 
	 */
	public function is_permit_in(array $dataset = null)
	{

		$result = true;

		if (isset($dataset) && is_array($dataset)) {

			$data_need = [];
			$data_access = [];
			$data_except = [];

			if (isset($dataset['need']) && is_array($dataset['need'])) {
				$data_need = $dataset['need'];
			}

			if (isset($dataset['access']) && is_array($dataset['access'])) {
				$data_access = $dataset['access'];
			}

			if (isset($dataset['except']) && is_array($dataset['except'])) {
				$data_except = $dataset['except'];
			}

			if ($data_except && count($data_except)) {
				if (is_numeric(array_search($this->_method, $data_except))) {
					$result = true;
				}
			} else {

				//
				// check permit to need
				if ($data_need && count($data_need)) {
					//
					// check permit
					if (can($data_need)) {
						$need = true;
						echo "need";
					} else {
						$need = false;
						$result = false;
						echo "Nooooooooooo!!!";
					}
					//
					//
				}
				//
				//

				//
				// check permit allowed
				if ($data_access && count($data_access) && $need === true) {

					if (is_numeric(array_search($this->_method, array_keys($data_access)))) {
						if (is_array($data_access[$this->_method]) && count($data_access[$this->_method])) {
							$array = $data_access[$this->_method];

							//
							// check permit
							if (can($array) === false) {
								$result = false;
							}
							//
							//
						}
					}
				}
			}	// End if except



		}
		echo "<br><pre>";

		// print_r($data_access);
		echo "</pre><pre>";
		print_r(my_permit());
		echo "<br>";

		if ($result == false) {
			echo $this->_method . "= error permit";
		} else {
			echo $this->_method . "= success";
		}

		die;
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
