<style>
.site-footer {
  background: #111827;
  margin-top: 80px;
}
.ft-body {
  max-width: 1200px;
  margin: 0 auto;
  padding: 56px 24px 44px;
  display: grid;
  grid-template-columns: 260px 1fr 220px;
  gap: 56px;
}
.ft-logo {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  text-decoration: none;
  margin-bottom: 14px;
}
.ft-logo-mark {
  width: 34px; height: 34px;
  background: #F97316;
  border-radius: 9px;
  display: grid; place-items: center;
  font-size: 15px; font-weight: 900;
  color: #fff; flex-shrink: 0;
}
.ft-logo-name {
  font-size: 19px; font-weight: 900;
  letter-spacing: -1px; color: #fff;
}
.ft-tagline {
  font-size: 13px; color: #6B7280;
  line-height: 1.7; margin-bottom: 10px;
}
.ft-biz { font-size: 12px; color: #4B5563; line-height: 1.6; }

/* 서비스 링크 그리드 */
.ft-col-title {
  font-size: 11px; font-weight: 700;
  color: #9CA3AF; letter-spacing: .8px;
  text-transform: uppercase; margin-bottom: 16px;
}
.ft-link-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px 24px;
}
.ft-link-grid a {
  font-size: 13px; font-weight: 500;
  color: #6B7280;
  transition: color .15s;
  white-space: nowrap;
}
.ft-link-grid a:hover { color: #F97316; }

/* 고객센터 */
.ft-contact-mail {
  font-size: 13px; font-weight: 700;
  color: #F97316; margin-bottom: 10px;
  display: block; word-break: break-all;
}
.ft-contact-mail:hover { color: #FB923C; }
.ft-contact-info { font-size: 12px; color: #4B5563; line-height: 1.8; }

/* 하단 바 */
.ft-bottom { border-top: 1px solid #1F2937; }
.ft-bottom-inner {
  max-width: 1200px; margin: 0 auto;
  padding: 18px 24px;
  display: flex; align-items: center;
  justify-content: space-between;
  flex-wrap: wrap; gap: 8px;
}
.ft-copy { font-size: 12px; color: #374151; }
.ft-copy strong { color: #4B5563; }

@media (max-width: 900px) {
  .ft-body { grid-template-columns: 1fr 1fr; }
  .ft-brand { grid-column: 1 / -1; }
  .ft-link-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 560px) {
  .ft-body { grid-template-columns: 1fr; gap: 32px; padding: 40px 16px 32px; }
  .ft-link-grid { grid-template-columns: repeat(2, 1fr); }
  .ft-bottom-inner { padding: 14px 16px; flex-direction: column; align-items: flex-start; }
}
</style>

<footer class="site-footer">
  <div class="ft-body">

    <div class="ft-brand">
      <a href="/" class="ft-logo">
        <span class="ft-logo-mark">편</span>
        <span class="ft-logo-name">편잇</span>
      </a>
      <p class="ft-tagline">전국 편의시설 정보를 한 곳에서.<br>편의점 할인부터 병원·주차장까지.</p>
      <p class="ft-biz">운영: 문딜로지스틱스<br>사업자번호: 345-18-02361</p>
    </div>

    <div class="ft-col">
      <p class="ft-col-title">서비스</p>
      <div class="ft-link-grid">
        <a href="/hospital">의료기관</a>
        <a href="/gas_stations">주유소</a>
        <a href="/parking">주차장</a>
        <a href="/automobile_repair_shops">자동차 정비소</a>
        <a href="/carwash">세차장</a>
        <a href="/hotel">숙박시설</a>
        <a href="/ev-stations">전기차 충전소</a>
        <a href="/parking-facilities">공영주차장</a>
        <a href="/events">편의점 이벤트</a>
        <a href="/recipes">편의점 레시피</a>
        <a href="/festival-info">축제·공연</a>
        <a href="/sitemap">사이트맵</a>
      </div>
    </div>

    <div class="ft-col">
      <p class="ft-col-title">고객센터</p>
      <a href="mailto:gjqmaoslwj@naver.com" class="ft-contact-mail">gjqmaoslwj@naver.com</a>
      <p class="ft-contact-info">
        평일 09:00 – 18:00<br>
        (점심 11:00 – 13:00)<br><br>
        정보 오류·삭제 요청<br>서비스 이용 문의
      </p>
    </div>

  </div>

  <div class="ft-bottom">
    <div class="ft-bottom-inner">
      <p class="ft-copy">© <strong>2024–2026 문딜로지스틱스</strong>. All rights reserved.</p>
      <p class="ft-copy">편잇 (EASEHUB) — 대한민국 편의시설 통합 플랫폼</p>
    </div>
  </div>
</footer>

<script>
(function () {
  if (window.__adRendered) return;
  window.__adRendered = true;
  var nodes = document.querySelectorAll('.ad-slot.adsbygoogle');
  for (var i = 0; i < nodes.length; i++) {
    if (!nodes[i].dataset.adsDone) {
      try { (window.adsbygoogle = window.adsbygoogle || []).push({}); } catch (e) {}
      nodes[i].dataset.adsDone = '1';
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
