<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Roles
{

	private $table = 'roles';

	public function __construct()
	{
	}

	/**
	 * data status
	 *
	 * @param string $select
	 * @param array $optional = [column=>value]
	 * @param string $order = 'column sort,column sort'
	 * @param integer|null $limit
	 * @param integer $start
	 * @return void
	 */
	function get_data(String $select = '*', array $optional = [], String $order = 'id asc', int $limit = null, int $start = 0)
	{
		//=	 call database	=//
		$ci = &get_instance();
		$ci->load->database();
		//===================//
		$ci->load->model('mdl_permit');

		$array_permit = array();

		$sql = $ci->mdl_permit->get_dataJoinMenus(null,null,'result_array');

        $array_group = array_unique(array_column($sql, 'MENUS_CODE'));
        if ($array_group) {
            foreach ($array_group as $g_index => $g_value) {
                // find permit have menu_id = g_index
                $array_list = array_keys(array_column($sql, 'MENUS_CODE'), $g_value);

                if ($array_list) {
                    foreach ($array_list as $l_index => $l_value) {
                        $array_permit[$g_value][] = $sql[$l_value];
                    }
                }
            }
        }


		return $array_permit;
	}

	function get_status_document(){
		$optional = array(
			'alias'	=> 'document'
		);

		$result = $this->get_data(false,$optional);

		return $result;
	}

	/**
	 * get roles data
	 *
	 * @param integer|null $id = roles_id from roles_control
	 * @return void
	 */
	function get_dataRoles(int $id = null){
		//=	 call database	=//
		$ci = &get_instance();
		$ci->load->database();
		//===================//

		$result = [];
		
		if($id){
			$ci->load->model('mdl_roles_control');
			
			$result = $ci->mdl_roles_control->get_dataRoles($id);
		}

		return $result;
	}

}
