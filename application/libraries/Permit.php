<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permit
{

	private $table = 'permit_control';
	private $permit;

	private $control;
	private $roles;

	public function __construct()
	{
		//=	 call database	=//
		$this->ci = &get_instance();
		$this->ci->load->database();
		//===================//
		$this->ci->load->model('mdl_permit');
		$this->ci->load->model('mdl_permit_control');
		$this->ci->load->model('mdl_roles_control');

		$this->permit = $this->ci->mdl_permit;
		$this->control = $this->ci->mdl_permit_control;
		$this->roles = $this->ci->mdl_roles_control;
	}

	/**
	 * get data set for authentication
	 *
	 * @return array $result = [role_id,permit_id,permit_name]
	 */
	function get_dataPermitSet(int $staff_id = null)
	{
		// variable for ban or allow
		$permit_allow = [];
		$permit_ban = [];

		// variable for data set
		$roles_id_list = [];
		$permit_id_list = [];
		$permit_name_list = [];
		$menu_name_list = [];

		if ($staff_id) {
			$query_permit = $this->control->get_dataStaff($staff_id);

			if ($query_permit) {
				foreach ($query_permit as $row_permit) {
					if ($row_permit->ROLES_ID) {
						$role_id = $row_permit->ROLES_ID;
						$roles_id_list[] =  $role_id;

						$q_in_1 = $this->roles->get_dataRoles($role_id);

						if ($q_in_1) {
							foreach ($q_in_1 as $row_in_1) {
								if ($row_in_1->CODE) {
									$permit_name_list[] = $row_in_1->CODE;
								}

								if ($row_in_1->MENUS_CODE) {
									$menu_name_list[] = $row_in_1->MENUS_CODE;
								}
							}
						}
					}	// end role list

					if ($row_permit->PERMIT_ID) {
						$permit_id = $row_permit->PERMIT_ID;
						$permit_id_list[] =  $permit_id;

						$q_in_2 = $this->permit->get_data($permit_id);

						if ($q_in_2) {
							foreach ($q_in_2 as $row_in_2) {
								if ($row_in_2->CODE) {
									$permit_name_list[] = $row_in_2->CODE;
								}

								if ($row_in_2->MENUS_CODE) {
									$menu_name_list[] = $row_in_2->MENUS_CODE;
								}
							}
						}
					}	// end permit list
				}
			}
		}

		$result = array(
			'user_id'			=> $staff_id,
			'roles_id_list'		=> array_unique($roles_id_list),
			'permit_id_list'	=> array_unique($permit_id_list),
			'permit_name_list'	=> array_unique($permit_name_list),
			'menu_name_list'	=> array_unique($menu_name_list)
		);

		return $result;
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
			foreach ($data as $key => $value) {
				$data[$key]['staff_id'] = $staff_id;
			}

			return $this->control->insert_batch_data($data);
		}
	}
}
