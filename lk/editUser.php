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

    if (isset($_POST['user_id'])){
      $user_id = $_POST['user_id'];
    }
    else {
        $err[] = "id пользователя не найден";
    }

    // проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['user_login']))
    {
        $err[]["error"] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['user_login']) < 3 or strlen($_POST['user_login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }
    $password = "";
    $hash="";

    if (isset($_POST['changePass'])){
      if ($_POST['changePass'] == 'on'){
        if(isset($_POST['password'])){
            $password = " user_password='".md5(md5(trim($_POST['password'])))."', ";
            $hash = " user_hash='".md5(generateCode(10))."', ";
        }
        else {
            $err[] = "Пароль пустой";
        }
      }
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {

        $login = $_POST['user_login'];

        // Убераем лишние пробелы и делаем двойное шифрование
      //  $password ="user_password=".md5(md5(trim($_POST['password'])));

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



        $sql = "UPDATE  users SET user_login='$login', $password $hash is_admin='$isAdmin', leasing='$leasing', active='$active', partner_id ='".($isAdmin ? '' : $partner)."' WHERE user_id=$user_id";

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
