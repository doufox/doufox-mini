<?php
ini_set("display_errors", "On");
error_reporting(E_ALL);

require_once 'tags.php';
require_once PATH_ROOT . '/data/config.php';

function app_404()
{
  header('HTTP/1.0 404 Not Found');
  echo "<h1>404 Not Found</h1>";
  echo "The page that you have requested could not be found.";
  exit();
}

function mc_get_url($mc_get_type, $mc_get_name = '', $path = '', $print = true)
{
  global $dp_config;
  $r = @$dp_config['site_route'] == 'path' ? '/' : '/?';
  $t = empty($mc_get_type) ? '' : $mc_get_type;
  $n = empty($mc_get_name) ? '' : '/' . $mc_get_name;

  $url = $r . $t . $n;
  $url = str_replace('//', '/', $url);
  $url = $dp_config['site_link'] . $url;

  if ($print) {
    echo $url;
    return;
  }

  return $url;
}

function dp_check_login()
{
  if (isset($_COOKIE['mc_token'])) {
    $token = $_COOKIE['mc_token'];
    global $dp_config;
    if ($token != md5($dp_config['user_name'] . '_' . $dp_config['user_pass'])) {
      Header("Location:login.php");
      exit;
    }
  } else {
    Header("Location:login.php");
    exit;
  }
}
