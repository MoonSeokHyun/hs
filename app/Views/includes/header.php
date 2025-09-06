<!-- 헤더 시작 -->
<div id="header-wrapper">
  <!-- 사이트 타이틀 -->
  <header>
    <h2>편잇</h2>
    <p>대한민국 편의시설 통합 플랫폼</p>
  </header>

  <!-- 네비게이션 -->
  <nav class="main-nav">
    <ul class="top-menu">
      <!-- 편의점 메뉴 -->
      <li class="menu-group">
        <a href="#" class="dropdown-toggle">🍩 편의점 ▾</a>
        <ul class="sub-menu">
          <li><a href="/events">전체</a></li>
          <li><a href="/events/cu">CU</a></li>
          <li><a href="/events/gs25">GS25</a></li>
          <li><a href="/events/7-ELEVEn">세븐일레븐</a></li>
          <li><a href="/events/emart24">이마트24</a></li>
        </ul>
      </li>

      <!-- 편의시설 메뉴 -->
      <li class="menu-group">
        <a href="#" class="dropdown-toggle">🏨 편의시설 ▾</a>
        <ul class="sub-menu">
          <li><a href="/hotel">숙박</a></li>
        </ul>
      </li>

      <!-- 자동차 메뉴 -->
      <li class="menu-group">
        <a href="#" class="dropdown-toggle">🚗 자동차 ▾</a>
        <ul class="sub-menu">
          <li><a href="/parking">주차장</a></li>
          <li><a href="/automobile_repair_shops">정비소</a></li>
          <li><a href="/gas_stations">주유소</a></li>
          <li><a href="/carwash">세차장</a></li>
          <li><a href="/towed-vehicle-storage">견인보관소</a></li>
          <li><a href="/parking-facilities">공영주차장</a></li>
          <li><a href="/stores">타이어판매소</a></li>
          <li><a href="/ev-stations">전기차 충전소</a></li>
          <li><a href="/station">가스 충전소</a></li>
        </ul>
      </li>

      <!-- 이벤트 메뉴 -->
      <li class="menu-group">
        <a href="#" class="dropdown-toggle">🎉 이벤트 ▾</a>
        <ul class="sub-menu">
          <li><a href="/event">이벤트</a></li>
          <li><a href="/recipes">레시피</a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <!-- ✅ 쿠팡 파트너스 배너(플로팅/모달 아님) -->
  <section class="coupang-banner" role="region" aria-label="쿠팡 파트너스 배너" id="coupang-banner" hidden>
    <div class="banner-inner">
      <a class="banner-link" href="https://link.coupang.com/a/cOmD6P" target="_blank" rel="noopener noreferrer nofollow sponsored" aria-label="쿠팡 제철 특가 자세히 보기">
        <img class="banner-hero" src="https://image14.coupangcdn.com/image/affiliate/event/promotion/2025/09/02/75aed5e5e3ab00900154b168f10fa550.png" alt="쿠팡 제철 특가 배너" loading="lazy" />
      </a>
      <div class="banner-cta-row">
        <a class="banner-cta" href="https://link.coupang.com/a/cOmD6P" target="_blank" rel="noopener noreferrer nofollow sponsored">자세히 보기</a>
        <button class="banner-close" type="button" aria-label="배너 닫기">×</button>
      </div>
      <p class="banner-disclaimer">※ 본 링크는 쿠팡 파트너스 활동의 일환으로, 이에 따른 일정액의 수수료를 제공받을 수 있습니다.</p>
    </div>
  </section>
</div>
<!-- 헤더 끝 -->

