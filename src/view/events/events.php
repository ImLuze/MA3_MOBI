<section>
  <?php foreach($events as $event): ?>
    <!-- <article>
      <header><h2><?php echo $event['title']; ?></h2></header>
      <dl>
        <dt>code</dt><dd><?php echo $event['code'];?></dd>
        <dt>content</dt><dd><?php echo $event['content'];?></dd>
        <dt>practical</dt><dd><?php echo $event['practical'];?></dd>
      <dt>location</dt><dd><?php echo $event['location'];?></dd>
        <dt>address</dt><dd><?php echo $event['address'];?></dd>
        <dt>postal</dt><dd><?php echo $event['postal'];?></dd>
        <dt>city</dt><dd><?php echo $event['city'];?></dd>
        <dt>start</dt><dd><?php echo $event['start'];?></dd>
        <dt>end</dt><dd><?php echo $event['end'];?></dd>
          <dt>link</dt><dd><?php echo $event['link'];?></dd>
        <dt>organisers</dt><dd><ul><?php foreach($event['organisers'] as $organiser): ?><li><?php echo $organiser['name'];?></li><?php endforeach;?></ul></dd>
        <dt>tags</dt><dd><ul><?php foreach($event['tags'] as $tag): ?><li><?php echo $tag['tag'];?></li><?php endforeach;?></ul></dd>
      </dl>
    </article> -->
  <? endforeach;?>
  <section class="cards">
    <ul class="date-filter">
      <li class="date-filter-day">
        <p>16</p>
        <p>september</p>
      </li>
      <li class="date-filter-day date-filter-day-active">
        <p>17</p>
        <p>september</p>
      </li>
      <li class="date-filter-day">
        <p>18</p>
        <p>september</p>
      </li>
      <li class="date-filter-day">
        <p>19</p>
        <p>september</p>
      </li>
      <li class="date-filter-day">
        <p>20</p>
        <p>september</p>
      </li>
      <li class="date-filter-day">
        <p>21</p>
        <p>september</p>
      </li>
      <li class="date-filter-day">
        <p>22</p>
        <p>september</p>
      </li>
    </ul>
    <?php foreach($events as $event): ?>
      <?php if(file_exists('./assets/img/photos/'.$event['code'])): ?>
        <article class="card-photo">
          <div class="timestamp">
            <p><?php echo date('j', strtotime($event['start'])); ?></p>
            <p><?php echo date('M', strtotime($event['start'])); ?></p>
          </div>
          <div class="card-img">
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
            <h2><?php echo $event['title'] ?></h2>
          </div>
          <div class="card-tags">
            <?php foreach($event['tags'] as $tag): ?>
              <p class="tag"><?php echo $tag['tag'] ?></p>
            <?php endforeach; ?>
          </div>
          <p class="card-bodycopy"><?php echo substr($event['content'], 0, 100)?></p>
          <a class="read-more" href="#">Meer info</a>
        </article>
      <?php else: ?>
        <article class="card-small">
          <div class="timestamp">
            <p><?php echo date('j', strtotime($event['start'])); ?></p>
            <p><?php echo date('M', strtotime($event['start'])); ?></p>
          </div>
          <h2><?php echo $event['title'] ?></h2>
          <div class="card-tags">
            <?php foreach($event['tags'] as $tag): ?>
              <p class="tag"><?php echo $tag['tag'] ?></p>
            <?php endforeach; ?>
          </div>
          <p class="card-bodycopy"><?php echo substr($event['content'], 0, 100)?></p>
          <a class="read-more" href="#">Meer info</a>
        </article>
      <?php endif; ?>
    <? endforeach;?>
  </section>
</section>
