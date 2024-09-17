<?php
  session_start();
  require_once("php/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Добавить новость - FoxGame</title>
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
        if (isset($_POST['create']))
        {
          $query="select * from news where id_news='{$_POST['id_news']}'";
          $result=$mysqli->query($query);
          if($result->num_rows>0)
          {
            ?>
            <script>
              alert("Данный ID новости уже существует Используйте другой");
            </script>
            <?php
          }
          else
          {
            move_uploaded_file($_FILES['photo']['tmp_name'],"Image/news/{$_POST['id_news']}.jpg");
            $query="insert into news(id_news, title, subtitle, article, date) VALUES ({$_POST['id_news']}, '{$_POST['title']}','{$_POST['subtitle']}','{$_POST['article']}',CURDATE())";
            $mysqli->query($query);
            if ($mysqli->affected_rows>0)
            {
              ?><script>
              alert("Новость успешно добавлена");
              location.href='news.php';
              </script><?php
            }
          }
        }
  ?>

  <div class="container page-section--pd80 add-news">
  <div class="title add-news__title">Добавить новость</div>
    <form action="#" enctype="multipart/form-data" method="post" class="add-news__form">

      <p>ID новости</p>
      <input type="text" name="id_news" value="<?php if (isset($_POST['create'])) echo $_POST['id_news']?>" class="form__input" required>

        <p>Загрузить фото для обложки статьи (только формат jpg)</p>
      <input type="file" name="photo" accept=".jpg" required>

      <p>Заголовок</p>
      <textarea class="form__textarea" name="title" required><?php if (isset($_POST['create'])) echo $_POST['title']?></textarea>

      <p>Подзаголовок</p>
      <textarea class="form__textarea" name="subtitle" required><?php if (isset($_POST['create'])) echo $_POST['subtitle']?></textarea>

      <p>Текст статьи</p>
      <p><b>Подсказка:</b><br>
        Помещайте абзацы статьи между тегами: <code>&lt;p class="article__text"&gt;<b>Ваш текст
        </b>&lt;/p&gt;</code> <br>
        Для выделения текста поместите нужный текст между тегами: <code>&ltspan class="text--bold"><b>Ваш текст
        </b>&lt;/span&gt;</code> <br>
        Ссылки помещайте в тег: <code> &lt;a href="<b>Адрес ссылки</b>" class="link"&gt; <b>Текст ссылки</b>&lt;/a&gt;</code>
    </p>
      <textarea class="form__textarea form__textarea--article" name="article" required><?php if (isset($_POST['create'])) echo $_POST['article']?></textarea>

      <button type="submit" name="create" class="button form__button">Добавить новость</button>
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