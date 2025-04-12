<?php
// 주유소의 도로명 주소 예시
$road_address = esc($station['road_address']);

// 구 이름이나 읍 이름을 추출하기 위한 정규 표현식
preg_match('/([가-힣]+구|[가-힣]+읍)/', $road_address, $matches);

// 구 또는 읍 이름을 추출
$district_name = isset($matches[0]) ? $matches[0] : '주유소';

// 주유소 종류 기본값 설정 (기존에 정의되지 않으면 '일반'으로 설정)
$gas_station_type = isset($station['gas_station_type']) ? esc($station['gas_station_type']) : '일반';
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= esc($station['gas_station_name']) ?> 주유소의 최신 유가 정보와 주변 주유소 위치를 확인하세요.">
  <meta name="keywords" content="<?= esc($station['gas_station_name']) ?>, 주유소, 가격 정보, <?= esc($station['road_address']) ?>, 주변 주유소">

  <!-- Open Graph meta tags for social media sharing -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= esc($station['gas_station_name']) ?> 주유소 가격 정보">
  <meta property="og:description" content="<?= esc($station['gas_station_name']) ?> 주유소의 유가와 위치 정보를 확인하세요.">
  <meta property="og:url" content="<?= current_url() ?>">
  <meta property="og:image" content="URL_TO_IMAGE"> <!-- 주유소 대표 이미지 URL 추가 -->
  <meta property="og:site_name" content="Car Hub - 주유소 정보 사이트">

  <!-- Twitter meta tags for social media sharing -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= esc($station['gas_station_name']) ?> 주유소 가격 정보">
  <meta name="twitter:description" content="<?= esc($station['gas_station_name']) ?> 주유소의 유가와 위치 정보를 확인하세요.">
  <meta name="twitter:image" content="URL_TO_IMAGE">

  <title><?= esc($station['gas_station_name']) ?> - <?= esc($station['road_address']) ?></title>

  <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>

  <style>
    /* 기본 초기화 */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    html, body {
      height: 100%;
      font-family: "Arial", sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      background-color: #f7f8fa;
    }
    a {
      color: inherit;
      text-decoration: none;
    }
    ul, ol, li {
      list-style: none;
    }
    table {
      border-collapse: collapse;
      border-spacing: 0;
    }

    :root {
      --main-color: #62D491;
      --point-color: #3eaf7c;
      --light-bg: #f7f8fa;
      --card-bg: #fff;
      --border-color: #ddd;
      --text-color: #333;
      --secondary-text: #666;
    }

    body {
      margin: 0;
      color: var(--text-color);
    }

    /* 전체 섹션 레이아웃 */
    main {
      width: 100%;
      max-width: 1000px;
      margin: 0 auto;
      padding: 20px 16px;
    }

    /* (1) Hero Section */
    .hero-section {
      background: #fff;
      border-radius: 8px;
      padding: 2rem;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
      text-align: center;
      margin-bottom: 2rem;
    }
    .hero-section h2 {
      font-size: 24px;
      margin-bottom: 1rem;
    }
    .hero-section p {
      font-size: 16px;
      color: #555;
      line-height: 1.6;
    }

    /* (2) 주유소 상세 Section */
    .detail-section {
      margin-bottom: 2rem;
    }
    .detail-card {
      background: #fff;
      border-left: 5px solid var(--main-color);
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
      margin-bottom: 1.5rem;
    }
    .detail-header {
      margin-bottom: 16px;
    }
    .facility-name {
      font-size: 22px;
      font-weight: bold;
      color: #333;
    }
    .facility-type {
      font-size: 16px;
      color: #555;
      margin: 5px 0;
    }
    .sub-info {
      font-size: 14px;
      color: #777;
      margin-bottom: 10px;
    }
    .section-title {
      font-size: 18px;
      color: var(--main-color);
      margin-bottom: 12px;
    }
    .info-table {
      width: 100%;
      border: 1px solid #ddd;
      margin-top: 12px;
    }
    .info-table th,
    .info-table td {
      padding: 10px;
      border: 1px solid #eee;
      font-size: 14px;
      vertical-align: top;
    }
    .info-table th {
      background-color: #f0f8ff;
      color: var(--point-color);
      width: 120px;
    }

    .back-button {
      display: inline-block;
      margin-top: 12px;
      padding: 10px 15px;
      background-color: var(--main-color);
      color: #fff;
      border-radius: 5px;
      text-decoration: none;
    }
    .back-button:hover {
      opacity: 0.9;
    }

    /* 지도 */
    #map {
      width: 100%;
      height: 400px;
      margin-top: 1rem;
      border: 1px solid #007bff;
      border-radius: 5px;
    }

    /* (3) 주변 주유소 섹션 */
    .nearby-section {
      margin-bottom: 2rem;
    }
    .nearby-table {
      width: 100%;
      margin-top: 12px;
      border: 1px solid #ddd;
    }
    .nearby-table th,
    .nearby-table td {
      padding: 10px;
      border: 1px solid #eee;
      font-size: 14px;
    }
    .nearby-table th {
      background-color: #e6f7ff;
      color: var(--point-color);
    }
    .nearby-table tr:hover {
      background-color: #fafafa;
      cursor: pointer;
    }

    /* (4) 리뷰 섹션 */
    .review-section {
      margin-bottom: 2rem;
    }
    .review-box {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 16px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .review-box h2 {
      font-size: 18px;
      color: var(--main-color);
      margin-bottom: 12px;
    }
    .comment-form {
      margin-bottom: 20px;
    }
    .rating-label {
      margin-right: 8px;
      font-size: 14px;
    }
    .star {
      font-size: 1.2rem;
      color: #ccc;
      cursor: pointer;
      margin-right: 2px;
    }
    .star.selected {
      color: gold;
    }
    .comment-textarea {
      width: 100%;
      min-height: 70px;
      margin-top: 8px;
      margin-bottom: 8px;
      padding: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
      border-radius: 5px;
      resize: vertical;
    }
    .submit-button {
      background-color: var(--main-color);
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 15px;
      font-size: 14px;
      cursor: pointer;
    }
    .submit-button:hover {
      opacity: 0.9;
    }
    .review-box h3 {
      font-size: 16px;
      color: #333;
      margin-top: 20px;
      margin-bottom: 10px;
    }
    .comment-item {
      border-bottom: 1px solid #eee;
      padding: 8px 0;
    }
    .comment-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 6px;
    }
    .comment-date {
      font-size: 12px;
      color: #999;
    }
    .comment-text {
      font-size: 14px;
      color: #444;
    }

    /* (6) 광고 배너 (예시) */
    .ad-banner {
      display: block;
      margin: 20px auto;
      text-align: center;
    }

    /* ▼ 모바일 최적화: 화면이 600px 이하일 때 */
    @media (max-width: 600px) {
      .facility-name {
        font-size: 20px;
      }
      .facility-type {
        font-size: 14px;
      }
      .info-table th,
      .info-table td {
        font-size: 13px;
        padding: 8px;
      }
      .nearby-table th,
      .nearby-table td {
        font-size: 13px;
        padding: 8px;
      }
      .comment-textarea {
        font-size: 13px;
      }
    }
  </style>
