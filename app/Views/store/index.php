<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 타이어 판매소 찾기 | 위치·연락처{$pageSuffix} | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 타이어 판매소 {$currentPage}페이지 - 지역별 타이어 판매소, 경정비 전문점의 위치·연락처·서비스 정보를 확인하세요."
    : "전국 타이어 판매소와 경정비 전문점의 위치, 전화번호, 취급 서비스 정보를 한눈에 확인하세요. 타이어 교체·엔진오일 교체 매장을 지역별로 검색할 수 있습니다.";
$canonical = $currentPage > 1 ? base_url('stores') . '?page=' . $currentPage : base_url('stores');
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
    <p class="lp-hero-eyebrow">TIRE STORE</p>
    <h1 class="lp-hero-title">🔘 타이어 판매소</h1>
    <p class="lp-hero-sub">전국 타이어 판매소 위치와 연락처 정보</p>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <?php if (!empty($stores) && is_array($stores)): ?>
    <div class="lp-grid">
      <?php foreach ($stores as $store): ?>
        <a class="lp-card" href="/stores/<?= esc($store['id']) ?>">
          <div class="lp-card-name"><?= esc($store['store_name']) ?></div>
          <?php if (!empty($store['region'])): ?>
          <div class="lp-card-row"><span class="lp-card-badge"><?= esc($store['region']) ?></span></div>
          <?php endif; ?>
          <?php if (!empty($store['phone_number'])): ?>
          <div class="lp-card-row">📞 <?= esc($store['phone_number']) ?></div>
          <?php endif; ?>
        </a>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <p class="lp-empty">등록된 판매소가 없습니다.</p>
    <?php endif; ?>

    <?php if (isset($pager)): ?>
    <div class="lp-pager"><?= $pager->links() ?></div>
    <?php endif; ?>

  </div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
