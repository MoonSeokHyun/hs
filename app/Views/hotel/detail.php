<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- SEO 최적화를 위한 메타 태그 -->
  <meta name="description" content="<?= esc($hotel['business_name']); ?>의 상세 정보 및 근처 맛집과 관광지">
  <meta name="keywords" content="호텔, 관광지, 맛집, <?= esc($hotel['business_name']); ?>, 숙박 정보">
  <meta name="robots" content="index, follow">
  <meta name="author" content="호텔허브">
  
  <!-- Open Graph / Twitter Card -->
  <meta property="og:title" content="<?= esc($hotel['business_name']); ?> - 호텔허브">
  <meta property="og:description" content="<?= esc($hotel['business_name']); ?>의 상세 정보와 근처 맛집 및 관광지를 확인하세요.">
  <meta property="og:image" content="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAATgAAAChCAMAAABkv1NnAAAA">
  <meta property="og:url" content="<?= current_url() ?>">
  <meta property="og:type" content="website">

  <script async src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
<!-- 구글 애드센스 -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
crossorigin="anonymous"></script>

  <title><?= esc($hotel['business_name']); ?> - 호텔허브</title>

  <style>
    /* 기본 초기화 */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    html, body {
      font-family: 'Arial', sans-serif;
      background-color: #f8f9fa;
      color: #333;
    }
    /* 컨테이너 */
    .container {
      width: 90%;
      max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
    }
    /* 제목 및 구분선 */
    h1 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 2.5em;
    }
    .section-title {
      font-size: 1.8em;
      color: #62D491;
      border-bottom: 2px solid #62D491;
      padding-bottom: 5px;
      margin: 30px 0 15px;
    }
    /* 상세 정보 카드 */
    .detail-container {
      background-color: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      margin-bottom: 30px;
    }
    .detail-container p {
      margin: 8px 0;
      font-size: 1em;
      color: #555;
    }
    .detail-container strong {
      color: #333;
    }
    /* 카드 슬라이더 */
    .card-slider {
      display: flex;
      gap: 15px;
      overflow-x: auto;
      padding: 10px 0;
    }
    .card {
      flex: 0 0 auto;
      width: 200px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      text-align: center;
      padding: 15px;
    }
    .card img {
      width: 100%;
      height: 120px;
      border-radius: 5px;
      object-fit: cover;
      margin-bottom: 10px;
    }
    .card h3 {
      font-size: 1.2em;
      margin-bottom: 5px;
      color: #62D491;
    }
    .card p {
      font-size: 0.9em;
      margin: 3px 0;
      color: #555;
    }
    .card a {
      display: inline-block;
      margin-top: 8px;
      padding: 8px 12px;
      background-color: #62D491;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-size: 0.9em;
      transition: background-color 0.3s;
    }
    .card a:hover { background-color: #3eaf7c; }
    /* 지도 컨테이너 */
    .map-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      margin-top: 30px;
    }
    #map { width: 100%; height: 400px; }
    /* 광고 배너 (광고 스타일은 기본 가운데 정렬) */
    .adsbygoogle {
      display: block;
      text-align: center;
      margin: 30px auto;
    }
    /* 반응형 */
    @media (max-width: 768px) {
      h1 { font-size: 2em; }
      .section-title { font-size: 1.5em; }
      .container { padding: 15px; }
    }
  </style>
  <!-- 구글 애드센스 스크립트 (헤더에서 단 한 번 로드) -->
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
          crossorigin="anonymous"></script>
  <!-- 네이버 지도 API (헤더에서 단 한 번 로드) -->
  <script async src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
</head>
<body>

  <?php include APPPATH . 'Views/includes/header.php'; ?>

  <div class="container">
    <h1><?= esc($hotel['business_name']); ?></h1>
    
    <!-- 상단 광고 배너 -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

    <!-- 호텔 정보 섹션 -->
    <div class="detail-container">
      <h2 class="section-title">호텔 정보</h2>
      <p><strong>주소:</strong> <?= esc($hotel['site_full_address']); ?></p>
      <p><strong>연락처:</strong> <?= esc($hotel['contact_number']); ?></p>
      <p><strong>체크인 시간:</strong> 15:00</p>
      <p><strong>체크아웃 시간:</strong> 11:00</p>
      <p><strong>객실 정보:</strong> 한실 <?= esc($hotel['han_room_count'] ?? '정보 없음'); ?>개, 양실 <?= esc($hotel['western_room_count'] ?? '정보 없음'); ?>개</p>
      <p><strong>건물 층수:</strong> 지상 <?= esc($hotel['building_above_ground'] ?? '정보 없음'); ?>층, 지하 <?= esc($hotel['building_below_ground'] ?? '정보 없음'); ?>층</p>
    </div>

    <!-- 중간 광고 배너 -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

    <!-- 근처 맛집 섹션 -->
    <div class="detail-container">
      <h2 class="section-title">근처 맛집</h2>
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
    </div>

    <!-- 하단 광고 배너 -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

    <!-- 주변 관광지 섹션 -->
    <div class="detail-container">
      <h2 class="section-title">주변 관광지</h2>
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
    </div>

    <!-- 지도 섹션 -->
    <div class="map-container">
      <h2 class="section-title">지도</h2>
      <div id="map"></div>
    </div>

    <!-- 최하단 광고 배너 -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
  </div>

  <?php include APPPATH . 'Views/includes/footer.php'; ?>

  <script>
    // Naver 지도 초기화
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

</body>
</html>
