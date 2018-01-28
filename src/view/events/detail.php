<section class="detail">
  <section class="intro">
    <img src=
      <?php
        $directory = './assets/img/photos/'.$event['code'];
        $files = scandir($directory);
        $index = 2;
        $firstphoto = $directory . '/' . $files[$index];
        if (substr($firstphoto, -3) != 'jpg') {
          $index++;
          $firstphoto = $directory . '/' . $files[$index];
          if (substr($firstphoto, -3) != 'jpg') {
            $index++;
            $firstphoto = $directory . '/' . $files[$index];
          }
        }
        echo $firstphoto;
      ?>
    alt="Blue bike stad">
    <h1><mark><?php echo $event['title'] ?></mark></h1>
    <p class="date"><mark><?php echo $event['start'] ?></mark></p>
  </section>
  <p class="event-content"><?php echo $event['content'] ?></p>
</section>
