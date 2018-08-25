<?php
	$duration = 3600*24*7;
	setcookie("id", "", time() - $duration, "/");
    setcookie("hash", "", time() - $duration, "/");
    header("Location: login.php"); exit();
?>