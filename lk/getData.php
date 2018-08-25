<?php
	require_once "../config.php";
	require_once "mysql.php";

//	print_r($_COOKIE['id']);
//
	$partnerId = getUserdata(intval($_COOKIE['id']))['partner_id'];

	$startdate = isset($_GET['start']) ? $_GET['start'] : strtotime('-1 month');
	$enddate = isset($_GET['end']) ? $_GET['end'] : strtotime('now');
//$partnerId = getUserdata(intval($_COOKIE['id']));
	// print_r($partnerId."!!!!!!!!!!!!!!!!!!!!!!!\n");
	echo json_encode(selectLeads($partnerId, $startdate, $enddate));
?>
