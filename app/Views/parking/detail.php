<?php
// 주소 처리 (road 우선, 없으면 land)
$address = !empty($parkingLot['address_road']) ? esc($parkingLot['address_road']) : esc($parkingLot['address_land']);

// 지역명 추출 (구, 읍, 군)
preg_match('/([\x{AC00}-\x{D7A3}]+(?:구|읍|군))/u', $address, $matches);
$district = isset($matches[0]) ? $matches[0] : '인근';

// 주차장 이름
$parkingLotName = esc($parkingLot['name']);

// 평점 평균 계산
$totalRating = array_sum(array_column($comments, 'rating'));
$averageRating = count($comments) ? round($totalRating / count($comments), 1) : 0;
?>

<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $district ?> 주차장 추천 | <?= $parkingLotName ?> - 평균 ★<?= $averageRating ?>점, 위치/요금 정보</title>
  <meta name="description" content="<?= $district; ?>에 위치한 <?= esc($parkingLot['name']); ?> 주차장의 상세 정보입니다.">
  <meta property="og:title" content="<?= $district; ?> <?= esc($parkingLot['name']); ?> 주차장 정보">
  <meta property="og:description" content="<?= $district; ?>에 위치한 <?= esc($parkingLot['name']); ?> 주차장의 상세 정보를 확인하세요.">
  <meta property="og:url" content="<?= current_url(); ?>">
  <meta name="twitter:title" content="<?= $district; ?> <?= esc($parkingLot['name']); ?> 주차장 정보">
  <meta name="twitter:description" content="<?= $district; ?>에 위치한 <?= esc($parkingLot['name']); ?> 주차장의 상세 정보를 확인하세요.">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
