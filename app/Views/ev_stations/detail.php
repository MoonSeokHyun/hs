<?php
$facilityName      = $station['facility_name']     ?? 'EV Station';
$fullAddress       = $station['full_address']       ?? '';
$availableChargers = $station['available_chargers'] ?? '0';
$inUseChargers     = $station['in_use_chargers']    ?? '0';

preg_match('/([가-힣]+구)/', $fullAddress, $m);
$district = $m[1] ?? '서울';

$pageTitle = esc("{$district} {$facilityName} 전기차 충전소 | 위치·가용충전기 | 편잇");
$pageDesc  = esc("{$district} {$facilityName} 전기차 충전소 위치, 가용 충전기 {$availableChargers}대, 이용 방법을 확인하세요.");
$canonical = esc(current_url());
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
    "@type": "LocalBusiness",
    "name": "<?= esc($facilityName) ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?= esc($fullAddress) ?>",
      "addressCountry": "KR"
    },
    "url": "<?= $canonical ?>"
  }
  </script>
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
    <a href="/">홈</a><span class="sep">/</span>
    <a href="/ev-stations">전기차 충전소</a><span class="sep">/</span>
    <span class="current"><?= esc($facilityName) ?></span>
  </nav>

  <!-- 히어로 -->
  <div class="detail-hero">
    <h1 class="detail-hero-title">⚡ <?= esc($facilityName) ?></h1>
    <p class="detail-hero-sub">📍 <?= esc($fullAddress) ?></p>
    <div class="dp-chips">
      <span class="dp-chip dp-chip-green">✅ 가용 <?= esc($availableChargers) ?>대</span>
      <span class="dp-chip dp-chip-orange">🔌 사용중 <?= esc($inUseChargers) ?>대</span>
    </div>
  </div>

  <!-- 광고 1 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 충전소 기본 정보 -->
  <div class="content-card">
    <h2 class="content-card-title">⚡ 충전소 기본 정보</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row"><dt class="dp-kv-key">시설명</dt><dd class="dp-kv-val"><?= esc($facilityName) ?></dd></div>
      <div class="dp-kv-row"><dt class="dp-kv-key">주소</dt><dd class="dp-kv-val"><?= esc($fullAddress) ?></dd></div>
      <div class="dp-kv-row"><dt class="dp-kv-key">가용충전기</dt><dd class="dp-kv-val"><?= esc($availableChargers) ?> 대</dd></div>
      <div class="dp-kv-row"><dt class="dp-kv-key">사용중</dt><dd class="dp-kv-val"><?= esc($inUseChargers) ?> 대</dd></div>
    </dl>
  </div>

  <!-- 충전기 종류 -->
  <div class="content-card">
    <h2 class="content-card-title">🔌 충전기 종류</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row"><dt class="dp-kv-key">커넥터</dt><dd class="dp-kv-val">DC콤보(CCS), CHAdeMO, AC완속(Type1/Type2)</dd></div>
      <div class="dp-kv-row"><dt class="dp-kv-key">최대속도</dt><dd class="dp-kv-val">100kW 급속 충전</dd></div>
    </dl>
  </div>

  <!-- 광고 2 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 이용 안내 -->
  <div class="content-card">
    <h2 class="content-card-title">📋 이용 안내</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row"><dt class="dp-kv-key">결제</dt><dd class="dp-kv-val">앱 내 카드결제 및 포인트 결제 지원</dd></div>
      <div class="dp-kv-row"><dt class="dp-kv-key">예약</dt><dd class="dp-kv-val">예약 없이 선착순 이용</dd></div>
      <div class="dp-kv-row"><dt class="dp-kv-key">우천시</dt><dd class="dp-kv-val">방수 처리 완료 — 젖은 손 조작 주의</dd></div>
      <div class="dp-kv-row"><dt class="dp-kv-key">고장신고</dt><dd class="dp-kv-val">관리번호(☎02-1234-5678)로 즉시 신고</dd></div>
    </dl>
  </div>

  <!-- 광고 3 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <a href="/ev-stations" class="back-btn">← 목록으로 돌아가기</a>

</div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
