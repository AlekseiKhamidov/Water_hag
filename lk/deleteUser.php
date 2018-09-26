<?php
 require_once "check.php";
  require_once "../config.php";
  require_once "../mysql.php";
  //require_once "../amoconn.php";

  // if (checkLogin() == -1) {
  //   header("Location: login.php"); exit();
  // };
  // Соединямся с БД
   $link=mysqli_connect(MYSQL["host"], MYSQL["login"], MYSQL["password"], MYSQL["dbname"]);


    $err = array();

    if (isset($_POST['user_id'])){
      $user_id = $_POST['user_id'];
    }
    else {
        $err[] = "id пользователя не найден";
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {
        $sql = "DELETE FROM  users  WHERE user_id=$user_id";

        processQuery($sql);

      //  header("Location: index.php"); exit();
         $response_array['status'] = 'success';
         $response_array['message'] = "Вы успешно удалили";
        echo json_encode($response_array);//{"Вы ввели неправильный логин/пароль";

    }
    else
    {
        //print "<b>При регистрации произошли следующие ошибки:</b><br>";
          $response_array['message'] = "При регистрации произошли следующие ошибки:";

        foreach($err AS $error)
        {
             $response_array['message'] =  $response_array['message']." <br />".$error;
           // print $error."<br>";
        }

         $response_array['status'] = 'error';
        echo json_encode($response_array);//{"Вы ввели неправильный логин/пароль";
    }

?>
