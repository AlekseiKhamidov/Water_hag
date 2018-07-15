<?php
// Страница авторизации
 require('config.php');
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
 $link=mysqli_connect(MYSQL_HOST, MYSQL_LOGIN, MYSQL_PASS, MYSQL_DBNAME);

if(isset($_POST['submit']))
{
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $query = mysqli_query($link,"SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    // Сравниваем пароли
    if($data['user_password'] === md5(md5($_POST['password'])))
    {
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));

        // Записываем в БД новый хеш авторизации и IP
        mysqli_query($link, "UPDATE users SET user_hash='".$hash."' WHERE user_id='".$data['user_id']."'");

        // Ставим куки
        setcookie("id", $data['user_id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30,null,null,null,true); // httponly !!!

        // Переадресовываем браузер на страницу проверки нашего скрипта
        header("Location: index.php"); exit();
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>


        <style>
            .form {
                width: 500;
                background-color: #ccdddd;
                border-radius: 10px;
            }
            .form-control {
                width: 400;
            }
        </style>
    </head>
    <body>
        <div align="center">
            <br>
            <div class="form" >
                <br>
                <form method="POST">
                    <div align="center">
                        <h1 style="font-family: Impact;">
                            АВТОРИЗАЦИЯ
                        </h1>
                    </div>
                  <div class="form-group" width=300>
                    <label for="login">Имя пользователя</label>
                    <input type="form-text" class="form-control" name="login" placeholder="Введите логин">
                  </div>
                  
                  <div class="form-group">
                    <label for="password">Пароль</label>
                    <input type="password" class="form-control" name="password" placeholder="Пароль">
                  </div>

                  <input name="submit" type="submit" class="btn btn-primary" value="Войти"></input>
                </form>
                <br>
            </div>
        </div>
    </body>
</html>