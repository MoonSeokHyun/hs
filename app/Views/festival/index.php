<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
    <title>공연 및 행사 정보 - 편잇</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background-color: #f8f9fa; color: #333; }
        .container { width: 90%; max-width: 1200px; margin: 0 auto; padding: 20px; }
        h1 { text-align: center; color: #007bff; margin-bottom: 30px; font-size: 2.5em; font-weight: 600; }
        .menu-bar { display: flex; justify-content: center; margin: 20px 0; gap: 15px; flex-wrap: wrap; }
        .menu-bar a { text-decoration: none; color: white; padding: 12px 25px; border-radius: 25px; font-size: 1.1em; font-weight: bold; transition: transform 0.3s, box-shadow 0.3s; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); }
        .menu-bar a:hover { transform: translateY(-5px); box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2); }
        .menu-all { background-color: #28a745; }
        .menu-festival { background-color: #17e2b8; }
        .card-container { display: flex; flex-wrap: wrap; justify-content: space-between; margin-bottom: 30px; }
        .card { background-color: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; flex: 0 0 calc(33.333% - 20px); margin-bottom: 20px; }
        .card:hover { transform: translateY(-10px); box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); }
        .card-img-top img { height: 200px; object-fit: cover; width: 100%; border-bottom: 2px solid #ddd; }
        .card-body { padding: 15px; background-color: #fff; }
        .card-title { font-size: 1.3em; font-weight: bold; color: #333; margin-bottom: 10px; }
        .card-text { font-size: 1em; color: #555; line-height: 1.5; margin-bottom: 10px; }
        .type-label { display: inline-block; font-size: 0.9em; font-weight: bold; color: #fff; padding: 5px 10px; border-radius: 3px; margin-bottom: 10px; }
        .status { font-weight: bold; padding: 5px 10px; border-radius: 5px; margin-top: 10px; display: inline-block; }
        .status-ongoing { background-color: #28a745; color: white; }
        .status-ended { background-color: #e74c3c; color: white; }
        .pagination { display: flex; justify-content: center; margin: 20px 0; }
        .pagination a { text-decoration: none; margin: 0 5px; padding: 8px 16px; border: 1px solid #ddd; color: #007bff; border-radius: 5px; transition: background-color 0.3s ease; }
        .pagination a:hover { background-color: #007bff; color: white; }
        .pagination .active { background-color: #007bff; color: white; border-color: #007bff; }
        @media (max-width: 768px) { .menu-bar a { font-size: 1em; padding: 10px 20px; } .card { flex: 0 0 100%; } }
        @media (min-width: 769px) and (max-width: 1024px) { .card { flex: 0 0 calc(50% - 20px); } }
    </style>
</head>
<body>
    <div class="container">
        <h1>공연 및 행사 정보</h1>

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

        <!-- 이벤트 카드 -->
        <div class="card-container">
    <?php
    function fetchPixabayImage($query) {
        $apiKey = '47860392-10aec8c46b9a9243d45daefcf';
        $query = urlencode($query);
        $url = "https://pixabay.com/api/?key=$apiKey&q=$query&image_type=photo";
        $response = file_get_contents($url);
        $data = json_decode($response, true);
        if (!empty($data['hits'][0]['webformatURL'])) {
            return $data['hits'][0]['webformatURL'];
        }
        return 'https://via.placeholder.com/300x200';
    }
    ?>

    <?php if (!empty($combinedData)): ?>
        <?php foreach ($combinedData as $item): ?>
            <?php 
                // ID와 URL 결정
                $id = $item['id'];
                $url = isset($item['Event_Name']) 
                    ? "/festival-info/eventdetail/$id" 
                    : "/festival-info/$id";
                
                // 데이터 유형에 따른 태그 결정
                $typeLabel = $item['type'] === 'event' ? '공연' : '행사';
                $typeColor = $item['type'] === 'event' ? '#007bff' : '#28a745';
            ?>
            <a href="<?= $url ?>" class="card-link">
                <div class="card">
                    <div class="card-img-top">
                        <img src="<?= fetchPixabayImage($item['Event_Name'] ?? $item['Festival_Name']) ?>" alt="<?= esc($item['Event_Name'] ?? $item['Festival_Name']) ?>">
                    </div>
                    <div class="card-body">
                        <span class="type-label" style="background-color: <?= $typeColor ?>;"><?= $typeLabel ?></span>
                        <h5 class="card-title">
                            <?= esc($item['Event_Name'] ?? $item['Festival_Name']) ?>
                        </h5>
                        <p class="card-text">
                            <strong>기간:</strong> <?= esc($item['Start_Date'] ?? $item['Event_Start_Date']) ?> ~ <?= esc($item['End_Date'] ?? $item['Event_End_Date']) ?><br>
                            <strong>장소:</strong> <?= esc($item['Venue'] ?? $item['Location']) ?><br>
                            <strong>주최 기관:</strong> <?= esc($item['Organizing_Agency']) ?><br>
                            <strong>웹사이트:</strong> <a href="<?= esc($item['Website_URL'] ?? '#') ?>" target="_blank">웹사이트 링크</a>
                        </p>
                        <span class="status <?= $item['End_Date'] ?? $item['Event_End_Date'] >= date('Y-m-d') ? 'status-ongoing' : 'status-ended' ?>">
                            <?= $item['End_Date'] ?? $item['Event_End_Date'] >= date('Y-m-d') ? '진행 중' : '종료' ?>
                        </span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    <?php else: ?>
        <p>현재 표시할 공연 및 행사가 없습니다.</p>
    <?php endif; ?>
</div>

        <!-- 페이징 -->
        <?= $pager->links() ?>
    </div>

    <?php

$hostname = $_SERVER['HTTP_HOST'];

if (!preg_match('/^localhost(:[0-9]*)?$/', $hostname)) {
    
?>

    <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
    <script type="text/javascript">
        if(!wcs_add) var wcs_add = {};
        wcs_add["wa"] = "8adec19974bed8";
        if(window.wcs) {
            wcs_do();
        }
    </script>
    <?php }
    ?>
</body>
</html>
