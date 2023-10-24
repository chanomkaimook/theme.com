<?php
error_reporting(E_ALL & ~E_NOTICE);

/**
 * check data name duplicate
 *
 * @param Array|null $data     = array key=column on table, value=data to search
 * @param String|null $table    = table name
 * @return boolean
 */
function status_offview(int $status = null, array $optional = ['html' => true])
{
  $ci = &get_instance();
  $ci->load->database();

  # code...

  $text = 'ปกติ';
  $result = '<span class="text-success">' . $text . '</span>';

  if ($status == 1) {
    $text = 'ซ่อน';
    $result = '<span class="text-warning">' . $text . '</span>';
  }

  if ($optional['html'] == false) {
    $result = $text;
  }

  return $result;
}

function imageis(String $path = null, String $name = null, String $type = null, array $optional = [])
{
  $ci = &get_instance();
  $ci->load->database();

  # code...
  $attribute = "";
  $class = "img-thumbnail";

  if ($optional) {
    foreach ($optional as $key => $val) {
      $attribute .= $key . "=" . $val;
    }
  }

  if ($type == 'icon') {
    $targetpath = $path . "/90/" . $name;
    $class = "avatar-md rounded";
  } else {
    $targetpath = $path . $name;
  }


  $result = '<img ' . $attribute . ' src="' . $targetpath . '"
                alt="Image" class="' . $class . '" />';

  return $result;
}

function workstatus(int $status = null,string $text = null, array $optional = ['html' => true])
{
  $ci = &get_instance();
  $ci->load->database();

  # code...

  switch ($status) {
    case 1:
      $result = '<span class="badge badge-primary"> '.$text.' </span>';
      break;
    case 2:
      $result = '<span class="badge badge-warning"> '.$text.' </span>';
      break;
    case 3:
      $result = '<span class="badge badge-success"> '.$text.' </span>';
      break;
    case 4:
      $result = '<span class="badge badge-danger"> '.$text.' </span>';
      break;
    default :
      $result = '<span class="badge badge-primary"> '.$text.' </span>';
      break;
  }

  if ($optional['html'] == false) {
    $result = $text;
  }

  return $result;
}
