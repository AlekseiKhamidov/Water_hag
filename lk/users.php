<?php require_once 'parts/users/check-login.php'	?>
<html>
 <head>
    <title>
        Пользователи
    </title>
    <?php require_once 'parts/css.php'	?>
  <?php require_once 'parts/style.php'	?>
</head>
 <body>
   <?php require_once '../parts/preloader.php'	?>
<?php require_once 'parts/users/nav-bar.php'	?>
<main>
  <div class="container-fluid">
    <?php require_once 'parts/users/table.php'	?>
    <?php require_once 'parts/users/modalForm.php'	?>
    <?php require_once 'parts/users/modalConfirmDelete.php'	?>
  </div>
</main>
<?php require_once 'parts/script-lib.php'	?>
<script>
<?php require_once 'parts/users/script-table.php'	?>
<?php require_once 'parts/users/script-form.php'	?>
</script>
</body>
</html>
