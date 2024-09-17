<?php
  session_start();
  require_once("php/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Добавить карточку проекта - FoxGame</title>
  <!-- icon -->
  <link rel="icon" href="../Image/favicon.png" type="image/png" sizes="32x32">
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
        if (isset($_POST['create']))
        {
          $query="select * from project where id_project='{$_POST['id_project']}'";
          $result=$mysqli->query($query);
          if($result->num_rows>0)
          {
            ?>
            <script>
              alert("Данный ID проекта уже существует Используйте другой");
            </script>
            <?php
          }
          else
          {
            move_uploaded_file($_FILES['photo']['tmp_name'],"Image/project/{$_FILES['photo']['name']}");
            $query="insert into project(id_project, name, rating, platform, date, link, photo) VALUES ('{$_POST['id_project']}', '{$_POST['name']}','{$_POST['rating']}', '{$_POST['platform']}','{$_POST['date']}', '{$_POST['link']}', 'Image/project/{$_FILES['photo']['name']}')";
            $mysqli->query($query);
            if ($mysqli->affected_rows>0)
            {
              ?><script>
              alert("Карточка проекта успешно добавлена");
              location.href='index.php';
              </script><?php
            }
          }
        }
  ?>

  <div class="container page-section--pd80 add-news">
  <div class="title add-news__title">Добавить карточку проекта</div>
    <form action="#" enctype="multipart/form-data" method="post" class="add-news__form">

      <p>ID проекта</p>
      <input type="text" name="id_project" value="<?php if (isset($_POST['create'])) echo $_POST['id_project']?>" class="form__input" required>

      <p>Загрузить фото для карточки</p>
      <input type="file" name="photo" accept=".jpg, .png" required>

      <p>Название проекта</p>
      <textarea class="form__textarea" name="name" required><?php if (isset($_POST['create'])) echo $_POST['name']?></textarea>

      <p>Рейтинг проекта</p>
      <textarea class="form__textarea" name="rating" required><?php if (isset($_POST['create'])) echo $_POST['rating']?></textarea>

      <p>Платформы, на которых доступен проект</p>
      <textarea class="form__textarea" name="platform" required><?php if (isset($_POST['create'])) echo $_POST['platform']?></textarea>

      <p>Дата релиза</p>
      <input type="date" name="date" value="<?php if (isset($_POST['create'])) echo $_POST['date']?>" class="form__input" required>

      <p>Ссылка</p>
      <textarea class="form__textarea" name="link" required><?php if (isset($_POST['create'])) echo $_POST['link']?></textarea>

      <button type="submit" name="create" class="button form__button">Добавить карточку проекта</button>
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