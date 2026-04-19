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
            <h1 class="hero-title">🏥 의료기관 찾기</h1>
            <p class="hero-subtitle">전국 의료기관 정보를 한눈에 확인하세요</p>
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

    <!-- 카테고리별 의료기관 -->
    <?php if (!empty($hospitalsByCategory)): ?>
        <?php foreach ($hospitalsByCategory as $category => $hospitals): ?>
            <section class="section-card mb-4">
                <div class="section-header">
                    <h2 class="section-title"><?= esc($category) ?></h2>
                    <a href="/hospital/search?category=<?= urlencode($category) ?>" class="section-link">
                        전체보기 →
                    </a>
                </div>
                <div class="card-grid">
                    <?php foreach (array_slice($hospitals, 0, 6) as $hospital): ?>
                        <div class="info-card">
                            <a href="/hospital/detail/<?= esc($hospital['ID']) ?>" class="card-link">
                                <div class="card-header">
                                    <h3 class="card-title"><?= esc($hospital['BusinessName'] ?? '의료기관') ?></h3>
                                    <?php if (isset($hospital['average_rating']) && $hospital['average_rating'] > 0): ?>
                                        <div class="card-rating">
                                            <span class="rating-stars">
                                                <?= str_repeat('★', min(5, (int)$hospital['average_rating'])) ?>
                                            </span>
                                            <span class="rating-value"><?= number_format($hospital['average_rating'], 1) ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="card-body">
                                    <p class="card-address">📍 <?= esc($hospital['FullAddress'] ?? '주소 정보 없음') ?></p>
                                    <?php if (isset($hospital['PhoneNumber']) && $hospital['PhoneNumber']): ?>
                                        <p class="card-phone">📞 <?= esc($hospital['PhoneNumber']) ?></p>
                                    <?php endif; ?>
                                    <?php if (isset($hospital['review_count']) && $hospital['review_count'] > 0): ?>
                                        <p class="card-reviews">리뷰 <?= number_format($hospital['review_count']) ?>개</p>
                                    <?php endif; ?>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- 인기 시설 -->
    <?php if (!empty($popularFacilities)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">⭐ 인기 의료기관</h2>
        </div>
        <div class="card-grid">
            <?php foreach ($popularFacilities as $facility): ?>
                <div class="info-card">
                    <a href="/hospital/detail/<?= esc($facility['ID']) ?>" class="card-link">
                        <div class="card-header">
                            <h3 class="card-title"><?= esc($facility['BusinessName'] ?? '의료기관') ?></h3>
                            <?php if (isset($facility['avg_rating']) && $facility['avg_rating'] > 0): ?>
                                <div class="card-rating">
                                    <span class="rating-stars"><?= str_repeat('★', min(5, (int)$facility['avg_rating'])) ?></span>
                                    <span class="rating-value"><?= number_format($facility['avg_rating'], 1) ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <p class="card-address">📍 <?= esc($facility['FullAddress'] ?? '') ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- 최근 추가된 시설 -->
    <?php if (!empty($recentlyAddedFacilities)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">🆕 최근 추가된 의료기관</h2>
        </div>
        <div class="card-grid">
            <?php foreach ($recentlyAddedFacilities as $facility): ?>
                <div class="info-card">
                    <a href="/hospital/detail/<?= esc($facility['ID']) ?>" class="card-link">
                        <div class="card-header">
                            <h3 class="card-title"><?= esc($facility['BusinessName'] ?? '의료기관') ?></h3>
                        </div>
                        <div class="card-body">
                            <p class="card-address">📍 <?= esc($facility['FullAddress'] ?? '') ?></p>
                            <?php if (isset($facility['PermitDate'])): ?>
                                <p class="card-date">등록일: <?= esc($facility['PermitDate']) ?></p>
                            <?php endif; ?>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- 진행 중인 이벤트 -->
    <?php if (!empty($events)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">🎉 진행 중인 편의점 이벤트</h2>
            <a href="/events" class="section-link">전체보기 →</a>
        </div>
        <div class="card-slider">
            <?php foreach (array_slice($events, 0, 6) as $event): ?>
                <div class="event-card">
                    <a href="/event/<?= esc($event['id']) ?>" class="card-link">
                        <?php if (isset($event['image_url'])): ?>
                            <div class="card-image">
                                <img src="<?= esc($event['image_url']) ?>" alt="<?= esc($event['title']) ?>" loading="lazy">
                            </div>
                        <?php endif; ?>
                        <div class="card-header">
                            <h3 class="card-title"><?= esc($event['title'] ?? '이벤트') ?></h3>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- 최신 레시피 -->
    <?php if (!empty($recipes)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">🍜 편의점 레시피</h2>
            <a href="/recipes" class="section-link">전체보기 →</a>
        </div>
        <div class="card-slider">
            <?php foreach ($recipes as $recipe): ?>
                <div class="recipe-card">
                    <a href="/recipes/<?= esc($recipe['id']) ?>" class="card-link">
                        <?php if (isset($recipe['image_url'])): ?>
                            <div class="card-image">
                                <img src="<?= esc($recipe['image_url']) ?>" alt="<?= esc($recipe['title']) ?>" loading="lazy">
                            </div>
                        <?php endif; ?>
                        <div class="card-header">
                            <h3 class="card-title"><?= esc($recipe['title'] ?? '레시피') ?></h3>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- 최근 리뷰 -->
    <?php if (!empty($latestReviews)): ?>
    <section class="section-card mb-4">
        <div class="section-header">
            <h2 class="section-title">💬 최근 리뷰</h2>
        </div>
        <div class="review-list">
            <?php foreach ($latestReviews as $review): ?>
                <div class="review-item">
                    <div class="review-header">
                        <strong><?= esc($review['user_name'] ?? '익명') ?></strong>
                        <span class="review-rating">
                            <?= str_repeat('★', (int)($review['rating'] ?? 0)) ?>
                        </span>
                    </div>
                    <p class="review-text"><?= esc($review['comment'] ?? '') ?></p>
                    <a href="/hospital/detail/<?= esc($review['hospital_id'] ?? '') ?>" class="review-link">
                        의료기관 보기 →
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>
</div>

<!-- 스타일은 common.css에 포함되어 있습니다 -->
