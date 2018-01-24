<section class="map">
  <img class="map" src="./assets/img/map.jpg" alt="belgium">
  <form class="location-filter-form" action="index.html" method="post">
    <div class="location-filter-container">
      <div class="location-filter-errors"></div>
      <input class="location-filter" type="text" name="location" value="">
      <label class="location-filter-label" for="location">Zoek op locatie!</label>
      <div class="location-filter-hints"></div>
    </div>
  </form>
</section>
<section class="events-container">
  <section class="cards">
    <div class="selected-tags"></div>
    <div class="tag-filter">
        <?php foreach($tags as $tag): ?>
          <li class="tag tag-filter-tag"><?php echo $tag['tag']; ?></li>
        <?php endforeach; ?>
    </div>
    <form class="date-filter" action="/events" method="post">
      <input class="date-filter-day" type="checkbox" name="16" value="16">
      <label class="date-filter-day-label" for="16">
        <p>Zon</p>
        <p>16</p>
        <p>september</p>
      </label>
      <input class="date-filter-day" type="checkbox" name="17" value="17">
      <label class="date-filter-day-label" for="17">
        <p>Maan</p>
        <p>17</p>
        <p>september</p>
      </label>
      <input class="date-filter-day" type="checkbox" name="18" value="18">
      <label class="date-filter-day-label" for="18">
        <p>Di</p>
        <p>18</p>
        <p>september</p>
      </label>
      <input class="date-filter-day" type="checkbox" name="19" value="19">
      <label class="date-filter-day-label" for="19">
        <p>Woe</p>
        <p>19</p>
        <p>september</p>
      </label>
      <input class="date-filter-day" type="checkbox" name="20" value="20">
      <label class="date-filter-day-label" for="20">
        <p>Don</p>
        <p>20</p>
        <p>september</p>
      </label>
      <input class="date-filter-day" type="checkbox" name="21" value="21">
      <label class="date-filter-day-label" for="21">
        <p>Vrij</p>
        <p>21</p>
        <p>september</p>
      </label>
      <input class="date-filter-day" type="checkbox" name="22" value="22">
      <label class="date-filter-day-label" for="22">
        <p>Zat</p>
        <p>22</p>
        <p>september</p>
      </label>
    </form>
    <?php foreach($events as $event): ?>
      <?php if(file_exists('./assets/img/photos/'.$event['code'])): ?>
        <article class="card-photo card">
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
            <h2><mark><?php echo $event['title'] ?></mark></h2>
          </div>
          <div class="card-tags">
            <?php foreach($event['tags'] as $tag): ?>
              <p class="tag"><?php echo $tag['tag'] ?></p>
            <?php endforeach; ?>
          </div>
          <p class="card-bodycopy"><?php echo substr($event['content'], 0, 100).' ...'?></p>
          <a class="read-more" href="#">Meer info</a>
        </article>
      <?php else: ?>
        <article class="card-small card">
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
          <p class="card-bodycopy"><?php echo substr($event['content'], 0, 100).' ...'?></p>
          <a class="read-more" href="#">Meer info</a>
        </article>
      <?php endif; ?>
    <? endforeach;?>
  </section>
</section>
