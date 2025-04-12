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
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= esc($parkingLot['address_road'] ?? '') ?> <?= esc($parkingLot['name'] ?? '주차장') ?> 주변 주유소 주변 정비소 주변 편의점 편의점 상품 1+1 상세정보 - 편잇</title>
  <meta name="description" content="<?= esc($parkingLot['name'] ?? '주차장') ?>의 위치, 요금, 리뷰 등 상세 정보를 확인하세요. 전국의 주차장을 편하게 비교하고 리뷰도 남겨보세요.">
  <meta name="keywords" content="주차장, <?= esc($parkingLot['name'] ?? '') ?>, 차량 관리, 리뷰, 별점, 위치 정보">
  <meta name="author" content="편잇">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= current_url() ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= esc($parkingLot['name'] ?? '주차장') ?> 상세정보 - 편잇">
  <meta property="og:description" content="<?= esc($parkingLot['name'] ?? '주차장') ?>의 요금, 위치, 리뷰 등 상세 정보 확인">
  <meta property="og:url" content="<?= current_url() ?>">
  <meta property="og:image" content="/static/images/og-parking.jpg">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= esc($parkingLot['name'] ?? '주차장') ?> 상세정보 - 편잇">
  <meta name="twitter:description" content="<?= esc($parkingLot['name'] ?? '주차장') ?>에 대한 상세 정보를 편하게 확인하세요.">
  <meta name="twitter:image" content="/static/images/og-parking.jpg">
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ParkingFacility",
    "name": "<?= esc($parkingLot['name'] ?? '') ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?= esc($parkingLot['address_road'] ?? '') ?>",
      "addressCountry": "KR"
    },
    "telephone": "<?= esc($parkingLot['phone_number'] ?? '') ?>",
    "url": "<?= current_url() ?>",
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "<?= round($averageRating ?? 0, 1) ?>",
      "reviewCount": "<?= count($comments ?? []) ?>"
    }
  }
  </script>
  <link rel="stylesheet" href="/assets/css/global.css">
  <style>
    :root {
      --main-color: #62D491;
      --point-color: #3eaf7c;
      --light-bg: #f7f8fa;
      --card-bg: #fff;
      --border-color: #ddd;
      --text-color: #333;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: Arial, sans-serif;
      background: var(--light-bg);
      color: var(--text-color);
    }
    main.container {
      max-width: 1000px;
      margin: auto;
      padding: 2rem 1rem;
    }
    h1 {
      font-size: 2rem;
      color: var(--main-color);
      text-align: center;
      margin-bottom: 2rem;
    }
    .section {
      background: var(--card-bg);
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      margin-bottom: 2rem;
    }
    .section h2 {
      font-size: 1.5rem;
      color: var(--main-color);
      margin-bottom: 1rem;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }
    th, td {
      padding: 12px;
      border: 1px solid var(--border-color);
      font-size: 0.95rem;
    }
    th {
      background: #e6f7ff;
      color: var(--point-color);
    }
    .form-group textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 0.95rem;
      margin-top: 10px;
    }
    .form-group .star {
      font-size: 1.5rem;
      color: #ccc;
      cursor: pointer;
    }
    .form-group .star.selected {
      color: #ffd700;
    }
    .form-group button {
      padding: 10px 20px;
      background: var(--point-color);
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }
    .form-group button:hover {
      background: #2e9b68;
    }
    .comment-box {
      border-top: 1px solid #eee;
      padding-top: 1rem;
    }
    .comment-meta {
      font-size: 0.85rem;
      color: #666;
    }
    .comment-text {
      margin-top: 0.5rem;
    }
  </style>
