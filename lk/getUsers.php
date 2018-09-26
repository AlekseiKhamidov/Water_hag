 <?php

  include 'amoconn.php';
  require_once "../mysql.php";
//  include 'config.php';

 // require('config.php');
//print_r();
$current_id = getUserdata(intval($_COOKIE['id']))['user_id'];
//print_r($current_id);
  $link=mysqli_connect(MYSQL["host"], MYSQL["login"], MYSQL["password"], MYSQL["dbname"]);
    $query = mysqli_query($link, "SELECT `user_id`, `user_login`, `is_admin`, `partner_id`, `leasing`, `active` FROM `users` WHERE `user_id`<> $current_id");
  	$userdata = mysqli_fetch_all($query);
//  print_r(getLeadCustomFieldEnums(AMO_CFID_PARTNER));
  //print_r($userdata);
  	$data = NULL;
  	foreach ($userdata as $user) {
  		$data[] = array(
        'user_id' => $user[0],
 			'user_login' 	=> $user[1],
  			'is_admin' 		=> $user[2],
  			'partner_id' 	=> $user[3],
         'partner_name' 	=>isset(getLeadCustomFieldEnums(AMO_CFID_PARTNER)[$user[3]])?getLeadCustomFieldEnums(AMO_CFID_PARTNER)[$user[3]]:"" ,
        'leasing' => isset($user[4])? $user[4]:'',
        'active' => isset($user[5])? $user[5]:'',

  		);

  	}

  	$data = array('data' => $data);

  	echo json_encode($data);

  ?>
