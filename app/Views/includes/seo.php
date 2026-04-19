<?php
/**
 * SEO 공통 Partial
 * 
 * 사용법:
 * <?= view('includes/seo', [
 *     'title' => '페이지 제목',
 *     'description' => '페이지 설명',
 *     'canonical' => 'https://example.com/page',
 *     'robots' => 'index, follow',
 *     'og' => [
 *         'title' => 'OG 제목',
 *         'description' => 'OG 설명',
 *         'image' => 'https://example.com/image.jpg',
 *         'type' => 'website'
 *     ],
 *     'jsonLd' => [
 *         '@context' => 'https://schema.org',
 *         '@type' => 'LocalBusiness',
 *         ...
 *     ]
 * ]) ?>
 */

// 기본값 설정
$title = $title ?? '편잇 - 대한민국 편의시설 통합 플랫폼';
$description = $description ?? '편잇에서 편의점 할인 정보, 자동차 관련 시설, 숙박 정보, 이벤트 등을 확인하세요.';
$canonical = $canonical ?? current_url();
$robots = $robots ?? 'index, follow';
$og = $og ?? [];
$twitter = $twitter ?? [];
$jsonLd = $jsonLd ?? null;

// OG 기본값
$ogTitle = $og['title'] ?? $title;
$ogDescription = $og['description'] ?? $description;
$ogImage = $og['image'] ?? base_url('img/logo.png');
$ogType = $og['type'] ?? 'website';
$ogUrl = $og['url'] ?? $canonical;

// Twitter 기본값
$twitterCard = $twitter['card'] ?? 'summary_large_image';
$twitterTitle = $twitter['title'] ?? $ogTitle;
$twitterDescription = $twitter['description'] ?? $ogDescription;
$twitterImage = $twitter['image'] ?? $ogImage;

// 사이트 기본 URL
$baseUrl = base_url();
$siteName = '편잇';
?>

<!-- 기본 메타 태그 -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= esc($title) ?></title>
<meta name="description" content="<?= esc($description) ?>">
<meta name="robots" content="<?= esc($robots) ?>">
<link rel="canonical" href="<?= esc($canonical) ?>">

<!-- Open Graph 메타 태그 -->
<meta property="og:type" content="<?= esc($ogType) ?>">
<meta property="og:title" content="<?= esc($ogTitle) ?>">
<meta property="og:description" content="<?= esc($ogDescription) ?>">
<meta property="og:image" content="<?= esc($ogImage) ?>">
<meta property="og:url" content="<?= esc($ogUrl) ?>">
<meta property="og:site_name" content="<?= esc($siteName) ?>">
<meta property="og:locale" content="ko_KR">

<?php if (isset($og['image_width'])): ?>
<meta property="og:image:width" content="<?= esc($og['image_width']) ?>">
<?php endif; ?>

<?php if (isset($og['image_height'])): ?>
<meta property="og:image:height" content="<?= esc($og['image_height']) ?>">
<?php endif; ?>

<!-- Twitter Card 메타 태그 -->
<meta name="twitter:card" content="<?= esc($twitterCard) ?>">
<meta name="twitter:title" content="<?= esc($twitterTitle) ?>">
<meta name="twitter:description" content="<?= esc($twitterDescription) ?>">
<meta name="twitter:image" content="<?= esc($twitterImage) ?>">

<?php if (isset($twitter['site'])): ?>
<meta name="twitter:site" content="<?= esc($twitter['site']) ?>">
<?php endif; ?>

<?php if (isset($twitter['creator'])): ?>
<meta name="twitter:creator" content="<?= esc($twitter['creator']) ?>">
<?php endif; ?>

<!-- 네이버 검색엔진 최적화 -->
<?php if (isset($jsonLd) && $jsonLd): ?>
<script type="application/ld+json">
<?= json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
<?php endif; ?>

<!-- 네이버 웹마스터 도구 -->
<?php if (!preg_match('/^localhost(:[0-9]*)?$/', $_SERVER['HTTP_HOST'])): ?>
<meta name="naver-site-verification" content="da4595e04224f83fa6c03f3136fc09f0094ef7a7" />
<?php endif; ?>

<!-- 네이버 검색 최적화: 모바일 친화적 -->
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
