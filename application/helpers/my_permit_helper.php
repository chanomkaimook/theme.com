<?php
error_reporting(E_ALL & ~E_NOTICE);
#
# Function recommended
# 
# check admin or master admin
# check_admin()
#

/**
 * check role data
 *
 * @param string|null $role_name
 * @param integer|null $staff_id = It's will be user login if not found
 * @return void
 */
function check_role(string $role_name = null, int $staff_id = null)
{
  $ci = &get_instance();
  $ci->load->database();

  # code...
  $result = false;

  if ($role_name && !$staff_id) {
    // convert json data permit to array
    //
    // caching
    if (!$ci->caching->get('permit_' . $ci->session->userdata('user_code'))) {
      // $permit = $ci->session->userdata('permit');

      // Save into the cache for 1 days
      // $ci->caching->save('permit', $permit);

      // $data_permit = json_decode($ci->session->userdata('permit'));
    } else {
      $data_permit = (array)json_decode($ci->caching->get('permit_' . $ci->session->userdata('user_code')));
    }

    if (is_numeric(array_search($role_name, $data_permit['roles_id_list']))) {
      $result = true;
    }
  } else {
    // set staff_id
    # codeing
  }

  return $result;
}

/**
 * check permit data
 *
 * @param array|string|null $permit_value = module/controler/method || permit id
 * @param integer|null $staff_id
 * @param string $type = permit_name_list || permit_id_list
 * @return void
 */
function check_permit($permit_value = null, int $staff_id = null, string $type = "permit_name_list")
{
  $ci = &get_instance();
  $ci->load->database();

  # code...
  $result = false;

  if ($permit_value && !$staff_id) {
    // convert json data permit to array
    //
    // caching
    if (!$ci->caching->get('permit_' . $ci->session->userdata('user_code'))) {
      // $permit = $ci->session->userdata('permit');

      // Save into the cache for 1 days
      // $ci->caching->save('permit', $permit);

      // $data_permit = json_decode($ci->session->userdata('permit'));
    } else {
      $data_permit = (array)json_decode($ci->caching->get('permit_' . $ci->session->userdata('user_code')));
    }

    if ($type == "permit_name_list") {

      if (is_array($permit_value)) {

        // loop
        foreach ($permit_value as $array_value) {
          $array_permit = explode('/', $array_value);
          if ($result != true) {
            $result = method_find_array($array_permit, $data_permit[$type]);
          }
        }
      } else {
        $array_permit = explode('/', $permit_value);
        $result = method_find_array($array_permit, $data_permit[$type]);
      }
    }
  } else {
    // set staff_id
    # codeing
  }

  return $result;
}

function method_find_array($value = null, array $dataarray = null)
{
  $result = false;

  if ($value && $dataarray) {
    if (count($value) == 3) {
      $value = implode("-", $value);

      if (is_numeric(array_search($value, $dataarray))) {
        $result = true;
      }
    } else if (count($value) == 2) {

      //
      // set default third position value = view
      $value = implode("-", $value);
      $value += "/view";

      if (is_numeric(array_search($value, $dataarray))) {
        $result = true;
      }
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

/**
 * check user id 
 *
 * @param integer|null $id
 * @return void
 */
function check_user($id = null)
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
}

/**
 * check menu html data
 *
 * @param string|null $module_name = module/controler/method || permit id
 * @param string $type = permit_name_list || permit_id_list
 * @return void
 */
function check_menu(string $module_name = null)
{
  $ci = &get_instance();
  $ci->load->database();

  # code...
  $result = false;

  // check role admin
  if (check_admin()) {
    $result = true;
  } else {
    // echo $module_name . "------------";
    if ($module_name) {
      // convert json data permit to array
      //
      // caching
      if ($ci->caching->get('permit_' . $ci->session->userdata('user_code'))) {
        $data_permit = (array)json_decode($ci->caching->get('permit_' . $ci->session->userdata('user_code')));
        // print_r($data_permit);

        if (is_numeric(array_search($module_name, $data_permit['menu_name_list']))) {
          $result = true;
        }
      }
    }
  }
  echo $result ? "++true" : "++false";
  return $result;
}







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
  $result = check_permit($module);
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

  if ($ci->session->userdata()) {
    $userid = $ci->session->userdata('user_code');

    $sql = $ci->db->from('staff')
      ->where('id', $userid)
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
  }

  // administrator
  if (check_adminRole()) {
    $result = true;
  }

  return $result;
}

function check_adminRole(int $staff_id = null)
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  $result = false;

  // role administrator
  if (check_role(1, null)) {
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

  // role masteradmin
  if (check_user(1)) {
    $result = true;
  }
  echo $ci->config->item('time_reference');
echo $result ? "true" : "fasle";
  return $result;
}
// 
// End small function
// 
