<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
     crossorigin="anonymous"></script>
    <title>레시피 목록 - 편잇</title>
    <link rel="stylesheet" href="/css/style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
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
            margin: 20px 0 40px;
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
        .menu-parking { background-color: #8A2BE2; } /* 오렌지 레드 */
        .menu-accommodation { background-color: #17a2b8; }
        .menu-festival { background-color: #17e2b8; }
        /* Card styles */
        .card-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3개 배치 */
            gap: 20px;
        }

        .card {
            display: flex;
            flex-direction: column;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: #fff;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .card-body {
            padding: 10px;
            text-align: center;
        }

        .card-title {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* 최대 2줄로 제한 */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-text {
            font-size: 0.9rem;
            color: #555;
        }

        /* Pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .pagination a {
            text-decoration: none;
            color: #007bff;
            margin: 0 5px;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .pagination a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .pagination .active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        /* Responsive styles */
        @media (max-width: 992px) {
            .card-container {
                grid-template-columns: repeat(2, 1fr); /* 태블릿: 2개 배치 */
            }
        }

        @media (max-width: 576px) {
            .card-container {
                grid-template-columns: 1fr; /* 작은 화면: 1개 배치 */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>편의점 레시피</h1>

        <!-- Floating menu bar -->
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

        <div class="card-container">
            <?php if (!empty($recipes)): ?>
                <?php foreach ($recipes as $recipe): ?>
                    <a href="/recipes/<?= esc($recipe['id']) ?>" class="card-link">
                        <div class="card">
                            <img src="<?= esc($recipe['image_url']) ?>" class="card-img-top" alt="<?= esc($recipe['title']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= esc($recipe['title']) ?></h5>
                                <p class="card-text">
                                    <strong>작성자:</strong> <?= esc($recipe['author']) ?><br>
                                    <strong>조회수:</strong> <?= esc($recipe['views']) ?>
                                </p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>레시피가 없습니다.</p>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?= $pager->links() ?>
        </div>
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
