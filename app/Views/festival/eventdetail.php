<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($event['Event_Name']) ?> - 공연 정보</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
    <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=YOUR_NCP_CLIENT_ID"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin-top: 60px;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 0 auto;
        }
        .event-img {
            max-width: 100%;
            height: auto;
            margin: 20px 0;
        }
        #map {
            width: 100%;
            height: 400px;
            margin-top: 20px;
        }
        .related-items {
            margin-top: 40px;
        }
        .related-items h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><?= esc($event['Event_Name']) ?></h1>
        <img src="<?= esc($event['image_path'] ?? 'https://via.placeholder.com/800x400') ?>" alt="이미지" class="event-img">
        <p><strong>기간:</strong> <?= esc($event['Event_Start_Date']) ?> ~ <?= esc($event['Event_End_Date']) ?></p>
        <p><strong>장소:</strong> <?= esc($event['Venue']) ?></p>
        <p><strong>설명:</strong> <?= esc($event['Description']) ?></p>
        <?php if (!empty($event['Website_URL'])): ?>
            <p><strong>웹사이트:</strong> <a href="<?= esc($event['Website_URL']) ?>" target="_blank"><?= esc($event['Website_URL']) ?></a></p>
        <?php endif; ?>
        <div id="map"></div>
        <a href="/festival-info" class="btn btn-primary mt-3">목록으로 돌아가기</a>
    </div>

    <div class="container related-items">
        <h2>관련된 공연</h2>
        <div class="row">
            <?php foreach ($relatedEvents as $related): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?= esc($related['image_path'] ?? 'https://via.placeholder.com/150') ?>" class="card-img-top" alt="관련 이미지">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($related['Event_Name']) ?></h5>
                            <p class="card-text"><?= esc($related['Venue']) ?></p>
                            <a href="/festival-info/eventdetail/<?= esc($related['id']) ?>" class="btn btn-secondary btn-sm">자세히 보기</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        var latitude = <?= json_encode($event['Latitude']) ?>;
        var longitude = <?= json_encode($event['Longitude']) ?>;

        var map = new naver.maps.Map('map', {
            center: new naver.maps.LatLng(latitude, longitude),
            zoom: 10
        });

        var marker = new naver.maps.Marker({
            position: new naver.maps.LatLng(latitude, longitude),
            map: map
        });

        var infoWindow = new naver.maps.InfoWindow({
            content: `<div style="padding:10px;"><strong><?= esc($event['Event_Name']) ?></strong></div>`
        });

        naver.maps.Event.addListener(marker, "click", function() {
            infoWindow.open(map, marker);
        });
    </script>
</body>

</html>
