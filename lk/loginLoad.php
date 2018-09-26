<?php
// Страница авторизации
 require('../config.php');
// Функция для генерации случайной строки
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
if(isset($_POST['login']))
{
  //  print_r($_POST['login']);
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($link,"SELECT user_id, user_password FROM users WHERE active=1 AND user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);
    // print_r($data);
    // Сравниваем пароли
    if($data['user_password'] === md5(md5($_POST['password'])))
    {
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));
        // Записываем в БД новый хеш авторизации и IP
        mysqli_query($link, "UPDATE users SET user_hash='".$hash."' WHERE user_id='".$data['user_id']."'");
        // Ставим куки
        $duration = 3600*24*7;
        setcookie("id", $data['user_id'], time()+$duration, '/', "");
        //setcookie("id", $data['user_id'], time()+$duration, '/', "", TRUE, TRUE);

        setcookie("hash", $hash, time()+$duration, '/', ""); // httponly !!!
    //    setcookie("hash", $hash, time()+$duration, '/', "", TRUE, TRUE); // httponly !!!
    //     print_r("ВГОВНЕЕ".$_COOKIE['hash']);
        // Переадресовываем браузер на страницу проверки нашего скрипта
        // header("Location: index.php"); exit();
        exit();
    }
    else
    {
    	   header('Content-type: application/json');
         $response_array['status'] = 'error';
         $response_array['message'] = "Вы ввели неправильный логин/пароль";
       //  print_r($response_array);
       //  echo json_encode($response_array);
    //	print_r("Вы ввели неправильный логин/пароль");
//echo "Вы ввели неправильный логин/пароль";
        echo json_encode($response_array);//{"Вы ввели неправильный логин/пароль";
    }
   // echo "Вы ввели неправильный логин/пароль";
}
//echo "Вы ввели неправильный логин/пароль";
?>
