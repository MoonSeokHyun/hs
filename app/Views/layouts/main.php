<?php
/**
 * 공통 메인 레이아웃
 * 
 * 사용법:
 * <?= view('layouts/main', [
 *     'title' => '페이지 제목',
 *     'description' => '페이지 설명',
 *     'content' => view('page/content'),
 *     'seo' => [...],
 *     'jsonLd' => [...]
 * ]) ?>
 */

// 기본값 설정
$title = $title ?? '편잇 - 대한민국 편의시설 통합 플랫폼';
$description = $description ?? '편잇에서 편의점 할인 정보, 자동차 관련 시설, 숙박 정보, 이벤트 등을 확인하세요.';
$content = $content ?? '';
$seo = $seo ?? [];
$jsonLd = $jsonLd ?? $seo['jsonLd'] ?? null;

// SEO 데이터 병합
$seoData = array_merge([
    'title' => $title,
    'description' => $description,
    'canonical' => current_url(),
    'robots' => 'index, follow',
    'og' => [
        'title' => $title,
        'description' => $description,
        'url' => current_url(),
    ],
    'jsonLd' => $jsonLd,
], $seo);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <?= view('includes/seo', $seoData) ?>
    
    <!-- Pretendard 폰트 (preload + 비동기 stylesheet 전환) -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preload" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css"></noscript>
    <style>body,html{font-display:swap;}</style>
    
    <!-- 공통 CSS (배포 시점 버전 고정으로 브라우저 캐시 활용) -->
    <?php
    // 파일 변경 시에만 버전 갱신되도록 filemtime 사용 (파일 존재 시)
    $commonCssPath = FCPATH . 'css/common.css';
    $cssVer = is_file($commonCssPath) ? filemtime($commonCssPath) : '1';
    ?>
    <link rel="stylesheet" href="<?= base_url('css/common.css') ?>?v=<?= esc($cssVer) ?>">
    
    <!-- 추가 CSS (페이지별) -->
    <?php if (isset($additionalCss)): ?>
        <?php foreach ($additionalCss as $css): ?>
            <link rel="stylesheet" href="<?= base_url($css) ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- AdSense preconnect (LCP 개선) -->
    <link rel="preconnect" href="https://pagead2.googlesyndication.com" crossorigin>
    <link rel="preconnect" href="https://googleads.g.doubleclick.net" crossorigin>
    <link rel="dns-prefetch" href="https://tpc.googlesyndication.com">

    <!-- Google AdSense -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464"
     crossorigin="anonymous"></script>
</head>
<body>
    <!-- 헤더 -->
    <?= view('includes/header') ?>
    
    <!-- 메인 컨텐츠 -->
    <main class="main-content">
        <?= $content ?>
    </main>
    
    <!-- 푸터 -->
    <?= view('includes/footer') ?>
    
    <!-- 추가 JavaScript (페이지별) -->
    <?php if (isset($additionalJs)): ?>
        <?php foreach ($additionalJs as $js): ?>
            <script src="<?= base_url($js) ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- 네이버 웹마스터 도구 -->
    <?php if (!preg_match('/^localhost(:[0-9]*)?$/', $_SERVER['HTTP_HOST'])): ?>
    <script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
    <script>
        if (!wcs_add) var wcs_add = {};
        wcs_add["wa"] = "8adec19974bed8";
        if (window.wcs) wcs_do();
    </script>
    <?php endif; ?>
</body>
</html>

<style>
.main-content {
    min-height: calc(100vh - 200px);
    padding-top: 20px;
    padding-bottom: 40px;
}
</style>
