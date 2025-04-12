<section class="extra-info">
  <h2>이런 정보도 필요하신가요?</h2>

  <!-- 이벤트 정보 -->
  <div class="info-category">
    <h3>이벤트 정보</h3>
    <?php if (!empty($events)): ?>
      <ul>
        <?php foreach ($events as $event): ?>
          <li>
            <?php if (!empty($event['image'])): ?>
              <img src="<?= esc($event['image']); ?>" alt="<?= esc($event['name']); ?>">
            <?php endif; ?>
            <strong><?= esc($event['name']); ?></strong>
            <p>이벤트 유형: <?= esc($event['type']); ?></p>
            <p>브랜드: <?= esc($event['brand']); ?></p>
            <p>가격: <?= esc($event['price']); ?> / 할인율: <?= esc($event['discount_rate']); ?></p>
            <p>작성일: <?= esc($event['created_at']); ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>이벤트 정보가 없습니다.</p>
    <?php endif; ?>
  </div>

  <!-- 호텔 정보 -->
  <div class="info-category">
    <h3>호텔 정보</h3>
    <?php if (!empty($hotels)): ?>
      <ul>
        <?php foreach ($hotels as $hotel): ?>
          <li>
            <strong><?= esc($hotel['name']); ?></strong>
            <p><?= esc($hotel['address']); ?></p>
            <p><?= esc($hotel['phone']); ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>호텔 정보가 없습니다.</p>
    <?php endif; ?>
  </div>

  <!-- 주차장 정보 -->
  <div class="info-category">
    <h3>주차장 정보</h3>
    <?php if (!empty($parkingLots)): ?>
      <ul>
        <?php foreach ($parkingLots as $parking): ?>
          <li>
            <strong><?= esc($parking['name']); ?></strong>
            <p><?= esc($parking['address']); ?></p>
            <p><?= esc($parking['phone']); ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>주차장 정보가 없습니다.</p>
    <?php endif; ?>
  </div>
</section>
