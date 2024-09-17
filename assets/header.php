<?php
    if (isset($_POST['exit']))
    {
      session_destroy();
      header("Refresh: 0.1");
    }
  ?>
  
<header class="page-header">
    <div class="container">
        <div class="page-header__row">
          <a href="index.php"><img src="Image/logo.svg" alt="Fox Game" width="122" height="66" class="logo page-header__logo"></a>

          <button class="page-header__toggle-menu hamburger hamburger--squeeze" type="button" onclick="this.classList.toggle('is-active')">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
            </span>
          </button>

            <nav class="page-header__nav">
            <ul class="page-header__menu">
            <?php
              if (isset($_SESSION['login']))
              {
                ?>
                <li><a href="news.php">Новости</a></li>
                <li><a href="vacancy.php">Вакансии</a></li>
                <li><a href="partner-program.php">Сотрудничество</a></li>
                <li><form action="#" method="post">
                  <button type="submit" name="exit" class="button form__button">Выход</button></li>
                </form>
                <?php
              }
              else
              {          
              ?>
                <li><a href="index.php#about">О нас</a></li>
                <li><a href="index.php#projects">Проекты</a></li>
                <li><a href="index.php#contacts">Контакты</a></li>
                <li><a href="news.php">Новости</a></li>
                <li><a href="vacancy.php">Вакансии</a></li>
                <li><a href="partner-program.php">Сотрудничество</a></li>
              <?php
              }
              ?>
            </ul>
            </nav>
        </div>
    </div>
  </header>

  <?php
    if (isset($_POST['exit']))
    {
      session_destroy();
      header("Refresh: 0.1");
    }
  ?>
