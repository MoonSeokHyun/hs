<?php
$facilityName      = esc($station['facility_name']   ?? '가스 충전소');
$fullAddress       = esc($station['FullAddress']     ?? '');
$availableChargers = esc($station['available_chargers'] ?? '0');
$inUseChargers     = esc($station['in_use_chargers'] ?? '0');
$lat               = esc($station['latitude']         ?? '0');
$lng               = esc($station['longitude']        ?? '0');

$address1          = esc($station['Address1'] ?? '');
$company           = esc($station['Company'] ?? '');

$seoTitle       = esc("{$fullAddress} {$company} - {$facilityName} 가스충전소 위치·요금·후기｜실시간 가용 {$availableChargers}대");
$seoDescription = esc("{$fullAddress} {$company} {$facilityName} 가스충전소의 위치, 요금, 이용 후기, 실시간 가용 충전기 현황({$availableChargers}대)을 한눈에 확인하세요.");
$seoKeywords    = esc("{$fullAddress} 가스충전소, {$company}, {$facilityName}, {$address1}, 충전소 요금, 충전소 후기, 실시간 가용 충전기");
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $seoTitle ?></title>
  <meta name="description" content="<?= $seoDescription ?>">
  <meta name="keywords" content="<?= $seoKeywords ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= esc(current_url()) ?>">

  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= $seoTitle ?>">
  <meta property="og:description" content="<?= $seoDescription ?>">
  <meta property="og:url" content="<?= esc(current_url()) ?>">
  <meta property="og:locale" content="ko_KR">
  <meta property="og:image" content="<?= base_url('img/logo.png') ?>">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="<?= $seoTitle ?>">
  <meta name="twitter:description" content="<?= $seoDescription ?>">

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
    <a href="<?= site_url('station') ?>">가스충전소</a>
    <span class="sep">/</span>
    <span class="current"><?= esc($station['Company']) ?> LPG 충전소</span>
  </nav>

  <!-- 히어로 -->
  <div class="detail-hero">
    <h1 class="detail-hero-title">💨 <?= esc($station['Company']) ?> LPG 충전소</h1>
    <p class="detail-hero-sub">📍 <?= $fullAddress ?></p>
    <div class="dp-chips">
      <?php if (!empty($station['Phone'])): ?>
        <a class="dp-chip dp-chip-link" href="tel:<?= esc($station['Phone']) ?>" aria-label="전화 연결">
          📞 <?= esc($station['Phone']) ?>
        </a>
      <?php endif; ?>
      <?php if (!empty($station['Status'])): ?>
        <span class="dp-chip"><?= esc($station['Status']) ?></span>
      <?php endif; ?>
      <span class="dp-chip dp-chip-orange">💨 가스충전소</span>
    </div>
  </div>

  <!-- 광고 1 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 기본 정보 -->
  <div class="content-card">
    <h2 class="content-card-title">📋 기본 정보</h2>
    <dl class="dp-kv">
      <div class="dp-kv-row">
        <dt class="dp-kv-key">주소1</dt>
        <dd class="dp-kv-val"><?= esc($station['Address1']) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">주소2</dt>
        <dd class="dp-kv-val"><?= esc($station['Address2']) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">전체주소</dt>
        <dd class="dp-kv-val"><?= esc($station['FullAddress']) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">도시</dt>
        <dd class="dp-kv-val"><?= esc($station['City']) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">회사</dt>
        <dd class="dp-kv-val"><?= esc($station['Company']) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">전화번호</dt>
        <dd class="dp-kv-val">
          <?php if (!empty($station['Phone'])): ?>
            <a href="tel:<?= esc($station['Phone']) ?>"><?= esc($station['Phone']) ?></a>
          <?php else: ?>
            정보 없음
          <?php endif; ?>
        </dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">서비스</dt>
        <dd class="dp-kv-val"><?= esc($station['Service']) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">상태</dt>
        <dd class="dp-kv-val"><?= esc($station['Status']) ?></dd>
      </div>
      <div class="dp-kv-row">
        <dt class="dp-kv-key">사업자ID</dt>
        <dd class="dp-kv-val"><?= esc($station['BusinessID']) ?></dd>
      </div>
    </dl>
  </div>

  <?php
  $_chgLat = $station['Latitude'] ?? $station['latitude'] ?? null;
  $_chgLng = $station['Longitude'] ?? $station['longitude'] ?? null;
  if ($_chgLat !== null && $_chgLng !== null && abs((float) $_chgLat) < 1e-8 && abs((float) $_chgLng) < 1e-8) {
      $_chgLat = $_chgLng = null;
  }
  ?>
  <?= view('includes/section_naver_map', [
      'latitude'  => $_chgLat,
      'longitude' => $_chgLng,
      'title'     => (string) ($station['Company'] ?? $station['Service'] ?? '가스충전소'),
      'address'   => (string) ($station['FullAddress'] ?? ''),
      'mapId'     => 'chg-map-' . (int) ($station['id'] ?? 0),
      'linkQuery' => $map_link_query ?? '',
  ]) ?>

  <!-- 광고 2 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <!-- 가스충전소 주의사항 -->
  <div class="content-card">
    <h2 class="content-card-title">⚠️ 가스충전소 주의사항</h2>
    <ul style="display:flex;flex-direction:column;gap:12px;padding:0;list-style:none;">
      <li style="display:flex;gap:12px;font-size:14px;line-height:1.7;color:#374151;">
        <span style="flex-shrink:0;width:24px;height:24px;background:#FFF7ED;border:1px solid #FED7AA;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#C2410C;">1</span>
        <div><strong>충전 중 차량을 떠나지 마세요.</strong> 충전이 완료될 때까지 차량을 충전소에서 대기시키세요.</div>
      </li>
      <li style="display:flex;gap:12px;font-size:14px;line-height:1.7;color:#374151;">
        <span style="flex-shrink:0;width:24px;height:24px;background:#FFF7ED;border:1px solid #FED7AA;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#C2410C;">2</span>
        <div><strong>충전 전 모든 차량 문을 닫아주세요.</strong> 가스 누출을 막기 위해 차량 문을 반드시 닫고 충전하세요.</div>
      </li>
      <li style="display:flex;gap:12px;font-size:14px;line-height:1.7;color:#374151;">
        <span style="flex-shrink:0;width:24px;height:24px;background:#FFF7ED;border:1px solid #FED7AA;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#C2410C;">3</span>
        <div><strong>충전 후 충전기를 제자리에 놓아주세요.</strong> 충전 완료 후 충전기를 반드시 제자리로 놓아주세요.</div>
      </li>
      <li style="display:flex;gap:12px;font-size:14px;line-height:1.7;color:#374151;">
        <span style="flex-shrink:0;width:24px;height:24px;background:#FFF7ED;border:1px solid #FED7AA;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#C2410C;">4</span>
        <div><strong>기상 악화 시 이용을 자제해주세요.</strong> 폭우·폭설 등 기상 악화 시 충전소 이용을 자제해 주세요.</div>
      </li>
    </ul>
  </div>

  <!-- 안전 수칙 -->
  <div class="content-card">
    <h2 class="content-card-title">🛡️ 안전 수칙</h2>
    <ul style="display:flex;flex-direction:column;gap:12px;padding:0;list-style:none;">
      <li style="display:flex;gap:12px;font-size:14px;line-height:1.7;color:#374151;">
        <span style="flex-shrink:0;width:24px;height:24px;background:#FEE2E2;border:1px solid #FECACA;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#DC2626;">1</span>
        <div><strong>충전소 근처에서 흡연을 금지해주세요.</strong> 가스가 누출될 경우 큰 화재로 이어질 수 있습니다.</div>
      </li>
      <li style="display:flex;gap:12px;font-size:14px;line-height:1.7;color:#374151;">
        <span style="flex-shrink:0;width:24px;height:24px;background:#FEE2E2;border:1px solid #FECACA;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#DC2626;">2</span>
        <div><strong>불필요한 기기 사용을 자제해주세요.</strong> 기계와 전자기기에서 발생하는 열이 위험할 수 있습니다.</div>
      </li>
      <li style="display:flex;gap:12px;font-size:14px;line-height:1.7;color:#374151;">
        <span style="flex-shrink:0;width:24px;height:24px;background:#FEE2E2;border:1px solid #FECACA;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#DC2626;">3</span>
        <div><strong>사고 발생 시 즉시 담당자에게 신고해주세요.</strong> 사고나 이상을 발견하면 즉시 관리자에게 알려야 합니다.</div>
      </li>
    </ul>
  </div>

  <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>

  <!-- 광고 3 -->
  <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

  <?= view('includes/section_naver_blog', ['blog_posts' => $blog_posts ?? []]) ?>

  <a href="<?= site_url('station') ?>" class="back-btn">← 목록으로 돌아가기</a>

</div>
</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
