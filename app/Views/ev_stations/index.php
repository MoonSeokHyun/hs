<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 전기차 충전소 찾기 | 위치·이용현황{$pageSuffix} | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 전기차 충전소 {$currentPage}페이지 - 지역별 급속·완속 충전기 위치, 운영시간, 충전 요금 정보를 확인하세요."
    : "전국 전기차 충전소의 위치, 충전기 유형(급속·완속), 운영시간, 이용 요금을 한눈에 확인하세요. 가까운 전기차 충전소를 지역별로 쉽게 찾아보세요.";
$canonical = current_url();
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
    <p class="lp-hero-eyebrow">EV CHARGING</p>
    <h1 class="lp-hero-title">⚡ 전기차 충전소</h1>
    <p class="lp-hero-sub">전국 전기차 충전소 위치와 실시간 이용 현황을 확인하세요</p>
    <div class="lp-hero-stats">
      <span class="lp-stat-chip"><strong>급속·완속</strong> 충전기 구분</span>
      <span class="lp-stat-chip"><strong>가용 충전기</strong> 실시간 현황</span>
    </div>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <div class="lp-section-head">
      <div>
        <span class="lp-section-kicker">LIST</span>
        <p class="lp-section-title">⚡ 전기차 충전소 목록</p>
      </div>
    </div>

    <div class="lp-table-wrap">
      <table class="lp-table">
        <thead>
          <tr>
            <th>충전소명</th>
            <th>주소</th>
            <th>가용 충전기</th>
            <th>이용중</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($stations as $s): ?>
          <tr onclick="location.href='/ev-stations/<?= esc($s['id']) ?>'" style="cursor:pointer;">
            <td class="lp-table-name"><?= esc($s['facility_name']) ?></td>
            <td><?= esc($s['full_address']) ?></td>
            <td><?= esc($s['available_chargers']) ?></td>
            <td><?= esc($s['in_use_chargers']) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <?php if (isset($pager)): ?>
    <div class="lp-pager"><?= $pager->links() ?></div>
    <?php endif; ?>

  </div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
