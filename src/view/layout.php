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

      <?php echo $content; ?>
    </div>

    <header>
      <nav class="navigation">
        <div class="navigation-lang">
          <a class="lang-link" href="#">Nl</a>
          <p class="white-bodycopy">|</p>
          <a class="lang-link lang-inactive" href="#">FR</a>
        </div>
        <span class="navigation-selector reverse-element"></span>
        <div class="navigation-list">
          <a class="navigation-link active-link" href="#">Home</a>
          <a class="navigation-link" href="#">Evenementen</a>
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

    <?php echo $js;?>
  </body>
</html>
