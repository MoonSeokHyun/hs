<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
     crossorigin="anonymous"></script>
    <title>편의점 이벤트 - 편잇</title>
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


        .card-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr); /* 한 줄에 4개 */
            gap: 15px;
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
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
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
            margin-bottom: 5px;
            color: #333;
        }

        .status {
            font-weight: bold;
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .status-ongoing {
            background-color: #28a745;
            color: white;
        }

        .status-ended {
            background-color: #e74c3c;
            color: white;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .pagination a {
            text-decoration: none;
            margin: 0 5px;
            padding: 5px 10px;
            border: 1px solid #ddd;
            color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .pagination a:hover {
            background-color: #007bff;
            color: white;
        }

        .pagination .active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        @media (max-width: 1024px) {
            .card-container {
                grid-template-columns: repeat(3, 1fr); /* 태블릿: 한 줄에 3개 */
            }
        }

        @media (max-width: 768px) {
            .card-container {
                grid-template-columns: repeat(2, 1fr); /* 모바일: 한 줄에 2개 */
            }
        }

        @media (max-width: 576px) {
            .card-container {
                grid-template-columns: 1fr; /* 작은 화면: 한 줄에 1개 */
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
            <a href="/recipes" class="menu-recipe">레시피</a>
            <a href="/event" class="menu-event">이벤트</a>
            <a href="/parking" class="menu-parking">카허브</a>
            <a href="/hotel" class="menu-accommodation">숙박</a>
        </div>

        <!-- 이벤트 카드 -->
        <div class="card-container">
            <?php if (!empty($allEvents)): ?>
                <?php foreach ($allEvents as $event): ?>
                    <a href="/event/<?= esc($event['id']) ?>" class="card-link">
                        <div class="card">
                            <img src="<?= esc($event['image_url']) ?>" class="card-img-top" alt="<?= esc($event['title']) ?>">
                            <div class="card-body">
                                <span class="status <?= $event['status'] === '진행중' ? 'status-ongoing' : 'status-ended' ?>">
                                    <?= $event['status'] === '진행중' ? '[진행]' : '[종료]' ?>
                                </span>
                                <h5 class="card-title"><?= esc($event['title']) ?></h5>
                                <p class="card-text">
                                    <strong>기간:</strong> <?= esc($event['event_period']) ?><br>
                                    <strong>브랜드:</strong> <?= esc($event['brand']) ?>
                                </p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>현재 이벤트가 없습니다.</p>
            <?php endif; ?>
        </div>

        <!-- 페이징 -->
        <?= $pager->links() ?>
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
