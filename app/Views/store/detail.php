<?php
foreach ($store as $k => $v) {
    $store[$k] = esc($v);
}
preg_match('/([가-힣]+구)/', $store['road_address'] ?? '', $m);
$district = $m[0] ?? '지역';

$storeName = $store['store_name'] ?? '타이어 판매소';
$storeAddr = $store['road_address'] ?? ($store['address'] ?? '');
$storeSvc  = $store['services_offered'] ?? '';
$storeDescRaw = trim("{$storeAddr} 위치의 {$storeName} 타이어·경정비·엔진오일 교체 전문점 정보입니다." . ($storeSvc ? " 주요 서비스: {$storeSvc}." : ''));
$storeDesc = mb_substr(preg_replace('/\s+/', ' ', strip_tags($storeDescRaw)), 0, 155);
$storeTitle = "{$storeName} - {$district} | 타이어·경정비·엔진오일 전문 | 편잇";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($storeTitle) ?></title>
  <meta name="description" content="<?= esc($storeDesc) ?>">
  <meta name="keywords" content="<?= esc($storeName) ?>, 타이어 판매소, <?= esc($district) ?> 타이어, 엔진오일 교체, 경정비, 편잇">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= esc(current_url()) ?>">
  <meta property="og:title" content="<?= esc($storeTitle) ?>">
  <meta property="og:description" content="<?= esc($storeDesc) ?>">
  <meta property="og:url" content="<?= esc(current_url()) ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?= base_url('img/logo.png') ?>">

  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="preload" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css"></noscript>
  <link rel="stylesheet" href="<?= base_url('css/common.css') ?>?v=<?= filemtime(FCPATH . 'css/common.css') ?>">
</head>
<body>
<?php include APPPATH . 'Views/includes/header.php'; ?>

<div class="main-content">
<div class="container" style="max-width:960px;">

  <!-- 브레드크럼 -->
  <nav class="dp-breadcrumb" aria-label="breadcrumb">
    <a href="/">홈</a>
    <span class="sep">/</span>
    <a href="<?= site_url('stores') ?>">타이어판매소</a>
    <span class="sep">/</span>
    <span class="current"><?= $store['store_name'] ?></span>
  </nav>

  <!-- 히어로 -->
  <div class="detail-hero">
    <h1 class="detail-hero-title">🔘 <?= $store['store_name'] ?></h1>
    <p class="detail-hero-sub">📍 <?= $store['road_address'] ?></p>
    <div class="dp-chips">
      <?php if (!empty($store['phone_number'])): ?>
        <a class="dp-chip dp-chip-link" href="tel:<?= esc($store['phone_number']) ?>" aria-label="전화 연결">
          📞 <?= esc($store['phone_number']) ?>
        </a>
      <?php endif; ?>
      <span class="dp-chip dp-chip-orange">🔘 타이어·경정비</span>
      <span class="dp-chip"><?= esc($district) ?></span>
    </div>
  </div>

  <!-- 광고 1 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 매장 기본 정보 -->
  <div class="content-card">
    <h2 class="content-card-title">📋 매장 기본 정보</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row">
        <dt class="dp-kv-key">매장명</dt>
        <dd class="dp-kv-val"><?= $store['store_name'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">지역</dt>
        <dd class="dp-kv-val"><?= $store['region'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">전화번호</dt>
        <dd class="dp-kv-val">
          <?php if (!empty($store['phone_number'])): ?>
            <a href="tel:<?= esc($store['phone_number']) ?>"><?= esc($store['phone_number']) ?></a>
          <?php else: ?>
            정보 없음
          <?php endif; ?>
        </dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">도로명</dt>
        <dd class="dp-kv-val"><?= $store['road_address'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">지번주소</dt>
        <dd class="dp-kv-val"><?= $store['address'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">사업자번호</dt>
        <dd class="dp-kv-val"><?= $store['business_registration_number'] ?></dd>
      </div>
      <?php if (!empty($store['services_offered'])): ?>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">서비스</dt>
        <dd class="dp-kv-val"><?= $store['services_offered'] ?></dd>
      </div>
      <?php endif; ?>
      <?php if (!empty($store['notes'])): ?>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">메모</dt>
        <dd class="dp-kv-val"><?= nl2br($store['notes']) ?></dd>
      </div>
      <?php endif; ?>
    </dl>
  </div>

  <!-- 광고 2 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 타이어 관리 팁 -->
  <div class="content-card">
    <h2 class="content-card-title">💡 타이어 오래 쓰는 법</h2>
    <div style="font-size:14px;line-height:1.8;color:#374151;">
      <p style="margin:0 0 8px;">1. 매달 타이어 공기압 체크하기</p>
      <p style="margin:0 0 8px;">2. 균일 마모를 위한 정기적인 타이어 로테이션</p>
      <p style="margin:0 0 12px;">3. 도로 상태에 맞춰 급출발·급제동 자제하기</p>
      <a href="https://www.motorguide.co.kr/tire-longevity" target="_blank" rel="noopener noreferrer" style="color:var(--c-primary);font-size:13px;font-weight:600;">더 알아보기 →</a>
    </div>
  </div>

  <div class="content-card">
    <h2 class="content-card-title">💰 타이어 비용 절감하기</h2>
    <div style="font-size:14px;line-height:1.8;color:#374151;">
      <p style="margin:0 0 8px;">- 온라인 할인 쿠폰 활용</p>
      <p style="margin:0 0 8px;">- 시즌 오프 세일 기간 노리기</p>
      <p style="margin:0 0 12px;">- 현지 중소 타이어 숍 비교 견적 받기</p>
      <a href="https://www.tiredeal.co.kr/discount-tips" target="_blank" rel="noopener noreferrer" style="color:var(--c-primary);font-size:13px;font-weight:600;">더 알아보기 →</a>
    </div>
  </div>

  <div class="content-card">
    <h2 class="content-card-title">🔧 간단 관리 방법</h2>
    <div style="font-size:14px;line-height:1.8;color:#374151;">
      <p style="margin:0 0 8px;">- 세차 후 타이어 전용 왁스 도포</p>
      <p style="margin:0 0 8px;">- 표면 균열 및 손상 여부 월 1회 점검</p>
      <p style="margin:0 0 12px;">- 장기간 보관 시 직사광선 피하기</p>
      <a href="https://www.carcareinfo.kr/tire-maintenance" target="_blank" rel="noopener noreferrer" style="color:var(--c-primary);font-size:13px;font-weight:600;">더 알아보기 →</a>
    </div>
  </div>

  <!-- 광고 3 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <a href="<?= site_url('stores') ?>" class="back-btn">← 목록으로 돌아가기</a>

</div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
