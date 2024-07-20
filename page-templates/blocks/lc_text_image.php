<?php
$txtcol = get_field('order') == 'text/image' ? 'order-2 order-lg-1' : 'order-2 order-lg-2';
$imgcol = get_field('order') == 'text/image' ? 'order-1 order-lg-2' : 'order-1 order-lg-1';

$txtcolwidth = get_field('split') == '5050' ? 'col-lg-6' : 'col-lg-9';
$imgcolwidth = get_field('split') == '5050' ? 'col-lg-6' : 'col-lg-3';

$overlay_alignment = get_field('order') == 'text/image' ? 'text_image__overlay--left' : 'text_image__overlay--right';

$colour = get_field('background') ?: 'white';
$title = 'text-purple-400';
$shadow = 'shadow-1';

$class = $block['className'] ?? 'py-5';

switch ($colour) {
    case 'white':
        $content = '';
        $title = 'text-purple-400';
        $shadow = '';
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

$img = wp_get_attachment_image(get_field('image'), 'full', false, array('class' => 'rounded-lg w-100 shadow-1')) ?: '<img src="' . get_stylesheet_directory_uri() . '/img/placeholder-400x300.jpg" class="rounded-lg">';

if ($colour == 'white') {
    ?>
<div class="buffer-top-sm bg-white"></div>
<?php
}

$anchor = isset($block['anchor']) ? $block['anchor'] : '';
if ($anchor) {
    ?>
<a id="<?=$anchor?>" class="anchor"></a>
<?php
}
?>

<section
    class="text_image <?=$shadow?> <?=$class?> bg-<?=$colour?>">
    <?php
    $overlay = get_field('overlay');
if (is_array($overlay) && !empty($overlay) && $overlay[0] == 'Yes') {
    ?>
    <div class="text_image__overlay <?=$overlay_alignment?>"></div>
    <?php
}
?>
    <div class="container-xl">
        <?php
        if (get_field('title') ?? null) {
            ?>
        <div class="h2 text-center d-lg-none mb-4 <?=$title?>">
            <?=get_field('title')?>
        </div>
        <?php
        }
?>
        <div class="row">
            <div
                class="<?=$txtcolwidth?> d-flex flex-column justify-content-center align-items-start mb-4 <?=$txtcol?>">
                <?php
    if (get_field('title') ?? null) {
        ?>
                <h2 class="d-none d-lg-block <?=$title?>">
                    <?=get_field('title')?>
                </h2>
                <?php
    }
?>
                <div><?=the_field('content')?>
                </div>
                <?php
if (get_field('link') ?? null) {
    $l = get_field('link');
    ?>
                <a href="<?=$l['url']?>"
                    target="<?=$l['target']?>"
                    class="mt-4 btn btn-primary mx-auto"><?=$l['title']?></a>
                <?php
}
?>
            </div>
            <div
                class="<?=$imgcolwidth?> <?=$imgcol?> mb-4 d-flex align-items-center justify-content-center">
                <?=$img?>
            </div>
        </div>
    </div>
</section>