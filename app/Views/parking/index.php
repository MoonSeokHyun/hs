<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 주차장 찾기{$pageSuffix} | 요금·위치·리뷰 정보 | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 주차장 {$currentPage}페이지 - 지역별 주차장 요금, 운영시간, 위치 및 사용자 리뷰를 확인하세요."
    : "전국 주차장 목록과 요금, 운영시간, 위치 정보를 한눈에 확인하세요. 실제 이용자 리뷰와 평점으로 신뢰할 수 있는 주차장을 찾아보세요.";
$canonicalBase = base_url('parking');
$canonical = $currentPage > 1 ? $canonicalBase . '?page=' . $currentPage : $canonicalBase;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="vTa0kwUBtDAIFY_RbTOw4p-LpneLpkhxTYAWYqNwAog" />
    <meta name="naver-site-verification" content="7a0d49f3fd680b5f4ab77f8edfd3deb13ee30f11" />
    <title><?= esc($pageTitle) ?></title>
    <meta name="description" content="<?= esc($pageDesc) ?>">
    <meta name="keywords" content="주차장, 공영주차장, 민영주차장, 주차요금, 주차장 리뷰, 주차장 위치, 편잇">
    <meta name="robots" content="<?= !empty($isSearchResult) ? 'noindex, follow' : 'index, follow' ?>">
    <link rel="canonical" href="<?= esc($canonical) ?>">
    <meta property="og:title" content="<?= esc($pageTitle) ?>">
    <meta property="og:description" content="<?= esc($pageDesc) ?>">
    <meta property="og:url" content="<?= esc($canonical) ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= base_url('img/logo.png') ?>">
    <meta name="author" content="편잇">
    <!-- 네이버맵 API 주석 처리
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
    -->
</head>
<!-- 구글 애드센스 -->
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
crossorigin="anonymous"></script><head>
    <style>
        /* 기본 초기화 */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* 컨테이너 */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5em;
        }

        /* Floating 메뉴 바 스타일 */
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

        .menu-parking { background-color: #62D491; }
        .menu-gas-stations { background-color: #28a745; }
        .menu-repair-shops { background-color: #e74c3c; }

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

        /* 섹션 스타일 */
        .section {
            margin-bottom: 40px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .section h2 {
            font-size: 1.8em;
            color: #62D491;
            margin-bottom: 15px;
        }

        /* 테이블 스타일 */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #62D491;
            color: #fff;
        }

        .clickable-row {
            cursor: pointer;
        }

        .clickable-row:hover {
            background-color: #f0f0f0;
        }

        /* Footer 스타일 */
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
            color: #62D491;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
    include APPPATH . 'Views/includes/header.php';
?>

    <div class="container">
        <!-- 주차장 검색 섹션 -->
        <div class="section">
            <h2>주차장 검색</h2>
            <form method="get" action="/parking/search">
                <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="주차장 이름 또는 주소 검색" style="width: 80%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                <button type="submit" style="padding: 10px 20px; background-color: #62D491; color: white; border: none; border-radius: 5px;">검색</button>
            </form>
        </div>

        <?php if (!empty($isSearchResult)): ?>
        <div class="section">
            <h2>검색 결과</h2>
            <?php if (!empty($noResultsMessage)): ?>
                <p><?= esc($noResultsMessage) ?></p>
            <?php elseif (!empty($parkingLots)): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>주차장명</th>
                            <th>주소</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($parkingLots as $lot): ?>
                        <tr class="clickable-row" onclick="window.location.href='/parking/detail/<?= esc($lot['id']) ?>'">
                            <td><?= esc($lot['name']) ?></td>
                            <td><?= esc($lot['address_road']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php if (!empty($pager)): ?>
            <div style="margin-top: 16px; text-align: center;">
                <?= $pager->links() ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- 최근 추가된 주차장 섹션 -->
        <div class="section">
            <h2>최근 추가된 주차장</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>주차장명</th>
                            <th>주소</th>
                            <th>추가일</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentParkingLots as $lot): ?>
                        <tr class="clickable-row" onclick="window.location.href='/parking/detail/<?= esc($lot['id']) ?>'">
                            <td><?= esc($lot['name']) ?></td>
                            <td><?= esc($lot['address_road']) ?></td>
                            <td><?= date('Y-m-d') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 인기 주차장 섹션 -->
        <div class="section">
            <h2>인기 주차장</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>주차장명</th>
                            <th>리뷰 개수</th>
                            <th>평균 별점</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($popularParkingLots as $popularLot): ?>
                        <tr class="clickable-row" onclick="window.location.href='/parking/detail/<?= esc($popularLot['id']) ?>'">
                            <td><?= esc($popularLot['name']) ?></td>
                            <td><?= esc($popularLot['review_count']) ?></td>
                            <td><?= number_format($popularLot['average_rating'], 1) ?> 점</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 최근 추가된 리뷰 섹션 -->
        <div class="section">
            <h2>최근 추가된 리뷰</h2>
            <?php foreach ($recentReviews as $review): ?>
            <div style="margin-bottom: 10px; padding: 10px; background-color: #f9f9f9; border-radius: 5px;">
                <div><strong><?= esc($review['parking_lot_name']) ?>:</strong> <span style="color: #ffa500;">★ <?= esc($review['rating']) ?>점</span></div>
                <div><?= esc($review['comment_text']) ?></div>
                <div style="font-size: 0.9em; color: #888;">작성일: <?= date('Y-m-d', strtotime($review['created_at'])) ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- 중간 광고 배치 -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-6686738239613464"
             data-ad-slot="1204098626"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>

        <!-- 구글 애드센스 광고 배너 -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-6686738239613464"
             data-ad-slot="1204098626"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>

        <!-- 푸터 -->
        <?php include APPPATH . 'Views/includes/footer.php'; ?>
    </div>

</body>
</html>
