<!-- 네이버 지도 -->
 <head>

</head>
<!-- 헤더 시작 -->
<div id="header-wrapper">
  <!-- 사이트 타이틀 -->
  <header>
    <h1>편잇</h1>
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

<!-- 스타일 -->
<style>
  #header-wrapper header {
    background-color: #62D491;
    color: white;
    padding: 1.5rem 1rem;
    text-align: center;
  }

  #header-wrapper header h1 {
    font-size: 29px;
    margin-bottom: 4px;
  }

  #header-wrapper header p {
    font-size: 16px;
    margin-top: 4px;
  }

  #header-wrapper .main-nav {
    background-color: #e6f7ef;
    padding: 0.7rem;
    text-align: center;
    position: relative;
    z-index: 9999;
  }

  #header-wrapper .top-menu {
    list-style: none;
    display: flex;
    gap: 2rem;
    justify-content: center;
    margin: 0;
    padding: 0;
    position: relative;
    flex-wrap: wrap;
  }

  #header-wrapper .top-menu > li {
    position: relative;
  }

  #header-wrapper .top-menu > li > a {
    text-decoration: none;
    color: #3eaf7c;
    font-weight: bold;
    font-size: 16px;
    padding: 10px 15px;
    border-radius: 8px;
    transition: background-color 0.3s ease, transform 0.3s ease;
  }

  #header-wrapper .top-menu > li > a:hover {
    background-color: #3eaf7c;
    color: white;
    transform: translateY(-2px);
  }

  .sub-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 0.5rem 0;
    min-width: 180px;
    list-style: none;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    z-index: 10000;
  }

  .menu-group:hover .sub-menu {
    display: block;
  }

  .sub-menu li a {
    display: block;
    padding: 8px 16px;
    color: #3eaf7c;
    font-size: 14px;
    text-decoration: none;
  }

  .sub-menu li a:hover {
    background-color: #f0fdf8;
  }

  @media (max-width: 768px) {
    #header-wrapper .top-menu {
      flex-direction: row;
      flex-wrap: wrap;
      justify-content: center;
      gap: 1rem;
    }

    #header-wrapper .top-menu > li {
      width: auto;
    }

    #header-wrapper .top-menu > li > a {
      padding: 10px 15px;
    }

    .sub-menu {
      position: absolute;
      top: 100%;
      left: 0;
    }

    .menu-group:hover .sub-menu {
      display: block;
    }

    .sub-menu li a {
      font-size: 14px;
    }
  }
      /* 모든 광고(ins) 태그 가운데 정렬 */
      .adsbygoogle {
      display: block;
      text-align: center;
      margin: 0 auto;
    }
</style>

<!-- 모바일 드롭다운 토글 스크립트 -->
<script>
  if (window.innerWidth <= 768) {
    document.querySelectorAll("#header-wrapper .menu-group > a.dropdown-toggle").forEach(function(toggleLink) {
      toggleLink.addEventListener('click', function(e) {
        e.preventDefault();
        var submenu = toggleLink.nextElementSibling;
        if (submenu) {
          submenu.style.display = submenu.style.display === "block" ? "none" : "block";
        }
      });
    });
  }
</script>
