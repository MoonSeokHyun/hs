<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 가스 충전소 찾기 | 위치·서비스{$pageSuffix} | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 가스 충전소 {$currentPage}페이지 - 지역별 충전기 위치와 이용 정보를 확인하세요."
    : "전국 가스 충전소의 위치, 운영 시간, 서비스 정보를 한눈에 확인하세요. 가까운 충전소를 지역별로 검색할 수 있습니다.";
$canonical = $currentPage > 1 ? base_url('station') . '?page=' . $currentPage : base_url('station');
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
    <p class="lp-hero-eyebrow">GAS CHARGING</p>
    <h1 class="lp-hero-title">💨 가스 충전소</h1>
    <p class="lp-hero-sub">전국 가스 충전소 위치와 서비스 정보를 한눈에</p>
    <div class="lp-hero-stats">
      <span class="lp-stat-chip"><strong>전국</strong> 가스 충전소</span>
      <span class="lp-stat-chip"><strong>서비스 종류</strong> 안내</span>
    </div>
  </div>
</section>

<div class="lp-body">
  <div class="container">

    <div class="lp-section-head">
      <div>
        <span class="lp-section-kicker">LIST</span>
        <p class="lp-section-title">💨 가스 충전소 목록</p>
      </div>
    </div>

    <div class="lp-table-wrap">
      <table class="lp-table">
        <thead>
          <tr>
            <th>업체명</th>
            <th>주소</th>
            <th>서비스</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($stations as $station): ?>
          <tr onclick="location.href='/station/detail/<?= esc($station['id']) ?>'" style="cursor:pointer;">
            <td class="lp-table-name"><?= esc($station['Company']) ?></td>
            <td><?= esc($station['FullAddress']) ?></td>
            <td><?= esc($station['Service']) ?></td>
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
