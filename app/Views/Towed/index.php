<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="vTa0kwUBtDAIFY_RbTOw4p-LpneLpkhxTYAWYqNwAog" />
    <meta name="naver-site-verification" content="7a0d49f3fd680b5f4ab77f8edfd3deb13ee30f11" />
    <title>견인차량 보관소 목록 - 편잇</title>

    <!-- Description 및 Keywords 추가 -->
    <meta name="description" content="편잇에서 제공하는 견인차량 보관소 목록을 확인하고, 근처 보관소를 검색해보세요. 위치, 연락처, 보관 요금 등 상세 정보를 제공합니다.">
    <meta name="keywords" content="견인차 보관소, 차량 보관소, 무단방치 차량 보관소, 차량 견인, 견인차 보관소 추천, 차량 보관소 검색">
    <meta name="author" content="편잇">
    <meta name="robots" content="index, follow">

    <!-- Open Graph (SNS 공유 최적화) -->
    <meta property="og:title" content="견인차량 보관소 목록 - 편잇">
    <meta property="og:description" content="편잇에서 제공하는 견인차량 보관소 목록을 확인하고, 근처 보관소를 검색해보세요. 위치, 연락처, 보관 요금 등 상세 정보를 제공합니다.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:image" content="/static/images/og-default.jpg">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="견인차량 보관소 목록 - 편잇">
    <meta name="twitter:description" content="편잇에서 제공하는 견인차량 보관소 목록을 확인하고, 근처 보관소를 검색해보세요. 위치, 연락처, 보관 요금 등 상세 정보를 제공합니다.">
    <meta name="twitter:image" content="/static/images/og-default.jpg">

    <!-- JSON-LD 구조화 데이터 (리스트) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ListItem",
      "name": "견인차량 보관소 목록",
      "url": "<?= current_url() ?>",
      "description": "편잇에서 제공하는 견인차량 보관소 목록을 확인하고, 근처 보관소를 검색해보세요. 위치, 연락처, 보관 요금 등 상세 정보를 제공합니다.",
      "image": "/static/images/og-default.jpg"
    }
    </script>

    <link rel="stylesheet" href="/assets/css/global.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-title {
            font-size: 2em;
            color: var(--main-color, #62D491);
            text-align: center;
            margin-bottom: 20px;
        }

        .search-box {
            text-align: center;
            margin-bottom: 30px;
        }

        .search-box input {
            padding: 10px;
            width: 70%;
            max-width: 400px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .search-box button {
            padding: 10px 20px;
            margin-left: 5px;
            border: none;
            background-color: #3eaf7c;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-box button:hover {
            background-color: #62d491;
        }

        /* 카드 스타일 */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            font-size: 18px;
            color: #333;
        }

        .card p {
            font-size: 14px;
            color: #555;
        }

        .card .details-link {
            display: inline-block;
            margin-top: 10px;
            background-color: #62D491;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        .card .details-link:hover {
            background-color: #4db67d;
        }

        /* 페이징 스타일 */
        .pagination {
          text-align: center;
          margin-top: 30px;
        }

        .pagination ul {
          list-style: none;
          padding: 0;
          margin: 0;
          display: flex;
          justify-content: center;
        }

        .pagination li {
          margin: 0 5px; /* 버튼 간 간격 */
        }

        .pagination a {
          padding: 8px 16px;
          background-color: #62D491;
          color: white;
          text-decoration: none;
          border-radius: 5px;
          transition: background-color 0.3s ease;
        }

        .pagination a:hover {
          background-color: #4db67d;
        }

        .pagination .active a {
          background-color: #3eaf7c;
        }

    </style>
</head>
<body>

<?php include APPPATH . 'Views/includes/header.php'; ?>

<div class="container">
    <h1 class="page-title">견인차량 보관소</h1>

    <!-- 검색 폼 -->
    <div class="search-box">
        <form action="/towed-vehicle-storage" method="get">
            <input type="text" name="search" placeholder="보관소명 또는 주소 검색" value="<?= esc($search) ?>">
            <button type="submit">검색</button>
        </form>
    </div>

    <!-- 카드 스타일로 보관소 목록 -->
    <div class="card-container">
        <?php foreach ($storages as $storage): ?>
            <div class="card">
                <h3><?= esc($storage['towed_vehicle_storage_name']); ?></h3>
                <p>주소: <?= esc($storage['address_road_name']); ?></p>
                <a href="/towed-vehicle-storage/detail/<?= esc($storage['id']); ?>" class="details-link">상세보기</a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- 페이징 -->
    <div class="pagination">
        <?= $pager->links() ?>
    </div>

</div>

<?php include APPPATH . 'Views/includes/footer.php'; ?>

</body>
</html>
