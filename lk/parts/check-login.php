<?php
  require_once "check.php";
  require_once "../config.php";
  require_once "../mysql.php";
  if (checkLogin() == -1) {
    header("Location: login.php"); exit();
  };
  $userdata = getUserdata(intval($_COOKIE['id']));
  print_r($userdata);
?>
