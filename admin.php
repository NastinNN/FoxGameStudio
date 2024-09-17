<?php
session_start();
require_once("php/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - FoxGame</title>
  <!-- icon -->
  <link rel="icon" href="Image/favicon.png" type="image/png" sizes="32x32">
   <!-- font -->
   <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- styles -->
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/admin.css">
</head>
<body>
<?php
if (isset($_POST['send']))
{
  $login=$_POST['login'];
  $pwd=$_POST['pwd'];
  $query="select * from admin where login='{$login}' and pwd='{$pwd}'";
  $result=$mysqli->query($query);
  if($result->num_rows>0)
  {
    $row=$result->fetch_assoc();
    $_SESSION['login']=$row['login'];
    ?>
    <script>
      alert ("Вы успешно авторизировались");
      location.href="index.php";
    </script>
    <?php
  }
  else {
    ?>
    <script>
      alert ("Пользователь не найден");
    </script>
    <?php
  }
}
?>
<div class="container">
<form action="#" method="post" class="form admin-form">
  <legend class="text--bold admin-form__title">Вход</legend>
  <input type="text" name="login" class="form__input admin-form__input" placeholder="Ваш логин" required>
  <input type="password" name="pwd" class="form__input admin-form__input" placeholder="Ваш пароль" required>
  <button type="submit" name="send" class="button form__button admin-form__button">Войти</button>
</form>
</div>
</body>
</html>
