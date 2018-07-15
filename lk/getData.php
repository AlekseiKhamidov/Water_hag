<?php
	require_once "config.php";
	require_once "mysql.php";

	$partnerId = getUserdata(intval($_COOKIE['id']))['partner_id'];
	
	// print_r($partnerId."!!!!!!!!!!!!!!!!!!!!!!!\n"); 
	
	echo json_encode(selectLeads($partnerId));


?>