<?php
  require_once "../amoCRMFunctions.php";
  require_once "../mysql.php";

  $partnerId = getUserdata(
    isset($_COOKIE['id']) ? intval($_COOKIE['id']) : 0
    )['partner_id'];

  $startdate = isset($_GET['start']) ? $_GET['start'] : strtotime('-1 month');
  $enddate = isset($_GET['end']) ? $_GET['end'] : strtotime('now');

  echo selectLeads($partnerId, $startdate, $enddate);
?>
