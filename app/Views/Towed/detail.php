<?php
$road_address = esc($storage['address_road_name']);
preg_match('/([가-힣]+구|[가-힣]+읍)/', $road_address, $matches);
$district_name = isset($matches[0]) ? $matches[0] : '보관소';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= esc($storage['towed_vehicle_storage_name']) ?> - <?= esc($district_name) ?> 견인차 보관소 | 편잇</title>
  <meta name="description" content="<?= esc($storage['address_road_name'] ?? '') ?> 위치의 견인차 보관소 <?= esc($storage['towed_vehicle_storage_name'] ?? '') ?>의 상세 정보, 전화번호, 보관 요금 등을 확인해보세요.">
  <meta name="keywords" content="견인차 보관소, <?= esc($storage['towed_vehicle_storage_name'] ?? '') ?>, 차량 보관소, 차량 견인, 견인차 보관소 추천, <?= esc($storage['address_road_name'] ?? '') ?>">
  <meta name="author" content="편잇 팀">
  <meta name="robots" content="index, follow" />
  <link rel="canonical" href="<?= esc(current_url()) ?>" />

  <meta property="og:title" content="<?= esc($storage['towed_vehicle_storage_name'] ?? '') ?> - 견인차 보관소 상세 정보">
  <meta property="og:description" content="<?= esc($storage['address_road_name'] ?? '') ?> 위치의 견인차 보관소 정보입니다.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= esc(current_url()) ?>">
  <meta property="og:image" content="<?= base_url('img/logo.png') ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= esc($storage['towed_vehicle_storage_name'] ?? '') ?>">
  <meta name="twitter:description" content="견인차 보관소 상세정보를 확인해보세요.">
  <meta name="twitter:image" content="<?= base_url('img/logo.png') ?>">

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Place",
    "name": "<?= esc($storage['towed_vehicle_storage_name'] ?? '') ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?= esc($storage['address_road_name'] ?? '') ?>",
      "addressLocality": "<?= esc($district_name) ?>",
      "addressCountry": "KR"
    },
    "telephone": "<?= esc($storage['storage_facility_phone_number'] ?? '') ?>",
    "url": "<?= esc(current_url()) ?>",
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": "<?= esc($storage['latitude']) ?>",
      "longitude": "<?= esc($storage['longitude']) ?>"
    },
    "description": "<?= esc($storage['towed_vehicle_storage_name'] ?? '') ?> 보관소의 전화번호, 주소 및 보관 요금 상세 정보"
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
    <a href="/towed-vehicle-storage">견인보관소</a>
    <span class="sep">/</span>
    <span class="current"><?= esc($storage['towed_vehicle_storage_name']) ?></span>
  </nav>

  <!-- 히어로 -->
  <div class="detail-hero">
    <h1 class="detail-hero-title">🚛 <?= esc($storage['towed_vehicle_storage_name']) ?></h1>
    <p class="detail-hero-sub">📍 <?= esc($storage['address_road_name']) ?></p>
    <div class="dp-chips">
      <?php if (!empty($storage['storage_facility_phone_number'])): ?>
        <a class="dp-chip dp-chip-link" href="tel:<?= esc($storage['storage_facility_phone_number']) ?>" aria-label="전화 연결">
          📞 <?= esc($storage['storage_facility_phone_number']) ?>
        </a>
      <?php endif; ?>
      <span class="dp-chip"><?= esc($district_name) ?> 견인보관소</span>
    </div>
  </div>

  <!-- 광고 1 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 기본 정보 -->
  <div class="content-card">
    <h2 class="content-card-title">📋 보관소 기본 정보</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row">
        <dt class="dp-kv-key">보관소명</dt>
        <dd class="dp-kv-val"><?= esc($storage['towed_vehicle_storage_name']) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">주소</dt>
        <dd class="dp-kv-val"><?= esc($storage['address_road_name']) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">전화</dt>
        <dd class="dp-kv-val">
          <?php if (!empty($storage['storage_facility_phone_number'])): ?>
            <a href="tel:<?= esc($storage['storage_facility_phone_number']) ?>"><?= esc($storage['storage_facility_phone_number']) ?></a>
          <?php else: ?>
            정보 없음
          <?php endif; ?>
        </dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">보관차량</dt>
        <dd class="dp-kv-val"><?= esc($storage['number_of_vehicles_that_can_be_stored']) ?> 대</dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">견인요금</dt>
        <dd class="dp-kv-val"><?= esc($storage['basic_tow_fee']) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">보관요금</dt>
        <dd class="dp-kv-val"><?= esc($storage['storage_fee']) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">관리기관</dt>
        <dd class="dp-kv-val"><?= esc($storage['management_organization_name']) ?></dd>
      </div>
    </dl>
  </div>

  <!-- 광고 2 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 근처 보관소 -->
  <div class="content-card">
    <h2 class="content-card-title">📍 1km 이내 견인차 보관소</h2>
    <?php if (empty($nearby_storages)): ?>
      <p class="text-muted">근처 보관소 정보가 없습니다.</p>
    <?php else: ?>
      <div class="table-responsive">
        <table class="nearby-table">
          <thead>
            <tr>
              <th>보관소명</th>
              <th>주소</th>
              <th>전화번호</th>
              <th>거리</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach (array_slice($nearby_storages, 0, 5) as $nearby): ?>
              <tr onclick="window.location.href='/towed-vehicle-storage/detail/<?= esc($nearby['id']) ?>'">
                <td>
                  <a href="/towed-vehicle-storage/detail/<?= esc($nearby['id']) ?>">
                    <?= esc($nearby['towed_vehicle_storage_name']) ?>
                  </a>
                </td>
                <td><?= esc($nearby['address_road_name']) ?></td>
                <td><?= esc($nearby['storage_facility_phone_number']) ?></td>
                <td><?= round($nearby['distance'], 1) ?> km</td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </div>

  <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>

  <!-- 광고 3 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <a href="/towed-vehicle-storage" class="back-btn">← 목록으로 돌아가기</a>

</div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
