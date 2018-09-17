 <?php

  include 'amoconn.php';
//  include 'config.php';

 // require('config.php');

  $link=mysqli_connect(MYSQL["host"], MYSQL["login"], MYSQL["password"], MYSQL["dbname"]);
    $query = mysqli_query($link, "SELECT `user_login`, `is_admin`, `partner_name` FROM `users` WHERE `user_login`<> 'admin'");
  	$userdata = mysqli_fetch_all($query);


  	$data = NULL;
  	foreach ($userdata as $user) {
  		$data[] = array(
 			'user_login' 	=> $user[0],
  			'is_admin' 		=> $user[1] ? "Администратор" : '',
  			'partner_name' 	=> $user[2]
  		);
  	}

  	$data = array('data' => $data);

  	echo json_encode($data);

  ?>
