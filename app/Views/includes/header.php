<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>편잇</title>

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

  /* ====== 쿠팡 배너 (비플로팅/비모달) ====== */
  .coupang-banner { background:#fff; border-top:1px solid #eaeaea; border-bottom:1px solid #eaeaea; }
  .coupang-banner[hidden]{ display:none !important; }
  .coupang-banner .banner-inner { max-width:1100px; margin:0 auto; padding:12px 16px 10px; }
  .banner-hero { width:100%; height:auto; display:block; border-radius:10px; box-shadow:0 2px 10px rgba(0,0,0,.06); }
  .banner-cta-row { display:flex; align-items:center; gap:10px; margin-top:10px; }
  .banner-cta { margin-left:auto; display:inline-block; padding:10px 14px; font-weight:700; background:#1677ff; color:#fff; text-decoration:none; border-radius:8px; }
  .banner-close { appearance:none; border:none; background:#f2f3f5; color:#222; width:32px; height:32px; line-height:32px; border-radius:50%; cursor:pointer; font-size:18px; }
  .banner-disclaimer { margin:8px 0 0; font-size:12px; color:#666; }

  @media (max-width:520px){
    .banner-cta{ padding:9px 12px; font-size:14px; }
    .banner-close{ width:28px; height:28px; font-size:16px; }
  }

  .adsbygoogle{ display:block; text-align:center; margin:0 auto; }

  /* ====== TikTok 플로팅 배너 ====== */
  .tiktok-float[hidden]{ display:none !important; }
  .tiktok-float{
    position:fixed;
    right:16px;
    bottom:max(16px, env(safe-area-inset-bottom));
    z-index:9999;
    pointer-events:none; /* 카드 밖은 클릭 통과 */
  }
  .tiktok-float .tf-card{
    width:320px; max-width:92vw;
    background:#fff; border:1px solid #eaeaea; border-radius:14px;
    box-shadow:0 14px 40px rgba(0,0,0,.18);
    overflow:hidden; pointer-events:auto; /* 카드 안은 클릭됨 */
    transform: translateY(8px);
    animation: tf-in .28s ease-out both;
  }
  @keyframes tf-in{ from{opacity:0; transform:translateY(16px);} to{opacity:1; transform:translateY(0);} }
  .tiktok-float .tf-close{
    position:absolute; top:8px; right:8px; width:32px; height:32px; line-height:32px;
    border:none; border-radius:50%; background:#f2f3f5; color:#222; cursor:pointer; font-size:18px;
  }
  .tiktok-float .tf-hero img{ display:block; width:100%; height:auto; }
  .tiktok-float .tf-body{
    display:flex; align-items:center; gap:10px; padding:10px 12px 6px;
  }
  .tiktok-float .tf-title{ font-size:15px; color:#111; }
  .tiktok-float .tf-cta{
    margin-left:auto; display:inline-block; padding:8px 12px; font-weight:700;
    background:#000; color:#fff; text-decoration:none; border-radius:8px;
  }
  .tiktok-float .tf-disclaimer{ margin:0; padding:0 12px 12px; font-size:12px; color:#666; }

  /* 모션 최소화 대응 */
  @media (prefers-reduced-motion: reduce){
    .tiktok-float .tf-card{ animation:none; }
  }
  /* 화면 높이가 매우 낮으면 숨김 */
  @media (max-height:520px){
    .tiktok-float{ display:none; }
  }
</style>
</head>
<body>

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
      <a class="banner-link" href="https://link.coupang.com/a/cPfzOJ" target="_blank" rel="noopener noreferrer nofollow sponsored" aria-label="쿠팡 제철 특가 자세히 보기">
        <img class="banner-hero" src="https://image15.coupangcdn.com/image/affiliate/event/promotion/2025/09/03/825a2ee5765400490107c72d34d155e6.png" alt="쿠팡 제철 특가 배너" loading="lazy" />
      </a>
      <div class="banner-cta-row">
        <a class="banner-cta" href="https://link.coupang.com/a/cPfzOJ" target="_blank" rel="noopener noreferrer nofollow sponsored">자세히 보기</a>
        <button class="banner-close" type="button" aria-label="배너 닫기">×</button>
      </div>
      <p class="banner-disclaimer">※ 본 링크는 쿠팡 파트너스 활동의 일환으로, 이에 따른 일정액의 수수료를 제공받을 수 있습니다.</p>
    </div>
  </section>
</div>
<!-- 헤더 끝 -->

<!-- ✅ TikTok Lite 플로팅 배너 (새 링크 적용) -->
<section id="tiktok-float" class="tiktok-float" role="region" aria-label="TikTok Lite 프로모션" hidden>
  <div class="tf-card" role="dialog" aria-modal="false">
    <button class="tf-close" type="button" aria-label="배너 닫기">×</button>

    <a class="tf-hero"
       href="https://www.tiktok.com/ug/incentive/share/coin_hundred?__status_bar=true&_d=em9hgj8g7hjgdc&_pia_=1&_svg=1&aid=473824&enter_from=share_coin_hundred_dollars_no_tributed&et_campaign=coin&et_gameplay=coin_hundred_dollars_no_tributed&gd_label=click_wap_coin_hundred_dollars_no_tributed&hide_nav_bar=1&inc_pid=coin_referral_onelink_coin_hundred_dollars_no_tributed&og_image=https%3A%2F%2Fp16-ug-incentive-va.tiktokcdn.com%2Ftos-maliva-i-68e3t9dfc1-us%2F4a3cefdb848f409c99b82ff356b7e1d1~tplv-68e3t9dfc1-image.image&region=kr&share_app_id=473824&share_page_data=MIIBCAQMr8g6jFTXon0Xp3MEBIHl6%2FvU5hZvwz285NBFnz6P6bVMAHafa4DeVVO8lWwS3AxVIT7Lw7q8aDkT6gKmoyLWKe3tkWhtIHMqIEyXY24kbfigGfIhglo3DDVrKWP5K5eRTO+xRQpDYt7Y29WQEsjYeWVFedBKP9zAiwf5Tc5rcT561K6Xec71Oyges9Ashui8HjSLzOv1%2F2toojtd0dGVJujJ4ddjY2AYm31PEeFaRRI1YiIAizp6nCXT9ULPusSYOIwz6ie53d4s44%2FTdzfxsMip75GoYSCi9pBomErioE0eUJCmfqyvNCoWO4Ea+5zq5MSLigQQ6Ukb0mZ0UuLytRGlq458ZQ%3D%3D&share_time=1757426267187&sharer_biz=ug_paid_acquisition&sharer_os=ios&should_full_screen=1&u_code=NzU0Nzk0MTY3OTE1NzM0NzMyOQ%3D%3D&utm_campaign=client_share&utm_source=kakaotalk"
       target="_blank" rel="noopener noreferrer nofollow sponsored"
       aria-label="TikTok Lite 이벤트 바로가기">
      <img src="https://p16-ug-incentive-va.tiktokcdn.com/tos-maliva-i-68e3t9dfc1-us/4a3cefdb848f409c99b82ff356b7e1d1~tplv-68e3t9dfc1-image.image"
           alt="TikTok Lite 프로모션" loading="lazy">
    </a>

    <div class="tf-body">
      <strong class="tf-title">틱톡 라이트 리워드</strong>
      <a class="tf-cta"
         href="https://www.tiktok.com/ug/incentive/share/coin_hundred?__status_bar=true&_d=em9hgj8g7hjgdc&_pia_=1&_svg=1&aid=473824&enter_from=share_coin_hundred_dollars_no_tributed&et_campaign=coin&et_gameplay=coin_hundred_dollars_no_tributed&gd_label=click_wap_coin_hundred_dollars_no_tributed&hide_nav_bar=1&inc_pid=coin_referral_onelink_coin_hundred_dollars_no_tributed&og_image=https%3A%2F%2Fp16-ug-incentive-va.tiktokcdn.com%2Ftos-maliva-i-68e3t9dfc1-us%2F4a3cefdb848f409c99b82ff356b7e1d1~tplv-68e3t9dfc1-image.image&region=kr&share_app_id=473824&share_page_data=MIIBCAQMr8g6jFTXon0Xp3MEBIHl6%2FvU5hZvwz285NBFnz6P6bVMAHafa4DeVVO8lWwS3AxVIT7Lw7q8aDkT6gKmoyLWKe3tkWhtIHMqIEyXY24kbfigGfIhglo3DDVrKWP5K5eRTO+xRQpDYt7Y29WQEsjYeWVFedBKP9zAiwf5Tc5rcT561K6Xec71Oyges9Ashui8HjSLzOv1%2F2toojtd0dGVJujJ4ddjY2AYm31PEeFaRRI1YiIAizp6nCXT9ULPusSYOIwz6ie53d4s44%2FTdzfxsMip75GoYSCi9pBomErioE0eUJCmfqyvNCoWO4Ea+5zq5MSLigQQ6Ukb0mZ0UuLytRGlq458ZQ%3D%3D&share_time=1757426267187&sharer_biz=ug_paid_acquisition&sharer_os=ios&should_full_screen=1&u_code=NzU0Nzk0MTY3OTE1NzM0NzMyOQ%3D%3D&utm_campaign=client_share&utm_source=kakaotalk"
         target="_blank" rel="noopener noreferrer nofollow sponsored">참여하기</a>
    </div>

    <p class="tf-disclaimer">가입하시고 친추 추천 하시면 20만원을 드려요!</p>
  </div>
</section>

<script>
  // ===== 모바일 메뉴 토글 =====
  if (window.innerWidth <= 768) {
    document.querySelectorAll("#header-wrapper .menu-group > a.dropdown-toggle").forEach(function(toggleLink) {
      toggleLink.addEventListener('click', function(e) {
        e.preventDefault();
        var submenu = toggleLink.nextElementSibling;
        if (submenu) submenu.style.display = submenu.style.display === "block" ? "none" : "block";
      });
    });
  }

  // ===== 간단 쿠키 유틸 =====
  function setCookie(name,value,maxAgeSeconds){
    var cookie=encodeURIComponent(name)+"="+encodeURIComponent(value)+";path=/;SameSite=Lax";
    if(maxAgeSeconds) cookie+=";max-age="+maxAgeSeconds;
    document.cookie=cookie;
  }
  function getCookie(name){
    var m=document.cookie.match(new RegExp('(?:^|; )'+encodeURIComponent(name)+'=([^;]*)'));
    return m?decodeURIComponent(m[1]):null;
  }

  // ===== 쿠팡 정적 배너 표시 제어 =====
  (function(){
    var banner = document.getElementById("coupang-banner");
    var closeBtn = banner ? banner.querySelector(".banner-close") : null;
    var HIDE_COOKIE="hide_coupang_banner";
    var HIDE_SECONDS=60*60*2; // 2시간

    if (banner && !getCookie(HIDE_COOKIE)) {
      banner.hidden = false;
    }
    if (closeBtn) {
      closeBtn.addEventListener("click", function(){
        banner.hidden = true;
        setCookie(HIDE_COOKIE, "1", HIDE_SECONDS);
      });
    }
  })();

  // ===== TikTok 플로팅 배너 표시 제어 =====
  (function(){
    var el = document.getElementById("tiktok-float");
    if(!el) return;

    var CLOSE_COOKIE = "hide_tiktok_float";
    var COOL_SECONDS = 60*60*6; // 닫은 후 6시간 숨김

    function show(){
      if(getCookie(CLOSE_COOKIE)) return;
      el.hidden = false;
    }

    // 첫 진입 1.2초 후 노출
    if(!getCookie(CLOSE_COOKIE)){
      setTimeout(show, 1200);
    }

    // 닫기 버튼: 클릭 시 숨김 + 쿠키 기록
    var btn = el.querySelector(".tf-close");
    if(btn){
      btn.addEventListener("click", function(){
        el.hidden = true;
        setCookie(CLOSE_COOKIE, "1", COOL_SECONDS);
      });
    }

    // (옵션) 스크롤 등 상호작용 후에만 노출하고 싶다면 아래 주석 해제
    // window.addEventListener("scroll", function onScroll(){
    //   window.removeEventListener("scroll", onScroll);
    //   if(!getCookie(CLOSE_COOKIE)) show();
    // }, { once:true, passive:true });
  })();
</script>
</body>
</html>
