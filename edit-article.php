<?php
  session_start();
  require_once("php/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Изменить новость - FoxGame</title>
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
        $query="select id_news, title, subtitle, article, date from news where id_news='{$_GET['article']}'";
        $result=$mysqli->query($query);
        $row=$result->fetch_assoc();
        
        if (isset($_POST['edit']))
        {
          move_uploaded_file($_FILES['photo']['tmp_name'],"Image/news/{$_GET['article']}.jpg");
          $query="update news set title='{$_POST['title']}',subtitle='{$_POST['subtitle']}', article='{$_POST['article']}', date='{$_POST['date']}' where id_news='{$_GET['article']}'";
          $mysqli->query($query);
          if ($mysqli->affected_rows>0 || $_FILES['photo']['tmp_name']!="{$_GET['article']}.jpg")
          {
            ?><script>
            alert("Новость успешно отредактирована");
            location.href='news.php';
            </script><?php
          }
        }
  ?>

  <div class="container page-section--pd80 add-news">
  <div class="title add-news__title">Редактирование новости</div>
    <form action="#" enctype="multipart/form-data" method="post" class="add-news__form">

      <p>ID новости</p>
      <input type="text" name='id' value="<?= $_GET['article'] ?>" class="form__input" disabled>

      <p>Изменить обложку статьи (только формат jpg)</p>
      <input type="file" name="photo" accept=".jpg">

      <p>Заголовок</p>
      <textarea class="form__textarea" name="title" required><?= $row['title']?></textarea>

      <p>Подзаголовок</p>
      <textarea class="form__textarea" name="subtitle" required><?= $row['subtitle']?></textarea>

      <p>Текст статьи</p>
      <p><b>Подсказка:</b><br>
        Помещайте абзацы статьи между тегами: <code>&lt;p&gt;class="article__text"><b>Ваш текст
        </b>&lt;/p&gt;</code> <br>
        Для выделения текста поместите нужный текст между тегами: <code>&ltspan class="text--bold"><b>Ваш текст
        </b>&lt;/span&gt;</code> <br>
        Ссылки помещайте в тег: <code> &lt;a href="<b>Адрес ссылки</b>" class="link"&gt; <b>Текст ссылки</b>&lt;/a&gt;</code>
    </p>
      <textarea class="form__textarea form__textarea--article " name="article" required><?= $row['article']?></textarea>

      <p>Изменить дату публикации</p>
      <input type="date" name="date" value="<?=$row['date']?>" class="form__input">

      <?php
      ?>
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