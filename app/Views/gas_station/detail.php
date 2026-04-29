<?php
$road_address = esc($station['road_address']);
preg_match('/([\x{AC00}-\x{D7A3}]+(?:구|읍|군))/u', $road_address, $matches);
$district_name = isset($matches[0]) ? $matches[0] : '인근';
$gas_station_name = esc($station['gas_station_name']);
$gas_station_type = isset($station['gas_station_type']) ? esc($station['gas_station_type']) : '일반';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $district_name ?> 주유소 | <?= $gas_station_name ?> - 유가 정보 | 편잇</title>
  <meta name="description" content="<?= $district_name ?> 위치 <?= $gas_station_name ?> 주유소의 휘발유, 경유, 고급 휘발유, 등유 가격과 위치 정보를 확인하세요.">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= current_url() ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= $district_name ?> 주유소 | <?= $gas_station_name ?> - 유가 정보 | 편잇">
  <meta property="og:description" content="<?= $district_name ?> 위치 <?= $gas_station_name ?> 주유소의 휘발유, 경유, 고급 휘발유, 등유 가격과 위치 정보를 확인하세요.">
  <meta property="og:url" content="<?= current_url() ?>">
  <meta property="og:image" content="<?= base_url('img/logo.png') ?>">
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "GasStation",
    "name": "<?= $gas_station_name ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?= $road_address ?>"
    }
    <?php if (!empty($station['phone_number'])): ?>
    ,"telephone": "<?= esc($station['phone_number']) ?>"
    <?php endif; ?>
  }
  </script>
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="preload" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css"></noscript>
  <link rel="stylesheet" href="<?= base_url('css/common.css') ?>?v=<?= filemtime(FCPATH.'css/common.css') ?>">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
</head>
<body>
<?php include APPPATH . 'Views/includes/header.php'; ?>

<div class="main-content">
<div class="container" style="max-width:1080px;">

  <!-- 브레드크럼 -->
  <nav class="dp-breadcrumb" aria-label="breadcrumb">
    <a href="/">홈</a>
    <span class="sep">›</span>
    <a href="/gas_stations">주유소</a>
    <span class="sep">›</span>
    <span class="current"><?= $gas_station_name ?></span>
  </nav>

  <!-- 히어로 -->
  <div class="detail-hero">
    <h1 class="detail-hero-title">⛽ <?= esc($station['gas_station_name']) ?></h1>
    <p class="detail-hero-sub">📍 <?= esc($station['road_address']) ?></p>
    <div class="dp-chips">
      <span class="dp-chip dp-chip-orange"><?= $gas_station_type ?></span>
    </div>
  </div>

  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 유가 정보 -->
  <div class="content-card">
    <h2 class="content-card-title">💰 유가 정보</h2>
    <div class="dp-price-grid">
      <div class="dp-price-box">
        <div class="dp-price-label">휘발유</div>
        <div class="dp-price-val"><?= number_format($gasolinePrice) ?></div>
        <div class="dp-price-unit">원/L</div>
      </div>
      <div class="dp-price-box">
        <div class="dp-price-label">경유</div>
        <div class="dp-price-val"><?= number_format($dieselPrice) ?></div>
        <div class="dp-price-unit">원/L</div>
      </div>
      <div class="dp-price-box">
        <div class="dp-price-label">고급휘발유</div>
        <div class="dp-price-val"><?= number_format($premiumGasolinePrice) ?></div>
        <div class="dp-price-unit">원/L</div>
      </div>
      <div class="dp-price-box">
        <div class="dp-price-label">등유</div>
        <div class="dp-price-val"><?= number_format($kerosenePrice) ?></div>
        <div class="dp-price-unit">원/L</div>
      </div>
    </div>
  </div>

  <?= view('includes/section_naver_map', [
      'latitude'  => $station['latitude'] ?? null,
      'longitude' => $station['longitude'] ?? null,
      'title'     => $station['gas_station_name'] ?? '',
      'address'   => $station['road_address'] ?? '',
      'mapId'     => 'gas-map-' . (int) ($station['id'] ?? 0),
      'linkQuery' => $map_link_query ?? '',
  ]) ?>

  <!-- 주변 주유소 -->
  <?php if (!empty($nearbyGasStations)): ?>
  <div class="content-card">
    <h2 class="content-card-title">📍 주변 3km 이내 주유소</h2>
    <div class="table-responsive">
      <table class="nearby-table">
        <thead>
          <tr>
            <th>주유소이름</th>
            <th>도로명주소</th>
            <th>거리</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($nearbyGasStations as $nearbyStation): ?>
            <tr onclick="location.href='/gas_stations/<?= esc($nearbyStation['id'] ?? '') ?>'">
              <td><a href="/gas_stations/<?= esc($nearbyStation['id'] ?? '') ?>"><?= esc($nearbyStation['gas_station_name']) ?></a></td>
              <td><?= esc($nearbyStation['road_address']) ?></td>
              <td><?= number_format($nearbyStation['distance'], 2) ?> km</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php endif; ?>

  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 리뷰 -->
  <div class="content-card">
    <h2 class="content-card-title">✏️ 리뷰 남기기</h2>
    <form action="/gas_station/saveComment" method="post" class="review-form" onsubmit="return validateForm()">
      <input type="hidden" name="station_id" value="<?= esc($station['id']) ?>">
      <div class="dp-chips" style="align-items:center;">
        <span class="star-label">평점:</span>
        <div class="star-row" id="star-rating">
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="star" data-value="<?= $i ?>">★</span>
          <?php endfor; ?>
        </div>
        <input type="hidden" name="rating" id="rating-value">
      </div>
      <textarea class="form-textarea" name="comment_text" id="comment-text" placeholder="리뷰를 등록해주세요!" required></textarea>
      <button class="form-submit" type="submit">리뷰 등록</button>
    </form>

    <?php if (!empty($reviews)): ?>
    <div class="review-list" style="margin-top:20px;">
      <?php foreach ($reviews as $review): ?>
        <div class="review-item">
          <div class="review-header">
            <span class="review-rating">
              <?php for ($i = 1; $i <= 5; $i++) echo ($i <= $review['rating']) ? '<span style="color:var(--c-star)">★</span>' : '<span style="color:#ddd">★</span>'; ?>
            </span>
            <span class="review-date"><?= date('Y-m-d', strtotime($review['created_at'])) ?></span>
          </div>
          <div class="review-text"><?= esc($review['comment_text']) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
      <p class="text-muted" style="margin-top:16px;">아직 등록된 리뷰가 없습니다.</p>
    <?php endif; ?>
  </div>

  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>

  <?= view('includes/section_naver_blog', ['blog_posts' => $blog_posts ?? []]) ?>

  <a href="/gas_stations" class="back-btn">← 주유소 목록으로</a>

</div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>

<script>
document.querySelectorAll('#star-rating .star').forEach(function(s){
  s.addEventListener('click', function(){
    var v = this.dataset.value;
    document.getElementById('rating-value').value = v;
    document.querySelectorAll('#star-rating .star').forEach(function(x,i){ x.classList.toggle('selected', i < v); });
  });
});
function validateForm(){
  if(!document.getElementById('rating-value').value || !document.getElementById('comment-text').value.trim()){ alert('평점과 리뷰를 입력해주세요.'); return false; }
  return true;
}
</script>
</body>
</html>
