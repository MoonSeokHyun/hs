<?php
$address = !empty($parkingLot['address_road']) ? esc($parkingLot['address_road']) : esc($parkingLot['address_land']);
preg_match('/([\x{AC00}-\x{D7A3}]+(?:구|읍|군))/u', $address, $matches);
$district = isset($matches[0]) ? $matches[0] : '인근';
$parkingLotName = esc($parkingLot['name']);
$totalRating = array_sum(array_column($comments, 'rating'));
$averageRating = count($comments) ? round($totalRating / count($comments), 1) : 0;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $district ?> 주차장 | <?= $parkingLotName ?> - 위치·요금·운영시간 | 편잇</title>
  <meta name="description" content="<?= $district ?>에 위치한 <?= $parkingLotName ?> 주차장의 요금, 운영시간, 상세 위치를 확인하세요.">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= current_url() ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= $district ?> 주차장 | <?= $parkingLotName ?> - 위치·요금·운영시간 | 편잇">
  <meta property="og:description" content="<?= $district ?>에 위치한 <?= $parkingLotName ?> 주차장의 요금, 운영시간, 상세 위치를 확인하세요.">
  <meta property="og:url" content="<?= current_url() ?>">
  <meta property="og:image" content="<?= base_url('img/logo.png') ?>">
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "<?= $parkingLotName ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?= $address ?>"
    }
    <?php if ($averageRating > 0): ?>
    ,"aggregateRating": {
      "@type": "AggregateRating",
      "ratingValue": "<?= $averageRating ?>",
      "reviewCount": "<?= count($comments) ?>"
    }
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
    <a href="/parking">주차장</a>
    <span class="sep">›</span>
    <span class="current"><?= $parkingLotName ?></span>
  </nav>

  <!-- 히어로 -->
  <div class="detail-hero">
    <h1 class="detail-hero-title">🅿️ <?= esc($parkingLot['name']) ?></h1>
    <p class="detail-hero-sub">📍 <?= $address ?></p>
    <div class="dp-chips">
      <?php if ($averageRating > 0): ?>
        <span class="dp-chip dp-chip-orange">★ <?= $averageRating ?> 평균</span>
      <?php endif; ?>
      <span class="dp-chip">리뷰 <?= count($comments) ?>개</span>
      <?php if (!empty($parkingLot['phone_number'])): ?>
        <a class="dp-chip dp-chip-link" href="tel:<?= esc($parkingLot['phone_number']) ?>">📞 <?= esc($parkingLot['phone_number']) ?></a>
      <?php endif; ?>
    </div>
  </div>

  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 주차장 정보 -->
  <div class="content-card">
    <h2 class="content-card-title">📋 주차장 정보</h2>
    <div class="dp-kv">
      <div class="dp-kv-row">
        <span class="dp-kv-key">주차장명</span>
        <span class="dp-kv-val"><?= esc($parkingLot['name']) ?></span>
      </div>
      <div class="dp-kv-row">
        <span class="dp-kv-key">주소</span>
        <span class="dp-kv-val">
          <?php
            if (!empty($parkingLot['address_road'])) echo esc($parkingLot['address_road']);
            elseif (!empty($parkingLot['address_land'])) echo esc($parkingLot['address_land']);
            else echo '주소 정보 없음';
          ?>
        </span>
      </div>
      <div class="dp-kv-row">
        <span class="dp-kv-key">전화번호</span>
        <span class="dp-kv-val">
          <?php if (!empty($parkingLot['phone_number'])): ?>
            <a href="tel:<?= esc($parkingLot['phone_number']) ?>"><?= esc($parkingLot['phone_number']) ?></a>
          <?php else: ?>정보 없음<?php endif; ?>
        </span>
      </div>
      <div class="dp-kv-row">
        <span class="dp-kv-key">주차면수</span>
        <span class="dp-kv-val"><?= esc($parkingLot['total_spots']) ?> 면</span>
      </div>
      <div class="dp-kv-row">
        <span class="dp-kv-key">요금</span>
        <span class="dp-kv-val"><?= esc($parkingLot['fee_information']) ?></span>
      </div>
      <div class="dp-kv-row">
        <span class="dp-kv-key">평일운영</span>
        <span class="dp-kv-val"><?= substr($parkingLot['weekday_start_time'], 0, 5) ?> ~ <?= substr($parkingLot['weekday_end_time'], 0, 5) ?></span>
      </div>
      <div class="dp-kv-row">
        <span class="dp-kv-key">토요일운영</span>
        <span class="dp-kv-val"><?= substr($parkingLot['saturday_start_time'], 0, 5) ?> ~ <?= substr($parkingLot['saturday_end_time'], 0, 5) ?></span>
      </div>
      <div class="dp-kv-row">
        <span class="dp-kv-key">공휴일운영</span>
        <span class="dp-kv-val"><?= substr($parkingLot['holiday_start_time'], 0, 5) ?> ~ <?= substr($parkingLot['holiday_end_time'], 0, 5) ?></span>
      </div>
      <?php if (!empty($parkingLot['special_notes'])): ?>
      <div class="dp-kv-row">
        <span class="dp-kv-key">특이사항</span>
        <span class="dp-kv-val"><?= esc($parkingLot['special_notes']) ?></span>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <?= view('includes/section_naver_map', [
      'latitude'  => $parkingLot['latitude'] ?? null,
      'longitude' => $parkingLot['longitude'] ?? null,
      'title'     => $parkingLot['name'] ?? '',
      'address'   => !empty($parkingLot['address_road']) ? $parkingLot['address_road'] : ($parkingLot['address_land'] ?? ''),
      'mapId'     => 'parking-map-' . (int) ($parkingLot['id'] ?? 0),
      'linkQuery' => $map_link_query ?? '',
  ]) ?>

  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 리뷰 -->
  <div class="content-card">
    <h2 class="content-card-title">✏️ 리뷰 남기기</h2>
    <form action="/parking/saveComment" method="post" class="review-form" onsubmit="return validateForm()">
      <input type="hidden" name="parking_lot_id" value="<?= esc($parkingLot['id']) ?>">
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

    <?php if (!empty($comments)): ?>
    <div class="review-list" style="margin-top:20px;">
      <?php foreach ($comments as $comment): ?>
        <div class="review-item">
          <div class="review-header">
            <span class="review-rating">
              <?php for ($i = 1; $i <= 5; $i++) echo ($i <= $comment['rating']) ? '<span style="color:var(--c-star)">★</span>' : '<span style="color:#ddd">★</span>'; ?>
            </span>
            <span class="review-date"><?= date('Y-m-d H:i', strtotime($comment['created_at'])) ?></span>
          </div>
          <div class="review-text"><?= esc($comment['comment_text']) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
      <p class="text-muted" style="margin-top:16px;">아직 등록된 리뷰가 없습니다.</p>
    <?php endif; ?>
  </div>

  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <?= view('includes/section_naver_blog', ['blog_posts' => $blog_posts ?? []]) ?>

  <a href="/parking" class="back-btn">← 주차장 목록으로</a>

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
