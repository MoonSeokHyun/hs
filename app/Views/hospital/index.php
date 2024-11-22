<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="Vg6LnwCg2ciJr3emetShc4yHm1AYLLPKWrg3UdFYpDg" />
    <meta name="naver-site-verification" content="da4595e04224f83fa6c03f3136fc09f0094ef7a7" />
    <title>편의점 할인 정보는 편잇</title>

    <meta name="description" content="Ease Hub에서 인기 있는 편의시설, 최근 추가된 시설 및 최신 리뷰를 확인하세요. 서울 지역의 병원 및 편의시설 정보를 제공합니다.">
    <meta name="keywords" content="편의시설, Ease Hub 리뷰, 인기 시설, 최근 추가">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Ease Hub">

    <!-- CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
            font-size: 2.5em;
        }

        /* Floating menu bar styles */
        .menu-bar {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            gap: 15px;
            flex-wrap: wrap;
        }

        .menu-bar a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1.1em;
            font-weight: bold;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .menu-bar a:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .menu-cu { background-color: #6c757d; }
        .menu-all { background-color: #28a745; }
        .menu-gs25 { background-color: #007bff; }
        .menu-seven { background-color: #e74c3c; }
        .menu-emart { background-color: #f1c40f; color: #333; }
        .menu-cspace { background-color: #e67e22; }
        .menu-recipe { background-color: #FFA07A; } /* 살몬 핑크 */
        .menu-event { background-color: #FF4500; } /* 오렌지 레드 */


        @media (max-width: 768px) {
            .menu-bar {
                flex-wrap: wrap;
                gap: 10px;
            }

            .menu-bar a {
                font-size: 0.9em;
                padding: 8px 15px;
            }
        }

        .section {
            margin-bottom: 40px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .search-container {
            display: flex;
            gap: 20px;
        }

        .search-box {
            flex: 1;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .search-box h2 {
            font-size: 1.5em;
            color: #007bff;
            margin-bottom: 15px;
            text-align: center;
        }

        .search-form {
            text-align: center;
        }

        .search-form input[type="text"] {
            padding: 12px;
            font-size: 1.1em;
            width: calc(100% - 30px);
            border: 2px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s, box-shadow 0.3s;
            margin-bottom: 10px;
        }

        .search-form input[type="text"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }

        .search-form button {
            padding: 12px 30px;
            font-size: 1.1em;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-form button:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            padding: 20px;
            background-color: #f1f1f1;
            color: #333;
            border-top: 1px solid #ddd;
            font-size: 0.9em;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .search-container {
                flex-direction: column;
            }

            .search-box {
                padding: 15px;
            }

            .search-form input[type="text"] {
                font-size: 1em;
            }

            .search-form button {
                font-size: 1em;
                padding: 10px 20px;
            }
        }
    </style>

<style>
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .section-title {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
            color: #007bff;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
        }

        .card-link {
            flex: 1 1 calc(20% - 10px); /* PC: 한 줄에 5개 */
            text-decoration: none; /* 링크 밑줄 제거 */
            color: inherit; /* 글자 색상 유지 */
            display: block; /* 전체 클릭 가능 */
        }

        .card {
            display: flex;
            flex-direction: column;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: #fff;
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 10px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 150px; /* 이미지 높이를 고정 */
            object-fit: cover; /* 비율을 유지하면서 잘라내기 */
        }

        .card-body {
            padding: 10px;
            text-align: center;
        }

        .card-title {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .card-text {
            font-size: 0.9rem;
            color: #555;
        }

        @media (max-width: 992px) {
            .card-link {
                flex: 1 1 calc(33.33% - 10px); /* 태블릿: 한 줄에 3개 */
            }

            .card-img-top {
                height: 120px; /* 이미지 크기 조정 */
            }
        }

        @media (max-width: 768px) {
            .card-link {
                flex: 1 1 calc(50% - 10px); /* 모바일: 한 줄에 2개 */
            }

            .card-img-top {
                height: 100px;
            }
        }

        @media (max-width: 576px) {
            .card-link {
                flex: 1 1 calc(50% - 10px); /* 작은 화면: 여전히 2개 */
            }

            .card-img-top {
                height: 120px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>편의점 할인은 편잇!</h1>

        <!-- Floating menu bar -->
        <div class="menu-bar">
            <a href="/events" class="menu-all">전체</a>
            <a href="/events/cu" class="menu-cu">CU</a>
            <a href="/events/gs25" class="menu-gs25">GS25</a>
            <a href="/events/7-ELEVEn" class="menu-seven">세븐일레븐</a>
            <a href="/events/emart24" class="menu-emart">이마트24</a>
            <a href="/events/C·SPACE" class="menu-cspace">씨스페이스</a>
            <a href="/recipes" class="menu-recipe">레시피</a>
            <a href="/event" class="menu-event">이벤트</a>
        </div>

        <!-- Search sections -->
        <div class="section search-container">
            <div class="search-box">
                <h2>상품 검색</h2>
                <form class="search-form" method="get" action="/events">
                    <input type="text" name="q" placeholder="ex) 비빔밥" value="<?= esc($query ?? '') ?>">
                    <button type="submit">검색</button>
                </form>
            </div>
        </div>
    <!-- 이벤트 섹션 -->
    <div class="container mt-4">
    <h2 class="section-title">진행 중인 편의점 이벤트</h2>
    <div class="card-container">
        <?php if (!empty($events)): ?>
            <?php foreach ($events as $event): ?>
                <a href="/event/<?= esc($event['id']) ?>" class="card-link">
                    <div class="card">
                        <img src="<?= esc($event['image_url']) ?>" class="card-img-top" alt="<?= esc($event['title']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($event['title']) ?></h5>
                            <p class="card-text">
                            </p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">현재 진행 중인 이벤트가 없습니다.</p>
        <?php endif; ?>
    </div>
</div>


<!-- 최신 레시피 섹션 -->
<div class="container mt-4">
    <h2 class="section-title">편의점 레시피</h2>
    <div class="card-container">
        <?php if (!empty($recipes)): ?>
            <?php foreach ($recipes as $recipe): ?>
                <!-- 링크로 감싸기 -->
                <a href="/recipes/<?= esc($recipe['id']) ?>" class="card-link">
                    <div class="card">
                        <img src="<?= esc($recipe['image_url']) ?>" class="card-img-top" alt="<?= esc($recipe['title']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($recipe['title']) ?></h5>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">레시피가 없습니다.</p>
        <?php endif; ?>
    </div>
</div>


        <!-- Footer -->
        <div class="footer">
            본 데이터는 <a href="https://www.data.go.kr" target="_blank">www.data.go.kr</a>에서 제공한 자료를 기반으로 하였습니다.<br>
            이 웹 사이트는 영리 목적으로 만들어졌습니다.<br>
            잘못된 정보는 <a href="mailto:gjqmaoslwj@naver.com">gjqmaoslwj@naver.com</a>으로 문의해 주세요.
        </div>
    </div>
</body>
</html>
