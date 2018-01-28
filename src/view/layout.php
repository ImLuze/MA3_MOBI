<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Autovrij</title>
    <?php echo $css;?>
  </head>
  <body>

    <div class="container">
      <?php if(!empty($_SESSION['info'])): ?><div class="alert alert-success"><?php echo $_SESSION['info'];?></div><?php endif; ?>
      <?php if(!empty($_SESSION['error'])): ?><div class="alert alert-danger"><?php echo $_SESSION['error'];?></div><?php endif; ?>

      <header>
        <nav class="navigation">
          <div class="navigation-lang">
            <a class="lang-link" href="#">Nl</a>
            <p class="white-bodycopy">|</p>
            <a class="lang-link lang-inactive" href="#">FR</a>
          </div>
          <span class="navigation-selector reverse-element"></span>
          <div class="navigation-list">
            <?php if($_GET['page'] !== 'events'): ?>
              <a class="navigation-link active-link" href="/index.php">Home</a>
              <a class="navigation-link" href="/events">Evenementen</a>
            <?php else: ?>
              <a class="navigation-link" href="/index.php">Home</a>
              <a class="navigation-link active-link" href="/events">Evenementen</a>
            <?php endif; ?>
            <a class="navigation-link" href="#">Praktisch</a>
            <a class="navigation-link" href="#">#weekvandemobiliteit</a>
            <a class="navigation-link" href="#">Blog</a>
          </div>

          <div class="hamburger">
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>
            <ul class="hamburger-menu">
              <a class="navigation-link" href="#"><li>Home</li></a>
              <a class="navigation-link" href="#"><li>Evenementen</li></a>
              <a class="navigation-link" href="#"><li>Praktisch</li></a>
              <a class="navigation-link" href="#"><li>#weekvandemobiliteit</li></a>
              <a class="navigation-link" href="#"><li>Blog</li></a>
            </ul>
          </div>
        </nav>
      </header>

      <?php echo $content; ?>

      <footer>
        <div class="footer-nav">
          <a class="navigation-link" href="#">Over ons</a>
          <a class="navigation-link" href="#">Contact</a>
        </div>
        <div class="social-media">
          <a class="navigation-link" href="#">Facebook</a>
          <a class="navigation-link" href="#">Twitter</a>
          <a class="navigation-link" href="#">Instagram</a>
        </div>
        <div class="newsletter">
          <p>Wees op de hoogte</p>
          <form class="location-filter-form footer-form" action="index.php" method="post">
            <div class="location-filter-container">
              <div class="location-filter-errors footer-errors"></div>
              <input class="location-filter footer-input" type="email" name="newsletter" value="">
              <label class="location-filter-label footer-label" for="newsletter">Email Adres</label>
            </div>
          </form>
        </div>
        <div class="partners">
          <img src="../assets/img/delijn.jpg" alt="de lijn">
          <img src="../assets/img/ndm.jpg" alt="ndm">
          <img src="../assets/img/nmbs.jpg" alt="nmbs">
          <img src="../assets/img/vlaanderen.jpg" alt="vlaanderen">
        </div>
      </footer>
    </div>

    <?php echo $js;?>
  </body>
</html>
