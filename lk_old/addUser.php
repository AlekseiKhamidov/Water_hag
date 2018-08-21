<?php
 require_once "check.php";
  require_once "config.php";
  require_once "mysql.php";
  require_once "amoconn.php";

  // if (checkLogin() == -1) {
  //   header("Location: login.php"); exit();
  // };

  // Соединямся с БД
 $link=mysqli_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS, MYSQL_DBNAME);

if(isset($_POST['login']))
{
    $err = array();

    // проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[]["error"] = "Логин может состоять только из букв английского алфавита и цифр";
    }

    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
    {
        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
    }

    // проверяем, не сущестует ли пользователя с таким именем
    $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='".mysqli_real_escape_string($link, $_POST['login'])."'");
    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {

        $login = $_POST['login'];

        // Убераем лишние пробелы и делаем двойное шифрование
        $password = md5(md5(trim($_POST['password'])));

        $partner = null;
        if(isset($_POST['partnerSelect'])){
            $partner =$_POST['partnerSelect'];
        }
        
        
        if(isset($_POST['isAdmin'])){
            $isAdmin = $_POST['isAdmin'];
        }
        else {
            $isAdmin =0;
        }
        
        $sql = "INSERT INTO users SET user_login='$login', user_password='$password', is_admin='".($isAdmin ? 1 : 0)."', partner_id ='".($isAdmin ? '' : $partner)."'";
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
