<?php
// 안전 초기화
$facilityName      = esc($station['facility_name']   ?? '가스 충전소');
$fullAddress       = esc($station['FullAddress']     ?? '');
$availableChargers = esc($station['available_chargers'] ?? '0');
$inUseChargers     = esc($station['in_use_chargers'] ?? '0');
$lat               = esc($station['latitude']         ?? '0');
$lng               = esc($station['longitude']        ?? '0');

// Address1과 Company를 이용해 SEO 생성
$address1          = esc($station['Address1'] ?? '');
$company           = esc($station['Company'] ?? '');


// SEO용 메타 (이목 끌기)
$seoTitle       = esc("{$fullAddress} {$company} - {$facilityName} 가스충전소 위치·요금·후기｜실시간 가용 {$availableChargers}대");
$seoDescription = esc("{$fullAddress} {$company} {$facilityName} 가스충전소의 위치, 요금, 이용 후기, 실시간 가용 충전기 현황({$availableChargers}대)을 한눈에 확인하세요.");
$seoKeywords    = esc("{$fullAddress} 가스충전소, {$company}, {$facilityName}, {$address1}, 충전소 요금, 충전소 후기, 실시간 가용 충전기");
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

  <!-- 네이버맵 API 주석 처리
  <script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
  -->
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
    /* 지도 스타일 주석 처리
    #map{ width:100%; height:300px; border-radius:8px; overflow:hidden; box-shadow:0 1px 4px rgba(0,0,0,0.1); }
    */
  </style>
</head>
<body>

  <?php include APPPATH . 'Views/includes/header.php'; ?>

  <div class="container">
    <h1 class="content-title"><?= esc($station['Company']) ?> LPG 충전소</h1>
    <div class="breadcrumb">
      <a href="<?= site_url() ?>">홈</a> &gt;
      <a href="<?= site_url('station') ?>">가스충전소 목록</a> &gt;
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
        <div class="detail-item"><div class="label">주소1</div><div class="value"><?= esc($station['Address1']) ?></div></div>
        <div class="detail-item"><div class="label">주소2</div><div class="value"><?= esc($station['Address2']) ?></div></div>
        <div class="detail-item"><div class="label">사업자 ID</div><div class="value"><?= esc($station['BusinessID']) ?></div></div>
        <div class="detail-item"><div class="label">상태</div><div class="value"><?= esc($station['Status']) ?></div></div>
        <div class="detail-item"><div class="label">도시</div><div class="value"><?= esc($station['City']) ?></div></div>
        <div class="detail-item"><div class="label">회사</div><div class="value"><?= esc($station['Company']) ?></div></div>
        <div class="detail-item"><div class="label">전체 주소</div><div class="value"><?= esc($station['FullAddress']) ?></div></div>
        <div class="detail-item"><div class="label">전화번호</div><div class="value"><?= esc($station['Phone']) ?></div></div>
        <div class="detail-item"><div class="label">서비스</div><div class="value"><?= esc($station['Service']) ?></div></div>
      </div>
    </div>

    <!-- 가스충전소 관련 내용 -->
    <div class="section">
      <h2>가스충전소 주의사항</h2>
      <ul class="detail-list">
        <li class="detail-item"><div class="label">1. 충전 중 차량을 떠나지 마세요.</div><div class="value">충전이 완료될 때까지 차량을 충전소에서 대기시키세요.</div></li>
        <li class="detail-item"><div class="label">2. 가스 누출을 방지하기 위해 충전 전에 모든 차량 문을 닫아주세요.</div><div class="value">가스 누출을 막기 위해 차량 문을 반드시 닫고 충전하세요.</div></li>
        <li class="detail-item"><div class="label">3. 충전이 끝난 후에는 꼭 충전기를 다시 제자리에 놓아주세요.</div><div class="value">충전 완료 후 충전기를 다시 제자리로 놓아주세요.</div></li>
        <li class="detail-item"><div class="label">4. 날씨가 나쁠 때는 가스충전소 이용을 자제해주세요.</div><div class="value">폭우나 폭설 등의 기상 악화 시 충전소 이용을 자제해 주세요.</div></li>
      </ul>
    </div>

    <!-- 안전 수칙 -->
    <div class="section">
      <h2>안전 수칙</h2>
      <ul class="detail-list">
        <li class="detail-item"><div class="label">1. 충전소 근처에서 흡연을 금지해주세요.</div><div class="value">가스가 누출될 경우 큰 화재로 이어질 수 있습니다.</div></li>
        <li class="detail-item"><div class="label">2. 불필요한 기기 사용을 자제해주세요.</div><div class="value">기계와 전자기기에서 발생하는 열이 위험할 수 있습니다.</div></li>
        <li class="detail-item"><div class="label">3. 사고 발생 시 즉시 담당자에게 신고해주세요.</div><div class="value">사고나 이상을 발견하면 즉시 관리자에게 알려야 합니다.</div></li>
      </ul>
    </div>



    <!-- 지도 섹션 주석 처리
    <div class="section">
      <h2>지도</h2>
      <div id="map"></div>
    </div>
    -->

    <p><a href="<?= site_url('station') ?>">← 목록으로 돌아가기</a></p>
  </div>

  <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>
  <?php include APPPATH . 'Views/includes/footer.php'; ?>

  <!-- 네이버맵 스크립트 주석 처리
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
  -->
</body>
</html>
