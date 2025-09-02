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
</div>

<!-- ✅ 쿠팡 파트너스 모달 (오버레이) -->
<div id="coupang-modal-overlay" role="dialog" aria-modal="true" aria-labelledby="coupang-modal-title" style="display:none;">
  <div id="coupang-modal">
    <button id="coupang-modal-close" type="button" aria-label="닫기">×</button>

    <!-- 상단 로고/타이틀 -->
    <div class="modal-header">
      <img class="coupang-logo" src="https://static.coupangcdn.com/image/coupang/common/logo_coupang_w360.png" alt="coupang" />
      <h3 id="coupang-modal-title">제철 특가</h3>
    </div>

    <!-- 광고 이미지 -->
    <a class="modal-link" href="https://link.coupang.com/a/cOmD6P" target="_blank" rel="noopener noreferrer nofollow sponsored">
      <img class="modal-hero" src="https://image14.coupangcdn.com/image/affiliate/event/promotion/2025/09/02/75aed5e5e3ab00900154b168f10fa550.png" alt="쿠팡 특가 배너" />
    </a>

    <!-- 하단 CTA -->
    <a class="modal-cta" href="https://link.coupang.com/a/cOmD6P" target="_blank" rel="noopener noreferrer nofollow sponsored">자세히 보기</a>

    <!-- 고지문 -->
    <p class="disclaimer">※ 본 링크는 쿠팡 파트너스 활동의 일환으로, 이에 따른 일정액의 수수료를 제공받을 수 있습니다.</p>
  </div>
</div>

<style>
  /* ====== 헤더 스타일 ====== */
  #header-wrapper header { background-color:#62D491; color:#fff; padding:1.5rem 1rem; text-align:center; }
  #header-wrapper header h1 { font-size:29px; margin-bottom:4px; }
  #header-wrapper header p { font-size:16px; margin-top:4px; }
  #header-wrapper .main-nav { background-color:#e6f7ef; padding:0.7rem; text-align:center; position:relative; z-index:9999; }
  #header-wrapper .top-menu { list-style:none; display:flex; gap:2rem; justify-content:center; margin:0; padding:0; position:relative; flex-wrap:wrap; }
  #header-wrapper .top-menu>li { position:relative; }
  #header-wrapper .top-menu>li>a { text-decoration:none; color:#3eaf7c; font-weight:bold; font-size:16px; padding:10px 15px; border-radius:8px; transition:background-color .3s ease, transform .3s ease; }
  #header-wrapper .top-menu>li>a:hover { background-color:#3eaf7c; color:#fff; transform:translateY(-2px); }
  .sub-menu { display:none; position:absolute; top:100%; left:0; background:#fff; border:1px solid #ccc; border-radius:6px; padding:.5rem 0; min-width:180px; list-style:none; box-shadow:0 4px 8px rgba(0,0,0,.1); z-index:10000; }
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
  .adsbygoogle{ display:block; text-align:center; margin:0 auto; }

  /* ====== 모달 스타일 ====== */
  html.no-scroll, body.no-scroll { overflow: hidden !important; }
  #coupang-modal-overlay{ position:fixed; inset:0; background:rgba(0,0,0,.6); display:flex; align-items:center; justify-content:center; z-index:100000; padding:16px; }
  #coupang-modal{ position:relative; width:100%; max-width:420px; background:#fff; border-radius:16px; box-shadow:0 20px 40px rgba(0,0,0,.25); overflow:hidden; animation:modalIn .24s ease-out; }
  @keyframes modalIn { from{transform:translateY(12px);opacity:0;} to{transform:translateY(0);opacity:1;} }
  #coupang-modal-close{ position:absolute; top:8px; right:8px; width:36px; height:36px; border:none; border-radius:50%; background:rgba(0,0,0,.55); color:#fff; font-size:22px; line-height:36px; cursor:pointer; }
  .modal-header{ display:flex; align-items:center; gap:8px; padding:12px 16px 0 16px; }
  .coupang-logo{ height:18px; }
  #coupang-modal-title{ font-size:18px; margin:0 0 8px 0; }
  .modal-link{ display:block; }
  .modal-hero{ width:100%; height:auto; display:block; background:#f3f3f3; }
  .modal-cta{ display:block; text-align:center; font-weight:700; padding:14px 16px; background:#1677ff; color:#fff; text-decoration:none; font-size:16px; border-radius:0 0 16px 16px; }
  .disclaimer{ margin:10px 16px 14px; font-size:12px; color:#666; }
  @media (max-width:360px){ #coupang-modal{ max-width:100%; } .modal-cta{ font-size:15px; padding:12px 14px; } }
</style>

<!-- 스크립트 -->
<script>
  // 모바일 메뉴 토글
  if (window.innerWidth <= 768) {
    document.querySelectorAll("#header-wrapper .menu-group > a.dropdown-toggle").forEach(function(toggleLink) {
      toggleLink.addEventListener('click', function(e) {
        e.preventDefault();
        var submenu = toggleLink.nextElementSibling;
        if (submenu) submenu.style.display = submenu.style.display === "block" ? "none" : "block";
      });
    });
  }

  // 쿠키 유틸
  function setCookie(name,value,maxAgeSeconds){
    var cookie=encodeURIComponent(name)+"="+encodeURIComponent(value)+";path=/;SameSite=Lax";
    if(maxAgeSeconds) cookie+=";max-age="+maxAgeSeconds;
    document.cookie=cookie;
  }
  function getCookie(name){
    var m=document.cookie.match(new RegExp('(?:^|; )'+encodeURIComponent(name)+'=([^;]*)'));
    return m?decodeURIComponent(m[1]):null;
  }

  // 모달 동작
  (function(){
    var overlay=document.getElementById("coupang-modal-overlay");
    var closeBtn=document.getElementById("coupang-modal-close");
    var HIDE_COOKIE="hide_coupang_modal";
    var HIDE_SECONDS=60*60*2; // 2시간

    function openModal(){
      overlay.style.display="flex";
      document.documentElement.classList.add("no-scroll");
      document.body.classList.add("no-scroll");
    }
    function closeModal(){
      overlay.style.display="none";
      document.documentElement.classList.remove("no-scroll");
      document.body.classList.remove("no-scroll");
      setCookie(HIDE_COOKIE,"1",HIDE_SECONDS);
    }

    if(!getCookie(HIDE_COOKIE)){ window.requestAnimationFrame(openModal); }
    if(closeBtn) closeBtn.addEventListener("click",closeModal);
    overlay.addEventListener("click",function(e){ if(e.target===overlay) closeModal(); });
    document.addEventListener("keydown",function(e){ if(e.key==="Escape"&&overlay.style.display!=="none") closeModal(); });
  })();
</script>
