<?php
$road_address = esc($carwash['Address (Road Name)']);
preg_match('/([가-힣]+구|[가-힣]+읍)/', $road_address, $matches);
$district_name = isset($matches[0]) ? $matches[0] : '지역';
$business_name = esc($carwash['Business Name']);
$canonicalUrl = current_url();
$pageTitle = "{$district_name} 세차장 | {$business_name} - 위치·서비스·리뷰 | 편잇";
$pageDesc = "{$district_name}에 위치한 {$business_name} 세차장의 운영시간, 서비스 종류, 요금 정보와 이용자 리뷰를 확인하세요.";
$jsonLd = [
  '@context' => 'https://schema.org',
  '@type' => 'AutoWash',
  'name' => $business_name,
  'url' => $canonicalUrl,
  'address' => ['@type'=>'PostalAddress','streetAddress'=>$carwash['Address (Road Name)'],'addressLocality'=>$district_name,'addressCountry'=>'KR'],
];
if (!empty($carwash['Car Wash Phone Number'])) $jsonLd['telephone'] = $carwash['Car Wash Phone Number'];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($pageTitle) ?></title>
  <meta name="description" content="<?= esc($pageDesc) ?>">
  <meta name="keywords" content="세차장,<?= $business_name ?>,<?= $district_name ?> 세차">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= esc($canonicalUrl) ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= esc($pageTitle) ?>">
  <meta property="og:description" content="<?= esc($pageDesc) ?>">
  <meta property="og:url" content="<?= esc($canonicalUrl) ?>">
  <script type="application/ld+json"><?= json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) ?></script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="preload" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css"></noscript>
  <link rel="stylesheet" href="<?= base_url('css/common.css') ?>?v=<?= filemtime(FCPATH.'css/common.css') ?>">
</head>
<body>
<?php include APPPATH . 'Views/includes/header.php'; ?>

<div class="main-content">
<div class="container" style="max-width:960px;">

  <!-- 브레드크럼 -->
  <nav class="dp-breadcrumb" aria-label="breadcrumb">
    <a href="/">홈</a>
    <span class="sep">/</span>
    <a href="/carwash">세차장</a>
    <span class="sep">/</span>
    <span class="current"><?= $business_name ?></span>
  </nav>

  <!-- 히어로 -->
  <div class="detail-hero">
    <h1 class="detail-hero-title">🚿 <?= esc($carwash['Business Name']) ?></h1>
    <p class="detail-hero-sub">📍 <?= esc($carwash['Address (Road Name)']) ?></p>
    <div class="dp-chips">
      <?php if (!empty($carwash['Car Wash Type'])): ?>
        <span class="dp-chip dp-chip-orange"><?= esc($carwash['Car Wash Type']) ?></span>
      <?php endif; ?>
      <?php if (!empty($carwash['Car Wash Phone Number'])): ?>
        <a class="dp-chip dp-chip-link" href="tel:<?= esc($carwash['Car Wash Phone Number']) ?>">📞 <?= esc($carwash['Car Wash Phone Number']) ?></a>
      <?php endif; ?>
    </div>
  </div>

  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 기본 정보 -->
  <div class="content-card">
    <h2 class="content-card-title">📋 기본 정보</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row">
        <dt class="dp-kv-key">주소</dt>
        <dd class="dp-kv-val"><?= esc($carwash['Address (Road Name)']) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">전화번호</dt>
        <dd class="dp-kv-val">
          <?php if (!empty($carwash['Car Wash Phone Number'])): ?>
            <a href="tel:<?= esc($carwash['Car Wash Phone Number']) ?>"><?= esc($carwash['Car Wash Phone Number']) ?></a>
          <?php else: ?>
            정보 없음
          <?php endif; ?>
        </dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">세차종류</dt>
        <dd class="dp-kv-val"><?= esc($carwash['Car Wash Type'] ?? '정보 없음') ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">운영시간</dt>
        <dd class="dp-kv-val">
          <?= !empty($carwash['Weekday Start Time']) ? esc($carwash['Weekday Start Time']) . ' ~ ' . esc($carwash['Weekday End Time']) : '09:00 ~ 21:00' ?>
        </dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">휴무일</dt>
        <dd class="dp-kv-val"><?= !empty($carwash['Day Off']) ? esc($carwash['Day Off']) : '매주 일요일' ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">요금정보</dt>
        <dd class="dp-kv-val"><?= !empty($carwash['Car Wash Fee Information']) ? esc($carwash['Car Wash Fee Information']) : '문의' ?></dd>
      </div>
    </dl>
  </div>

  <?= view('includes/section_naver_map', [
      'latitude'  => $carwash['WGS84 Latitude'] ?? null,
      'longitude' => $carwash['WGS84 Longitude'] ?? null,
      'title'     => $carwash['Business Name'] ?? '',
      'address'   => $carwash['Address (Road Name)'] ?? '',
      'mapId'     => 'carwash-map-' . (int) ($carwash['ID'] ?? 0),
      'linkQuery' => $map_link_query ?? '',
  ]) ?>

  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 이용 후기 -->
  <div class="content-card">
    <h2 class="content-card-title">⭐ 이용 후기</h2>
    <?php if ($averageRating > 0): ?>
      <p>평균 <strong><?= esc(number_format((float)$averageRating, 1)) ?></strong>점 &nbsp;·&nbsp; 리뷰 <strong><?= esc((string)$reviewCount) ?></strong>개</p>
    <?php endif; ?>
    <?php if (!empty($reviews)): ?>
      <div class="review-list">
        <?php foreach ($reviews as $review): ?>
          <div class="review-item">
            <div class="review-header">
              <span class="review-rating">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                  <?= ($i <= (int)$review['rating']) ? '<span class="star selected">★</span>' : '<span class="star">★</span>' ?>
                <?php endfor; ?>
              </span>
              <time class="review-date"><?= esc($review['created_at']) ?></time>
            </div>
            <p class="review-text"><?= esc($review['comment_text']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="text-muted">아직 등록된 리뷰가 없습니다.</p>
    <?php endif; ?>
  </div>

  <!-- 리뷰 쓰기 -->
  <div class="content-card">
    <h2 class="content-card-title">✏️ 리뷰 쓰기</h2>
    <form action="/carwash/addReview" method="post" onsubmit="return validateForm()">
      <input type="hidden" name="carwash_id" value="<?= esc($carwash['ID']) ?>">
      <div class="star-row" id="star-rating">
        <span class="star-label">평점</span>
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <span class="star" data-value="<?= $i ?>">★</span>
        <?php endfor; ?>
      </div>
      <input type="hidden" name="rating" id="rating-value">
      <textarea class="form-textarea" name="comment" id="comment-text" placeholder="리뷰를 입력해주세요." required></textarea>
      <button class="form-submit" type="submit">리뷰 등록</button>
    </form>
  </div>

  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <?= view('includes/section_naver_blog', ['blog_posts' => $blog_posts ?? []]) ?>

  <a href="/carwash" class="back-btn">← 세차장 목록으로</a>

</div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>

<script>
document.querySelectorAll('#star-rating .star').forEach(function(s){
  s.addEventListener('click',function(){
    var v=this.dataset.value;
    document.getElementById('rating-value').value=v;
    document.querySelectorAll('#star-rating .star').forEach(function(x,i){x.classList.toggle('selected',i<v);});
  });
});
function validateForm(){
  if(!document.getElementById('rating-value').value||!document.getElementById('comment-text').value.trim()){alert('평점과 리뷰를 입력해주세요.');return false;}
  return true;
}
</script>
</body>
</html>
