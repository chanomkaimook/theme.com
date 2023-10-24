<?php
error_reporting(E_ALL & ~E_NOTICE);

/**
 * check text or replace text
 *
 * @param String|null $text
 * @param String|null $replace
 * @return void
 */
function textShow(String $text = null, String $replace = null)
{
  # code...
  $result = trim($text) ? trim($text) : "";

  if ($replace && !$result) {
    $result = $replace;

  }

  return $result;
}

/**
 * check null
 *
 * @param String|null $text
 * @return void
 */
function textNull(String $text = null)
{
  # code...
  $result = null;

  if (trim($text)) {
    if ($text != "null" && $text != "NULL") {
      $result = $text;
    }
  }

  return $result;
}

if (!function_exists('mb_ucfirst')) {
  function mb_ucfirst($str, $encoding = "UTF-8", $lower_str_end = false) {
    $first_letter = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding);
    $str_end = "";
    if ($lower_str_end) {
    $str_end = mb_strtolower(mb_substr($str, 1, mb_strlen($str, $encoding), $encoding), $encoding);
    }
    else {
    $str_end = mb_substr($str, 1, mb_strlen($str, $encoding), $encoding);
    }
    $str = $first_letter . $str_end;
    return $str;
  }
}
