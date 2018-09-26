<?php
// Скрипт проверки
  require_once "../config.php";
  function checkLogin() {
      $link=mysqli_connect(MYSQL["host"], MYSQL["login"], MYSQL["password"], MYSQL["dbname"]);
       if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
        {
            $query = mysqli_query($link, "SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."' AND active = 1 LIMIT 1");
            $userdata = mysqli_fetch_assoc($query);


            if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))
            {
                $duration = 3600*24*7;
                setcookie("id", "", time() - $duration, "/");
                setcookie("hash", "", time() - $duration, "/");
                return false;
            } elseif ($userdata['is_admin']) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return -1;
        }
    };
?>
