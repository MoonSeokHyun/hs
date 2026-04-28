<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 견인차량 보관소 찾기 | 위치·정보{$pageSuffix} | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 견인차량 보관소 {$currentPage}페이지 - 지역별 보관소 위치, 연락처, 보관 요금 정보를 확인하세요."
    : "전국 견인차량 보관소의 위치, 연락처, 보관 요금 정보를 확인하세요. 무단방치 차량, 견인 차량 보관 위치를 지역별로 한눈에 검색할 수 있습니다.";
$canonicalBase = base_url('towed-vehicle-storage');
$canonical = $currentPage > 1 ? $canonicalBase . '?page=' . $currentPage : $canonicalBase;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($pageTitle) ?></title>
  <meta name="description" content="<?= esc($pageDesc) ?>">
  <meta name="robots" content="<?= !empty($isSearchResult) ? 'noindex, follow' : 'index, follow' ?>">
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
    <p class="lp-hero-eyebrow">TOWED VEHICLE</p>
    <h1 class="lp-hero-title">🚛 견인차량 보관소</h1>
    <p class="lp-hero-sub">견인된 차량 위치와 보관소 정보를 확인하세요</p>
    <form class="lp-search" action="/towed-vehicle-storage" method="get">
      <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="보관소명, 주소 검색">
      <button type="submit">검색</button>
    </form>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <?php if (!empty($storages)): ?>
    <div class="lp-grid">
      <?php foreach ($storages as $storage): ?>
        <a class="lp-card" href="/towed-vehicle-storage/detail/<?= esc($storage['id']) ?>">
          <div class="lp-card-name"><?= esc($storage['towed_vehicle_storage_name']) ?></div>
          <div class="lp-card-row">📍 <?= esc($storage['address_road_name']) ?></div>
        </a>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <p class="lp-empty">등록된 보관소가 없습니다.</p>
    <?php endif; ?>

    <?php if (isset($pager)): ?>
    <div class="lp-pager"><?= $pager->links() ?></div>
    <?php endif; ?>

  </div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
