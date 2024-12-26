<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($festival['Festival_Name']) ?> - 편잇</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
   
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
   <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin-top: 60px;
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
        .menu-recipe { background-color: #FFA07A; }
        .menu-event { background-color: #FF4500; }
        .menu-parking { background-color: #8A2BE2; }
        .menu-accommodation { background-color: #17a2b8; }
        .menu-festival { background-color: #17e2b8; }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #343a40;
        }

        p {
            font-size: 1.1rem;
            color: #495057;
        }

        strong {
            color: #007bff;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            font-size: 1rem;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        #map {
            width: 100%;
            height: 400px;
            margin-top: 20px;
        }
    </style>
</head>

<body>

<h1><?= esc($festival['Festival_Name']) ?></h1>
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

    <div class="container">
        <p><strong>기간:</strong> <?= esc($festival['Start_Date']) ?> ~ <?= esc($festival['End_Date']) ?></p>
        <p><strong>장소:</strong> <?= esc($festival['Venue']) ?></p>
        <?php if (!empty($festival['Description'])): ?>
            <p><strong>설명:</strong> <?= esc($festival['Description']) ?></p>
        <?php endif; ?>
        <?php if (!empty($festival['Organizing_Agency'])): ?>
            <p><strong>주최 기관:</strong> <?= esc($festival['Organizing_Agency']) ?></p>
        <?php endif; ?>
        <?php if (!empty($festival['Hosting_Agency'])): ?>
            <p><strong>주관 기관:</strong> <?= esc($festival['Hosting_Agency']) ?></p>
        <?php endif; ?>
        <?php if (!empty($festival['Supporting_Agency'])): ?>
            <p><strong>후원 기관:</strong> <?= esc($festival['Supporting_Agency']) ?></p>
        <?php endif; ?>
        <?php if (!empty($festival['Contact_Number'])): ?>
            <p><strong>연락처:</strong> <?= esc($festival['Contact_Number']) ?></p>
        <?php endif; ?>
        <?php if (!empty($festival['Website_URL'])): ?>
            <p><strong>웹사이트:</strong> <a href="<?= esc($festival['Website_URL']) ?>" target="_blank"><?= esc($festival['Website_URL']) ?></a></p>
        <?php endif; ?>
        <?php if (!empty($festival['Related_Information'])): ?>
            <p><strong>기타 정보:</strong> <?= esc($festival['Related_Information']) ?></p>
        <?php endif; ?>
        <p><strong>도로 주소:</strong> <?= esc($festival['Address_Road']) ?></p>
        <p><strong>지번 주소:</strong> <?= esc($festival['Address_Land']) ?></p>
        <p><strong>자료 참조일:</strong> <?= esc($festival['Data_Reference_Date']) ?></p>
        <p><strong>제공 기관 코드:</strong> <?= esc($festival['Provider_Code']) ?></p>
        <p><strong>제공 기관 이름:</strong> <?= esc($festival['Provider_Name']) ?></p>
        <div id="map"></div>
        <a href="/festival-info" class="back-link">목록으로 돌아가기</a>
    </div>

    <script>
    var latitude = <?= json_encode($festival['Latitude']) ?>;
    var longitude = <?= json_encode($festival['Longitude']) ?>;
    
    // 값이 올바르게 전달되었는지 확인
    console.log("Latitude:", latitude);
    console.log("Longitude:", longitude);

    var map = new naver.maps.Map('map', {
        center: new naver.maps.LatLng(latitude, longitude),
        zoom: 10
    });

    var marker = new naver.maps.Marker({
        position: new naver.maps.LatLng(latitude, longitude),
        map: map
    });

    var infoWindow = new naver.maps.InfoWindow({
        content: `<div style="padding:10px;min-width:200px;text-align:center;">
                    <strong><?= esc($festival['Festival_Name']) ?></strong><br>
                    <?= esc($festival['Venue']) ?>
                </div>`
    });

    naver.maps.Event.addListener(marker, "click", function() {
        infoWindow.open(map, marker);
    });
</script>

</body>

</html>
