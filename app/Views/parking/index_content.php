<?php
// 브레드크럼
if (isset($breadcrumb)) {
    echo view('includes/breadcrumb', ['items' => $breadcrumb]);
}
?>

<div class="container">
    <!-- 히어로 섹션 -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">🅿️ 주차장 찾기</h1>
            <p class="hero-subtitle">전국 주차장 위치와 요금 정보를 한눈에</p>
        </div>
    </section>

    <!-- 광고 -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

    <!-- 최근 추가된 주차장 -->
    <?php if (!empty($recentParkingLots)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">🆕 최근 추가된 주차장</h2>
        </div>
        <div class="card-grid">
            <?php foreach ($recentParkingLots as $lot): ?>
                <div class="info-card">
                    <a href="/parking/detail/<?= esc($lot['id']) ?>" class="card-link">
                        <div class="card-header">
                            <h3 class="card-title"><?= esc($lot['name'] ?? '주차장') ?></h3>
                        </div>
                        <div class="card-body">
                            <p class="card-address">📍 <?= esc($lot['address_road'] ?? '') ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- 인기 주차장 -->
    <?php if (!empty($popularParkingLots)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">⭐ 인기 주차장</h2>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>주차장 이름</th>
                        <th>리뷰 개수</th>
                        <th>평균 평점</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($popularParkingLots as $lot): ?>
                        <tr onclick="window.location.href='/parking/detail/<?= esc($lot['id']) ?>'" style="cursor: pointer;">
                            <td><strong><?= esc($lot['name'] ?? '') ?></strong></td>
                            <td><?= number_format($lot['review_count'] ?? 0) ?>개</td>
                            <td>
                                <span class="rating-badge">
                                    <?= str_repeat('★', min(5, (int)($lot['average_rating'] ?? 0))) ?>
                                    <?= number_format($lot['average_rating'] ?? 0, 1) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php endif; ?>

    <!-- 최근 리뷰 -->
    <?php if (!empty($recentReviews)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">💬 최근 리뷰</h2>
        </div>
        <div class="review-list">
            <?php foreach ($recentReviews as $review): ?>
                <div class="review-item">
                    <div class="review-header">
                        <strong><?= esc($review['parking_lot_name'] ?? '주차장') ?></strong>
                        <span class="review-rating">
                            <?= str_repeat('★', (int)($review['rating'] ?? 0)) ?>
                        </span>
                    </div>
                    <p class="review-text"><?= esc($review['comment_text'] ?? '') ?></p>
                    <a href="/parking/detail/<?= esc($review['parking_lot_id'] ?? '') ?>" class="review-link">
                        주차장 보기 →
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- 주차장 목록 -->
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">📋 주차장 목록</h2>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>주차장 이름</th>
                        <th>주소</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($parkingLots)): ?>
                        <?php foreach ($parkingLots as $lot): ?>
                            <tr onclick="window.location.href='/parking/detail/<?= esc($lot['id']) ?>'" style="cursor: pointer;">
                                <td><strong><?= esc($lot['name'] ?? '') ?></strong></td>
                                <td><?= esc($lot['address_road'] ?? $lot['address_land'] ?? '') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center">주차장 정보가 없습니다.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- 페이지네이션 -->
        <?php if (isset($pager)): ?>
            <div class="pagination-wrapper">
                <?= $pager->links() ?>
            </div>
        <?php endif; ?>
    </section>
</div>

<!-- 스타일은 common.css에 포함되어 있습니다 -->
