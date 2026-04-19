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
            <h1 class="hero-title">🔧 자동차 정비소 찾기</h1>
            <p class="hero-subtitle">전국 자동차 정비소 위치와 리뷰 정보를 한눈에</p>
        </div>
    </section>

    <!-- 검색 박스 -->
    <section class="search-section card mb-4">
        <div class="card-body">
            <form action="/automobile_repair_shops" method="get" class="search-form">
                <div class="search-input-group">
                    <input type="text" 
                           name="search" 
                           placeholder="정비소 이름 또는 주소 검색..." 
                           class="search-input"
                           value="<?= esc($search ?? '') ?>">
                    <button type="submit" class="btn btn-primary">검색</button>
                </div>
            </form>
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

    <!-- 최근 추가된 정비소 -->
    <?php if (!empty($recentRepairShops)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">🆕 최근 추가된 정비소</h2>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>정비소명</th>
                        <th>주소</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentRepairShops as $shop): ?>
                        <tr onclick="window.location.href='/automobile_repair_shop/<?= esc($shop['id']) ?>'" style="cursor: pointer;">
                            <td><strong><?= esc($shop['repair_shop_name'] ?? '') ?></strong></td>
                            <td><?= esc($shop['road_address'] ?? '') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php endif; ?>

    <!-- 인기 정비소 -->
    <?php if (!empty($popularRepairShops)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">⭐ 인기 정비소</h2>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>정비소명</th>
                        <th>리뷰 개수</th>
                        <th>평균 평점</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($popularRepairShops as $shop): ?>
                        <tr onclick="window.location.href='/automobile_repair_shop/<?= esc($shop['repair_shop_id'] ?? $shop['id'] ?? '') ?>'" style="cursor: pointer;">
                            <td><strong><?= esc($shop['repair_shop_name'] ?? '') ?></strong></td>
                            <td><?= number_format($shop['review_count'] ?? 0) ?>개</td>
                            <td>
                                <span class="rating-badge">
                                    <?= str_repeat('★', min(5, (int)($shop['average_rating'] ?? 0))) ?>
                                    <?= number_format($shop['average_rating'] ?? 0, 1) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php endif; ?>

    <!-- 정비소 목록 -->
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">📋 정비소 목록</h2>
        </div>
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>정비소명</th>
                        <th>정비소 종류</th>
                        <th>주소</th>
                        <th>전화번호</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($repair_shops)): ?>
                        <?php foreach ($repair_shops as $shop): ?>
                            <tr onclick="window.location.href='/automobile_repair_shop/<?= esc($shop['id']) ?>'" style="cursor: pointer;">
                                <td><strong><?= esc($shop['repair_shop_name'] ?? '') ?></strong></td>
                                <td><?= esc($shop['repair_shop_type'] ?? '') ?>급</td>
                                <td><?= esc($shop['road_address'] ?? '') ?></td>
                                <td><?= esc($shop['phone_number'] ?? '정보 없음') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">등록된 정비소가 없습니다.</td>
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

    <!-- 최근 리뷰 -->
    <?php if (!empty($recentReviews)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">💬 최근 리뷰</h2>
        </div>
        <div class="review-list">
            <?php foreach ($recentReviews as $review): ?>
                <div class="review-item" onclick="window.location.href='/automobile_repair_shop/<?= esc($review['repair_shop_id'] ?? '') ?>'" style="cursor: pointer;">
                    <div class="review-header">
                        <strong><?= esc($review['repair_shop_name'] ?? '정비소') ?></strong>
                        <span class="review-rating">
                            <?= str_repeat('★', (int)($review['rating'] ?? 0)) ?>
                            <span style="color: var(--text-secondary); font-size: 14px; margin-left: 4px;">
                                <?= number_format($review['rating'] ?? 0, 1) ?>점
                            </span>
                        </span>
                    </div>
                    <p class="review-text"><?= esc($review['comment_text'] ?? '') ?></p>
                    <small class="text-muted">작성일: <?= date('Y-m-d', strtotime($review['created_at'] ?? 'now')) ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>
</div>

<!-- 스타일은 common.css에 포함되어 있습니다 -->
