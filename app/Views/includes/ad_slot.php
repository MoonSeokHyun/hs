<?php
/**
 * 공통 광고 슬롯 컴포넌트
 *
 * 사용법:
 *   <?= view('includes/ad_slot', ['slot' => '1204098626', 'variant' => 'inline']) ?>
 *
 * 파라미터:
 *   - slot    : data-ad-slot 값(필수). 역할별로 분리된 슬롯 ID를 권장.
 *   - variant : 'default' | 'inline' | 'sidebar' | 'footer' (레이아웃 예약 높이 차이)
 *   - format  : data-ad-format (기본 auto)
 *   - client  : 기본 'ca-pub-6686738239613464'
 */
$slot    = $slot    ?? '1204098626';
$variant = $variant ?? 'default';
$format  = $format  ?? 'auto';
$client  = $client  ?? 'ca-pub-6686738239613464';
$variantClass = in_array($variant, ['inline', 'sidebar', 'footer'], true)
    ? "ad-slot-box--{$variant}"
    : '';
?>
<div class="ad-slot-box <?= esc($variantClass) ?>" data-ad-wrapper="1">
  <ins class="adsbygoogle ad-slot"
       style="display:block"
       data-ad-client="<?= esc($client) ?>"
       data-ad-slot="<?= esc($slot) ?>"
       data-ad-format="<?= esc($format) ?>"
       data-full-width-responsive="true"></ins>
</div>
