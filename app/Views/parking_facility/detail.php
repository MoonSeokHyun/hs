<?php
foreach ($facility as $k => $v) {
    $facility[$k] = esc($v);
}
preg_match('/([가-힣]+구|[가-힣]+읍|[가-힣]+면)/', $facility['RDNMADR_NM'] ?? '', $m);
$district = $m[0] ?? '';

$titleSeo    = "{$facility['FCLTY_NM']} {$district} 공영주차장 안내 | 공영주차장 정보 검색";
$descSeo     = "{$district} {$facility['RDNMADR_NM']}에 위치한 {$facility['FCLTY_NM']} 공영주차장 정보. 요금, 운영시간, 주차면수 등 상세 안내.";
$keywordsSeo = implode(',', [$district, '공영주차장', $facility['FCLTY_NM'], '주차요금', '주차장조회']);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $titleSeo ?></title>
  <meta name="description" content="<?= $descSeo ?>">
  <meta name="keywords" content="<?= $keywordsSeo ?>">
  <meta name="robots" content="index,follow">
  <link rel="canonical" href="<?= esc(current_url()) ?>">

  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= $titleSeo ?>">
  <meta property="og:description" content="<?= $descSeo ?>">
  <meta property="og:url" content="<?= esc(current_url()) ?>">
  <meta property="og:image" content="<?= base_url('img/logo.png') ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= $titleSeo ?>">
  <meta name="twitter:description" content="<?= $descSeo ?>">

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "<?= $facility['FCLTY_NM'] ?> 공영주차장",
    "image": "<?= base_url('img/logo.png') ?>",
    "@id": "<?= esc(current_url()) ?>",
    "url": "<?= esc(current_url()) ?>",
    "telephone": "<?= $facility['TEL_NO'] ?? '' ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?= $facility['RDNMADR_NM'] ?>",
      "addressRegion": "<?= $district ?>"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": <?= $facility['FCLTY_LA'] ?>,
      "longitude": <?= $facility['FCLTY_LO'] ?>
    },
    "openingHoursSpecification": [
      {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": ["Monday","Tuesday","Wednesday","Thursday","Friday"],
        "opens": "<?= $facility['WORKDAY_OPN_BSNS_TIME'] ?>",
        "closes": "<?= $facility['WORKDAY_CLOS_TIME'] ?>"
      }
    ],
    "priceRange": "<?= $facility['BASS_PRICE'] ?>원~"
  }
  </script>

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
    <a href="<?= site_url('parking-facilities') ?>">공영주차장</a>
    <span class="sep">/</span>
    <span class="current"><?= $facility['FCLTY_NM'] ?></span>
  </nav>

  <!-- 히어로 -->
  <div class="detail-hero">
    <h1 class="detail-hero-title">🏙️ <?= $facility['FCLTY_NM'] ?></h1>
    <p class="detail-hero-sub">📍 <?= $facility['RDNMADR_NM'] ?></p>
    <div class="dp-chips">
      <?php if (!empty($facility['TEL_NO'])): ?>
        <a class="dp-chip dp-chip-link" href="tel:<?= esc($facility['TEL_NO']) ?>" aria-label="전화 연결">
          📞 <?= esc($facility['TEL_NO']) ?>
        </a>
      <?php endif; ?>
      <?php if (!empty($facility['TY_NM'])): ?>
        <span class="dp-chip dp-chip-orange"><?= $facility['TY_NM'] ?></span>
      <?php endif; ?>
      <?php if (!empty($facility['PARKNG_SPCE_CO'])): ?>
        <span class="dp-chip">총 <?= $facility['PARKNG_SPCE_CO'] ?>면</span>
      <?php endif; ?>
    </div>
  </div>

  <!-- 광고 1 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 분류 및 위치 -->
  <div class="content-card">
    <h2 class="content-card-title">📍 위치 및 분류</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row">
        <dt class="dp-kv-key">대분류</dt>
        <dd class="dp-kv-val"><?= $facility['MLSFC_NM'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">상세분류</dt>
        <dd class="dp-kv-val"><?= $facility['LCLAS_NM'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">유형</dt>
        <dd class="dp-kv-val"><?= $facility['TY_NM'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">시도</dt>
        <dd class="dp-kv-val"><?= $facility['CTPRVN_NM'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">시군구</dt>
        <dd class="dp-kv-val"><?= $facility['SIGNGU_NM'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">법정동</dt>
        <dd class="dp-kv-val"><?= $facility['LEGALDONG_NM'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">행정동</dt>
        <dd class="dp-kv-val"><?= $facility['ADSTRD_NM'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">우편번호</dt>
        <dd class="dp-kv-val"><?= $facility['ZIP_NO'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">도로명</dt>
        <dd class="dp-kv-val"><?= $facility['RDNMADR_NM'] ?></dd>
      </div>
    </dl>
  </div>

  <!-- 주차 면수 및 운영 시간 -->
  <div class="content-card">
    <h2 class="content-card-title">🕐 주차 면수 및 운영 시간</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row">
        <dt class="dp-kv-key">주차면수</dt>
        <dd class="dp-kv-val"><?= $facility['PARKNG_SPCE_CO'] ?> 면</dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">이용제한</dt>
        <dd class="dp-kv-val"><?= $facility['UTILIIZA_LMTT_FLAG_NM'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">평일개장</dt>
        <dd class="dp-kv-val"><?= $facility['WORKDAY_OPN_BSNS_TIME'] ?> ~ <?= $facility['WORKDAY_CLOS_TIME'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">토요일</dt>
        <dd class="dp-kv-val"><?= $facility['SAT_OPN_BSNS_TIME'] ?> ~ <?= $facility['SAT_CLOS_TIME'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">일요일</dt>
        <dd class="dp-kv-val"><?= $facility['SUN_OPN_BSNS_TIME'] ?> ~ <?= $facility['SUN_CLOS_TIME'] ?></dd>
      </div>
    </dl>
  </div>

  <!-- 광고 2 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 요금 정보 -->
  <div class="content-card">
    <h2 class="content-card-title">💰 요금 정보</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row">
        <dt class="dp-kv-key">기본시간</dt>
        <dd class="dp-kv-val"><?= $facility['BASS_TIME'] ?> 분</dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">기본요금</dt>
        <dd class="dp-kv-val"><?= $facility['BASS_PRICE'] ?> 원</dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">추가시간</dt>
        <dd class="dp-kv-val"><?= $facility['ADIT_UNIT_TIME'] ?> 분</dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">추가요금</dt>
        <dd class="dp-kv-val"><?= $facility['ADIT_UNIT_PRICE'] ?> 원</dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">1일시간</dt>
        <dd class="dp-kv-val"><?= $facility['ONE_DAY_PARKNG_VLM_TIME'] ?> 분</dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">1일요금</dt>
        <dd class="dp-kv-val"><?= $facility['ONE_DAY_PARKNG_VLM_PRICE'] ?> 원</dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">월정액</dt>
        <dd class="dp-kv-val"><?= $facility['MT_FDRM_PRICE'] ?> 원</dd>
      </div>
    </dl>
  </div>

  <!-- 결제 및 할인 -->
  <div class="content-card">
    <h2 class="content-card-title">💳 결제 및 할인</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row">
        <dt class="dp-kv-key">결제수단</dt>
        <dd class="dp-kv-val"><?= $facility['SETLE_MTH_CN'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">추가할인</dt>
        <dd class="dp-kv-val"><?= $facility['ADIT_DC'] ?></dd>
      </div>
    </dl>
  </div>

  <!-- 광고 3 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 관리/제공 기관 -->
  <div class="content-card">
    <h2 class="content-card-title">🏛️ 관리 및 제공 기관</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row">
        <dt class="dp-kv-key">관리기관</dt>
        <dd class="dp-kv-val"><?= $facility['MANAGE_INSTT_NM'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">제공기관</dt>
        <dd class="dp-kv-val"><?= $facility['PROVD_INSTT_NM'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">기준일자</dt>
        <dd class="dp-kv-val"><?= $facility['데이터기준일자'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">관리번호</dt>
        <dd class="dp-kv-val"><?= $facility['MANAGE_NO'] ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">최종변경</dt>
        <dd class="dp-kv-val"><?= $facility['LAST_CHG_DE'] ?></dd>
      </div>
    </dl>
  </div>

  <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>

  <!-- 광고 4 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <a href="<?= site_url('parking-facilities') ?>" class="back-btn">← 목록으로 돌아가기</a>

</div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
