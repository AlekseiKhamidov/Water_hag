<?php
	require_once "../config.php";
	require_once "mysql.php";

	print_r($_COOKIE['id']);
//
	$partnerId = getUserdata(intval($_COOKIE['id']))['partner_id'];

//$partnerId = getUserdata(intval($_COOKIE['id']));

	 print_r($partnerId."!!!!!!!!!!!!!!!!!!!!!!!\n");

//	echo json_encode(selectLeads($partnerId));


?>
