<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="Vg6LnwCg2ciJr3emetShc4yHm1AYLLPKWrg3UdFYpDg" />
    <meta name="naver-site-verification" content="da4595e04224f83fa6c03f3136fc09f0094ef7a7" />
    <title>Ease Hub - 편의시설 정보</title>

    <meta name="description" content="Ease Hub에서 인기 있는 편의시설, 최근 추가된 시설 및 최신 리뷰를 확인하세요. 서울 지역의 병원 및 편의시설 정보를 제공합니다.">
    <meta name="keywords" content=" 편의시설, Ease Hub 리뷰, 인기 시설, 최근 추가">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Ease Hub">

    <!-- CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f9fc;
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
            margin-bottom: 30px;
            font-size: 2em;
        }

        /* Floating menu bar styles */
        .menu-bar {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            gap: 15px;
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

        .menu-cu { background-color: #2c3e50; }
        .menu-gs25 { background-color: #007bff; }
        .menu-seven { background-color: #e74c3c; }
        .menu-emart { background-color: #f1c40f; color: #333; }
        .menu-cspace { background-color: #e67e22; }

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
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            text-align: center;
            font-size: 1.5em;
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            background-color: #007bff;
            color: white;
            font-size: 0.9em;
            border-radius: 8px;
        }

        .footer a {
            color: #ffcc00;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>편의점 할인 정보는 편잇</h1>

        <!-- Floating menu bar -->
        <div class="menu-bar">
            <a href="/cu" class="menu-cu">CU</a>
            <a href="/gs25" class="menu-gs25">GS25</a>
            <a href="/seveneleven" class="menu-seven">세븐일레븐</a>
            <a href="/emart24" class="menu-emart">이마트24</a>
            <a href="/cspace" class="menu-cspace">씨스페이스</a>
        </div>

        <div class="section">
            <h2>편의시설 검색 (주소 혹은 상호명)</h2>
            <form class="search-form" method="get" action="/hospital/search">
                <input type="text" name="query" placeholder="편의시설 이름을 입력하세요" value="<?= esc($searchQuery ?? '') ?>">
                <button type="submit">검색</button>
            </form>
            <?php if (!empty($searchResults)): ?>
                <div>
                    <h3>검색 결과</h3>
                    <?php foreach ($searchResults as $result): ?>
                        <div class="search-item" onclick="navigateTo('/hospital/detail/<?= esc($result['ID']); ?>')">
                            <h3><?= esc($result['BusinessName']); ?></h3>
                            <p>주소: <?= esc($result['FullAddress']); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php elseif (isset($searchQuery)): ?>
                <p>검색 결과가 없습니다.</p>
            <?php endif; ?>
        </div>

        <div class="footer">
            본 데이터는 <a href="https://www.data.go.kr" target="_blank">www.data.go.kr</a>에서 제공한 자료를 기반으로 하였습니다.<br>
            이 웹 사이트는 영리 목적으로 만들어졌습니다.<br>
            잘못된 정보는 <a href="mailto:gjqmaoslwj@naver.com">gjqmaoslwj@naver.com</a>으로 문의해 주세요.
        </div>
    </div>
    <script>
        function navigateTo(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>
