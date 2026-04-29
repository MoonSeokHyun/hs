<?php
$road_address = $repair_shop['road_address'] ?? '';
preg_match('/([가-힣]+구|[가-힣]+읍)/', $road_address, $matches);
$district_name = $matches[0] ?? '정비소';

$shopName   = $repair_shop['repair_shop_name'] ?? '';
$shopType   = $repair_shop['repair_shop_type'] ?? '';
$phone      = $repair_shop['phone_number'] ?? '';
$statusCode = $repair_shop['business_status'] ?? 0;
$statusText  = $statusCode == 1 ? '영업중' : ($statusCode == 2 ? '폐업' : '알 수 없음');
$statusClass = $statusCode == 1 ? 'dp-chip-green' : ($statusCode == 2 ? 'dp-chip-red' : '');

$pageTitle = esc("{$shopName} - {$district_name} 자동차 정비소 | 위치·전화·리뷰 | 편잇");
$pageDesc  = esc("{$road_address} 위치의 {$shopName} 자동차 정비소. 위치, 전화번호, 이용 후기를 확인하세요.");
$canonical = esc(current_url());
$avgRating = round($averageRating ?? 0, 1);
$reviewCount = count($reviews ?? []);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?></title>
  <meta name="description" content="<?= $pageDesc ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= $canonical ?>">
  <meta property="og:title" content="<?= $pageTitle ?>">
  <meta property="og:description" content="<?= $pageDesc ?>">
  <meta property="og:url" content="<?= $canonical ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?= base_url('img/logo.png') ?>">
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "AutoRepair",
    "name": "<?= esc($shopName) ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?= esc($road_address) ?>",
      "addressCountry": "KR"
    },
    "telephone": "<?= esc($phone) ?>",
    "url": "<?= $canonical ?>"<?= $reviewCount > 0 ? ',
    "aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "' . $avgRating . '",
      "reviewCount": "' . $reviewCount . '"
    }' : '' ?>
  }
  </script>
  <style>
    .review-star { font-size: 24px; color: #D1D5DB; cursor: pointer; transition: color .1s; margin-right: 2px; }
    .review-star.selected, .review-star.hovered { color: #F97316; }
  </style>
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="preload" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css"></noscript>
  <link rel="stylesheet" href="<?= base_url('css/common.css') ?>?v=<?= filemtime(FCPATH.'css/common.css') ?>">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
</head>
<body>
<?php include APPPATH . 'Views/includes/header.php'; ?>

<div class="main-content">
<div class="container" style="max-width:960px;">

  <!-- 브레드크럼 -->
  <nav class="dp-breadcrumb" aria-label="breadcrumb">
    <a href="/">홈</a><span class="sep">/</span>
    <a href="/automobile_repair_shops">자동차 정비소</a><span class="sep">/</span>
    <span class="current"><?= esc($shopName) ?></span>
  </nav>

  <!-- 히어로 -->
  <div class="detail-hero">
    <h1 class="detail-hero-title"><?= esc($shopName) ?></h1>
    <p class="detail-hero-sub">📍 <?= esc($road_address) ?></p>
    <div class="dp-chips">
      <?php if ($shopType): ?>
        <span class="dp-chip dp-chip-orange">🔧 <?= esc($shopType) ?>급 정비소</span>
      <?php endif; ?>
      <span class="dp-chip <?= $statusClass ?>"><?= esc($statusText) ?></span>
      <?php if ($avgRating > 0): ?>
        <span class="dp-chip">⭐ <?= $avgRating ?> / 5.0</span>
      <?php endif; ?>
      <?php if ($phone): ?>
        <a href="tel:<?= esc($phone) ?>" class="dp-chip dp-chip-link" aria-label="전화 연결">📞 <?= esc($phone) ?></a>
      <?php endif; ?>
    </div>
  </div>

  <!-- 광고 1 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 기본 정보 -->
  <div class="content-card">
    <h2 class="content-card-title">🔧 정비소 기본 정보</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row"><dt class="dp-kv-key">정비소명</dt><dd class="dp-kv-val"><?= esc($shopName) ?></dd></div>
      <?php if ($shopType): ?>
        <div class="dp-kv-row"><dt class="dp-kv-key">종류</dt><dd class="dp-kv-val"><?= esc($shopType) ?>급 정비소</dd></div>
      <?php endif; ?>
      <div class="dp-kv-row"><dt class="dp-kv-key">도로명</dt><dd class="dp-kv-val"><?= esc($road_address) ?></dd></div>
      <?php if (!empty($repair_shop['land_lot_address'])): ?>
        <div class="dp-kv-row"><dt class="dp-kv-key">지번</dt><dd class="dp-kv-val"><?= esc($repair_shop['land_lot_address']) ?></dd></div>
      <?php endif; ?>
      <?php if ($phone): ?>
        <div class="dp-kv-row"><dt class="dp-kv-key">전화</dt><dd class="dp-kv-val"><a href="tel:<?= esc($phone) ?>"><?= esc($phone) ?></a></dd></div>
      <?php endif; ?>
      <?php if (!empty($repair_shop['registration_date'])): ?>
        <div class="dp-kv-row"><dt class="dp-kv-key">등록일</dt><dd class="dp-kv-val"><?= esc($repair_shop['registration_date']) ?></dd></div>
      <?php endif; ?>
      <div class="dp-kv-row"><dt class="dp-kv-key">영업상태</dt><dd class="dp-kv-val"><?= esc($statusText) ?></dd></div>
      <?php if (!empty($repair_shop['management_agency_name'])): ?>
        <div class="dp-kv-row"><dt class="dp-kv-key">관리기관</dt><dd class="dp-kv-val"><?= esc($repair_shop['management_agency_name']) ?></dd></div>
      <?php endif; ?>
      <?php if (!empty($repair_shop['provider_name'])): ?>
        <div class="dp-kv-row"><dt class="dp-kv-key">제공업체</dt><dd class="dp-kv-val"><?= esc($repair_shop['provider_name']) ?></dd></div>
      <?php endif; ?>
    </dl>
  </div>

  <?= view('includes/section_naver_map', [
      'latitude'  => $repair_shop['latitude'] ?? null,
      'longitude' => $repair_shop['longitude'] ?? null,
      'title'     => $repair_shop['repair_shop_name'] ?? '',
      'address'   => $repair_shop['road_address'] ?? '',
      'mapId'     => 'repair-map-' . (int) ($repair_shop['id'] ?? 0),
      'linkQuery' => $map_link_query ?? '',
  ]) ?>

  <!-- 주변 정비소 -->
  <?php if (!empty($nearby_shops)): ?>
  <div class="content-card">
    <h2 class="content-card-title">📍 주변 정비소</h2>
    <div class="table-responsive">
      <table class="nearby-table">
        <thead>
          <tr>
            <th>정비소명</th>
            <th>주소</th>
            <th>전화</th>
            <th>거리</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (array_slice($nearby_shops, 0, 5) as $shop): ?>
            <tr onclick="location.href='/automobile_repair_shop/<?= esc($shop['id']) ?>'">
              <td><a href="/automobile_repair_shop/<?= esc($shop['id']) ?>"><?= esc($shop['repair_shop_name'] ?? '') ?></a></td>
              <td><?= esc($shop['road_address'] ?? '') ?></td>
              <td><?= esc($shop['phone_number'] ?? '') ?></td>
              <td><?= round($shop['distance'] ?? 0, 1) ?> km</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php endif; ?>

  <!-- 광고 2 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 리뷰 쓰기 -->
  <div class="content-card">
    <h2 class="content-card-title">✍️ 리뷰 작성</h2>
    <form action="/automobile_repair_shop/saveReview" method="post" onsubmit="return validateForm()" class="review-form">
      <input type="hidden" name="repair_shop_id" value="<?= esc($repair_shop['id'] ?? 0) ?>">
      <div class="star-row" id="star-rating">
        <span class="star-label">평점</span>
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <span class="review-star" data-value="<?= $i ?>">★</span>
        <?php endfor; ?>
        <input type="hidden" name="rating" id="rating-value">
      </div>
      <textarea name="comment_text" id="comment-text" placeholder="리뷰를 남겨주세요" required class="form-textarea"></textarea>
      <button type="submit" class="form-submit">리뷰 등록</button>
    </form>
  </div>

  <!-- 이용 후기 -->
  <?php if (!empty($reviews)): ?>
  <div class="content-card">
    <h2 class="content-card-title">⭐ 이용 후기</h2>
    <div class="review-list">
      <?php foreach ($reviews as $review): ?>
        <div class="review-item">
          <div class="review-header">
            <span class="review-rating">
              <?php for ($i = 1; $i <= 5; $i++) echo $i <= ($review['rating'] ?? 0) ? '★' : '☆'; ?>
            </span>
            <time class="review-date"><?= date('Y-m-d H:i', strtotime($review['created_at'] ?? '')) ?></time>
          </div>
          <p class="review-text"><?= esc($review['comment_text'] ?? '') ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php else: ?>
  <p class="text-muted" style="margin:8px 0 16px;">아직 리뷰가 없습니다.</p>
  <?php endif; ?>

  <!-- 광고 3 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>

  <?= view('includes/section_naver_blog', ['blog_posts' => $blog_posts ?? []]) ?>

  <a href="/automobile_repair_shops" class="back-btn">← 목록으로 돌아가기</a>

</div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>

<script>
(function () {
  var stars = document.querySelectorAll('.review-star');
  stars.forEach(function (s) {
    s.addEventListener('mouseover', function () {
      var v = +this.dataset.value;
      stars.forEach(function (x) { x.classList.toggle('hovered', +x.dataset.value <= v); });
    });
    s.addEventListener('mouseout', function () {
      stars.forEach(function (x) { x.classList.remove('hovered'); });
    });
    s.addEventListener('click', function () {
      var v = +this.dataset.value;
      document.getElementById('rating-value').value = v;
      stars.forEach(function (x) { x.classList.toggle('selected', +x.dataset.value <= v); });
    });
  });
  window.validateForm = function () {
    if (!document.getElementById('rating-value').value || !document.getElementById('comment-text').value.trim()) {
      alert('평점과 리뷰 내용을 입력해주세요!'); return false;
    }
    return true;
  };
})();
</script>
</body>
</html>
