<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Вакансии - Fox Game</title>
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
  <!-- header -->
  <?php
    require_once("assets/header.php");
  ?>

  <main>
    <!-- article banner -->
    <section>
      <div class="container">
        <div class="article-banner">
          <div class="article-banner__container">
            <img src="./Image/article_banner/vacancy.jpg" alt="Reflection" class="article-banner__img">
          </div>
            <div class="title article-banner__title"> Стань частью команды Fox Game</div>
          </div>
        </div>
    </section>

    <!-- article -->
    <section class="page-section--pd60">
        <div class="vacancy container">
          <h2 class="title vacancy__title">Открытые вакансии</h2>

          <div class="vacancy__item">
            <h3 class="vacancy__inner-title">Дизайнер уровней</h3>
            <div class="vacancy__block">
              
              <div class="vacancy__inner-block">
                <p class="vacancy__inner-block-title">Требования</p>

                <div class="vacancy__inner-block-text">
                  <p class="text--bold">Основные задачи:</p>
                  <ul>
                    <li>Создание игровых уровней в специализированном редакторе.</li>
                    <li>Тестирование и балансировка игровых уровней.</li>
                    <li>Ведение документации по дизайну уровней.</li>
                  </ul>
                </div>

                <div class="vacancy__inner-block-text">
                  <p class="text--bold">Необходимые навыки:</p>
                  <ul>
                    <li>Опыт разработки уровней, хорошее чувство пространства и композиции, отличное знание основ дизайна уровней и того, как дизайн уровней влияет на игровой процесс.</li>
                    <li>Разнообразный игровой опыт, интерес к разработке игр.</li>
                    <li>Навык работы с современными игровыми движками, такими как Unreal Engine, Unity, CryEngine.</li>
                    <li>Способность ставить себя на место игрока.</li>
                    <li>Умение формулировать требования и доносить их до других</li>
                  </ul>
                </div>

                <div class="vacancy__inner-block-text">
                  <p class="text--bold">Хорошим бонусом будут:</p>
                  <ul>
                    <li>Навыки скриптования.</li>
                    <li>Реальный опыт любительской или профессиональной разработки.</li>
                    <li>Знание английского на уровне понимания игровых образов и литературы по игровому дизайну.</li>
                    <li>Владение пакетами трехмерного моделирования.</li>
                    <li>Высшее образование.</li>
                  </ul>
                </div>
              </div>

              <div class="vacancy__inner-block">
                <p class="vacancy__inner-block-title">Условия работы:</p>
                
                <div class="vacancy__inner-block-text">
                  <p class="text--bold">Заработная плата: </p>
                  <p>По итогам собеседования</p>
                </div>

                <div class="vacancy__inner-block-text">
                  <p class="text--bold">График работы:</p>
                  <p>Гибкое начало рабочего дня</p>
                </div>

                <div class="vacancy__inner-block-text">
                  <p class="text--bold">Формат работы: </p>
                  <p>Полная занятость</p>
                </div>

              </div>

              <div class="vacancy__inner-block">
                <p class="vacancy__inner-block-title">Отправить резюме</p>
                <div class="vacancy__inner-block-text">
                  <a href="mailto: foxgamestudio_hr@gmail.com" class="link">foxgamestudio_hr@gmail.com</a>
                </div>
              </div>

            </div>
          </div>

          <div class="vacancy__item">
            <h3 class="vacancy__inner-title">Программист с++</h3>
            <div class="vacancy__block">
              
              <div class="vacancy__inner-block">
                <p class="vacancy__inner-block-title">Требования</p>

                <div class="vacancy__inner-block-text">
                  <p class="text--bold">Основные задачи:</p>
                  <ul>
                    <li>Разработка компонентов игры, затрагивающая разные области: игровые правила игровая физика, AI, мультиплеер, аналитика, UI, звук.</li>
                    <li>Оптимизация и поддержка текущих технологий.</li>
                    <li>Разработка инструментов разработки для дизайнеров, художников, операторов и пр.</li>
                    <li>Участие в дизайне игровых фич совместно с игровыми дизайнерами и другим разработчиками</li>
                  </ul>
                </div>

                <div class="vacancy__inner-block-text">
                  <p class="text--bold">Необходимые навыки:</p>
                  <ul>
                    <li>Любовь к компьютерным играм.</li>
                    <li>Опыт программирования на C++.</li>
                    <li>Хороший алгоритмический базис.</li>
                    <li>Высокая обучаемость, желание осваивать новые технологии.</li>
                  </ul>
                </div>

                <div class="vacancy__inner-block-text">
                  <p class="text--bold">Хорошим бонусом будут:</p>
                  <ul>
                    <li>Знание базовых основ работы компьютерных подсистем (процессора, памяти, кешей и т.п.).</li>
                    <li>Знание основ векторной алгебры (вектора, матрицы, скалярное/векторное произведение и т.п.).</li>
                    <li>Технический английский.</li>
                    <li>Высшее техническое образование.</li>
                    <li>Любовь к консолям (Playstation, Xbox, Switch) и к другим платформам для видеоигр.</li>
                  </ul>
                </div>
              </div>

              <div class="vacancy__inner-block">
                <p class="vacancy__inner-block-title">Условия работы:</p>
                
                <div class="vacancy__inner-block-text">
                  <p class="text--bold">Заработная плата: </p>
                  <p>По итогам собеседования. Мнимальная оплата труда составляет 150 00 рублей.</p>
                </div>

                <div class="vacancy__inner-block-text">
                  <p class="text--bold">График работы:</p>
                  <p>Гибкое начало рабочего дня</p>
                </div>

                <div class="vacancy__inner-block-text">
                  <p class="text--bold">Формат работы: </p>
                  <p>Полная занятость</p>
                </div>

              </div>

              <div class="vacancy__inner-block">
                <p class="vacancy__inner-block-title">Отправить резюме</p>
                <div class="vacancy__inner-block-text">
                  <a href="mailto: foxgamestudio_hr@gmail.com" class="link">foxgamestudio_hr@gmail.com</a>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </main>


  <!-- footer -->
  <?php
    require_once ("assets/footer.php");
  ?>


<a href="#top" id="back-to-top" class="back-to-top" title="Наверх"><img src="./Image/back_to_top.svg" alt="" width="60" height="60"></a>

<script src="js/backToTop.js"></script>
<script src="js/main.js"></script>
</body>
</html>