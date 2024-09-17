<?php
  session_start();
  require_once("php/connect.php");
  $query="select title, article, date_format(date, '%e %M %Y') as date from news where id_news={$_GET['article']}";
  $result=$mysqli->query($query);
  $row=$result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> <?= "{$row['title']}" ?>- Fox Game</title>
  <!-- icon -->
  <link rel="icon" href="Image/favicon.png" type="image/png" sizes="32x32">
  <!-- font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- styles -->
  <link rel="stylesheet" href="styles/fancybox.css">
  <link rel="stylesheet" href="styles/hamburgers.min.css">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/article.css">
  <link rel="stylesheet" href="styles/media.css">
</head>
<body>
<?php
require_once("assets/header.php");
?>

<main>
    <!-- article banner -->
    <section>
      <div class="container">
        <div class="article-banner">
          <div class="article-banner__container">
            <img src="Image/news/<?=$_GET['article']?>.jpg" alt="" class="article-banner__img">
          </div>
            <div class="title article-banner__title"><?= $row['title'] ?></div>
          </div>
        </div>
    </section>

    <!-- article -->
    <section class="page-section--pd60">
        <div class="container article">
          <p class="article__history"><a href="news.php" class="article__history-link">Новости</a>/<a href="article.php?article=<?=$_GET['article']?>" class="article__history-link"><?= $row['title'] ?></a>/</p>
          <h3 class="title article__title"><?= $row['title'] ?></h3>
          <p class="article__date"><?= $row ['date'] ?></p>
          <?= $row ['article'] ?>
        </div>
    </section>
</main>

<?php
require_once("assets/footer.php");
?>

<a href="#top" id="back-to-top" class="back-to-top" title="Наверх"><img src="./Image/back_to_top.svg" alt="" width="60" height="60"></a>

<script src="js/fancybox.umd.js"></script>
<script src="js/fancybox.js"></script>
<script src="js/swiper-bundle.min.js"></script>
<script src="js/backToTop.js"></script>
<script src="js/main.js"></script>
</body>
</html>