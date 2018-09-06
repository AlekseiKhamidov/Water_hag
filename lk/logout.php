<?php
	// $duration = 3600*24*7;
	unset($_COOKIE['id']);
	unset($_COOKIE['hash']);
	setcookie("id", null, time()-1, '/', "");
  setcookie("hash", null, time()-1, '/', ""); // httponly !!!
	//	setcookie("id", null, time()-1, '/', "", TRUE, TRUE);
  //  setcookie("hash", null, time()-1, '/', "", TRUE, TRUE); // httponly !!!
    header("Location: login.php"); exit();
?>
