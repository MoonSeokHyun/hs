<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="Vg6LnwCg2ciJr3emetShc4yHm1AYLLPKWrg3UdFYpDg" />
    <meta name="naver-site-verification" content="da4595e04224f83fa6c03f3136fc09f0094ef7a7" />
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
    crossorigin="anonymous"></script>
    <title>호텔 리스트 - 호텔허브</title>

    <style>
        body {
            font-family: Arial, sans-serif;
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
            margin-top: 20px;
            color: #007bff;
            font-size: 2.5em;
        }

        .menu-bar {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin: 20px 0;
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
        .menu-recipe { background-color: #FFA07A; }
        .menu-event { background-color: #FF4500; }
        .menu-parking { background-color: #8A2BE2; }
        .menu-accommodation { background-color: #17a2b8; }

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

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 15px;
            text-decoration: none;
            color: #007bff;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .search-container {
            text-align: center;
            margin: 20px 0;
        }

        .search-container input {
            width: 60%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        .search-container button {
            padding: 10px 20px;
            margin-left: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #0056b3;
        }

        .recent-hotels {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            margin-top: 20px;
        }

        .hotel-card {
            flex: 0 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            width: 200px;
            text-align: center;
        }

        .hotel-card h3 {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .hotel-card p {
            font-size: 0.9em;
            color: #555;
        }

        @media (max-width: 768px) {
            .hotel-card {
                width: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>호텔허브</h1>

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

        <div class="search-container">
            <form action="/hotel/search" method="get">
                <input type="text" name="query" placeholder="호텔 또는 모텔 이름으로 검색">
                <button type="submit">검색</button>
            </form>
        </div>

        <h2>최근에 추가된 숙박업소</h2>
        <div class="recent-hotels">
            <?php foreach ($recentHotels as $hotel): ?>
            <div class="hotel-card">
                <h3><?= esc($hotel['business_name']) ?></h3>
                <p><?= esc($hotel['site_full_address']) ?></p>
                <p>추가일: <?= date('Y-m-d') ?></p>
            </div>
            <?php endforeach; ?>
        </div>


        <table>
            <thead>
                <tr>
                    <th>번호</th>
                    <th>서비스 이름</th>
                    <th>업소 이름</th>
                    <th>인허가 날짜</th>
                    <th>주소</th>
                    <th>연락처</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($hotels)) : ?>
                    <?php foreach ($hotels as $hotel) : ?>
                        <tr data-href="/hotel/detail/<?= esc($hotel['id']) ?>">
                            <td><?= esc($hotel['id']) ?></td>
                            <td><?= esc($hotel['service_name']) ?></td>
                            <td><?= esc($hotel['business_name']) ?></td>
                            <td><?= esc($hotel['license_date']) ?></td>
                            <td><?= esc($hotel['site_full_address']) ?></td>
                            <td>
                                <?php 
                                    $contact = $hotel['contact_number']; 
                                    $formattedContact = preg_replace('/^(\d{2,3})(\d{3,4})(\d{4})$/', '$1-$2-$3', $contact); 
                                ?>
                                <?= esc($formattedContact) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">데이터가 없습니다.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="pagination">
            <?= $pager->links() ?>
        </div>
    </div>
</body>
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
if(!wcs_add) var wcs_add = {};
wcs_add["wa"] = "8adec19974bed8";
if(window.wcs) {
  wcs_do();
}
</script>
</html>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('tr[data-href]');
            rows.forEach(row => {
                row.addEventListener('click', function() {
                    window.location = this.dataset.href;
                });
            });
        });
    </script>
