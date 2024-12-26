<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
     crossorigin="anonymous"></script>
    <title><?= esc($recipe['title']) ?> - 편의점 레시피</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
            font-size: 2.5em;
        }

        /* 완성 사진 스타일 */
        .recipe-image {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        /* 메뉴 스타일 */
        .menu-bar {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .menu-bar a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 1.1em;
            font-weight: bold;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .menu-cu { background-color: #6c757d; }
        .menu-all { background-color: #28a745; }
        .menu-gs25 { background-color: #007bff; }
        .menu-seven { background-color: #e74c3c; }
        .menu-emart { background-color: #f1c40f; color: #333; }
        .menu-cspace { background-color: #e67e22; }
        .menu-recipe { background-color: #FFA07A; } /* 살몬 핑크 */
        .menu-event { background-color: #FF4500; } /* 오렌지 레드 */
        .menu-parking { background-color: #8A2BE2; } /* 오렌지 레드 */
        .menu-accommodation { background-color: #17a2b8; }
        .menu-festival { background-color: #17e2b8; }

        .menu-bar a:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        /* 재료 스타일 */
        .ingredients {
            margin-bottom: 30px;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .ingredients h2 {
            font-size: 1.8em;
            color: #007bff;
            margin-bottom: 10px;
        }

        .ingredients ul {
            list-style: none;
            padding: 0;
        }

        .ingredients li {
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
            font-size: 1em;
            color: #555;
        }

        .ingredients li:last-child {
            border-bottom: none;
        }

        /* 조리 과정 스타일 */
        .cooking-steps {
            margin-bottom: 30px;
        }

        .cooking-steps h2 {
            font-size: 1.8em;
            color: #007bff;
            margin-bottom: 10px;
        }

        .step {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        .step img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
        }

        .step-content {
            flex: 1;
        }

        .step-num {
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .step-desc {
            font-size: 1em;
            line-height: 1.5;
            color: #555;
        }

        /* 모바일 대응 */
        @media (max-width: 576px) {
            .step {
                flex-direction: column;
                text-align: center;
            }

            .step img {
                width: 100%;
                height: auto;
            }
        }

        /* 뒤로가기 버튼 */
        .back-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            text-align: center;
            font-size: 1em;
            font-weight: bold;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- 제목 -->
        <h1><?= esc($recipe['title']) ?></h1>

        <!-- 메뉴바 -->
        <div class="menu-bar">
            <a href="/events" class="menu-all">전체</a>
            <a href="/events/cu" class="menu-cu">CU</a>
            <a href="/events/gs25" class="menu-gs25">GS25</a>
            <a href="/events/7-ELEVEn" class="menu-seven">세븐일레븐</a>
            <a href="/events/emart24" class="menu-emart">이마트24</a>
            <a href="/recipes" class="menu-recipe">레시피</a>
            <a href="/event" class="menu-event">이벤트</a>
            <a href="/parking" class="menu-parking">카허브</a>
            <a href="/hotel" class="menu-accommodation">숙박</a>
            <a href="/festival-info" class="menu-festival">행사/공연</a>
        </div>

        <!-- 완성 사진 -->
        <img src="<?= esc($recipe['image_url']) ?>" alt="완성 사진" class="recipe-image">


        <!-- 재료 섹션 -->
        <div class="ingredients">
            <h2>재료</h2>
            <ul>
                <?php foreach (json_decode($recipe['ingredients']) as $ingredient): ?>
                    <li><?= esc($ingredient) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- 조리 과정 -->
        <div class="cooking-steps">
            <h2>조리 과정</h2>
            <?php foreach (json_decode($recipe['cooking_steps'], true) as $index => $step): ?>
                <div class="step">
                    <img src="<?= esc($step['image']) ?>" alt="Step <?= $index + 1 ?>">
                    <div class="step-content">
                        <div class="step-num">STEP <?= $index + 1 ?></div>
                        <div class="step-desc"><?= esc($step['text']) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- 뒤로가기 버튼 -->
        <a href="/recipes" class="back-button">목록으로 돌아가기</a>
    </div>
    <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
if(!wcs_add) var wcs_add = {};
wcs_add["wa"] = "8adec19974bed8";
if(window.wcs) {
  wcs_do();
}
</script>
</body>
</html>
