<?php
error_reporting(E_ALL & ~E_NOTICE);
#
# Function recommended
# 
# 'user_id'			      => $staff_id,
# 'roles_id_list'		  => array(roles id),
# 'permit_id_list'	  => array(permit id),
# 'permit_name_list'	=> array(permit name),
# 'menu_name_list'	  => array(menu name),
# 
# // check admin or master admin
# check_admin()
# 
# // check role roles_name_list & roles_id_list
# check_role()
#
# // check permit permit_name_list & permit_id_list
# check_permit()
#

/**
 * check role data
 *
 * @param string|null $role_name
 * @param integer|null $staff_id = It's will be user login if not found
 * @param string $nameselect = default roles_name_list || roles_id_list
 * @return void
 */
function check_role(string $role_name = null, int $staff_id = null, string $nameselect = 'roles_name_list')
{
  $ci = &get_instance();
  $ci->load->database();

  # code...
  $result = false;

  if (!$staff_id) {
    $staff_id = userlogin();
  }

  if (check_admin()) {
    $result = true;
  } else {
    if ($nameselect == 'id') {
      $nameselect = 'roles_id_list';
    }

    if ($role_name) {

      $ci->load->library('Permit');

      $data_permit = $ci->permit->get_dataPermitSet($staff_id);

      $array_permitset = $data_permit[$nameselect];

      if (is_array($role_name)) {
        // loop
        foreach ($role_name as $value) {
          if ($result != true) {
            if (is_numeric(array_search($value, $array_permitset))) {
              $result = true;
            }
          }
        }
      } else {
        if (is_numeric(array_search($role_name, $array_permitset))) {
          $result = true;
        }
      }
    }
  }


  return $result;
}

/**
 * check permit data
 *
 * @param array|string|null $permit_value = module/controler/method || permit id
 * @param integer|null $staff_id
 * @param string $type = default permit_name_list || permit_id_list
 * @return void
 */
function check_permit($permit_value = null, int $staff_id = null, string $nameselect = "permit_name_list")
{
  $ci = &get_instance();
  $ci->load->database();

  # code...
  $result = false;

  if (!$staff_id) {
    $staff_id = userlogin();
  }

  if (check_admin()) {
    $result = true;
  } else {

    if ($nameselect == 'id') {
      $nameselect = 'permit_id_list';
    }

    if ($permit_value) {

      $ci->load->library('Permit');

      $data_permit = $ci->permit->get_dataPermitSet($staff_id);

      $array_permitset = $data_permit[$nameselect];

      if (is_array($permit_value)) {
        // loop
        foreach ($permit_value as $value) {
          if ($result != true) {
            if (is_numeric(array_search($value, $array_permitset))) {
              $result = true;
            }
          }
        }
      } else {
        if (is_numeric(array_search($permit_value, $array_permitset))) {
          $result = true;
        }
      }
    }
  }

  return $result;
}

/**
 * check permit data for menu
 *
 * @param array|string|null $permit_value = module/controler/method
 * @param integer|null $staff_id
 * @param string $type = default permit_name_list || permit_id_list
 * @return void
 */
function check_menu($menu_value = null, int $staff_id = null, string $nameselect = "menu_name_list")
{
  $ci = &get_instance();
  $ci->load->database();

  # code...
  $result = false;

  if (!$staff_id) {
    $staff_id = userlogin();
  }

  if (check_admin()) {
    $result = true;
  } else {

    if ($menu_value) {

      $ci->load->library('Permit');

      $data_permit = $ci->permit->get_dataPermitSet($staff_id);

      $array_permitset = $data_permit[$nameselect];

      if (is_array($menu_value)) {
        // loop
        foreach ($menu_value as $value) {
          if ($result != true) {
            if (is_numeric(array_search($value, $array_permitset))) {
              $result = true;
            }
          }
        }
      } else {
        if (is_numeric(array_search($menu_value, $array_permitset))) {
          $result = true;
        }
      }
    }
  }

  return $result;
}

/**
 * check permit data for url
 *
 * @param array|string|null $permit_value = module/controler/method
 * @param integer|null $staff_id
 * @param string $type = default permit_name_list || permit_id_list
 * @return void
 */
