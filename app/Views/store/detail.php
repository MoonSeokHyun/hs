<?php
// 안전 초기화
foreach($store as $k => $v) {
    $store[$k] = esc($v);
}
// 구(동) 정보 추출
preg_match('/([가-힣]+구)/', $store['road_address'] ?? '', $m);
$district = $m[0] ?? '지역';
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- SEO 최적화된 Title -->
  <title><?= $store['store_name'] ?> - <?= $district ?> | 타이어·경정비·엔진오일 전문</title>
  <!-- 네이버 지도 API 주석 처리
  <script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
  -->
  <style>
    body{background:#f5f5f5;font-family:'Noto Sans KR',sans-serif;margin:0;padding:0;color:#333}
    .container{max-width:900px;margin:2rem auto;padding:0 1rem}
    .back{display:inline-block;margin:1rem 0;color:#0078ff;text-decoration:none}
    .section{background:#fff;margin-bottom:1.5rem;padding:1.5rem;border-radius:8px;box-shadow:0 1px 4px rgba(0,0,0,0.1)}
    .section h2{font-size:1.2rem;margin-bottom:1rem;color:#0078ff;border-left:4px solid #0078ff;padding-left:.5rem}
    .detail-list{list-style:none;padding:0;margin:0}
    .detail-item{display:flex;justify-content:space-between;padding:.75rem 0;border-bottom:1px solid #eee}
    .detail-item:last-child{border-bottom:none}
    .label{font-weight:600}
    .value{text-align:right;word-break:break-all;max-width:60%}
    /* 지도 스타일 주석 처리
    #map{width:100%;height:300px;border-radius:8px;margin-top:1rem}
    */
    a.tip-link{color:#3eaf7c;text-decoration:none;font-size:0.95rem}
    a.tip-link:hover{text-decoration:underline}
  </style>

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
crossorigin="anonymous"></script>
</head>
<body>
  <?php include APPPATH . 'Views/includes/header.php'; ?>
  <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
  <div class="container">
    <a href="<?= site_url('stores') ?>" class="back">← 목록으로 돌아가기</a>

    <!-- 매장 기본 정보 -->
    <div class="section">
      <h2>매장 기본 정보</h2>
      <ul class="detail-list">
        <li class="detail-item"><span class="label">매장명</span><span class="value"><?= $store['store_name'] ?></span></li>
        <li class="detail-item"><span class="label">지역</span><span class="value"><?= $store['region'] ?></span></li>
        <li class="detail-item"><span class="label">전화번호</span><span class="value"><?= $store['phone_number'] ?></span></li>
      </ul>
    </div>

    <!-- 위치 & 지도 -->
    <div class="section">
      <h2>위치 & 지도</h2>
      <ul class="detail-list">
        <li class="detail-item"><span class="label">도로명주소</span><span class="value"><?= $store['road_address'] ?></span></li>
        <li class="detail-item"><span class="label">지번주소</span><span class="value"><?= $store['address'] ?></span></li>
      </ul>
      <!-- 지도 div 주석 처리
      <div id="map"></div>
      -->
    </div>

    <!-- 추가 정보 -->
    <div class="section">
      <h2>추가 정보</h2>
      <ul class="detail-list">
        <li class="detail-item"><span class="label">사업자등록번호</span><span class="value"><?= $store['business_registration_number'] ?></span></li>
        <li class="detail-item"><span class="label">Notes</span><span class="value"><?= nl2br($store['notes']) ?></span></li>
        <li class="detail-item"><span class="label">Services Offered</span><span class="value"><?= $store['services_offered'] ?></span></li>
      </ul>
    </div>
    <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
    <!-- 팁 섹션: 타이어 잘 가는 법 -->
    <div class="section">
      <h2>Tip: 타이어 오래 쓰는 법</h2>
      <p>1. 매달 타이어 공기압 체크하기<br>
         2. 균일 마모를 위한 정기적인 타이어 로테이션<br>
         3. 도로 상태에 맞춰 급출발·급제동 자제하기</p>
      <p><a href="https://www.motorguide.co.kr/tire-longevity" target="_blank" class="tip-link">더 알아보기 &raquo;</a></p>
    </div>

    <!-- 팁 섹션: 싸게 가는 법 -->
    <div class="section">
      <h2>Tip: 타이어 비용 절감하기</h2>
      <p>- 온라인 할인 쿠폰 활용<br>
         - 시즌 오프 세일 기간 노리기<br>
         - 현지 중소 타이어 숍 비교 견적 받기</p>
      <p><a href="https://www.tiredeal.co.kr/discount-tips" target="_blank" class="tip-link">더 알아보기 &raquo;</a></p>
    </div>

    <!-- 팁 섹션: 관리 방법 -->
    <div class="section">
      <h2>Tip: 간단 관리 방법</h2>
      <p>- 세차 후 타이어 전용 왁스 도포<br>
         - 표면 균열 및 손상 여부 월 1회 점검<br>
         - 장기간 보관 시 직사광선 피하기</p>
      <p><a href="https://www.carcareinfo.kr/tire-maintenance" target="_blank" class="tip-link">더 알아보기 &raquo;</a></p>
    </div>
  </div>
  <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
  <?php include APPPATH . 'Views/includes/footer.php'; ?>

  <!-- 네이버맵 스크립트 주석 처리
  <script>
    (function(){
      var lat = parseFloat("<?= $store['latitude'] ?>");
      var lng = parseFloat("<?= $store['longitude'] ?>");
      var map = new naver.maps.Map('map', {
        center: new naver.maps.LatLng(lat, lng),
        zoom: 16
      });
      new naver.maps.Marker({
        position: new naver.maps.LatLng(lat, lng),
        map: map,
        title: "<?= $store['store_name'] ?>"
      });
    })();
  </script>
  -->
</body>
</html>
