<?php
  session_start();
  require_once("php/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Изменить баннер - FoxGame</title>
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
        $query="select * from banner where id_banner='{$_GET['banner']}'";
        $result=$mysqli->query($query);
        $row=$result->fetch_assoc();
        
        if (isset($_POST['edit']))
        {
          if (file_exists($_FILES['photo']['tmp_name']) || is_uploaded_file($_FILES['photo']['tmp_name']))
          {
            move_uploaded_file($_FILES['photo']['tmp_name'],"Image/banner/{$_FILES['photo']['name']}");
            $query="update banner set title='{$_POST['title']}',subtitle='{$_POST['subtitle']}', link='{$_POST['link']}', photo='Image/banner/{$_FILES['photo']['name']}' where id_banner='{$_GET['banner']}'";
          }
          else
          {
            $query="update banner set title='{$_POST['title']}',subtitle='{$_POST['subtitle']}', link='{$_POST['link']}' where id_banner='{$_GET['banner']}'";
          }
          $mysqli->query($query);
          if ($mysqli->affected_rows>0 || $_FILES['photo']['name']!="{$_GET['banner']}.jpg" || $_FILES['photo']['name']!="{$_GET['banner']}.png")
          {
            ?><script>
            alert("Баннер успешно отредактирован");
            location.href='index.php';
            </script><?php
          }
        }
  ?>

  <div class="container page-section--pd80 add-news">
  <div class="title add-news__title">Редактирование баннер</div>
    <form action="#" enctype="multipart/form-data" method="post" class="add-news__form">

    <p>ID баннера</p>
      <input type="text" name="id_banner" value="<?= $_GET['banner'] ?>" class="form__input" disabled>

      <p>Изменить фото баннера</p>
      <input type="file" name="photo" accept=".jpg, .png">

      <p>Заголовок баннера</p>
      <textarea class="form__textarea" name="title"><?= $row['title']?></textarea>

      <p>Подзаголовок баннера</p>
      <textarea class="form__textarea" name="subtitle"><?= $row['subtitle']?></textarea>

      <p>Ссылка баннера</p>
      <textarea class="form__textarea" name="link"><?= $row['link']?></textarea>

      <button type="submit" name="edit" class="button form__button">Изменить баннер</button>
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