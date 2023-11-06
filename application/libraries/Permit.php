<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permit
{

	private $table = 'permit_control';
	private $permit = 'permit';

	private $control = 'permit';

	public function __construct()
	{
		//=	 call database	=//
		$this->ci = &get_instance();
		$this->ci->load->database();
		//===================//
		$this->ci->load->model('mdl_permit_control');

		$this->control = $this->ci->mdl_permit_control;
	}

	/**
	 * insert data user permit
	 *
	 * @param array|null $data = data[col=>value]
	 * @param integer|null $staff_id
	 * @return void
	 */
	function insert_data(array $data = null, int $staff_id = null)
	{
		if ($data) {
			$data['staff_id'] = $staff_id;

			return $this->control->insert_data($data);
		}
	}

	/**
	 * insert_batch data user permit
	 *
	 * @param array|null $data = data[key] => array(col=>value)
	 * @param integer|null $staff_id
	 * @return void
	 */
	function insert_batch_data(array $data = null, int $staff_id = null)
	{
		if ($data) {
			foreach($data as $key => $value){
				$data[$key]['staff_id'] = $staff_id;
			}

			return $this->control->insert_batch_data($data);
		}
	}
}
