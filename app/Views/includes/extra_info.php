<style>
  /* 공통 추가 정보 섹션 스타일 */
  .extra-info {
    max-width: 1000px;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
  }
  
  .extra-info h2 {
    font-size: 28px;
    color: var(--main-color, #62D491);
    text-align: center;
    margin-bottom: 30px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--main-color, #62D491);
  }
  
  .extra-info .info-category {
    margin-bottom: 30px;
  }
  
  .extra-info .info-category h3 {
    font-size: 22px;
    color: var(--point-color, #3eaf7c);
    margin-bottom: 15px;
    border-left: 4px solid var(--point-color, #3eaf7c);
    padding-left: 10px;
  }
  
  .extra-info .info-category ul {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    list-style: none;
    margin: 0;
    padding: 0;
  }
  
  .extra-info .info-category ul li {
    flex: 1 1 calc(33.333% - 20px);
    background-color: #f9f9f9;
    border: 1px solid #eee;
    border-radius: 6px;
    padding: 15px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
  }
  
  .extra-info .info-category ul li strong {
    display: block;
    font-size: 18px;
    margin-bottom: 8px;
    color: #333;
  }
  
  .extra-info .info-category ul li p {
    margin: 4px 0;
    font-size: 14px;
    color: #555;
    line-height: 1.4;
  }
  
  .extra-info .info-category ul li img {
    max-width: 100%;
    height: auto;
    display: block;
    margin-bottom: 10px;
    border-radius: 4px;
  }
  
  /* 모바일: 1열 레이아웃 */
  @media (max-width: 600px) {
    .extra-info .info-category ul li {
      flex: 1 1 100%;
    }
  }
</style>

<section class="extra-info">
  <h2>이런 정보도 필요하신가요?</h2>

  <!-- 이벤트 정보 -->
  <div class="info-category">
    <h3>편의점 1+1 정보</h3>
    <?php if (!empty($events)): ?>
      <ul>
        <?php foreach ($events as $event): ?>
          <li>
            <a href="/events/detail/<?= esc($event['id']); ?>">
              <?php if (!empty($event['image'])): ?>
                <img src="<?= esc($event['image']); ?>" alt="<?= esc($event['name']); ?>">
              <?php endif; ?>
              <strong><?= esc($event['name']); ?></strong>
              <p>이벤트 유형: <?= esc($event['type']); ?></p>
              <p>브랜드: <?= esc($event['brand']); ?></p>
              <p>가격: <?= esc($event['price']); ?> / 할인율: <?= esc($event['discount_rate']); ?></p>
              <p>작성일: <?= esc($event['created_at']); ?></p>
            </a>
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
            <a href="/hotel/detail/<?= esc($hotel['id']); ?>">
              <strong><?= esc($hotel['name']); ?></strong>
              <p><?= esc($hotel['address']); ?></p>
              <p><?= esc($hotel['phone']); ?></p>
            </a>
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
            <a href="/parking/detail/<?= esc($parking['id']); ?>">
              <strong><?= esc($parking['name']); ?></strong>
              <p><?= esc($parking['address']); ?></p>
              <p><?= esc($parking['phone']); ?></p>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>주차장 정보가 없습니다.</p>
    <?php endif; ?>
  </div>

  <!-- 정비소 정보 -->
  <div class="info-category">
    <h3>정비소 정보</h3>
    <?php if (!empty($repairShops)): ?>
      <ul>
        <?php foreach ($repairShops as $shop): ?>
          <li>
            <a href="/automobile_repair_shop/<?= esc($shop['id']); ?>">
              <strong><?= esc($shop['name']); ?></strong>
              <p><?= esc($shop['address']); ?></p>
              <p><?= esc($shop['phone']); ?></p>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>정비소 정보가 없습니다.</p>
    <?php endif; ?>
  </div>

  <!-- 주유소 정보 -->
  <div class="info-category">
    <h3>주유소 정보</h3>
    <?php if (!empty($gasStations)): ?>
      <ul>
        <?php foreach ($gasStations as $station): ?>
          <li>
            <a href="/gas_stations/<?= esc($station['id']); ?>">
              <strong><?= esc($station['name']); ?></strong>
              <p><?= esc($station['address']); ?></p>
              <p><?= esc($station['phone']); ?></p>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>주유소 정보가 없습니다.</p>
    <?php endif; ?>
  </div>
</section>
