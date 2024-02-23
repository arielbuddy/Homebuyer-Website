<?php

$countyName = get_query_var('county_name');

if ($countyName) {
  if (file_exists(dirname(__FILE__) . "/mortgage-loan-limits/$countyName.php")) {
    require_once("mortgage-loan-limits/$countyName.php");
    exit;
  }
  global $wp_query;
  $wp_query->set_404();
  status_header(404);
  require_once("404.php");
  exit;
}

require_once("mortgage-loan-limits/national.php");
