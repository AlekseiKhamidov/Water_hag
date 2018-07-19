<?php
  require_once "check.php";
  require_once "config.php";
  require_once "mysql.php";
  require_once "amoconn.php";

  if (checkLogin() == -1) {
    header("Location: login.php"); exit();
  };
  $userdata = getUserdata(intval($_COOKIE['id']));

if(isset($_POST['submit']))
{
    $err = array();

    // проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
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

        $partner = explode('_', $_POST['partnerSelect']);
        
        

        $isAdmin = $_POST['isAdmin'];
        
        $sql = "INSERT INTO users SET user_login='$login', user_password='$password', is_admin='".($isAdmin ? 1 : 0)."', partner_id ='".($isAdmin ? '' : $partner[0])."', partner_name='".($isAdmin ? '' : $partner[1])."'";
		// print_r($sql);
        processQuery($sql);
        
        header("Location: index.php"); exit();
        
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
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
                        РЕГИСТРАЦИЯ
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

                  <div class="form-group">
                    <label for="confirm">Повторите пароль</label>
                    <input type="password" class="form-control" name="confirm" placeholder="Повторите пароль">
                  </div>

                <div class="form-group">
                     <label for="isAdmin">
                        <input type="checkbox"  id="isAdmin" name="isAdmin">
                            Администратор
                    </label>
                  </div>


                  <label for="partnerSelect">Принадлежит организации-партнеру:</label>
    		      <select class="form-control" name="partnerSelect">
    			        <?php
    			        	include_once 'amoconn.php';
    			        	$data = getLeadCustomFieldEnums(AMO_CFID_PARTNER);
    			        	foreach ($data as $key => $value) {
    			        		echo "<option value=".$key.'_'.$value.">$value</option>";
    			        	}
    			        ?>
    		      </select>
    		      <br>
                  
                  <input name="submit" type="submit" class="btn btn-primary" value="Зарегистрировать"></input>
            </form>
            <br>
        </div>
    </div>
</form>
</body>