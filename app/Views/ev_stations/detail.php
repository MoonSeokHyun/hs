<?php
// 안전 초기화
$facilityName      = esc($station['facility_name']   ?? 'EV Station');
$fullAddress       = esc($station['full_address']     ?? '');
$availableChargers = esc($station['available_chargers'] ?? '0');
$inUseChargers     = esc($station['in_use_chargers'] ?? '0');
$lat               = esc($station['latitude']         ?? '0');
$lng               = esc($station['longitude']        ?? '0');

// 구 추출 (SEO에 활용)
if (preg_match('/([가-힣]+구)/', $fullAddress, $m)) {
    $district = $m[1];
} else {
    $district = '서울';
}

// SEO용 메타 (이목 끌기)
$seoTitle       = esc("{$district} {$facilityName} 전기차 충전소 위치·요금·후기｜실시간 가용 {$availableChargers}대");
$seoDescription = esc("{$district} {$facilityName} 전기차 충전소의 위치, 요금, 이용 후기, 실시간 가용 충전기 현황({$availableChargers}대)을 한눈에 확인하세요.");
$seoKeywords    = esc("{$district} 전기차 충전소, {$facilityName}, 충전소 요금, 충전소 후기, 실시간 가용 충전기");
?>
<!doctype html>
<html lang="ko">
<head>
  <meta charset="utf-8">
  <title><?= $seoTitle ?></title>
  <meta name="description" content="<?= $seoDescription ?>" />
  <meta name="keywords" content="<?= $seoKeywords ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Open Graph -->
  <meta property="og:type"        content="website" />
  <meta property="og:title"       content="<?= $seoTitle ?>" />
  <meta property="og:description" content="<?= $seoDescription ?>" />
  <meta property="og:url"         content="<?= current_url() ?>" />
  <meta property="og:locale"      content="ko_KR" />

  <!-- Twitter Card -->
  <meta name="twitter:card"        content="summary" />
  <meta name="twitter:title"       content="<?= $seoTitle ?>" />
  <meta name="twitter:description" content="<?= $seoDescription ?>" />

  <script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
