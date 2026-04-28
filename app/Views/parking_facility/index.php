<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 공영주차장 찾기 | 위치·요금·정보{$pageSuffix} | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 공영주차장 {$currentPage}페이지 - 지역별 공영주차장의 요금, 운영시간, 주차면수 정보를 확인하세요."
    : "전국 공영주차장의 요금, 운영시간, 주차면수, 위치 정보를 지역별로 확인하세요. 가까운 공영주차장을 쉽게 찾고 요금을 미리 비교할 수 있습니다.";
$canonical = $currentPage > 1 ? base_url('parking-facilities') . '?page=' . $currentPage : base_url('parking-facilities');
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($pageTitle) ?></title>
  <meta name="description" content="<?= esc($pageDesc) ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= esc($canonical) ?>">
  <meta property="og:title" content="<?= esc($pageTitle) ?>">
  <meta property="og:description" content="<?= esc($pageDesc) ?>">
  <meta property="og:url" content="<?= esc($canonical) ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?= base_url('img/logo.png') ?>">
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="preload" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css"></noscript>
  <link rel="stylesheet" href="<?= base_url('css/common.css') ?>?v=<?= filemtime(FCPATH.'css/common.css') ?>">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
</head>
<body>
<?php include APPPATH . 'Views/includes/header.php'; ?>

<section class="lp-hero">
  <div class="lp-hero-inner">
    <p class="lp-hero-eyebrow">PUBLIC PARKING</p>
    <h1 class="lp-hero-title">🏙️ 공영주차장</h1>
    <p class="lp-hero-sub">전국 공영주차장 위치와 운영 정보</p>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <?php if (!empty($facilities)): ?>
    <div class="lp-grid">
      <?php foreach ($facilities as $f): ?>
        <a class="lp-card" href="/parking-facilities/<?= esc($f['id']) ?>">
          <div class="lp-card-name"><?= esc($f['FCLTY_NM']) ?></div>
          <div class="lp-card-row">📍 <?= esc($f['RDNMADR_NM'] ?? '주소 정보 없음') ?></div>
          <?php if (!empty($f['TEL_NO'])): ?>
          <div class="lp-card-row">📞 <?= esc($f['TEL_NO']) ?></div>
          <?php endif; ?>
        </a>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <p class="lp-empty">등록된 공영주차장이 없습니다.</p>
    <?php endif; ?>

    <?php if (isset($pager)): ?>
    <div class="lp-pager"><?= $pager->links() ?></div>
    <?php endif; ?>

  </div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
