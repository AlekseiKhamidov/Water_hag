<?php

	include 'amoconn.php';
//	require('config.php');
	 $link=mysqli_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS, MYSQL_DBNAME);
	$query = mysqli_query($link, "SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
    $userdata = mysqli_fetch_assoc($query);
    
    
	echo makeLeadsTableJSON($userdata['partner_name']);
?>