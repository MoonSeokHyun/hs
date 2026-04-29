<?php
$recipeTitle = $recipe['title'] ?? '편의점 레시피';
$recipeDescRaw = trim((string)($recipe['description'] ?? ''));
if ($recipeDescRaw === '') {
    $ingredientsList = '';
    if (!empty($recipe['ingredients'])) {
        $ing = json_decode($recipe['ingredients'], true);
        if (is_array($ing)) {
            $ingredientsList = implode(', ', array_slice(array_map('strval', $ing), 0, 5));
        }
    }
    $recipeDescRaw = $ingredientsList !== ''
        ? "{$recipeTitle} 편의점 레시피 - 주요 재료: {$ingredientsList}. 따라 하기 쉬운 조리법과 꿀팁을 확인하세요."
        : "{$recipeTitle} 편의점 레시피 - 따라 하기 쉬운 조리법, 필요한 재료와 순서별 조리 과정을 확인하세요.";
}
$recipeDesc   = mb_substr(preg_replace('/\s+/', ' ', strip_tags($recipeDescRaw)), 0, 155);
$recipeImage  = !empty($recipe['image_url']) ? $recipe['image_url'] : base_url('img/logo.png');
$canonical    = esc(current_url());
$pageTitle    = esc("{$recipeTitle} - 편의점 레시피 | 재료·조리법 | 편잇");

$ingredients  = json_decode($recipe['ingredients'] ?? '[]', true) ?: [];
$cookingSteps = json_decode($recipe['cooking_steps'] ?? '[]', true) ?: [];
$lastStepIdx  = count($cookingSteps) - 1;
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $pageTitle ?></title>
  <meta name="description" content="<?= esc($recipeDesc) ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= $canonical ?>">
  <meta property="og:title" content="<?= $pageTitle ?>">
  <meta property="og:description" content="<?= esc($recipeDesc) ?>">
  <meta property="og:image" content="<?= esc($recipeImage) ?>">
  <meta property="og:url" content="<?= $canonical ?>">
  <meta property="og:type" content="article">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= $pageTitle ?>">
  <meta name="twitter:description" content="<?= esc($recipeDesc) ?>">
  <meta name="twitter:image" content="<?= esc($recipeImage) ?>">
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
  <link rel="preload" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard.min.css"></noscript>
  <link rel="stylesheet" href="<?= base_url('css/common.css') ?>?v=<?= filemtime(FCPATH.'css/common.css') ?>">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
  <?php if (!empty($ingredients) && !empty($cookingSteps)): ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Recipe",
    "name": "<?= esc($recipeTitle) ?>",
    "description": "<?= esc($recipeDesc) ?>",
    "image": "<?= esc($recipeImage) ?>",
    "recipeIngredient": <?= json_encode(array_map('strval', $ingredients), JSON_UNESCAPED_UNICODE) ?>,
    "recipeInstructions": [<?php foreach ($cookingSteps as $i => $step): ?><?= $i > 0 ? ',' : '' ?>{
      "@type": "HowToStep",
      "text": "<?= esc($step['text'] ?? '') ?>"
    }<?php endforeach; ?>]
  }
  </script>
  <?php endif; ?>
</head>
<body>
<?php include APPPATH . 'Views/includes/header.php'; ?>

<div class="main-content">
<div class="container" style="max-width:960px;">

  <nav class="dp-breadcrumb" aria-label="breadcrumb">
    <a href="/">홈</a><span class="sep">/</span>
    <a href="/recipes">편의점 레시피</a><span class="sep">/</span>
    <span class="current"><?= esc($recipeTitle) ?></span>
  </nav>

  <div class="detail-hero">
    <h1 class="detail-hero-title">👨‍🍳 <?= esc($recipeTitle) ?></h1>
    <?php if (!empty($recipe['description'])): ?>
    <p class="detail-hero-sub"><?= esc(mb_substr($recipe['description'], 0, 100)) ?></p>
    <?php endif; ?>
  </div>

  <?php if (!empty($recipe['image_url'])): ?>
  <div class="content-card" style="padding:0;overflow:hidden;">
    <img src="<?= esc($recipe['image_url']) ?>" alt="<?= esc($recipeTitle) ?> 완성 사진"
      loading="lazy" decoding="async"
      style="width:100%;max-height:400px;object-fit:cover;display:block;">
  </div>
  <?php endif; ?>

  <ins class="adsbygoogle ad-slot"
    style="display:block" data-ad-client="ca-pub-6686738239613464"
    data-ad-slot="1204098626" data-ad-format="auto" data-full-width-responsive="true"></ins>

  <?php if (!empty($ingredients)): ?>
  <div class="content-card">
    <h2 class="content-card-title">🛒 재료</h2>
    <div style="display:flex;flex-wrap:wrap;gap:8px;padding-top:4px;">
      <?php foreach ($ingredients as $ing): ?>
      <span class="dp-chip"><?= esc((string)$ing) ?></span>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if (!empty($cookingSteps)): ?>
  <div class="content-card">
    <h2 class="content-card-title">📋 조리 과정</h2>
    <?php foreach ($cookingSteps as $i => $step): ?>
    <div style="display:flex;gap:16px;padding:16px 0;<?= $i < $lastStepIdx ? 'border-bottom:1px solid #F3F4F6;' : '' ?>">
      <div style="flex-shrink:0;width:32px;height:32px;background:#F97316;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:900;color:#fff;">
        <?= $i + 1 ?>
      </div>
      <div style="flex:1;">
        <?php if (!empty($step['image'])): ?>
        <img src="<?= esc($step['image']) ?>" alt="Step <?= $i + 1 ?>"
          loading="lazy" decoding="async"
          style="width:100%;max-height:220px;object-fit:cover;border-radius:10px;margin-bottom:10px;">
        <?php endif; ?>
        <p style="font-size:14px;line-height:1.7;color:#374151;margin:0;"><?= esc($step['text'] ?? '') ?></p>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <ins class="adsbygoogle ad-slot"
    style="display:block" data-ad-client="ca-pub-6686738239613464"
    data-ad-slot="1204098626" data-ad-format="auto" data-full-width-responsive="true"></ins>

  <?= view('includes/section_naver_map', [
      'latitude'  => null,
      'longitude' => null,
      'title'     => $recipeTitle,
      'address'   => '',
      'mapId'     => 'recipe-map-' . (int) ($recipe['id'] ?? 0),
      'linkQuery' => $map_link_query ?? $recipeTitle,
  ]) ?>

  <?= view('includes/section_naver_blog', ['blog_posts' => $blog_posts ?? []]) ?>

  <a href="/recipes" class="back-btn">← 목록으로 돌아가기</a>

</div>
</div>

<?= view_cell('\App\Cells\ExtraInfoCell::render') ?>
<?php include APPPATH . 'Views/includes/footer.php'; ?>

<?php if (!preg_match('/^localhost(:[0-9]*)?$/', $_SERVER['HTTP_HOST'])): ?>
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
  if (!wcs_add) var wcs_add = {};
  wcs_add["wa"] = "8adec19974bed8";
  if (window.wcs) wcs_do();
</script>
<?php endif; ?>
</body>
</html>
