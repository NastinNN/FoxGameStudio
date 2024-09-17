<?php
session_start();
require_once("php/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Удалить карточку проекта - FoxGame</title>
  <!-- icon -->
  <link rel="icon" href="Image/favicon.png" type="image/png" sizes="32x32">
  <!-- font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- styles -->
  <link rel="stylesheet" href="styles/hamburgers.min.css">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/NewsStyle.css">
  <link rel="stylesheet" href="styles/media.css">
  <link rel="stylesheet" href="styles\admin.css">
</head>
<body>
<?php
require_once("assets/header.php");

if (isset($_SESSION['login']))
{
    $query="delete from project where id_project='{$_GET['project']}'";
    $mysqli->query($query);
    if ($mysqli->affected_rows>0)
    {
      ?>
      <script>
      alert("Карточка проекта успешно удалена");
      location.href='index.php';
      </script>
      <?php
    }
}
else
{
  ?>
    <div class="access access--error">
      <p>У вас нет доступа</p>
      <img src="Image\admin\no-access.png" alt="" width="500" height="500">
    </div>
  <?php
}
require_once("assets/footer.php");
?>
</body>
</html>