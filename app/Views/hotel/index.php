<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
    <title>호텔 리스트 - 호텔허브</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
        .menu-parking { background-color: #8A2BE2; } /* 오렌지 레드 */
        .menu-accommodation { background-color: #17a2b8; }
        .menu-festival { background-color: #17e2b8; }

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
        main {
            padding: 30px;
        }

        .search-bar {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-bar input[type="text"] {
            width: 300px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        .search-bar button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #0056b3;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .hotel-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .hotel-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .hotel-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .hotel-card-content {
            padding: 15px;
            text-align: center;
        }

        .hotel-card h3 {
            font-size: 1.4em;
            margin-bottom: 10px;
            color: #007bff;
        }

        .hotel-card p {
            font-size: 1em;
            margin: 5px 0;
            color: #555;
        }

        .hotel-card a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .hotel-card a:hover {
            background-color: #0056b3;
        }

        .recent-hotels {
            margin-top: 30px;
        }

        .recent-hotels h2 {
            font-size: 1.5em;
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }

        .recent-hotels ul {
            list-style: none;
            padding: 0;
        }

        .recent-hotels li {
            margin-bottom: 10px;
            padding: 10px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }

        .recent-hotels li:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .recent-hotels a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.2s;
        }

        .recent-hotels a:hover {
            color: #007bff;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
        <h1>호텔허브</h1>
    <nav class="menu-bar">
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
        
    </nav>


    <main>
    <div class="search-bar">
            <form action="/hotel" method="get">
                <input type="text" name="query" placeholder="검색어를 입력하세요" value="<?= esc($query ?? '') ?>">
                <button type="submit">검색</button>
            </form>
        </div>

    <div class="recent-hotels">
            <h2>최근 추가된 호텔</h2>
            <ul>
                <?php foreach ($recentHotels as $recent): ?>
                    <li>
                        <a href="/hotel/detail/<?= esc($recent['id']) ?>">
                            <?= esc($recent['business_name']) ?> (<?= esc($recent['site_full_address']) ?>)
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <h2>호텔 리스트</h2>
        <div class="card-container">
            <?php foreach ($hotels as $hotel): ?>
                <div class="hotel-card">
                    <img src="<?= esc($hotel['map_image_url']) ?>" alt="호텔 이미지">
                    <div class="hotel-card-content">
                        <h3><?= esc($hotel['business_name']) ?></h3>
                        <p><?= esc($hotel['site_full_address']) ?></p>
                        <p>연락처: <?= esc($hotel['contact_number'] ?? '정보 없음') ?></p>
                        <a href="/hotel/detail/<?= esc($hotel['id']) ?>">자세히 보기</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="pagination">
            <?= $pager->links() ?>
        </div>


    </main>
</body>
</html>
