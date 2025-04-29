<?php
  $address = esc($hotel['site_full_address']);
  preg_match('/([\x{AC00}-\x{D7A3}]+(?:구|읍|군))/u', $address, $matches);
  $district = isset($matches[0]) ? $matches[0] : '인근';

  $hotelName = esc($hotel['business_name']);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $district ?> 숙박시설 추천 | <?= $hotelName ?> - 위치, 가격, 후기 정보 | 호텔허브</title>
  <meta name="description" content="<?= esc($hotel['business_name']); ?>의 상세 정보 및 근처 맛집과 관광지">
  <meta name="keywords" content="호텔, 관광지, 맛집, <?= esc($hotel['business_name']); ?>, 숙박 정보">
  <meta name="robots" content="index, follow">
  <meta name="author" content="호텔허브">
  <meta property="og:title" content="<?= esc($hotel['business_name']); ?> - 호텔허브">
  <meta property="og:description" content="<?= esc($hotel['business_name']); ?>의 상세 정보와 근처 맛집 및 관광지를 확인하세요.">
  <meta property="og:url" content="<?= current_url(); ?>">
  <meta property="og:type" content="website">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
crossorigin="anonymous"></script>
<script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    html, body { font-family: 'Arial', sans-serif; background-color: #f7f8fa; color: #333; }
    a { color: inherit; text-decoration: none; }
    :root {
      --main-color: #62D491;
      --point-color: #3eaf7c;
      --card-bg: #fff;
      --border-color: #ddd;
      --text-color: #333;
    }
    main { max-width: 1000px; margin: 0 auto; padding: 20px; }
    .hero-section {
      background: #fff; border-radius: 8px; padding: 2rem;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05); text-align: center; margin-bottom: 2rem;
    }
    .section-title {
      font-size: 20px; color: var(--main-color);
      margin-bottom: 12px; font-weight: bold;
    }
    .detail-card {
      background: #fff; border-left: 5px solid var(--main-color);
      border-radius: 8px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);
      margin-bottom: 2rem;
    }
    .info-table {
      width: 100%; border: 1px solid #ddd; margin-top: 1rem;
    }
    .info-table th, .info-table td {
      padding: 10px; border: 1px solid #eee; font-size: 14px;
    }
    .info-table th {
      background-color: #f0f8ff; color: var(--point-color); width: 140px;
    }
    .card-slider {
      display: flex; overflow-x: auto; gap: 12px; padding: 8px 0;
    }
    .card {
      min-width: 200px; background: #fff; border: 1px solid #ddd;
      border-radius: 8px; padding: 12px; text-align: center;
    }
    .card img {
      width: 100%; height: 120px; object-fit: cover; border-radius: 5px; margin-bottom: 8px;
    }
    .card h3 { font-size: 1.1em; color: var(--main-color); margin: 0 0 5px; }
    .card p { font-size: 0.9em; color: #555; margin: 2px 0; }
    .card a {
      display: inline-block; padding: 6px 10px; background: var(--main-color);
      color: #fff; border-radius: 5px; font-size: 0.9em; margin-top: 6px;
    }
    .back-button {
      display: inline-block; margin-top: 16px; padding: 10px 15px;
      background-color: var(--main-color); color: #fff; border-radius: 5px;
    }
    .back-button:hover { opacity: 0.9; }
    #map {
      width: 100%; height: 400px; margin-top: 1rem;
      border: 1px solid #007bff; border-radius: 5px;
    }
  </style>
</head>
<body>
<?php include APPPATH . 'Views/includes/header.php'; ?>
<main>
  <section class="hero-section">
    <h1>🏨 <?= esc($hotel['business_name']); ?> 숙소 정보</h1>
    <p><?= esc($hotel['site_full_address']); ?> 위치의 숙박 정보입니다.</p>
  </section>
  <section class="detail-card">
    <h3 class="section-title">기본 정보</h3>
    <table class="info-table">
      <tr><th>숙소명</th><td><?= esc($hotel['business_name']); ?></td></tr>
      <tr><th>주소</th><td><?= esc($hotel['site_full_address']); ?></td></tr>
      <tr><th>연락처</th><td><?= esc($hotel['contact_number']); ?></td></tr>
      <tr><th>체크인</th><td>15:00</td></tr>
      <tr><th>체크아웃</th><td>11:00</td></tr>
      <tr><th>객실 수</th><td>한실 <?= esc($hotel['han_room_count'] ?? '정보 없음'); ?>개 / 양실 <?= esc($hotel['western_room_count'] ?? '정보 없음'); ?>개</td></tr>
      <tr><th>건물 층수</th><td>지상 <?= esc($hotel['building_above_ground'] ?? '-'); ?>층 / 지하 <?= esc($hotel['building_below_ground'] ?? '-'); ?>층</td></tr>
    </table>
  </section>
  <section class="detail-card">
    <h3 class="section-title">근처 맛집</h3>
    <div class="card-slider">
      <?php foreach ($results_food as $item): ?>
        <div class="card">
          <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATgAAAChCAMAAABkv1NnAAAA" alt="맛집 이미지">
          <h3><?= esc($item['title']); ?></h3>
          <p><?= esc($item['roadAddress']); ?></p>
          <p><?= esc($item['telephone'] ?? '정보 없음'); ?></p>
          <a href="<?= esc($item['link']); ?>" target="_blank">자세히 보기</a>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <section class="detail-card">
    <h3 class="section-title">주변 관광지</h3>
    <div class="card-slider">
      <?php foreach ($results_tour as $item): ?>
        <div class="card">
          <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATgAAAChCAMAAABkv1NnAAAA" alt="관광지 이미지">
          <h3><?= esc($item['title']); ?></h3>
          <p><?= esc($item['roadAddress']); ?></p>
          <p><?= esc($item['telephone'] ?? '정보 없음'); ?></p>
          <a href="<?= esc($item['link']); ?>" target="_blank">자세히 보기</a>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
  <section class="detail-card">
    <h3 class="section-title">위치</h3>
    <div id="map"></div>
  </section>
</main>
<script>
  var map = new naver.maps.Map('map', {
    center: new naver.maps.LatLng(<?= esc($hotel['coordinate_y']); ?>, <?= esc($hotel['coordinate_x']); ?>),
    zoom: 15
  });
  var marker = new naver.maps.Marker({
    position: new naver.maps.LatLng(<?= esc($hotel['coordinate_y']); ?>, <?= esc($hotel['coordinate_x']); ?>),
    map: map,
    title: "<?= esc($hotel['business_name']); ?>"
  });
</script>
<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
