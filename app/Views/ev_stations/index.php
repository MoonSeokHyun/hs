<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- 네이버 지도 API 주석 처리 (필요 없으시면 제거) -->
    <!-- <script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script> -->
  
    <!-- 광고 스크립트 -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
<?php
$currentPage = max(1, (int)($_GET['page'] ?? 1));
$pageSuffix  = $currentPage > 1 ? " - {$currentPage}페이지" : '';
$pageTitle   = "전국 전기차 충전소 찾기{$pageSuffix} | 급속·완속 충전기 위치 | 편잇";
$pageDesc    = $currentPage > 1
    ? "전국 전기차 충전소 {$currentPage}페이지 - 지역별 급속·완속 충전기 위치, 운영시간, 충전 요금 정보를 확인하세요."
    : "전국 전기차 충전소의 위치, 충전기 유형(급속·완속), 운영시간, 이용 요금을 한눈에 확인하세요. 가까운 전기차 충전소를 지역별로 쉽게 찾아보세요.";
$canonical = $currentPage > 1 ? base_url('ev-stations') . '?page=' . $currentPage : base_url('ev-stations');
?>
    <title><?= esc($pageTitle) ?></title>
    <meta name="description" content="<?= esc($pageDesc) ?>">
    <meta name="keywords" content="전기차 충전소, 급속 충전기, 완속 충전기, EV 충전소, 전기차 충전 요금, 편잇">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= esc($canonical) ?>">
    <meta property="og:title" content="<?= esc($pageTitle) ?>">
    <meta property="og:description" content="<?= esc($pageDesc) ?>">
    <meta property="og:url" content="<?= esc($canonical) ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?= base_url('img/logo.png') ?>">

    <!-- ===================== 여기에 스타일 복사 ===================== -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .main-nav {
            background-color: #e6f7ef;
            padding: 0.7rem;
            text-align: center;
        }

        /* 제목 스타일 */
        .page-title {
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        /* 검색바 (사용 안 하시면 지우세요) */
        .search-bar {
            padding: 10px;
            margin: 20px auto;
            text-align: center;
        }

        .search-bar input {
            padding: 10px;
            font-size: 16px;
            width: 60%;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 10px;
        }

        .search-bar button {
            padding: 10px;
            font-size: 16px;
            background-color: #62D491;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #55b379;
        }

        /* 카드 그리드 */
        .card-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            padding: 20px;
            width: 80%;
            margin: 0 auto;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card h3 {
            margin: 10px 0;
            color: #333;
        }

        .card p {
            font-size: 14px;
            color: #555;
            margin: 5px 0;
        }

        /* 페이징 */
        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 16px;
            margin: 0 5px;
            background-color: #62D491;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }

        .pagination a:hover {
            background-color: #55b379;
        }

        .pagination .active {
            background-color: #4e9e68;
        }

        /* 모바일 최적화 */
        @media (max-width: 768px) {
            .page-title {
                font-size: 24px;
                margin-top: 10px;
            }

            .search-bar input {
                width: 90%;
            }

            .card-container {
                grid-template-columns: repeat(auto-fill, minmax(100%, 1fr));
            }

            .pagination a {
                padding: 6px 12px;
            }
        }
    </style>
    <!-- ====================================================== -->

</head>
<body>

<?php include APPPATH . 'Views/includes/header.php'; ?>

<?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

<h1 class="page-title">전국 전기차 충전소</h1>

<div class="card-container">
    <?php foreach ($stations as $s): ?>
    <div class="card" onclick="window.location='<?= site_url('ev-stations/' . $s['id']) ?>'">
        <h3><?= esc($s['facility_name']) ?> 🔌</h3>
        <p>주소: <?= esc($s['full_address']) ?> 🏠</p>
        <p>가용 충전기: <?= $s['available_chargers'] ?> | 사용 중: <?= $s['in_use_chargers'] ?> ⏰</p>
    </div>
    <?php endforeach; ?>
</div>

<!-- 중간 광고 배치 -->
<?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

<!-- 하단 광고 배치 -->
<?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>

<?php include APPPATH . 'Views/includes/footer.php'; ?>

</body>
</html>
