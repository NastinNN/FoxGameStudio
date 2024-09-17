<?php
session_start();
require_once("php/connect.php");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fox Game</title>
    <!-- icon -->
    <link rel="icon" href="Image/favicon.png" type="image/png" sizes="32x32">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
     <!-- styles -->
    <link rel="stylesheet" href="styles/swiper-bundle.min.css">
    <link rel="stylesheet" href="styles/hamburgers.min.css">
    <link rel="stylesheet" href="styles/hystmodal.min.css">
    <link rel="stylesheet" href="styles\admin.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/media.css">
</head>
<body>

  <!-- header -->
  <?php
    require_once("assets/header.php");
  ?>

  <main>
    <!-- slider -->
    <div class="container">
      <div class="slider swiper page-section--pd60">
        <?php
        if (isset($_SESSION['login']))
        { ?>
          <div class="admin-btn">
          <a href='add-banner.php' class='button'>Добавить баннер</a>
          </div>
        <?php } ?>
        <ul class="slider__list swiper-wrapper">
        <?php
          $query="select * from banner";
          $result=$mysqli->query($query);
          while ($row=$result->fetch_assoc())
          {        
        ?>
        
          <li class="swiper-slide slider-block">
            <div class="slider-block__text">
              <div class="title slider-block__title"><?= $row['title'] ?></div>
              <p><?= $row['subtitle'] ?></p>
              <a href="<?= $row['link'] ?>" class="button slider-block__button">Узнать подробности</a>
              <?php
              if (isset($_SESSION['login']))
                { ?>
                <form action="#">
                  <a href="edit-banner.php?banner=<?= $row['id_banner'] ?>" class="button slider-block__button">Изменить</a>
                  <button type="button" id="<?=$row['id_banner']?>-banner" class="button form__button slider-block__button">Удалить</button>
                </form>

                <script>
                  document.getElementById('<?=$row['id_banner']?>-banner').onclick = function() {
                    if (confirm("Вы действительно хотите удалить баннер?"))
                    {
                      location.href='delete-banner.php?banner=<?=$row['id_banner']?>';
                    }
                  }
                </script>

                <?php }
                ?>
            </div>
            <img src="<?= $row['photo'] ?>" alt="" class="slider-block__img">
          </li>
          <?php
          }
          ?>
        </ul> 

        <div class="slider__nav"></div>
      </div>
    </div>

    <!-- about -->
    <section class="page-section--grey page-section--pd80" id="about">
      <div class="about container">
        <img src="./Image/about.png" alt="" width="480" height="480" class="about__img">
        <div class="about__text">
          <h2 class="title about__title">О нас</h2>
          <p>Мы - передовая и инновационная игровая студия, которая расширяет границы воображения. Мы верим в создание увлекательного опыта, который переносит игроков в захватывающие виртуальные миры, наполненные чудесами, волнением и бесконечными возможностями.</p>
          <p>Наша команда талантливых разработчиков, дизайнеров, художников и сценаристов неустанно работает над созданием игр, которые захватывают ваши чувства и отправляют в незабываемые путешествия. От потрясающей графики до умопомрачительной игровой механики — каждый аспект тщательно проработан, чтобы обеспечить беспрецедентный игровой опыт.</p>
        </div>
      </div>
    </section>

    <!-- about project -->
    <section class="page-section--pd80" id="projects">
      <div class="about-project container">
        <h2 class="title about-project__title">Наши проекты</h2>
        <p>Приоритет нашей студии — качественный контент, многократно отмеченный экспертами и игроками. Мы специализируемся на создании неповторимой атмосферы, увлекательного геймплея, красочной графики и уникального игрового опыта.</p>
        <p class="about-project__quote">“Ваши ощущения - наши приключения!”</p>
      </div>
    </section>

    <!-- project -->
    <section class="page-section--grey page-section--pd80">
      <div class="project container">
      <?php
        if (isset($_SESSION['login']))
        {
      ?>
        <div class="admin-btn">
          <a href='add-project.php' class='button .admin-btn'>Добавить карточку проекта</a>
        </div>
      <?php } ?>
        <div class="project__swiper swiper">
          <ul class="project__list swiper-wrapper">
              <?php
              $query="select id_project, name, rating, platform, date_format(date, '%e.%m.%Y') as date, link, photo from project ORDER BY UNIX_TIMESTAMP(STR_TO_DATE(date, '%Y-%m-%d')) desc";
              $result=$mysqli->query($query);
              while ($row=$result->fetch_assoc())
              {   
              ?>
              <li class="card project__card swiper-slide">
                <div class="card__content">
                  <div class="card__img">
                    <a href="<?= $row['link'] ?>"><img src="<?= $row['photo'] ?>" alt="<?= $row['name'] ?>"></a>
                  </div>
                  <div class="card__title">
                    <a href="<?= $row['link'] ?>"><?= $row['name'] ?></a>
                    <div class="card__rating">
                      <img src="./Image/star_icon.svg" alt="">
                      <p><?= $row['rating'] ?></p>
                    </div>
                  </div>
                  <p class="card__text"><span class="text--bold">Платформы:</span> <?= $row['platform'] ?></p>
                  <p class="card__text"><span class="text--bold">Дата релиза:</span><?= $row['date'] ?></p>
                </div>
                <div class="card__container-button">
                <a href="<?= $row['link'] ?>" class="button card__button">Подробнее</a>
                <?php
                  if (isset($_SESSION['login']))
                  {
                ?>
                    <a href='edit-project.php?project=<?=$row['id_project']?>' class='button card__button'>Изменить</a>
                    <button type="button" id="<?=$row['id_project']?>-project" class="button form__button card__button">Удалить</button>
                    </div>
                <?php } ?>
              </li>

              <script>
                document.getElementById('<?=$row['id_project']?>-project').onclick = function() {
                  if (confirm("Вы действительно хотите удалить проект?"))
                  {
                    location.href='delete-project.php?project=<?=$row['id_project']?>';
                  }
                }
                </script>
              <?php
              } ?>
            </ul>
          <div class="project__pagination"></div>
        </div>
      </div>
    </section>

    <!-- Q&A -->
    <section class="page-section--pd80" id="q-and-a">
      <div class="q-and-a container">
        <h2 class="title q-and-a__title">Вопрос-ответ</h2>
        <div class="q-and-a__content">
          <div class="q-and-a__acor acor-container"> 
            
            <input type="radio" name="acor" id="acor1" checked="checked" />
            <label for="acor1">На каких платформах можно поиграть в ваши игры?</label>
            <div class="acor-body">
                <p>В настоящее время наши игры доступны на следующих платформах: Nintendo Switch, PlayStation 4, Xbox One, Windows, iOS, macOS, Android, PlayStation Vita </p>
            </div>
            
            <input type="radio" name="acor" id="acor2" />
            <label for="acor2">Можно ли стримить ваши игры на YouTube/Twitch? </label>
            <div class="acor-body">
                <p>Можно и даже нужно! Мы даже специально предусмотрели <a href="./article_program.html" class="link">партнёрскую программу</a> для контент-мейкеров. Присоединяйтесь!</p>
            </div>
            
            <input type="radio" name="acor" id="acor3" />
            <label for="acor3">Где можно приобрести ваши игры?</label>
            <div class="acor-body">
                <p>Наши игры можно приобрести на различных доступных цифровых площадках: <a href="#" class="link">Steam</a>, <a href="#" class="link">Epic Games</a>, <a href="#" class="link">Origin</a>, <a href="#" class="link">Xbox Store</a>, <a href="#" class="link">PlayStation Store</a>, <a href="#" class="link">Google Play</a> и <a href="#" class="link">App Store</a>.
                </p>
            </div> 

            <input type="radio" name="acor" id="acor4" />
            <label for="acor4">Над какими проектами сейчас работает студия?</label>
            <div class="acor-body">
                <p>В настоящее время наша студия работает над двумя основными проектами: <a href="#" class="link">Magic Shop</a> и <a href="#" class="link">Reflection</a>. Но у нас еще много планов, так что следите за <a href="news.html" class="link">новостями</a>.</p>
            </div> 
            
          </div>

          <img src="./Image/fox_q_a.png" alt=""  width="370" height="370">
        </div>     
      </div>

    </section>

    <!-- Contact -->
    <section class="page-section--grey page-section--pd80" id="contacts">
      <div class="feedback container">
        <h2 class="title feedback__ttitle">Связаться с нами</h2>
        <div class="feedback__grid">
          <div class="feedback__contacts">
            <div class="feedback__contacts-item">
              <p class="feedback__contacts-title text--bold">Юридический адрес:</p>
              <p>197198, город Санкт-Петербург, Ропшинская улица,дом 1/32 литер а, помещение 10 офис 79</p>
            </div>

            <div class="feedback__contacts-item">
              <p class="feedback__contacts-title text--bold">Для вопросов и предложений:</p>
              <p><a href="mailto: support@foxgamenn.ru" class="link">support@foxgamenn.ru</a></p>
            </div>

            <div class="feedback__contacts-item">
              <p class="feedback__contacts-title text--bold">Для ваших резюме:</p>
              <p><a href="mailto: hr@foxgamenn.ru" class="link">hr@foxgamenn.ru</a></p>
            </div>

            <div class="feedback__contacts-item">
              <p class="feedback__contacts-title text--bold">Мы в социальных сетях:</p>
              <div class="feedback__social-media">
                <a href="#"><img src="./Image/contact/vk_color.svg" alt="VK" class="feedback__social-media-icon"></a>

                <a href="#"><img src="./Image/contact/youtube_color.svg" alt="YouTube" class="feedback__social-media-icon"></a>

                <a href="#"><img src="./Image/contact/twitter_color.svg" alt="Twitter" class="feedback__social-media-icon"></a>

                <a href="#"><img src="./Image/contact/facebook_color.svg" alt="Facebook" class="feedback__social-media-icon"></a>

                <a href="#"><img src="./Image/contact/instagram_color.svg" alt="Instagram" class="feedback__social-media-icon"></a>
              </div>
            </div>
          </div>


            <form action="http://foxgamestudio.ru.swtest.ru/assets/send" method="post" class="form feedback__form" enctype="multipart/form-data" onsubmit="submitForm(event)">
              <legend class="feedback__contacts-title text--bold">Для обратной связи</legend>
                <input type="text" name="name" placeholder="Ваше имя" class="form__input" required>
                <input type="email" name="email" placeholder="Ваш e-mail" class="form__input" required>
                <textarea class="form__textarea" name="message" placeholder="Ваше сообщение" required></textarea>
                <button type="submit" name="send" id="feedback-btn" class="button form__button">Отправить</button>
            </form>
        </div>
      </div>
    </section>
  </main>

  <!-- footer -->
  <?php
    require_once ("assets/footer.php");
  ?>

  <!-- наверх -->
  <a href="#top" id="back-to-top" class="back-to-top" title="Наверх"><img src="./Image/back_to_top.svg" alt="" width="60" height="60"></a>

  <!-- модальное окно - успех -->
  <div id="modal-feedback--success" class="modal">
    <div class="modal__content">
      <div class="modal__close">
        <img src="Image/icon_close.svg" alt="" width="30" height="30">
      </div>
      <div class="modal__body">
        <div class="modal__img">
          <img src="Image/modal.png" alt="">
        </div>
        <p>Ваше сообщение отправлено!
        <br>Мы ответим вам в течении 7 рабочих дней</p>
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

  <!-- scripts -->
  <script src="js/swiper-bundle.min.js"></script>
  <script src="js/hystmodal.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/backToTop.js"></script>
</script>
</body>
</html>