</head>
<body>
  <!-- 헤더 (header.php) -->
  <?php
    include APPPATH . 'Views/includes/header.php';
  ?>

  <!-- 상단 광고 배너 (예: 애드센스) -->
  <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
  <script>
     (adsbygoogle = window.adsbygoogle || []).push({});
  </script>

  <!-- Hero Section -->
  <section class="hero-section">
    <h2>💡 주유소 정보</h2>
    <p>
      <?= esc($station['gas_station_name']) ?> 주유소의 최신 유가 정보와 주변 주유소 위치를 확인해보세요.
    </p>
  </section>

  <!-- 본문 메인 -->
  <main>
    <!-- (1) 주유소 상세 Section -->
    <section class="detail-section">
      <div class="detail-card">
        <div class="detail-header">
          <div class="facility-name"><?= esc($station['gas_station_name']) ?></div>
          <div class="facility-type"><?= esc($gas_station_type) ?> 주유소</div>
          <div class="sub-info">📍 <?= esc($station['road_address']) ?></div>
        </div>

        <h3 class="section-title">유가 정보</h3>
        <table class="info-table">
          <tr>
            <th>가솔린</th>
            <td><?= number_format($gasolinePrice) ?> 원</td>
          </tr>
          <tr>
            <th>경유</th>
            <td><?= number_format($dieselPrice) ?> 원</td>
          </tr>
          <tr>
            <th>고급 휘발유</th>
            <td><?= number_format($premiumGasolinePrice) ?> 원</td>
          </tr>
          <tr>
            <th>등유</th>
            <td><?= number_format($kerosenePrice) ?> 원</td>
          </tr>
        </table>

        <!-- 목록으로 돌아가기 버튼 -->
        <a href="<?= site_url('/gas_stations') ?>" class="back-button">목록으로 돌아가기</a>

        <!-- 지도 -->
        <div id="map"></div>
      </div>
    </section>

    <!-- (2) 주변 주유소 Section -->
    <section class="nearby-section">
      <h3 class="section-title">주변 3km 이내 주유소</h3>
      <table class="nearby-table">
        <thead>
          <tr>
            <th>주유소 이름</th>
            <th>도로명 주소</th>
            <th>거리 (km)</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($nearbyGasStations as $nearbyStation): ?>
            <tr>
              <td><?= esc($nearbyStation['gas_station_name']) ?></td>
              <td><?= esc($nearbyStation['road_address']) ?></td>
              <td><?= number_format($nearbyStation['distance'], 2) ?> km</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </section>

    <!-- (3) 리뷰 섹션 -->
    <section class="review-section">
      <div class="review-box">
        <h2>리뷰 남기기</h2>
        <form action="/gas_station/saveComment" method="post" class="comment-form" onsubmit="return validateForm()">
          <input type="hidden" name="station_id" value="<?= esc($station['id']); ?>">
          
          <div class="rating" id="star-rating">
            <span class="rating-label">평점:</span>
            <?php for ($i = 1; $i <= 5; $i++): ?>
              <span class="star" data-value="<?= $i; ?>">&#9733;</span>
            <?php endfor; ?>
            <input type="hidden" name="rating" id="rating-value">
          </div>

          <textarea name="comment_text" placeholder="리뷰를 등록해주세요!" required class="comment-textarea" id="comment-text"></textarea>
          <button type="submit" class="submit-button">리뷰 등록</button>
        </form>

        <!-- 리뷰 목록 -->
        <h3>리뷰 목록</h3>
        <div class="comments-list">
          <?php if (!empty($reviews)): ?>
            <?php foreach ($reviews as $review): ?>
              <div class="comment-item">
                <div class="comment-header">
                  <span class="comment-rating">
                    <?php 
                      for ($i = 1; $i <= 5; $i++): 
                        echo ($i <= $review['rating']) ? '<span class="star selected">&#9733;</span>' : '<span class="star">&#9733;</span>';
                      endfor;
                    ?>
                  </span>
                  <span class="comment-date"><?= date('Y-m-d H:i', strtotime($review['created_at'])); ?></span>
                </div>
                <p class="comment-text"><?= esc($review['comment_text']); ?></p>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>댓글이 없습니다.</p>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>
  <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>
  <?php include APPPATH . 'Views/includes/footer.php'; ?>

  <script>
    // 지도 초기화
    (function(){
      var lat  = parseFloat("<?= esc($station['latitude']) ?>");
      var lng  = parseFloat("<?= esc($station['longitude']) ?>");
      var name = "<?= esc($station['gas_station_name']) ?>";

      var map = new naver.maps.Map('map', {
        center: new naver.maps.LatLng(lat, lng),
        zoom: 16
      });

      var mainMarker = new naver.maps.Marker({
        position: new naver.maps.LatLng(lat, lng),
        map: map,
        title: name
      });

      // 주변 주유소(5개)
      var nearbyStations = <?php echo json_encode($nearbyGasStations); ?>;
      nearbyStations.forEach(function(station){
        var marker = new naver.maps.Marker({
          position: new naver.maps.LatLng(station.latitude, station.longitude),
          map: map,
          title: station.gas_station_name
        });
        var infoWindow = new naver.maps.InfoWindow({
          content: '<div style="padding:10px; font-size:14px;"><b>' + station.gas_station_name + '</b><br>' +
                   '주소: ' + station.road_address + '<br>' +
                   '전화: ' + station.phone_number + '</div>'
        });
        naver.maps.Event.addListener(marker, 'click', function(){
          infoWindow.open(map, marker);
        });
      });
    })();

    // 별점 선택 이벤트
    document.querySelectorAll('#star-rating .star').forEach(star => {
      star.addEventListener('click', function() {
        const ratingValue = this.getAttribute('data-value');
        document.getElementById('rating-value').value = ratingValue;

        // 모든 별에서 selected 제거
        document.querySelectorAll('#star-rating .star').forEach(s => s.classList.remove('selected'));
        // 선택한 별까지 selected 추가
        for (let i = 0; i < ratingValue; i++) {
          document.querySelectorAll('#star-rating .star')[i].classList.add('selected');
        }
      });
    });

    // 리뷰 폼 유효성 검사
    function validateForm(){
      const ratingValue = document.getElementById('rating-value').value;
      const commentText = document.getElementById('comment-text').value.trim();
      if (!ratingValue || !commentText) {
        alert("평점과 리뷰 내용을 입력해주세요!");
        return false;
      }
      return true;
    }
  </script>
</body>
</html>
