<?php
 require_once "check.php";
  require_once "../config.php";
  require_once "../mysql.php";
  //require_once "../amoconn.php";

  // if (checkLogin() == -1) {
  //   header("Location: login.php"); exit();
  // };
  function generateCode($length=6) {
      $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
      $code = "";
      $clen = strlen($chars) - 1;
      while (strlen($code) < $length) {
              $code .= $chars[mt_rand(0,$clen)];
      }
      return $code;
  }

  // Соединямся с БД
   $link=mysqli_connect(MYSQL["host"], MYSQL["login"], MYSQL["password"], MYSQL["dbname"]);

if(isset($_POST['user_login']))
{
    $err = array();

    // проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['user_login']))
    {
        $err[]  = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['user_login']) < 3 or strlen($_POST['user_login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    // проверяем, не сущестует ли пользователя с таким именем
    $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['user_login'])."'");
    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    if(isset($_POST['password'])){
        $password = md5(md5($_POST['password']));
        $hash = md5(generateCode(10));
    }
    else {
        $err[] = "Пароль пустой";
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {

        $login = $_POST['user_login'];

        // Убераем лишние пробелы и делаем двойное шифрование
        $password = md5(md5(trim($_POST['password'])));

        $partner = null;
        if(isset($_POST['partner_id'])){
            $partner =$_POST['partner_id'];
        }




        if(isset($_POST['is_admin'])){
            $isAdmin = $_POST['is_admin']=='on'?1:0;
        }
        else {
            $isAdmin =0;
        }

        if(isset($_POST['leasing'])){
            $leasing = $_POST['leasing']=='on'?1:0;
        }
        else {
            $leasing =null;
        }

        if(isset($_POST['active'])){
            $active = $_POST['active']=='on'?1:0;
        }
        else {
            $active =0;
        }

        $sql = "INSERT INTO users SET user_login='$login', user_password='$password', user_hash='$hash', is_admin='$isAdmin', leasing='$leasing', active='$active', partner_id ='".($isAdmin ? '' : $partner)."'";
    //     print_r($sql);
        processQuery($sql);

      //  header("Location: index.php"); exit();
         $response_array['status'] = 'success';
         $response_array['message'] = "Вы успешно зарегестировали";
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
}
else{
    $response_array['message'] = "submit пустой";
    $response_array['status'] = 'error';
    echo json_encode($response_array);//{"Вы ввели неправильный логин/пароль";
}
?>
