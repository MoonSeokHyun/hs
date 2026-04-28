<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 축제·공연·행사 정보{$pageSuffix} | 일정·장소·주최기관 | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 축제·공연 {$currentPage}페이지 - 지역별 축제, 공연, 행사의 일정·장소·주최기관 정보를 확인하세요."
    : "전국에서 진행 중이거나 예정된 축제, 공연, 문화 행사의 일정·장소·주최기관·연락처 정보를 한눈에 확인하세요.";
$canonical = $currentPage > 1 ? current_url() . '?page=' . $currentPage : current_url();
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
    <p class="lp-hero-eyebrow">FESTIVAL</p>
    <h1 class="lp-hero-title">🎊 축제·공연·행사</h1>
    <p class="lp-hero-sub">전국 축제, 공연, 문화 행사 일정을 한눈에 확인하세요</p>
    <div class="lp-hero-stats">
      <span class="lp-stat-chip"><strong>진행중</strong> 실시간 업데이트</span>
      <span class="lp-stat-chip"><strong>예정·종료</strong> 일정 포함</span>
      <span class="lp-stat-chip"><strong>지역별</strong> 행사 정보</span>
    </div>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <?php if (!empty($combinedData)): ?>
    <div class="lp-section-head">
      <div>
        <span class="lp-section-kicker">ALL EVENTS</span>
        <p class="lp-section-title">전체 행사 목록</p>
      </div>
    </div>
    <div class="lp-grid">
      <?php foreach ($combinedData as $item):
        $id  = $item['id'] ?? $item['ID'] ?? 0;
        $url = $item['type'] === 'event'
          ? "/festival-info/eventdetail/{$id}"
          : "/festival-info/{$id}";
        $name     = $item['Festival_Name'] ?? $item['Event_Name'] ?? '';
        $dateFrom = $item['Start_Date'] ?? '';
        $dateTo   = $item['End_Date'] ?? '';
        $location = $item['Location'] ?? $item['Venue'] ?? '';
        $agency   = $item['Organizing_Agency'] ?? '';
        $status   = $item['status'] ?? '';
        if ($status === '진행중') {
          $badgeStyle = 'background:#16a34a;color:#fff;';
        } elseif ($status === '예정') {
          $badgeStyle = 'background:#ea580c;color:#fff;';
        } else {
          $badgeStyle = 'background:#9ca3af;color:#fff;';
        }
      ?>
        <a class="lp-card" href="<?= esc($url) ?>">
          <div class="lp-card-name"><?= esc($name) ?></div>
          <?php if ($status): ?>
          <div class="lp-card-row">
            <span class="lp-card-badge" style="<?= $badgeStyle ?>"><?= esc($status) ?></span>
          </div>
          <?php endif; ?>
          <?php if ($dateFrom || $dateTo): ?>
          <div class="lp-card-row">📅 <?= esc($dateFrom) ?> ~ <?= esc($dateTo) ?></div>
          <?php endif; ?>
          <?php if ($location): ?>
          <div class="lp-card-row">📍 <?= esc($location) ?></div>
          <?php endif; ?>
          <?php if ($agency): ?>
          <div class="lp-card-row">🏛 <?= esc($agency) ?></div>
          <?php endif; ?>
        </a>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <p class="lp-empty">현재 표시할 공연 및 행사가 없습니다.</p>
    <?php endif; ?>

    <?php if (isset($pager)): ?>
    <div class="lp-pager"><?= $pager->links() ?></div>
    <?php endif; ?>

  </div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
