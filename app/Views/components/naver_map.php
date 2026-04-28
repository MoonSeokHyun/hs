<?php
/**
 * 네이버 지도 공통 컴포넌트
 * 
 * 사용법:
 * <?= view('components/naver_map', [
 *     'latitude' => 37.5665,
 *     'longitude' => 126.9780,
 *     'title' => '장소명',
 *     'address' => '주소',
 *     'mapId' => 'map' // 기본값: 'naver-map'
 * ]) ?>
 */

// 기본값 설정
$latitude = $latitude ?? null;
$longitude = $longitude ?? null;
$title = $title ?? '';
$address = $address ?? '';
$mapId = $mapId ?? 'naver-map';

// API 키 가져오기
$apiKeyId = getenv('NAVER_MAPS_API_KEY_ID') ?: 'c3hsihbnx3';
$apiKey = getenv('NAVER_MAPS_API_KEY') ?: 'iyBYir1BVYhy4bW5XWB1wHGfUNyOit2Pz4g413ce';
?>

<div class="naver-map-container">
    <?php if ($latitude && $longitude): ?>
        <!-- 좌표가 있는 경우: 지도 렌더링 -->
        <div id="<?= esc($mapId) ?>" class="naver-map"></div>
        
        <script type="text/javascript" src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpKeyId=<?= esc($apiKeyId) ?>"></script>
        <script>
            (function() {
                var mapId = '<?= esc($mapId) ?>';
                var latitude = <?= json_encode((float)$latitude) ?>;
                var longitude = <?= json_encode((float)$longitude) ?>;
                var title = <?= json_encode($title, JSON_UNESCAPED_UNICODE) ?>;
                var address = <?= json_encode($address, JSON_UNESCAPED_UNICODE) ?>;
                
                // 지도 초기화
                var mapOptions = {
                    center: new naver.maps.LatLng(latitude, longitude),
                    zoom: 16,
                    zoomControl: true,
                    zoomControlOptions: {
                        position: naver.maps.Position.TOP_RIGHT
                    }
                };
                
                var map = new naver.maps.Map(mapId, mapOptions);
                
                // 마커 생성
                var marker = new naver.maps.Marker({
                    position: new naver.maps.LatLng(latitude, longitude),
                    map: map,
                    title: title || address
                });
                
                // 정보창 생성
                var infoWindow = new naver.maps.InfoWindow({
                    content: '<div style="padding:10px;font-size:14px;color:#333;min-width:150px;">' +
                             '<strong style="display:block;margin-bottom:5px;">' + (title || '위치') + '</strong>' +
                             (address ? '<span style="color:#666;font-size:12px;">' + address + '</span>' : '') +
                             '</div>'
                });
                
                // 마커 클릭 시 정보창 표시
                naver.maps.Event.addListener(marker, 'click', function() {
                    if (infoWindow.getMap()) {
                        infoWindow.close();
                    } else {
                        infoWindow.open(map, marker);
                    }
                });
                
                // 지도 로드 시 정보창 자동 표시
                naver.maps.Event.addListener(map, 'idle', function() {
                    infoWindow.open(map, marker);
                });
            })();
        </script>
    <?php else: ?>
        <!-- 좌표가 없는 경우: 안내 문구 + 네이버 지도 검색 링크 -->
        <div class="naver-map-fallback">
            <div class="map-fallback-content">
                <p class="map-fallback-icon">📍</p>
                <p class="map-fallback-text">지도 정보를 불러올 수 없습니다.</p>
                <?php if ($address): ?>
                    <a href="https://map.naver.com/v5/search/<?= urlencode($address) ?>" 
                       target="_blank" 
                       class="btn btn-primary btn-map-search"
                       rel="noopener noreferrer">
                        네이버 지도에서 검색하기
                    </a>
                <?php elseif ($title): ?>
                    <a href="https://map.naver.com/v5/search/<?= urlencode($title) ?>" 
                       target="_blank" 
                       class="btn btn-primary btn-map-search"
                       rel="noopener noreferrer">
                        네이버 지도에서 검색하기
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
.naver-map-container {
    width: 100%;
    margin: 20px 0;
}

.naver-map {
    width: 100%;
    height: 400px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    border: 1px solid #e0e0e0;
}

.naver-map-fallback {
    width: 100%;
    min-height: 300px;
    background: #FBF8F3;
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
}

.map-fallback-content {
    text-align: center;
}

.map-fallback-icon {
    font-size: 48px;
    margin-bottom: 16px;
}

.map-fallback-text {
    font-size: 16px;
    color: #6f64a8;
    margin-bottom: 20px;
}

.btn-map-search {
    display: inline-block;
    padding: 12px 24px;
    background-color: #03c75a;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

.btn-map-search:hover {
    background-color: #02b350;
    color: #fff;
    text-decoration: none;
}

@media (max-width: 768px) {
    .naver-map {
        height: 300px;
    }
    
    .naver-map-fallback {
        min-height: 250px;
        padding: 30px 15px;
    }
    
    .map-fallback-icon {
        font-size: 36px;
    }
    
    .map-fallback-text {
        font-size: 14px;
    }
}
</style>