</head>
<body>
  <?php include APPPATH . 'Views/includes/header.php'; ?>
  <main class="container">
    <h1><?= esc($parkingLot['name'] ?? '주차장명') ?> 상세정보</h1>

    <section class="section">
      <h2>기본 정보</h2>
      <table>
        <tr><th>주소</th><td><?= esc($parkingLot['address_road']) ?></td></tr>
        <tr><th>전화번호</th><td><?= esc($parkingLot['phone_number']) ?></td></tr>
        <tr><th>총 주차 구획 수</th><td><?= esc($parkingLot['total_spots']) ?></td></tr>
        <tr><th>요금 정보</th><td><?= esc($parkingLot['fee_information']) ?></td></tr>
        <tr><th>운영 시간</th><td>
          평일: <?= esc($parkingLot['weekday_start_time']) ?> ~ <?= esc($parkingLot['weekday_end_time']) ?><br>
          토요일: <?= esc($parkingLot['saturday_start_time']) ?> ~ <?= esc($parkingLot['saturday_end_time']) ?><br>
          공휴일: <?= esc($parkingLot['holiday_start_time']) ?> ~ <?= esc($parkingLot['holiday_end_time']) ?>
        </td></tr>
        <tr><th>특이사항</th><td><?= esc($parkingLot['special_notes']) ?></td></tr>
      </table>
    </section>

    <section class="section">
      <h2>리뷰</h2>
      <form action="/parking/saveComment" method="post" class="form-group">
        <input type="hidden" name="parking_lot_id" value="<?= esc($parkingLot['id']) ?>">
        <div>
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="star" data-value="<?= $i ?>">&#9733;</span>
          <?php endfor; ?>
          <input type="hidden" name="rating" id="rating-value">
        </div>
        <textarea name="comment_text" placeholder="리뷰를 입력하세요" required></textarea>
        <button type="submit">등록</button>
      </form>

      <script>
        document.querySelectorAll('.star').forEach(star => {
          star.addEventListener('click', function () {
            const rating = this.getAttribute('data-value');
            document.getElementById('rating-value').value = rating;
            document.querySelectorAll('.star').forEach(s => s.classList.remove('selected'));
            for (let i = 1; i <= rating; i++) {
              document.querySelector('.star[data-value="' + i + '"]').classList.add('selected');
            }
          });
        });
      </script>

      <?php foreach ($comments as $comment): ?>
      <div class="comment-box">
        <div class="comment-meta">
          <span class="rating-stars">★ <?= $comment['rating'] ?>점</span> · <?= date('Y-m-d', strtotime($comment['created_at'])) ?>
        </div>
        <div class="comment-text"><?= esc($comment['comment_text']) ?></div>
      </div>
      <?php endforeach; ?>
    </section>

    <section class="section">
      <h3 class="section-title">다른 서비스</h3>
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px,1fr)); gap: 1rem; margin-top:1rem;">
        <a href="/events" style="text-decoration: none;">
          <div style="background:#fff; border-left:5px solid var(--main-color); border-radius:8px; padding:1rem; box-shadow:0 2px 5px rgba(0,0,0,0.05); transition: transform 0.2s;">
            <h4 style="color:var(--main-color); margin-bottom:0.5rem;">🏞️ 편의점 이벤트</h4>
            <p style="font-size:14px; line-height:1.4; color:#555;">전국의 편의점 1+1 이벤트를 한번에!</p>
          </div>
        </a>
        <a href="/recipes" style="text-decoration: none;">
          <div style="background:#fff; border-left:5px solid var(--main-color); border-radius:8px; padding:1rem; box-shadow:0 2px 5px rgba(0,0,0,0.05); transition: transform 0.2s;">
            <h4 style="color:var(--main-color); margin-bottom:0.5rem;">👨‍👩‍👧 편의점음식으로 만드는 레시피</h4>
            <p style="font-size:14px; line-height:1.4; color:#555;">편의점 음식으로 레시피를!?</p>
          </div>
        </a>
        <a href="/parking" style="text-decoration: none;">
          <div style="background:#fff; border-left:5px solid var(--main-color); border-radius:8px; padding:1rem; box-shadow:0 2px 5px rgba(0,0,0,0.05); transition: transform 0.2s;">
            <h4 style="color:var(--main-color); margin-bottom:0.5rem;">🏛️ 각종 자동차 정보</h4>
            <p style="font-size:14px; line-height:1.4; color:#555;">주유소 주차장은 여기로!</p>
          </div>
        </a>
      </div>
    </section>

    <?= view_cell('\\App\\Cells\\ExtraInfoCell::render') ?>
  </main>
  <?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>