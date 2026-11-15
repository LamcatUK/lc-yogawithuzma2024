<?php
$l = get_field('link');
$class = $block['className'] ?? 'py-5';

// A new/empty button block returns '' or false, so $l['url'] would be a fatal TypeError on PHP 8.
if (! is_array($l) || empty($l['url'])) {
    return;
}
?>
<section class="button <?=esc_attr($class)?>">
    <div class="container-xl text-center">
        <a href="<?=esc_url($l['url'])?>"
            target="<?=esc_attr($l['target'] ?? '')?>"
            class="btn btn-primary"><?=esc_html($l['title'] ?? '')?></a>
    </div>
</section>