crossorigin="anonymous"></script>
  <style>
    body { background: #f5f5f5; font-family: 'Noto Sans KR', sans-serif; color: #333; margin:0; padding:0; }
    a { color:#0078ff; text-decoration:none; }
    .container{ max-width:800px; margin:2rem auto; padding:0 1rem; }
    .content-title{ font-size:2rem; margin-bottom:.5rem; border-bottom:2px solid #0078ff; padding-bottom:.3rem; }
    .breadcrumb{ font-size:.9rem; color:#555; margin-bottom:1.5rem; }
    .ad-box{ margin:1.5rem 0; text-align:center; }
    .section{ background:#fff; border-radius:8px; box-shadow:0 1px 4px rgba(0,0,0,0.1); margin-bottom:1.5rem; padding:1.5rem; }
    .section h2{ font-size:1.2rem; margin-bottom:1rem; color:#0078ff; border-left:4px solid #0078ff; padding-left:.5rem; }
    .detail-list{ margin:0; padding:0; }
    .detail-item{ display:flex; justify-content:space-between; padding:.75rem 0; border-bottom:1px solid #eee; }
    .detail-item:last-child{ border-bottom:none; }
    .label{ font-weight:600; color:#333; }
    .value{ color:#555; text-align:right; }
    #map{ width:100%; height:300px; border-radius:8px; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,0.1); }
    .qa-list { list-style: none; margin:0; padding:0; }
    .qa-item { margin-bottom: 1rem; }
    .qa-item p.question { font-weight:600; color:#0078ff; margin-bottom:.25rem; }
    .qa-item p.answer { margin:0; color:#555; }
  </style>
</head>
<body>

  <?php include APPPATH . 'Views/includes/header.php'; ?>

  <div class="container">
    <h1 class="content-title"><?= $facilityName ?></h1>
    <div class="breadcrumb">
      <a href="<?= site_url() ?>">홈</a> &gt;
      <a href="<?= site_url('ev-stations') ?>">EV Stations</a> &gt;
      상세정보
    </div>

    <div class="ad-box">
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="ca-pub-6686738239613464"
           data-ad-slot="1204098626"
           data-ad-format="auto"
           data-full-width-responsive="true"></ins>
      <script>(adsbygoogle=window.adsbygoogle||[]).push({});</script>
    </div>

    <!-- 기본 정보 -->
    <div class="section">
      <h2>기본 정보</h2>
      <div class="detail-list">
        <div class="detail-item"><div class="label">주소</div><div class="value"><?= $fullAddress ?></div></div>
        <div class="detail-item"><div class="label">가용 충전기</div><div class="value"><?= $availableChargers ?>대</div></div>
        <div class="detail-item"><div class="label">사용 중</div><div class="value"><?= $inUseChargers ?>대</div></div>
      </div>
    </div>

    <!-- 충전기 종류 -->
    <div class="section">
      <h2>충전기 종류</h2>
      <ul class="qa-list">
        <li class="qa-item">
          <p class="question">Q1. 어떤 커넥터를 제공하나요?</p>
          <p class="answer">DC콤보(CCS), CHAdeMO, AC완속(Type1/Type2)를 모두 지원합니다.</p>
        </li>
        <li class="qa-item">
          <p class="question">Q2. 최대 충전 속도는?</p>
          <p class="answer">최대 100kW 급속 충전을 제공합니다.</p>
        </li>
      </ul>
    </div>

    <!-- 이용 방법 -->
    <div class="section">
      <h2>이용 방법</h2>
      <ul class="qa-list">
        <li class="qa-item">
          <p class="question">Q1. 결제 수단은?</p>
          <p class="answer">앱 내 카드결제 및 포인트 결제를 지원합니다.</p>
        </li>
        <li class="qa-item">
          <p class="question">Q2. 예약 가능한가요?</p>
          <p class="answer">예약 시스템은 없으며, 선착순으로 이용하셔야 합니다.</p>
        </li>
      </ul>
    </div>
    <div class="ad-box">
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="ca-pub-6686738239613464"
           data-ad-slot="1204098626"
           data-ad-format="auto"
           data-full-width-responsive="true"></ins>
      <script>(adsbygoogle=window.adsbygoogle||[]).push({});</script>
    </div>
    <!-- 후기 -->
    <div class="section">
      <h2>이용 후기</h2>
      <ul class="qa-list">
        <li class="qa-item">
          <p class="question">★★★★★</p>
          <p class="answer">“충전 속도가 빠르고 주변에 카페도 많아 편리했어요.”</p>
        </li>
        <li class="qa-item">
          <p class="question">★★★★☆</p>
          <p class="answer">“주차공간이 약간 협소하지만, 충전기는 항상 작동됐습니다.”</p>
        </li>
      </ul>
    </div>

    <!-- 안전 수칙 -->
    <div class="section">
      <h2>안전 수칙</h2>
      <ul class="qa-list">
        <li class="qa-item">
          <p class="question">Q1. 비 오는 날 사용해도 되나요?</p>
          <p class="answer">충전기 방수가 되어 있으나, 젖은 손으로 조작은 피하세요.</p>
        </li>
        <li class="qa-item">
          <p class="question">Q2. 고장 시 대처 방법은?</p>
          <p class="answer">관리번호(☎02-1234-5678)로 즉시 신고해주세요.</p>
        </li>
      </ul>
    </div>
    <div class="ad-box">
      <ins class="adsbygoogle"
           style="display:block"
           data-ad-client="ca-pub-6686738239613464"
           data-ad-slot="1204098626"
           data-ad-format="auto"
           data-full-width-responsive="true"></ins>
      <script>(adsbygoogle=window.adsbygoogle||[]).push({});</script>
    </div>
    <!-- 지도 -->
    <div class="section">
      <h2>지도</h2>
      <div id="map"></div>
    </div>

    <p><a href="<?= site_url('ev-stations') ?>">← 목록으로 돌아가기</a></p>
  </div>

  <?php include APPPATH . 'Views/includes/footer.php'; ?>

  <script>
    (function(){
      var map = new naver.maps.Map('map', {
        center: new naver.maps.LatLng(parseFloat("<?= $lat ?>"), parseFloat("<?= $lng ?>")),
        zoom: 16
      });
      new naver.maps.Marker({
        position: map.getCenter(),
        map: map,
        title: "<?= $facilityName ?>"
      });
    })();
  </script>
</body>
</html>