crossorigin="anonymous"></script>
<script src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=psp2wjl0ra"></script>
 <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    html, body { height: 100%; font-family: "Arial", sans-serif; background-color: #f7f8fa; }
    a { color: inherit; text-decoration: none; }
    table { border-collapse: collapse; border-spacing: 0; }
    :root {
      --main-color: #62D491;
      --point-color: #3eaf7c;
      --light-bg: #f7f8fa;
      --card-bg: #fff;
      --border-color: #ddd;
      --text-color: #333;
    }
    body { color: var(--text-color); }
    main { max-width: 1000px; margin: 0 auto; padding: 20px; }
    .hero-section {
      background: #fff; border-radius: 8px; padding: 2rem;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05); text-align: center;
      margin-bottom: 2rem;
    }
    .detail-card {
      background: #fff; border-left: 5px solid var(--main-color);
      border-radius: 8px; padding: 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 2rem;
    }
    .info-table { width: 100%; border: 1px solid #ddd; margin-top: 1rem; }
    .info-table th, .info-table td {
      padding: 10px; border: 1px solid #eee; font-size: 14px;
    }
    .info-table th {
      background-color: #f0f8ff; color: var(--point-color); width: 120px;
    }
    .back-button {
      display: inline-block; margin-top: 16px; padding: 10px 15px;
      background-color: var(--main-color); color: #fff; border-radius: 5px;
    }
    .back-button:hover { opacity: 0.9; }
    #map {
      width: 100%; height: 400px; margin-top: 1rem;
      border: 1px solid #007bff; border-radius: 5px;
    }
    .star { font-size: 2rem; color: #ccc; cursor: pointer; transition: color 0.3s ease; }
    .star.selected { color: gold; }
    .submit-button {
      background-color: #007bff; color: white; padding: 10px;
      border: none; border-radius: 5px; cursor: pointer;
    }
    .submit-button:hover { background-color: #0056b3; }
    .comment-form { display: flex; flex-direction: column; gap: 10px; margin-top: 10px; }
    .comment-textarea {
      width: 100%; height: 80px; padding: 10px; border: 1px solid #ccc;
      border-radius: 4px; resize: vertical; font-size: 14px;
    }
    .comment-item {
      border-bottom: 1px solid #eee; padding: 10px 0;
    }
    .comment-header {
      display: flex; justify-content: space-between; font-size: 13px; color: #555;
    }
  </style>
</head>
<body>
  <?php include APPPATH . 'Views/includes/header.php'; ?>
  <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
  <main>
    <section class="hero-section">
      <h1>📍 <?= esc($parkingLot['name']); ?> 주차장</h1>
      <p><?= esc($parkingLot['address_road']); ?> 위치의 주차장 정보를 확인해보세요.</p>
    </section>
    <section class="detail-card">
      <h3 class="section-title">주차장 기본 정보</h3>
      <table class="info-table">
        <tr><th>주차장명</th><td><?= esc($parkingLot['name']); ?></td></tr>
        <tr>
  <th>주소</th>
  <td>
    <?php
      if (!empty($parkingLot['address_road'])) {
        echo esc($parkingLot['address_road']);
      } elseif (!empty($parkingLot['address_land'])) {
        echo esc($parkingLot['address_land']);
      } else {
        echo '주소 정보 없음';
      }
    ?>
  </td>
</tr>
        <tr><th>전화번호</th><td><?= esc($parkingLot['phone_number']); ?></td></tr>
        <tr><th>총 주차 구획 수</th><td><?= esc($parkingLot['total_spots']); ?></td></tr>
        <tr><th>요금</th><td><?= esc($parkingLot['fee_information']); ?></td></tr>
        <tr><th>운영 시간</th>
          <td>
            평일: <?= substr($parkingLot['weekday_start_time'], 0, 5); ?> ~ <?= substr($parkingLot['weekday_end_time'], 0, 5); ?><br>
            토요일: <?= substr($parkingLot['saturday_start_time'], 0, 5); ?> ~ <?= substr($parkingLot['saturday_end_time'], 0, 5); ?><br>
            공휴일: <?= substr($parkingLot['holiday_start_time'], 0, 5); ?> ~ <?= substr($parkingLot['holiday_end_time'], 0, 5); ?>
          </td>
        </tr>
        <tr><th>특이사항</th><td><?= esc($parkingLot['special_notes']); ?></td></tr>
      </table>
      <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
      <a href="/parking" class="back-button">목록으로 돌아가기</a>
      <div id="map"></div>
    </section>
    <section class="detail-card">
      <h3 class="section-title">리뷰 남기기</h3>
      <form action="/parking/saveComment" method="post" class="comment-form" onsubmit="return validateForm()">
        <input type="hidden" name="parking_lot_id" value="<?= esc($parkingLot['id']); ?>">
        <div id="star-rating">
          <span>평점:</span>
          <?php for ($i = 1; $i <= 5; $i++): ?>
            <span class="star" data-value="<?= $i; ?>">&#9733;</span>
          <?php endfor; ?>
          <input type="hidden" name="rating" id="rating-value">
        </div>
        <textarea name="comment_text" class="comment-textarea" placeholder="리뷰를 등록해주세요!" required id="comment-text"></textarea>
        <button type="submit" class="submit-button">리뷰 등록</button>
      </form>
      <ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6686738239613464"
     data-ad-slot="1204098626"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
      <h3>리뷰 목록</h3>
      <?php if (empty($comments)): ?>
        <p style="font-size:14px; color:#555;">아직 리뷰가 없습니다.</p>
      <?php else: ?>
        <?php foreach ($comments as $comment): ?>
        <div class="comment-item">
          <div class="comment-header">
            <span>
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <span class="star <?= ($i <= $comment['rating']) ? 'selected' : '' ?>">&#9733;</span>
              <?php endfor; ?>
            </span>
            <span><?= date('Y-m-d H:i', strtotime($comment['created_at'])); ?></span>
          </div>
          <p><?= esc($comment['comment_text']); ?></p>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </section>
  </main>
  <script>
    document.querySelectorAll('#star-rating .star').forEach(star => {
      star.addEventListener('click', function() {
        const value = this.getAttribute('data-value');
        document.getElementById('rating-value').value = value;
        document.querySelectorAll('#star-rating .star').forEach((s, i) => {
          s.classList.toggle('selected', i < value);
        });
      });
    });
    function validateForm() {
      const rating = document.getElementById('rating-value').value;
      const comment = document.getElementById('comment-text').value.trim();
      if (!rating || !comment) {
        alert("평점과 리뷰 내용을 모두 입력해주세요.");
        return false;
      }
      return true;
    }
    var map = new naver.maps.Map('map', {
      center: new naver.maps.LatLng(<?= esc($parkingLot['latitude']); ?>, <?= esc($parkingLot['longitude']); ?>),
      zoom: 15
    });
    var marker = new naver.maps.Marker({
      position: new naver.maps.LatLng(<?= esc($parkingLot['latitude']); ?>, <?= esc($parkingLot['longitude']); ?>),
      map: map,
      title: "<?= esc($parkingLot['name']); ?>"
    });
  </script>
    <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>
  <?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
