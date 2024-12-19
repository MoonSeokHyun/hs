<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="Vg6LnwCg2ciJr3emetShc4yHm1AYLLPKWrg3UdFYpDg" />
    <meta name="naver-site-verification" content="da4595e04224f83fa6c03f3136fc09f0094ef7a7" />
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
    crossorigin="anonymous"></script>
    <title>호텔 검색 - 호텔허브</title>

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
            color: #007bff;
            margin-bottom: 20px;
            font-size: 2.5em;
        }

        .menu-bar {
            display: flex;
            justify-content: center;
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
        }

        .menu-bar a:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }

        .menu-all { background-color: #28a745; } /* 초록색 */
        .menu-cu { background-color: #6c757d; } /* 회색 */
        .menu-gs25 { background-color: #007bff; } /* 파란색 */
        .menu-seven { background-color: #e74c3c; } /* 빨간색 */
        .menu-emart { background-color: #f1c40f; color: #333; } /* 노란색 */
        .menu-recipe { background-color: #FFA07A; } /* 살몬 핑크 */
        .menu-event { background-color: #FF4500; } /* 오렌지 레드 */
        .menu-parking { background-color: #8A2BE2; } /* 보라색 */
        .menu-accommodation { background-color: #17a2b8; } /* 청록색 */

        .search-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .search-container input {
            padding: 10px;
            width: 80%;
            max-width: 500px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .search-container button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .pagination {
            text-align: center;
            margin: 20px 0;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #0056b3;
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
                <input type="text" name="query" placeholder="호텔 이름, 서비스 이름, 주소로 검색" value="<?= esc($query ?? '') ?>">
                <button type="submit">검색</button>
            </form>
        </div>

        <?php if (!empty($hotels)) : ?>
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
        <?php else : ?>
        <p>검색 결과가 없습니다.</p>
        <?php endif; ?>

        <div class="pagination">
            <?= $pager->links(); ?>
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
