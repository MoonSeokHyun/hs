<?php
// 정비소의 도로명 주소 예시
$road_address = esc($repair_shop['road_address']);

// 구 이름이나 읍 이름을 추출하기 위한 정규 표현식
preg_match('/([가-힣]+구|[가-힣]+읍)/', $road_address, $matches);

// 구 또는 읍 이름을 추출
$district_name = isset($matches[0]) ? $matches[0] : '정비소';
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8" />
  <title><?= esc($repair_shop['repair_shop_name']); ?> - <?= esc($district_name); ?> 차량정비·수리·엔진오일 교체 전문 정비소</title>

  <meta name="description" content="<?= esc($repair_shop['road_address'] ?? '') ?> 위치의 정비소 <?= esc($repair_shop['repair_shop_name'] ?? '') ?>의 상세 정보, 지도, 리뷰, 전화번호 등을 확인해보세요.">
  <meta name="keywords" content="정비소, <?= esc($repair_shop['repair_shop_name'] ?? '') ?>, 자동차 수리, 차량정비, 정비소 추천, 전국 정비소, <?= esc($repair_shop['road_address'] ?? '') ?>">
  <meta name="author" content="편잇 팀">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="robots" content="index, follow" />

  <!-- Open Graph (SNS 공유 최적화) -->
  <meta property="og:title" content="<?= esc($repair_shop['repair_shop_name'] ?? '') ?> - 정비소 상세 정보">
  <meta property="og:description" content="<?= esc($repair_shop['road_address'] ?? '') ?> 위치의 정비소 정보입니다.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= current_url() ?>">
  <meta property="og:image" content="/static/images/og-default.jpg">

  
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= esc($repair_shop['repair_shop_name'] ?? '') ?>">
  <meta name="twitter:description" content="정비소 상세정보를 확인해보세요.">
  <meta name="twitter:image" content="/static/images/og-default.jpg">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
crossorigin="anonymous"></script>
<!--
<script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
 -->
</head>
<!-- 구글 애드센스 -->

  <!-- JSON-LD 구조화 데이터 (LocalBusiness) -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "AutoRepair",
    "name": "<?= esc($repair_shop['repair_shop_name'] ?? '') ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?= esc($repair_shop['road_address'] ?? '') ?>",
      "addressLocality": "<?= esc($repair_shop['road_address'] ?? '') ?>",
      "addressCountry": "KR"
    },
    "telephone": "<?= esc($repair_shop['phone_number'] ?? '') ?>",
    "url": "<?= current_url() ?>",
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "<?= round($averageRating ?? 0, 1) ?>",
      "reviewCount": "<?= count($reviews ?? []) ?>"
    }
  }
  </script>

  <!-- CSS 초기화 & 공통 스타일 -->
  <style>
    /* 기본 초기화 */
    * {
      margin: 0; padding: 0; box-sizing: border-box;
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
    ul, ol, li { list-style: none; }
    table { border-collapse: collapse; border-spacing: 0; }

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

    /* (2) 정비소 상세 Section */
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

    /* (3) 주변 정비소 섹션 */
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
      /* ★ 헤더/푸터 관련 부분 제거 (header h1 등) ★ */
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
      .menu-bar a {
        margin: 0 5px;
      }
    }

    /* ★ (5) 푸터 섹션 CSS 모두 제거됨 ★ */
  /* 별점 스타일 */
  .star {
    font-size: 2rem;
    color: #ccc;
    cursor: pointer;
    transition: color 0.3s ease;
  }

  .star.selected {
    color: gold;
  }

  .star.hover {
    color: #fa0;
  }

  /* 클릭 시 별색 변경 */
  .comment-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }

  .submit-button {
    background-color: #007bff;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .submit-button:hover {
    background-color: #0056b3;
  }

  /* 공통 섹션 스타일 */
.maintenance-section {
  margin-bottom: 2rem;
}

