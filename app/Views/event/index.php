<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "이벤트 정보 | 지역·문화 행사{$pageSuffix} | 편잇";
$pageDesc    = $currentPage > 1
    ? "편의점 이벤트 {$currentPage}페이지 - CU, GS25, 세븐일레븐 등 편의점 1+1, 2+1 할인 이벤트를 확인하세요."
    : "CU, GS25, 세븐일레븐, 이마트24 등 편의점 1+1, 2+1 할인 이벤트와 행사를 모아놓았습니다. 최신 편의점 할인 정보를 놓치지 마세요.";
$canonical = $currentPage > 1 ? base_url('event') . '?page=' . $currentPage : base_url('event');
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
    <p class="lp-hero-eyebrow">EVENTS</p>
    <h1 class="lp-hero-title">🎉 이벤트</h1>
    <p class="lp-hero-sub">전국 이벤트, 문화 행사 정보</p>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <?php if (!empty($allEvents)): ?>
    <div class="lp-img-grid">
      <?php foreach ($allEvents as $event): ?>
        <a class="lp-img-card" href="/event/<?= esc($event['id']) ?>">
          <div class="lp-img-card-thumb">
            <img src="<?= esc($event['image_url']) ?>" alt="<?= esc($event['title']) ?>" loading="lazy" decoding="async">
          </div>
          <div class="lp-img-card-body">
            <?php if (!empty($event['brand'])): ?>
            <span class="brand-badge brand-other"><?= esc($event['brand']) ?></span>
            <?php endif; ?>
            <div class="lp-img-card-title"><?= esc($event['title']) ?></div>
            <div class="lp-img-card-meta"><?= esc($event['event_period']) ?></div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <p class="lp-empty">현재 이벤트가 없습니다.</p>
    <?php endif; ?>

    <?php if (isset($pager)): ?>
    <div class="lp-pager"><?= $pager->links() ?></div>
    <?php endif; ?>

  </div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
