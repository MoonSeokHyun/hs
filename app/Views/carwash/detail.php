<?php
$road_address = esc($carwash['Address (Road Name)']);
preg_match('/([가-힣]+구|[가-힣]+읍)/', $road_address, $matches);
$district_name = isset($matches[0]) ? $matches[0] : '지역';

$business_name = esc($carwash['Business Name']);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $district_name ?> 세차장 | <?= $business_name ?> - 셀프세차, 스팀세차 정보</title>
  <meta name="description" content="<?= esc($carwash['Business Name']) ?> 세차장의 위치, 서비스, 가격 정보 및 리뷰 확인">
  <meta name="keywords" content="세차장, <?= esc($carwash['Business Name']) ?>, 세차, 자동차, <?= esc($carwash['City/District']) ?>">
  <meta name="robots" content="index, follow">
  <meta property="og:title" content="<?= esc($carwash['Business Name']) ?> 세차장 정보">
  <meta property="og:description" content="<?= esc($carwash['Business Name']) ?> 세차장의 정보와 리뷰를 확인해보세요.">
  <meta property="og:url" content="<?= current_url() ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="/static/images/og-carwash.jpg">
  <link rel="canonical" href="<?= current_url() ?>">
  <link rel="stylesheet" href="/assets/css/global.css">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
crossorigin="anonymous"></script>
<!-- 네이버맵 API 주석 처리
<script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
-->
  <style>
    :root {
      --main-color: #62D491;
      --point-color: #3eaf7c;
    }

    html {
      scroll-behavior: smooth;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f8f9fa;
      color: #333;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      padding: 1rem;
    }

    .page-title {
      font-size: 2rem;
      color: var(--main-color);
      text-align: center;
      margin: 1.5rem 0;
    }

    .info-card, .review-form, .review-list, .other-services {
      background: #fff;
      padding: 1.25rem;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      margin-bottom: 2rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }

    th {
      width: 140px;
      color: var(--point-color);
      font-weight: 600;
    }

    /* 지도 스타일 주석 처리
    .map-section {
      height: 400px;
      border-radius: 10px;
      border: 1px solid #ccc;
    }
    */

    textarea {
      width: 100%;
      height: 100px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 1rem;
    }

    .submit-btn {
      padding: 10px 20px;
      background-color: var(--point-color);
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
      font-size: 1rem;
    }

    .stars {
      font-size: 20px;
      color: #ccc;
      cursor: pointer;
    }

    .stars.selected {
      color: gold;
    }

    .review-item {
      border-bottom: 1px solid #eee;
      padding: 10px 0;
    }

    .review-item .meta {
      font-size: 0.85rem;
      color: #777;
      margin-bottom: 5px;
    }

    .review-item .text {
      font-size: 1rem;
    }

    .section-title {
      font-size: 1.25rem;
      color: var(--main-color);
      margin-bottom: 12px;
    }

    .extra-info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1rem;
    }

    @media (max-width: 768px) {
      .page-title {
        font-size: 1.5rem;
      }

      th, td {
        font-size: 0.9rem;
      }

      .submit-btn {
        font-size: 0.95rem;
      }
    }
  </style>

</head>
<body>
  <?php include APPPATH . 'Views/includes/header.php'; ?>

  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>
  <main class="container">
    <h1 class="page-title"><?= esc($carwash['Business Name']) ?> 세차장 정보</h1>

    <div class="info-card">
      <table>
        <tr><th>주소</th><td><?= esc($carwash['Address (Road Name)']) ?>, <?= esc($carwash['City/District']) ?></td></tr>
        <tr><th>전화번호</th><td><?= esc($carwash['Car Wash Phone Number']) ?></td></tr>
        <tr><th>대표자명</th><td><?= esc($carwash['Representative Name']) ?></td></tr>
        <tr><th>세차 종류</th><td><?= esc($carwash['Car Wash Type']) ?></td></tr>
        <tr><th>주차 가능 여부</th><td><?= esc($carwash['Business Type']) ?></td></tr>
        <tr>
  <th>운영 시간</th>
  <td>
    <?= esc($carwash['Weekday Start Time'] ?? '') && esc($carwash['Weekday End Time'] ?? '') 
      ? esc($carwash['Weekday Start Time']) . ' ~ ' . esc($carwash['Weekday End Time']) 
      : '09:00 ~ 21:00' ?>
  </td>
</tr>

<tr>
  <th>휴무일</th>
  <td><?= !empty($carwash['Day Off']) ? esc($carwash['Day Off']) : '매주 일요일' ?></td>
</tr>

<tr>
  <th>요금</th>
  <td><?= !empty($carwash['Car Wash Fee Information']) ? esc($carwash['Car Wash Fee Information']) : '5,000원' ?></td>
</tr>

      </table>
    </div>

    <!-- 지도 div 주석 처리
    <div id="map" class="map-section"></div>
    -->

    <div class="review-form">
      <h2>리뷰 작성</h2>
      <form action="/carwash/saveReview" method="post" onsubmit="return validateForm()">
        <input type="hidden" name="carwash_id" value="<?= esc($carwash['ID']) ?>">
        <div id="star-rating">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="stars" data-value="<?= $i ?>">&#9733;</span>
          <?php endfor; ?>
        </div>
        <input type="hidden" name="rating" id="rating-value">
        <textarea name="comment_text" id="comment-text" placeholder="리뷰를 입력해주세요" required></textarea>
        <button type="submit" class="submit-btn">리뷰 등록</button>
      </form>
    </div>

    <div class="review-list">
      <h2>리뷰 목록</h2>
      <?php foreach ($reviews as $review): ?>
        <div class="review-item">
          <div class="meta">
            <?= date('Y-m-d H:i', strtotime($review['created_at'])) ?> - 평점: <?= $review['rating'] ?>점
          </div>
          <div class="text"><?= esc($review['comment_text']) ?></div>
        </div>
      <?php endforeach; ?>
    </div>

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
<?php include APPPATH . 'Views/includes/footer.php'; ?>


  <!-- 네이버맵 스크립트 주석 처리
  <script>
    const lat = <?= esc($carwash['WGS84 Latitude']) ?>;
    const lng = <?= esc($carwash['WGS84 Longitude']) ?>;
    const map = new naver.maps.Map('map', {
      center: new naver.maps.LatLng(lat, lng),
      zoom: 16
    });
    new naver.maps.Marker({
      position: new naver.maps.LatLng(lat, lng),
      map: map
    });

    document.querySelectorAll('.stars').forEach(star => {
      star.addEventListener('click', () => {
        const rating = star.getAttribute('data-value');
        document.getElementById('rating-value').value = rating;
        document.querySelectorAll('.stars').forEach(s => s.classList.remove('selected'));
        for (let i = 1; i <= rating; i++) {
          document.querySelector('.stars[data-value="' + i + '"]').classList.add('selected');
        }
      });
    });

    function validateForm() {
      const rating = document.getElementById('rating-value').value;
      const comment = document.getElementById('comment-text').value.trim();
      if (!rating || !comment) {
        alert('평점과 리뷰 내용을 모두 입력해주세요.');
        return false;
      }
      return true;
    }
  </script>
</body>
</html>