<style>
  /* ====== 헤더 스타일 ====== */
  #header-wrapper header { background-color:#62D491; color:#fff; padding:1.5rem 1rem; text-align:center; }
  #header-wrapper header h1, #header-wrapper header h2 { font-size:29px; margin-bottom:4px; }
  #header-wrapper header p { font-size:16px; margin-top:4px; }
  #header-wrapper .main-nav { background-color:#e6f7ef; padding:0.7rem; text-align:center; position:relative; z-index:1; }
  #header-wrapper .top-menu { list-style:none; display:flex; gap:2rem; justify-content:center; margin:0; padding:0; position:relative; flex-wrap:wrap; }
  #header-wrapper .top-menu>li { position:relative; }
  #header-wrapper .top-menu>li>a { text-decoration:none; color:#3eaf7c; font-weight:bold; font-size:16px; padding:10px 15px; border-radius:8px; transition:background-color .3s ease, transform .3s ease; }
  #header-wrapper .top-menu>li>a:hover { background-color:#3eaf7c; color:#fff; transform:translateY(-2px); }
  .sub-menu { display:none; position:absolute; top:100%; left:0; background:#fff; border:1px solid #ccc; border-radius:6px; padding:.5rem 0; min-width:180px; list-style:none; box-shadow:0 4px 8px rgba(0,0,0,.1); z-index:10; }
  .menu-group:hover .sub-menu { display:block; }
  .sub-menu li a { display:block; padding:8px 16px; color:#3eaf7c; font-size:14px; text-decoration:none; }
  .sub-menu li a:hover { background-color:#f0fdf8; }
  @media (max-width:768px){
    #header-wrapper .top-menu{ flex-direction:row; flex-wrap:wrap; justify-content:center; gap:1rem; }
    #header-wrapper .top-menu>li{ width:auto; }
    #header-wrapper .top-menu>li>a{ padding:10px 15px; }
    .sub-menu{ position:absolute; top:100%; left:0; }
    .menu-group:hover .sub-menu{ display:block; }
    .sub-menu li a{ font-size:14px; }
  }

  /* ====== 배너 스타일 (비플로팅/비모달) ====== */
  .coupang-banner { background:#fff; border-top:1px solid #eaeaea; border-bottom:1px solid #eaeaea; }
  .coupang-banner[hidden]{ display:none !important; }
  .coupang-banner .banner-inner { max-width:1100px; margin:0 auto; padding:12px 16px 10px; }
  .banner-hero { width:100%; height:auto; display:block; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,.06); }
  .banner-cta-row { display:flex; align-items:center; gap:10px; margin-top:10px; }
  .coupang-logo { height:18px; opacity:.9; }
  .banner-cta { margin-left:auto; display:inline-block; padding:10px 14px; font-weight:700; background:#1677ff; color:#fff; text-decoration:none; border-radius:8px; }
  .banner-close { appearance:none; border:none; background:#f2f3f5; color:#222; width:32px; height:32px; line-height:32px; border-radius:50%; cursor:pointer; font-size:18px; }
  .banner-disclaimer { margin:8px 0 0; font-size:12px; color:#666; }
  @media (max-width:520px){
    .banner-cta{ padding:9px 12px; font-size:14px; }
    .banner-close{ width:28px; height:28px; font-size:16px; }
  }

  .adsbygoogle{ display:block; text-align:center; margin:0 auto; }
</style>

<script>
  // 모바일 메뉴 토글 (기존 유지)
  if (window.innerWidth <= 768) {
    document.querySelectorAll("#header-wrapper .menu-group > a.dropdown-toggle").forEach(function(toggleLink) {
      toggleLink.addEventListener('click', function(e) {
        e.preventDefault();
        var submenu = toggleLink.nextElementSibling;
        if (submenu) submenu.style.display = submenu.style.display === "block" ? "none" : "block";
      });
    });
  }

  // 간단 쿠키 유틸
  function setCookie(name,value,maxAgeSeconds){
    var cookie=encodeURIComponent(name)+"="+encodeURIComponent(value)+";path=/;SameSite=Lax";
    if(maxAgeSeconds) cookie+=";max-age="+maxAgeSeconds;
    document.cookie=cookie;
  }
  function getCookie(name){
    var m=document.cookie.match(new RegExp('(?:^|; )'+encodeURIComponent(name)+'=([^;]*)'));
    return m?decodeURIComponent(m[1]):null;
  }

  // ✅ 배너 동작 (모달/플로팅 아님, 컨텐츠 밀어내는 정적 배치)
  (function(){
    var banner = document.getElementById("coupang-banner");
    var closeBtn = banner ? banner.querySelector(".banner-close") : null;
    var HIDE_COOKIE="hide_coupang_banner";
    var HIDE_SECONDS=60*60*2; // 2시간

    // 쿠키가 없으면 배너 표시
    if (banner && !getCookie(HIDE_COOKIE)) {
      banner.hidden = false;
    }

    // 닫기 시 배너만 접기 (레이아웃 정상 유지)
    if (closeBtn) {
      closeBtn.addEventListener("click", function(){
        banner.hidden = true;
        setCookie(HIDE_COOKIE, "1", HIDE_SECONDS);
      });
    }
  })();
</script>
