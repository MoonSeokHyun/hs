<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
     crossorigin="anonymous"></script>
    <title><?= esc($recipe['title']) ?> - 편의점 레시피</title>

        <style>
    /* 기본 초기화 */
    * {
      margin: 0; padding: 0; box-sizing: border-box;
    }
    html, body {
      height: 100%;
      font-family: "Arial", sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      background-color: #f7f8fa;
    }
    a {
      color: inherit;
      text-decoration: none;
    }
    ul, ol, li { list-style: none; }
    table { border-collapse: collapse; border-spacing: 0; }

    :root {
      --main-color: #62D491;
      --point-color: #3eaf7c;
      --light-bg: #f7f8fa;
      --card-bg: #fff;
      --border-color: #ddd;
      --text-color: #333;
      --secondary-text: #666;
    }

    body {
      margin: 0;
      color: var(--text-color);
    }

    /* 전체 섹션 레이아웃 */
    main {
      width: 100%;
      max-width: 1000px;
      margin: 0 auto;
      padding: 20px 16px;
    }

    /* (1) Hero Section */
    .hero-section {
      background: #fff;
      border-radius: 8px;
      padding: 2rem;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
      text-align: center;
      margin-bottom: 2rem;
    }
    .hero-section h2 {
      font-size: 24px;
      margin-bottom: 1rem;
    }
    .hero-section p {
      font-size: 16px;
      color: #555;
      line-height: 1.6;
    }

    /* (2) 정비소 상세 Section */
    .detail-section {
      margin-bottom: 2rem;
    }
    .detail-card {
      background: #fff;
      border-left: 5px solid var(--main-color);
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
      margin-bottom: 1.5rem;
    }
    .detail-header {
      margin-bottom: 16px;
    }
    .facility-name {
      font-size: 22px;
      font-weight: bold;
      color: #333;
    }
    .facility-type {
      font-size: 16px;
      color: #555;
      margin: 5px 0;
    }
    .sub-info {
      font-size: 14px;
      color: #777;
      margin-bottom: 10px;
    }
    .section-title {
      font-size: 18px;
      color: var(--main-color);
      margin-bottom: 12px;
    }
    .info-table {
      width: 100%;
      border: 1px solid #ddd;
      margin-top: 12px;
    }
    .info-table th,
    .info-table td {
      padding: 10px;
      border: 1px solid #eee;
      font-size: 14px;
      vertical-align: top;
    }
    .info-table th {
      background-color: #f0f8ff;
      color: var(--point-color);
      width: 120px;
    }

    .back-button {
      display: inline-block;
      margin-top: 12px;
      padding: 10px 15px;
      background-color: var(--main-color);
      color: #fff;
      border-radius: 5px;
      text-decoration: none;
    }
    .back-button:hover {
      opacity: 0.9;
    }

    /* 지도 */
    #map {
      width: 100%;
      height: 400px;
      margin-top: 1rem;
      border: 1px solid #007bff;
      border-radius: 5px;
    }

    /* (3) 주변 정비소 섹션 */
    .nearby-section {
      margin-bottom: 2rem;
    }
    .nearby-table {
      width: 100%;
      margin-top: 12px;
      border: 1px solid #ddd;
    }
    .nearby-table th,
    .nearby-table td {
      padding: 10px;
      border: 1px solid #eee;
      font-size: 14px;
    }
    .nearby-table th {
      background-color: #e6f7ff;
      color: var(--point-color);
    }
    .nearby-table tr:hover {
      background-color: #fafafa;
      cursor: pointer;
    }

    /* (4) 리뷰 섹션 */
    .review-section {
      margin-bottom: 2rem;
    }
    .review-box {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 16px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .review-box h2 {
      font-size: 18px;
      color: var(--main-color);
      margin-bottom: 12px;
    }
    .comment-form {
      margin-bottom: 20px;
    }
    .rating-label {
      margin-right: 8px;
      font-size: 14px;
    }
    .star {
      font-size: 1.2rem;
      color: #ccc;
      cursor: pointer;
      margin-right: 2px;
    }
    .star.selected {
      color: gold;
    }
    .comment-textarea {
      width: 100%;
      min-height: 70px;
      margin-top: 8px;
      margin-bottom: 8px;
      padding: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
      border-radius: 5px;
      resize: vertical;
    }
    .submit-button {
      background-color: var(--main-color);
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 10px 15px;
      font-size: 14px;
      cursor: pointer;
    }
    .submit-button:hover {
      opacity: 0.9;
    }
    .review-box h3 {
      font-size: 16px;
      color: #333;
      margin-top: 20px;
      margin-bottom: 10px;
    }
    .comment-item {
      border-bottom: 1px solid #eee;
      padding: 8px 0;
    }
    .comment-header {
      display: flex;
      justify-content: space-between;
      margin-bottom: 6px;
    }
    .comment-date {
      font-size: 12px;
      color: #999;
    }
    .comment-text {
      font-size: 14px;
      color: #444;
    }

    /* (6) 광고 배너 (예시) */
    .ad-banner {
      display: block;
      margin: 20px auto;
      text-align: center;
    }

    /* ▼ 모바일 최적화: 화면이 600px 이하일 때 */
    @media (max-width: 600px) {
      /* ★ 헤더/푸터 관련 부분 제거 (header h1 등) ★ */
      .facility-name {
        font-size: 20px;
      }
      .facility-type {
        font-size: 14px;
      }
      .info-table th,
      .info-table td {
        font-size: 13px;
        padding: 8px;
      }
      .nearby-table th,
      .nearby-table td {
        font-size: 13px;
        padding: 8px;
      }
      .comment-textarea {
        font-size: 13px;
      }
      .menu-bar a {
        margin: 0 5px;
      }
    }

    /* ★ (5) 푸터 섹션 CSS 모두 제거됨 ★ */

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

    <div class="container">
        <!-- 제목 -->
        <h1><?= esc($recipe['title']) ?></h1>

        <!-- 완성 사진 -->
        <img src="<?= esc($recipe['image_url']) ?>" alt="완성 사진" class="recipe-image">


        <!-- 재료 섹션 -->
        <div class="ingredients">
            <h2>재료</h2>
            <ul>
                <?php foreach (json_decode($recipe['ingredients']) as $ingredient): ?>
                    <li><?= esc($ingredient) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- 조리 과정 -->
        <div class="cooking-steps">
            <h2>조리 과정</h2>
            <?php foreach (json_decode($recipe['cooking_steps'], true) as $index => $step): ?>
                <div class="step">
                    <img src="<?= esc($step['image']) ?>" alt="Step <?= $index + 1 ?>">
                    <div class="step-content">
                        <div class="step-num">STEP <?= $index + 1 ?></div>
                        <div class="step-desc"><?= esc($step['text']) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- 뒤로가기 버튼 -->
        <a href="/recipes" class="back-button">목록으로 돌아가기</a>
    </div>
    <?= view_cell('\App\Cells\ExtraInfoCell::render') ?>
    <?php include APPPATH . 'Views/includes/footer.php'; ?>
</body>
</html>