function check_data($url_value = null, int $staff_id = null, string $nameselect = null)
{
  $ci = &get_instance();
  $ci->load->database();

  # code...
  $result = false;

  if (!$staff_id) {
    $staff_id = userlogin();
  }

  if (!$nameselect) {
    $nameselect = 'permit_name_list';
  }

  if (check_admin()) {
    $result = true;
  } else {

    if ($url_value) {

      $ci->load->library('Permit');

      $data_permit = $ci->permit->get_dataPermitSet($staff_id);

      $array_permitset = $data_permit[$nameselect];

      if ($data_permit[$nameselect]) {
        if (is_array($url_value)) {
          // loop
          foreach ($url_value as $value) {
            if ($result != true) {
              if (is_numeric(array_search($value, $array_permitset))) {
                $result = true;
              }
            }
          }
        } else {
          if (is_numeric(array_search($url_value, $array_permitset))) {
            $result = true;
          }
        }
      } // end if data_permit
    }
  }

  return $result;
}

/**
 * check user id 
 *
 * @param integer|null $id
 * @return void
 */
/* function check_user($id = null)
{
  $ci = &get_instance();
  $ci->load->database();

  # code...
  $result = false;
  $user_login = $ci->session->userdata('user_code');

  if ($id) {
    // convert json data permit to array
    $data_permit = (array)json_decode($ci->caching->get('permit_' . $user_login));

    if (is_array($id) && count($id)) {
      foreach ($id as $value) {
        if ($result != true) {
          $result = method_find_user($value, $data_permit, $user_login);
        }
      }
    } else {
      $result = method_find_user($id, $data_permit, $user_login);
    }
  }

  return $result;
}

function method_find_user($id, $data_permit, $userlogin)
{
  //
  // caching
  if ($data_permit['user_id']) {
    if ($data_permit['user_id'] == $id) {
      $result = true;
    }
  } else {

    if ($userlogin && $userlogin == $id) {
      $result = true;
    }
  }

  return $result;
} */








function check_permitssssssss(string $module_name = null, string $controller = null, string $method = null)
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  $result = false;

  $module = $module_name ? $module_name : $ci->uri->segment(1);

  // check role admin
  if (check_admin()) {
    $result = true;
  } else {
  }

  if (!$result) {
    redirect(site_url('error_permit'));
  }

  return $result;
}

function check_permit_menu(string $module = null)
{
  // $result = check_menu($module);
  $result = result_fromUrl($module);
  $css_name = '';

  if (!$result) {
    $css_name = 'd-none';
  }

  return $css_name;
}

// 
// Begin small function
// 

function check_userlive()
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  $userlogin = userlogin();
  if ($userlogin) {

    $sql = $ci->db->from('staff')
      ->where('id', $userlogin)
      ->where('(status !=1 or verify is null)', null, false)
      ->get();
    $num = $sql->num_rows();
    if ($num) {
      redirect(site_url('error_permit'));
    }
  }
}

function check_admin(int $staff_id = null)
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  $result = false;

  // master admin
  if (check_masterAdminRole()) {
    $result = true;
  } else {
    // administrator
    if (check_adminRole()) {
      $result = true;
    }
  }

  return $result;
}

function check_adminRole(int $staff_id = null)
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  $result = false;

  if (!$staff_id) {
    $staff_id = userlogin();
  }

  $ci->load->library('Permit');

  $data_permit = $ci->permit->get_dataPermitSet($staff_id);

  $array_permitset = $data_permit['roles_id_list'];

  if (is_numeric(array_search(1, $array_permitset))) {
    $result = true;
  }

  return $result;
}

function check_masterAdminRole(int $staff_id = null)
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  $result = false;

  if (!$staff_id) {
    $staff_id = userlogin();
  }

  // role masteradmin
  $data = $ci->config->item('masteradmin_id');

  if ($data) {
    if (is_array($data) && count($data)) {
      // loop
      if (is_numeric(array_search($staff_id, $data))) {
        $result = true;
      }
    } else {

      if ($staff_id == $data) {
        $result = true;
      }
    }
  }

  return $result;
}
// 
// End small function
// 

// 
// Begin core function
//

/**
 * defind data user
 *
 * @return int = user id
 */
function userlogin()
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  $result = "";

  if ($ci->session->userdata('user_code')) {
    $result = $ci->session->userdata('user_code');
  }

  return $result;
}

/**
 * check value from url
 *
 * @param [type] $value
 * @param array|null $dataarray
 * @return void
 */
function result_fromUrl($value = null)
{
  $result = false;

  if ($value) {
    if (count($value) == 3) {
      // convert value index to be view
      if ($value[2] == "index") {
        $value[2] == "view";
      }

      $value = implode("-", $value);

      $result = check_permit($value);

    } else if (count($value) == 2) {

      //
      // set default third position value = view
      $value = implode("-", $value);
      $value += "/view";

      $result = check_permit($value);
      
    } else if (count($value) == 1) {
      $value = (string) $value[0];
      //
      // result from function implode = 1.
      // It's mean value = menu 
      if (check_menu($value)) {
        $result = true;
      }
    }
  }

  return $result;
}
// 
// End core function
// 