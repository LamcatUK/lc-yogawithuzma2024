<?php
$class = $block['className'] ?? '';
$bgcolour = get_field('background') ?: 'ivory';
$colour = get_field('cta_colour') ?: 'white';
$title = 'text-purple-400';

switch ($colour) {
    case 'white':
        $content = '';
        $title = 'text-purple-400';
        break;
    case 'teal-400':
        $content = 'text-white';
        $title = 'text-white';
        break;
    case 'purple-400':
        $content = 'text-purple-400';
        $title = 'text-white';
        break;
    default:
        $content = '';
        $title = 'text-purple-400';
        break;
}

?>
<div class="buffer-top bg-<?=$bgcolour?>"></div>
<section
    class="cta pt-3 pb-5 bg-<?=$bgcolour?> <?=$class?>">
    <div class="container-xl">
        <div class="cta__card text-center shadow-1 bg-<?=$colour?>">
            <div class="cta__overlay"></div>
            <h2 class="mb-3">
                <?=get_field('title')?>
            </h2>
            <div class="fs-500 mb-2"><i class="fa-solid fa-phone"></i>
                <?=contact_phone()?>
            </div>
            <div class="fs-500"><i class="fa-solid fa-paper-plane"></i>
                <?=contact_email()?>
            </div>
        </div>
</section>
<div class="buffer-bottom bg-<?=$bgcolour?>"></div>