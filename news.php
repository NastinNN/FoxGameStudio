<?php
  session_start();
  require_once("php/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Новости - Fox Game</title>
  <!-- icon -->
  <link rel="icon" href="Image/favicon.png" type="image/png" sizes="32x32">
  <!-- font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- styles -->
  <link rel="stylesheet" href="styles/hamburgers.min.css">
  <link rel="stylesheet" href="styles\admin.css">
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="styles/NewsStyle.css">
  <link rel="stylesheet" href="styles/media.css">
</head>

<script
  src="https://code.jquery.com/jquery-3.6.3.js"
  integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM="
  crossorigin="anonymous">
</script>
<!-- http://127.0.0.1:8080/FoxGame/news.php -->
<body>
    
  <!-- header -->
  <?php
    require_once("assets/header.php");
  ?>

  <!-- main -->
  <main>
    <section class="page-section--pd60">
    <div class="news container">
      <div class="title news__title">Последние новости</div>
      
      <?php
        if (isset($_SESSION['login']))
        {
          ?>
          <div class="admin-btn">
          <a href='add-news.php' class='button'>Добавить новость</a>
          </div>
          <?php
        }
      $query="select * from news";
      $result=$mysqli->query($query);
      $row=$result->fetch_assoc();
      $last_id_news=($result->num_rows)-1;
    
      function newsAdd(&$last_id_news, $mysqli) {
        $query="select id_news, title, subtitle, date_format(date, '%e %M %Y') as date from news ORDER BY UNIX_TIMESTAMP(STR_TO_DATE(date, '%Y-%m-%d')) limit 1 offset {$last_id_news}";
        $result=$mysqli->query($query);
        $row=$result->fetch_assoc();
        ?>
        <div class='news__content news-block'>
          <div class='news-block__img'>
          <a href='article.php?article=<?= $row['id_news']?>'><img src='Image/news/<?=$row['id_news']?>.jpg' alt=''></a>
          </div>
          <div class='news-block__description'>
            <div class='news-block__text'>
              <div class='news-block__title'><a href='article.php?article=<?=$row['id_news']?>'><?=$row['title']?></a></div>
              <p><?=$row['subtitle']?></p>
              <?php
                if (isset($_SESSION['login']))
                {
                  ?>
                    <form action="#">
                    <a href="edit-article.php?article=<?=$row['id_news']?>" class='button news-block__button'>Изменить</a>
                    <button type="button" id="<?=$row['id_news']?>-article" class="button form__button news-block__button">Удалить</button>
                    </form>

                    <script>
                      document.getElementById('<?=$row['id_news']?>-article').onclick = function() {
                        if (confirm("Вы действительно хотите удалить новость?"))
                        {
                          location.href='delete-article.php?article=<?=$row['id_news']?>';
                        }
                      }
                    </script>
                  <?php
                }
                else
                {
                  ?>
                    <a href='article.php?article=<?=$row['id_news']?>' class='button news-block__button'>Подробнее</a>
                  <?php
                }
              ?>
            </div>
            <div class='news-block__date'><?=$row['date']?></div>
          </div>
        </div>

        <?php
        $last_id_news=$last_id_news-1;
      }
        

      for ($i=1; $i<=3; $i++)
      {
        if ($last_id_news<0)
        {
          break;
        }
        newsAdd($last_id_news, $mysqli);
      } 

      if (isset($_POST['loadNews']))
      {
        while ($last_id_news>=0)
        {
          newsAdd($last_id_news, $mysqli);
        }
        ?>
        <style>
          .more {
            display: none;
          }
          .page-section--pd60 {
          padding-bottom: 0;
          }
        </style>
        <?php
      }
    ?>

      <form action="#" method="post" class="more" id="loadNews">
        <button type="submit" id="loadNews-btn" name="loadNews" class="button loadNews-btn">Показать еще</button>
        <input type="hidden" name="scroll" value="">
      </form>
    </div>

    <!-- отключение скролла при подгрузке новостей -->
    <script>
      $(window).on("scroll", function(){
        $('input[name="scroll"]').val($(window).scrollTop());
      });
      
      <?php if (!empty($_REQUEST['scroll'])): ?>
      $(document).ready(function(){
        window.scrollTo(0, <?php echo intval($_REQUEST['scroll']); ?>);  
      }); 
      <?php endif; ?>
    </script>
  </section>
  

  <!-- подписаться -->
  <section>
    <div class="container">
      <div class="subscribe">
        <div class="subscribe__text">
          <div class="title subscribe__title">Подпишись!</div>
          <p>Подпишись на наши обновления, чтобы не пропустить важные новости о  релизах и обновлениях!</p>

          <form action="http://foxgamestudio.ru.swtest.ru/assets/subscribe" method="post" class="form email-block" enctype="multipart/form-data" onsubmit="submitForm(event)">
            <input class="form__input email-block__input" type="email" name="sub-email" placeholder="Ваш e-mail" required>
            <button type="submit" id="subscribe-btn" class="button form__button email-block__button">Отправить</button>
          </form>
   
        </div>
        <img src="./Image/news_fox_subcribe.png" alt="">
      </div>
    </div>
  </section>
</main>


  <!-- footer -->
  <?php
    require_once ("assets/footer.php");
  ?>

<a href="#top" id="back-to-top" class="back-to-top" title="Наверх"><img src="./Image/back_to_top.svg" alt="" width="60" height="60"></a>

<!-- модальное окно - успех -->
<div id="modal-feedback--success" class="modal">
  <div class="modal__content">
    <div class="modal__close">
      <img src="Image/icon_close.svg" alt="" width="30" height="30">
    </div>
    <div class="modal__body">
      <div class="modal__img">
        <img src="Image/modal-news.png" alt="">
      </div>
      <p>Спасибо, что подписаллись 
      <br>на наши обновления!</p>
    </div>
  </div>
</div>

<!-- модальное окно - ошибка -->
<div id="modal-feedback--error" class="modal" >
  <div class="modal__content">
    <div class="modal__close">
      <img src="Image/icon_close.svg" alt="" width="30" height="30">
    </div>
    <div class="modal__body">
      <div class="modal__img">
        <img src="Image/modal-error.png" alt="">
      </div>
      <p>Упс! Что-то пошло не так.
      <br>Попробуйте снова</p>
    </div>
  </div>
</div>

<!-- модальное окно - уже подписан на рассылку -->
<div id="modal-feedback--alreadydone" class="modal" >
  <div class="modal__content">
    <div class="modal__close">
      <img src="Image/icon_close.svg" alt="" width="30" height="30">
    </div>
    <div class="modal__body">
      <div class="modal__img">
        <img src="Image/modal-alreadydone.png" alt="">
      </div>
      <p>Вы уже подписаны на рассылку</p>
    </div>
  </div>
</div>

<script src="js/backToTop.js"></script>
<script src="js/main.js"></script>
</body>
</html>