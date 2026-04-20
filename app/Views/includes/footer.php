<!-- footer.php -->
<footer>
  <div class="footer-container">
    <!-- 회사 정보 -->
    <div class="footer-section">
      <h3>편잇 (EASEHUB)</h3>
      <p>전국 의료기관·주유소·주차장·정비소·숙박·편의점 정보 통합 플랫폼</p>
      <p>운영: 문딜로지스틱스 (MoonDilogistics)</p>
      <p>사업자 등록번호 : 345-18-02361</p>
      <p class="copyright">
        © Copyright Since 2024 문딜로지스틱스. All rights reserved.
      </p>
    </div>
    <!-- 주요 서비스 -->
    <div class="footer-section">
      <h3>주요 서비스</h3>
      <ul>
        <li><a href="/hospital">전국 의료기관</a></li>
        <li><a href="/gas_stations">주유소</a></li>
        <li><a href="/parking">주차장</a></li>
        <li><a href="/automobile_repair_shops">자동차 정비소</a></li>
        <li><a href="/carwash">세차장</a></li>
      </ul>
    </div>
    <!-- 생활 편의 -->
    <div class="footer-section">
      <h3>생활 편의</h3>
      <ul>
        <li><a href="/hotel">숙박시설</a></li>
        <li><a href="/ev-stations">전기차 충전소</a></li>
        <li><a href="/parking-facilities">공영주차장</a></li>
        <li><a href="/towed-vehicle-storage">견인차량 보관소</a></li>
        <li><a href="/stores">타이어 판매소</a></li>
      </ul>
    </div>
    <!-- 콘텐츠 -->
    <div class="footer-section">
      <h3>콘텐츠</h3>
      <ul>
        <li><a href="/events">편의점 이벤트</a></li>
        <li><a href="/recipes">편의점 레시피</a></li>
        <li><a href="/festival-info">축제·공연 정보</a></li>
        <li><a href="/sitemap">사이트맵</a></li>
      </ul>
    </div>
    <!-- 고객센터 -->
    <div class="footer-section">
      <h3>고객센터</h3>
      <p>이메일: <a href="mailto:gjqmaoslwj@naver.com">gjqmaoslwj@naver.com</a></p>
      <p>운영시간: 평일 09:00 ~ 18:00 (점심시간 11:00 ~ 13:00)</p>
      <p class="footer-note">홈페이지 정보 오류 수정 / 삭제 요청 / 이용 문의 등</p>
    </div>
  </div>
</footer>

<!-- 전역 광고 렌더 스크립트 (모든 페이지에서 1회만 실행, 중복 push 방지) -->
<script>
(function () {
  if (window.__adSlotsRendered) return;
  window.__adSlotsRendered = true;
  var adNodes = document.querySelectorAll('.ad-slot.adsbygoogle');
  for (var i = 0; i < adNodes.length; i++) {
    var node = adNodes[i];
    if (!node.dataset.adsRendered) {
      try { (window.adsbygoogle = window.adsbygoogle || []).push({}); } catch (e) {}
      node.dataset.adsRendered = '1';
    }
  }
})();
</script>

<?php if (!preg_match('/^localhost(:[0-9]*)?$/', $_SERVER['HTTP_HOST'])): ?>
  <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
  <script>
    if (!wcs_add) var wcs_add = {};
    wcs_add["wa"] = "8adec19974bed8";
    if (window.wcs) wcs_do();
  </script>
<?php endif; ?>

<!-- 스타일 -->
<style>
  footer {
    background-color: #f8f9fa;
    color: #333;
    padding: 40px 20px;
    border-top: 1px solid #ddd;
    font-size: 14px;
  }
  .footer-container {
    display: flex;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
    gap: 40px;
    justify-content: space-between;
  }
  .footer-section {
    flex: 1 1 120px;
    min-width: 250px;
  }
  .footer-section h3 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #111;
  }
  .footer-section p,
  .footer-section li {
    margin: 6px 0;
    line-height: 1.6;
  }
  .footer-section a {
    color: #0066cc;
    text-decoration: none;
    transition: all 0.2s ease;
  }
  .footer-section a:hover {
    text-decoration: underline;
    color: #004999;
  }
  .footer-section ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  .footer-note {
    color: #666;
    font-size: 13px;
    margin-top: 10px;
  }
  .copyright {
    margin-top: 20px;
    font-size: 12px;
    color: #888;
  }
</style>
