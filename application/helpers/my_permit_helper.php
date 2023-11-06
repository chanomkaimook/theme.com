<?php
error_reporting(E_ALL & ~E_NOTICE);

function check_role(string $role_name = null)
{
  $ci = &get_instance();
  $ci->load->database();

  # code...
  $result = false;

  if ($role_name) {
    // convert json data permit to array
    //
    // caching
    if (!$ci->caching->get('permit')) {
      // $permit = $ci->session->userdata('permit');

      // Save into the cache for 1 days
      // $ci->caching->save('permit', $permit);

      // $data_permit = json_decode($ci->session->userdata('permit'));
    } else {
      // $data_permit = json_decode($ci->caching->get('authorization'));
      $data_permit = $ci->caching->get('permit');
    }
    echo "<pre>";
    print_r($data_permit);
    /* if (is_numeric(array_search($role_name, $data_permit))) {
      $result = true;
    } */
  }

  return $result;
}
#
# role    | value
#
# 1       | administrator
function check_session(string $module_name = null)
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  $role = $ci->session->userdata('role');

  $module = $module_name ? $module_name : $ci->uri->segment(1);
  $result = false;

  /*   echo "<pre>";
  print_r($ci->session->userdata());
    echo $module;

    $default = array('name', 'index','gender', 'location', 'type', 'sort');
$array = $ci->uri->segment_array();
if($ci->uri->segment(3) == false){
  $array[3] = 'view';
}
echo "<pre>";
print_r($array);
  exit; */


  if ($ci->session->userdata('user_code') == 1) {
    $result = true;
  } else {
    // role administrator
    // convert json data permit to array
    $data_permit = json_decode($ci->session->userdata('permit'));

    if (is_numeric(array_search($module, $data_permit)) && $ci->session->userdata('permit')) {
      $result = true;
    }
  }



  return $result;
}

function check_userlive()
{
  $ci = &get_instance();
  $ci->load->database();
  # code...
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

function check_permit(string $module_name = null, string $controller = null, string $method = null)
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  $result = false;
  $result = true;
  $module = $module_name ? $module_name : $ci->uri->segment(1);

  if (check_admin()) {
    $result = true;
  } else {

  }

  if (!$result) {
    redirect(site_url('error_permit'));
  }
}

function check_permit_menu(string $module = null, string $controller = null, string $method = null)
{
  $result = check_permit($module, $controller, $method);
  $css_name = '';

  if (!$result) {
    $css_name = 'd-none';
  }

  return $css_name;
}

// 
// Function
// 
function check_operator()
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  $result = false;

  if ($ci->session->userdata('role_level') >= 20 && $ci->session->userdata('role_level') <= 29) {
    $result = true;
    return $result;
  }
}

function check_supervisor()
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  $result = false;

  if ($ci->session->userdata('role_level') <= 19) {
    $result = true;
    return $result;
  }
}

function check_admin(int $staff_id = null)
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  $result = false;

  // master admin
  if ($ci->session->userdata('user_code') == 1) {
    $result = true;
  }

  return $result;
}

function check_adminRole(int $staff_id = null)
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  // role administrator
  if (check_role('administrator')) {
    // check_role('administrator');
    $result = true;
  }
}

function is_Mobile()
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  include FCPATH . "mobile_detect.php";
  $ci->_detect = new Mobile_Detect();

  return $ci->_detect->isMobile();
}

function check_helpdesk()
{
  $ci = &get_instance();
  $ci->load->database();
  # code...

  $result = false;

  if ($ci->session->userdata('role_level') == 11) {
    $result = true;
    return $result;
  }
}

// 
// End Function
// 
