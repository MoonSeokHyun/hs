<?php
/**
 * 네이버 지도 블록 (상세 페이지 공통)
 *
 * @var mixed $latitude
 * @var mixed $longitude
 * @var string $title
 * @var string $address
 * @var string $mapId   지도 div id (페이지당 고유)
 * @var string $linkQuery 네이버 지도 검색 링크용 문자열 (미지정 시 address → title 순)
 */
$lat = $latitude ?? null;
$lng = $longitude ?? null;
$mapTitle = $title ?? '';
$mapAddress = $address ?? '';
$mapId = $mapId ?? 'naver-map-detail';
$linkQ = $linkQuery ?? (trim((string) $mapAddress) !== '' ? $mapAddress : $mapTitle);
?>
<div class="content-card">
  <h2 class="content-card-title">🗺️ 위치</h2>
  <?= view('components/naver_map', [
      'latitude'  => $lat,
      'longitude' => $lng,
      'title'     => $mapTitle,
      'address'   => $mapAddress,
      'mapId'     => $mapId,
  ]) ?>
  <?php if (trim((string) $linkQ) !== ''): ?>
  <div style="margin-top:10px; text-align:right;">
    <a href="https://map.naver.com/v5/search/<?= urlencode($linkQ) ?>"
       target="_blank" rel="noopener noreferrer"
       style="font-size:13px; color:#03c75a; font-weight:700; text-decoration:none;">
      네이버 지도에서 보기 →
    </a>
  </div>
  <?php endif; ?>
</div>