.maintenance-card {
  background: #fff;
  border-left: 5px solid var(--main-color);
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.maintenance-card h4 {
  font-size: 18px;
  color: #333;
  margin-bottom: 10px;
}

.maintenance-card p {
  font-size: 14px;
  color: #555;
  line-height: 1.6;
  margin-bottom: 15px;
}

.section-title {
  font-size: 22px;
  color: var(--main-color);
  margin-bottom: 15px;
  font-weight: bold;
  text-align: left;
}

/* (4) 엔진오일 관리법 Section */
.maintenance-section .maintenance-card {
  border-left: 5px solid #62D491; /* 엔진오일 섹션에 초록색 강조 */
}

.maintenance-section .maintenance-card h4 {
  font-size: 18px;
  color: #3eaf7c; /* 엔진오일 관련 제목 색상 */
}

.maintenance-section .maintenance-card p {
  color: #444;
}

/* (5) 타이어 관리법 Section */
.maintenance-section .maintenance-card {
  border-left: 5px solid #3eaf7c; /* 타이어 섹션에 푸른색 강조 */
}

.maintenance-section .maintenance-card h4 {
  font-size: 18px;
  color: #007bff; /* 타이어 관련 제목 색상 */
}

.maintenance-section .maintenance-card p {
  color: #444;
}

/* (6) 자동차 배터리 관리법 Section */
.maintenance-section .maintenance-card {
  border-left: 5px solid #f39c12; /* 배터리 섹션에 주황색 강조 */
}

.maintenance-section .maintenance-card h4 {
  font-size: 18px;
  color: #f39c12; /* 배터리 관련 제목 색상 */
}

.maintenance-section .maintenance-card p {
  color: #444;
}

/* (7) 브레이크 시스템 관리법 Section */
.maintenance-section .maintenance-card {
  border-left: 5px solid #e74c3c; /* 브레이크 섹션에 빨간색 강조 */
}

.maintenance-section .maintenance-card h4 {
  font-size: 18px;
  color: #e74c3c; /* 브레이크 관련 제목 색상 */
}

.maintenance-section .maintenance-card p {
  color: #444;
}

  </style>

  <!-- (선택) 구글 애드센스 등 스크립트 -->

</head>
<body>




<?php
    include APPPATH . 'Views/includes/header.php';
  ?>
  <!-- 상단 광고 배너 (예: 애드센스) -->
<!-- easehub -->

  <!-- Hero Section -->
  <section class="hero-section">
    <h1>💡 누구나 쉽게 접근 가능한 <?= esc($repair_shop['repair_shop_name'] ?? '업체명'); ?> 정보! </h1>
    <p>
      원하는 정보를 빠르게 찾고 자유롭게 활용해보세요.
    </p>
    <p>
    <span style="font-size:14px;">(평균 평점: <?= round($averageRating ?? 0, 1); ?>)</span>
    </p>
  </section>
  <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>

  <!-- 본문 메인 -->
  <main>
    <!-- (1) 정비소 상세 Section -->
    <section class="detail-section">
      <div class="detail-card">
        <div class="detail-header">
          <div class="facility-name"><?= esc($repair_shop['repair_shop_name'] ?? '업체명'); ?></div>
          <div class="facility-type"><?= esc($repair_shop['repair_shop_type'] ?? '1'); ?>급 정비소</div>
          <div class="sub-info">📍 <?= esc($repair_shop['road_address'] ?? '도로명 주소'); ?></div>
        </div>

        <h3 class="section-title">정비소 기본 정보</h3>
        <table class="info-table">
          <tr>
            <th>정비소명</th>
            <td><?= esc($repair_shop['repair_shop_name'] ?? ''); ?></td>
          </tr>
          <tr>
            <th>정비소 종류</th>
            <td><?= esc($repair_shop['repair_shop_type'] ?? ''); ?>급 정비소</td>
          </tr>
          <tr>
            <th>도로명 주소</th>
            <td><?= esc($repair_shop['road_address'] ?? ''); ?></td>
          </tr>
          <tr>
            <th>지번 주소</th>
            <td><?= esc($repair_shop['land_lot_address'] ?? ''); ?></td>
          </tr>
          <tr>
            <th>전화번호</th>
            <td><?= esc($repair_shop['phone_number'] ?? ''); ?></td>
          </tr>
          <tr>
            <th>등록일</th>
            <td><?= esc($repair_shop['registration_date'] ?? ''); ?></td>
          </tr>
          <tr>
            <th>영업 상태</th>
            <td>
              <?php 
                $status = $repair_shop['business_status'] ?? 0;
                echo ($status == 1) ? '영업중'
                  : (($status == 2) ? '폐업' : '알 수 없음');
              ?>
            </td>
          </tr>
          <tr>
            <th>관리기관명</th>
            <td><?= esc($repair_shop['management_agency_name'] ?? ''); ?></td>
          </tr>
          <tr>
            <th>제공업체명</th>
            <td><?= esc($repair_shop['provider_name'] ?? ''); ?></td>
          </tr>
        </table>
        <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
  <!-- (3) 리뷰 섹션 -->
  <section class="review-section">
  <div class="review-box">
    <h2>리뷰 남기기 <span style="font-size:14px;">(평균 평점: <?= round($averageRating ?? 0, 1); ?>)</span></h2>
    <form action="/automobile_repair_shop/saveReview" method="post" class="comment-form" onsubmit="return validateForm()">
      <input type="hidden" name="repair_shop_id" value="<?= esc($repair_shop['id'] ?? 0); ?>">
      
      <div id="star-rating" style="margin-bottom:8px;">
        <span class="rating-label">평점:</span>
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <span class="star" data-value="<?= $i; ?>">&#9733;</span>
        <?php endfor; ?>
        <input type="hidden" name="rating" id="rating-value">
      </div>

      <textarea name="comment_text" class="comment-textarea" id="comment-text" placeholder="리뷰를 등록해주세요!" required></textarea>
      <button type="submit" class="submit-button">리뷰 등록</button>
    </form>
    <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
    <h3>리뷰 목록</h3>
    <?php if (empty($reviews)): ?>
      <p style="font-size:14px; color:#555;">아직 리뷰가 없습니다.</p>
    <?php else: ?>
      <?php foreach ($reviews as $review): ?>
      <div class="comment-item">
        <div class="comment-header">
          <span>
          <?php 
            $r = $review['rating'] ?? 0;
            for ($i=1; $i<=5; $i++){
              if($i <= $r){
                echo '<span class="star selected">&#9733;</span>';
              } else {
                echo '<span class="star">&#9733;</span>';
              }
            }
          ?>
          </span>
          <span class="comment-date"><?= date('Y-m-d H:i', strtotime($review['created_at'] ?? '')); ?></span>
        </div>
        <p class="comment-text"><?= esc($review['comment_text'] ?? ''); ?></p>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>
        <!-- 목록으로 돌아가기 버튼 -->
        <a href="<?= site_url('/automobile_repair_shops') ?>" class="back-button">
          목록으로 돌아가기
        </a>

        <section class="nearby-section">
        <div id="map"></div>
      </div>
    </section>


    <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>



    <!-- (2) 주변 정비소 Section -->
    <section class="nearby-section">
      <h3 class="section-title">1km 이내 정비소 정보</h3>
      <table class="nearby-table">
        <thead>
          <tr>
            <th>정비소명</th>
            <th>주소</th>
            <th>전화번호</th>
            <th>거리 (km)</th>
          </tr>
        </thead>
        <tbody>
        <?php if (empty($nearby_shops)) : ?>
          <tr>
            <td colspan="4">근처 정비소 정보가 없습니다.</td>
          </tr>
        <?php else : 
          $limitShops = array_slice($nearby_shops, 0, 5);
          foreach ($limitShops as $shop) : ?>
            <tr onclick="window.location.href='/automobile_repair_shop/<?= esc($shop['id']) ?>'">
              <td><?= esc($shop['repair_shop_name'] ?? ''); ?></td>
              <td><?= esc($shop['road_address'] ?? ''); ?></td>
              <td><?= esc($shop['phone_number'] ?? ''); ?></td>
              <td><?= round($shop['distance'] ?? 0, 1); ?> km</td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
      </table>
    </section>
 


    <!-- (추가) 카드 섹션 예시 -->
    <section>
  <h3 class="section-title">다른 서비스</h3>
  <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px,1fr)); gap: 1rem; margin-top:1rem;">
    
    <!-- 편의점 이벤트 -->
    <a href="/events" style="text-decoration: none;">
      <div style="background:#fff; border-left:5px solid var(--main-color); border-radius:8px; padding:1rem; box-shadow:0 2px 5px rgba(0,0,0,0.05); transition: transform 0.2s;">
        <h4 style="color:var(--main-color); margin-bottom:0.5rem;">🏞️ 편의점 이벤트</h4>
        <p style="font-size:14px; line-height:1.4; color:#555;">전국의 편의점 1+1 이벤트를 한번에!</p>
      </div>
    </a>

    <!-- 편의점 레시피 -->
    <a href="/recipes" style="text-decoration: none;">
      <div style="background:#fff; border-left:5px solid var(--main-color); border-radius:8px; padding:1rem; box-shadow:0 2px 5px rgba(0,0,0,0.05); transition: transform 0.2s;">
        <h4 style="color:var(--main-color); margin-bottom:0.5rem;">👨‍👩‍👧 편의점음식으로 만드는 레시피</h4>
        <p style="font-size:14px; line-height:1.4; color:#555;">편의점 음식으로 레시피를!?</p>
      </div>
    </a>

    <!-- 자동차 정보 -->
    <a href="/parking" style="text-decoration: none;">
      <div style="background:#fff; border-left:5px solid var(--main-color); border-radius:8px; padding:1rem; box-shadow:0 2px 5px rgba(0,0,0,0.05); transition: transform 0.2s;">
        <h4 style="color:var(--main-color); margin-bottom:0.5rem;">🏛️ 각종 자동차 정보</h4>
        <p style="font-size:14px; line-height:1.4; color:#555;">주유소 주차장은 여기로!</p>
      </div>
    </a>

  </div>
