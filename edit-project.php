<?php
  session_start();
  require_once("php/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Изменить карточку проекта - FoxGame</title>
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
        $query="select id_project, name, rating, platform, date, link from project where id_project='{$_GET['project']}'";
        $result=$mysqli->query($query);
        $row=$result->fetch_assoc();
        
        if (isset($_POST['edit']))
        {
          if (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))
          {
            move_uploaded_file($_FILES['photo']['tmp_name'],"Image/project/{$_FILES['photo']['name']}");
            $query="update project set name='{$_POST['name']}', rating='{$_POST['rating']}', platform='{$_POST['platform']}', date='{$_POST['date']}', link='{$_POST['link']}', photo='Image/project/{$_FILES['photo']['name']}' where id_project='{$_GET['project']}'";
          }
          else
          {
            $query="update project set name='{$_POST['name']}', rating='{$_POST['rating']}', platform='{$_POST['platform']}', date='{$_POST['date']}', link='{$_POST['link']}' where id_project='{$_GET['project']}'";
          }
          $mysqli->query($query);
          if ($mysqli->affected_rows>0 || $_FILES['photo']['tmp_name']!="{$_GET['project']}.jpg" || $_FILES['photo']['tmp_name']!="{$_GET['project']}.png")
          {
            ?><script>
            alert("Карточка проекта успешно отредактирована");
            location.href='index.php';
            </script><?php
          }
        }
  ?>

  <div class="container page-section--pd80 add-news">
  <div class="title add-news__title">Редактирование карточки проекта</div>
    <form action="#" enctype="multipart/form-data" method="post" class="add-news__form">

      <p>ID проекта</p>
      <input type="text" name="id_project" value="<?= $_GET['project'] ?>" class="form__input" disabled>

      <p>Изменить фото для карточки</p>
      <input type="file" name="photo" accept=".jpg, .png">

      <p>Название проекта</p>
      <textarea class="form__textarea" name="name"><?= $row['name'] ?></textarea>

      <p>Рейтинг проекта</p>
      <textarea class="form__textarea" name="rating"><?= $row['rating'] ?></textarea>

      <p>Платформы, на которых доступен проект</p>
      <textarea class="form__textarea" name="platform"><?= $row['platform'] ?></textarea>

      <p>Дата релиза</p>
      <input type="date" name="date" value="<?= $row['date'] ?>" class="form__input">

      <p>Ссылка</p>
      <textarea class="form__textarea" name="link"><?= $row['link'] ?></textarea>

      <button type="submit" name="edit" class="button form__button">Изменить новость</button>
    </form>
  </div>
  
  <?php
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