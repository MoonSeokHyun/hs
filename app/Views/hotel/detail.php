<?php
$address = esc($hotel['site_full_address']);
preg_match('/([\x{AC00}-\x{D7A3}]+(?:구|읍|군))/u', $address, $matches);
$district = isset($matches[0]) ? $matches[0] : '인근';
$hotelName = esc($hotel['business_name']);
$canonicalUrl = current_url();
$pageTitle = "{$district} 숙박시설 | {$hotelName} - 위치·연락처·후기 | 편잇";
$addrSnippet = mb_substr($address, 0, 30);
$pageDesc = "{$hotelName}({$addrSnippet}) - 위치, 연락처, 객실 요금 및 주변 맛집·관광지 정보를 확인하세요.";
$jsonLd = [
  '@context' => 'https://schema.org',
  '@type' => 'Hotel',
  'name' => $hotelName,
  'url' => $canonicalUrl,
  'address' => ['@type'=>'PostalAddress','streetAddress'=>$address,'addressLocality'=>$district,'addressCountry'=>'KR'],
];
if (!empty($hotel['contact_number'])) $jsonLd['telephone'] = $hotel['contact_number'];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($pageTitle) ?></title>
  <meta name="description" content="<?= esc($pageDesc) ?>">
  <meta name="keywords" content="호텔,숙박,<?= $hotelName ?>,<?= $district ?> 숙박">
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
    <a href="/hotel">숙박시설</a>
    <span class="sep">/</span>
    <span class="current"><?= $hotelName ?></span>
  </nav>

  <!-- 히어로 -->
  <div class="detail-hero">
    <h1 class="detail-hero-title">🏨 <?= esc($hotel['business_name']) ?></h1>
    <p class="detail-hero-sub">📍 <?= esc($hotel['site_full_address']) ?></p>
    <div class="dp-chips">
      <span class="dp-chip">체크인 15:00</span>
      <span class="dp-chip">체크아웃 11:00</span>
      <?php if (!empty($hotel['contact_number'])): ?>
        <a class="dp-chip dp-chip-link" href="tel:<?= esc($hotel['contact_number']) ?>">📞 <?= esc($hotel['contact_number']) ?></a>
      <?php endif; ?>
    </div>
  </div>

  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 기본 정보 -->
  <div class="content-card">
    <h2 class="content-card-title">📋 기본 정보</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row">
        <dt class="dp-kv-key">숙소명</dt>
        <dd class="dp-kv-val"><?= esc($hotel['business_name']) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">주소</dt>
        <dd class="dp-kv-val"><?= esc($hotel['site_full_address']) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">연락처</dt>
        <dd class="dp-kv-val">
          <?php if (!empty($hotel['contact_number'])): ?>
            <a href="tel:<?= esc($hotel['contact_number']) ?>"><?= esc($hotel['contact_number']) ?></a>
          <?php else: ?>
            정보 없음
          <?php endif; ?>
        </dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">체크인</dt>
        <dd class="dp-kv-val">15:00</dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">체크아웃</dt>
        <dd class="dp-kv-val">11:00</dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">한실</dt>
        <dd class="dp-kv-val"><?= esc($hotel['han_room_count'] ?? '정보 없음') ?>개</dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">양실</dt>
        <dd class="dp-kv-val"><?= esc($hotel['western_room_count'] ?? '정보 없음') ?>개</dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">건물 층수</dt>
        <dd class="dp-kv-val">지상 <?= esc($hotel['building_above_ground'] ?? '-') ?>층 / 지하 <?= esc($hotel['building_below_ground'] ?? '-') ?>층</dd>
      </div>
    </dl>
  </div>

  <?= view('includes/section_naver_map', [
      'latitude'  => $hotelLatitude ?? null,
      'longitude' => $hotelLongitude ?? null,
      'title'     => $hotel['business_name'] ?? '',
      'address'   => $hotel['site_full_address'] ?? '',
      'mapId'     => 'hotel-map-' . (int) ($hotel['id'] ?? 0),
      'linkQuery' => $map_link_query ?? '',
  ]) ?>

  <!-- 근처 맛집 -->
  <?php if (!empty($results_food)): ?>
  <div class="content-card">
    <h2 class="content-card-title">🍽️ 근처 맛집</h2>
    <div class="card-grid">
      <?php foreach ($results_food as $item): ?>
        <a href="<?= esc($item['link']) ?>" target="_blank" rel="noopener" class="info-card">
          <div class="card-header">
            <h3 class="card-title"><?= esc($item['title']) ?></h3>
          </div>
          <div class="card-body">
            <p class="card-address">📍 <?= esc($item['roadAddress']) ?></p>
            <p class="card-phone">📞 <?= esc($item['telephone'] ?? '정보 없음') ?></p>
            <span class="badge badge-primary">자세히 보기 →</span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

  <!-- 주변 관광지 -->
  <?php if (!empty($results_tour)): ?>
  <div class="content-card">
    <h2 class="content-card-title">🗺️ 주변 관광지</h2>
    <div class="card-grid">
      <?php foreach ($results_tour as $item): ?>
        <a href="<?= esc($item['link']) ?>" target="_blank" rel="noopener" class="info-card">
          <div class="card-header">
            <h3 class="card-title"><?= esc($item['title']) ?></h3>
          </div>
          <div class="card-body">
            <p class="card-address">📍 <?= esc($item['roadAddress']) ?></p>
            <p class="card-phone">📞 <?= esc($item['telephone'] ?? '정보 없음') ?></p>
            <span class="badge badge-primary">자세히 보기 →</span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <?= view('includes/section_naver_blog', ['blog_posts' => $blog_posts ?? []]) ?>

  <a href="/hotel" class="back-btn">← 숙박 목록으로</a>

</div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