</section>

  </main>
  <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>

  <!-- 푸터 (footer.php) -->
  <?php
    include APPPATH . 'Views/includes/footer.php';
  ?>


  <script>


  (function(){
    var lat  = parseFloat("<?= esc($repair_shop['latitude'] ?? '37.5665'); ?>");
    var lng  = parseFloat("<?= esc($repair_shop['longitude'] ?? '126.9780'); ?>");
    var name = "<?= esc($repair_shop['repair_shop_name'] ?? '정비소'); ?>";

    var map = new naver.maps.Map('map', {
      center: new naver.maps.LatLng(lat, lng),
      zoom: 16
    });
    var mainMarker = new naver.maps.Marker({
      position: new naver.maps.LatLng(lat, lng),
      map: map,
      title: name
    });

    // 주변 정비소(5개)
    var nearbyShops = <?php echo json_encode(array_slice($nearby_shops ?? [], 0, 5)); ?>;
    nearbyShops.forEach(function(shop){
      var marker = new naver.maps.Marker({
        position: new naver.maps.LatLng(shop.latitude, shop.longitude),
        map: map,
        title: shop.repair_shop_name
      });
      var infoWindow = new naver.maps.InfoWindow({
        content: '<div style="padding:10px; font-size:14px;"><b>' + shop.repair_shop_name + '</b><br>'
              + '주소: ' + shop.road_address + '<br>'
              + '전화: ' + shop.phone_number + '</div>'
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
        for (let i = 1; i <= ratingValue; i++) {
          document.querySelector('#star-rating .star[data-value="'+ i +'"]').classList.add('selected');
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

<script>
  // 별점 클릭 이벤트
  document.querySelectorAll('#star-rating .star').forEach(star => {
    star.addEventListener('mouseover', function() {
      // 마우스 오버 시 선택한 별까지 색상 변경
      const value = parseInt(this.getAttribute('data-value'));
      document.querySelectorAll('#star-rating .star').forEach((s, index) => {
        if (index < value) {
          s.classList.add('hover');
        } else {
          s.classList.remove('hover');
        }
      });
    });

    star.addEventListener('click', function() {
      // 클릭 시 선택된 별까지 색상 변경
      const value = parseInt(this.getAttribute('data-value'));
      document.getElementById('rating-value').value = value;  // hidden input에 점수 저장

      // 색상 변경: 선택된 별까지 yellow로 채우기
      document.querySelectorAll('#star-rating .star').forEach((s, index) => {
        if (index < value) {
          s.classList.add('selected');
        } else {
          s.classList.remove('selected');
        }
      });
    });

    star.addEventListener('mouseout', function() {
      // 마우스 아웃 시 hover 클래스 제거
      document.querySelectorAll('#star-rating .star').forEach(s => {
        s.classList.remove('hover');
      });
    });
  });

  // 폼 유효성 검사
  function validateForm() {
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