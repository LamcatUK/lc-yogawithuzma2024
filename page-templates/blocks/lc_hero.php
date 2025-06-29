<?php
$shadow = $block['class'] ?: 'shadow-1';

?>

<section class="hero shadow-1">
    <?=wp_get_attachment_image(get_field('background'), 'full', false, array('class' => 'hero__bg')) ?? null?>
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-md-6 order-2 order-md-1 d-flex flex-column justify-content-center align-items-start">
                <h1 class="mb-3 text-purple-400">
                    <?=get_field('title')?>
                </h1>
                <?php
                if (get_field('content') ?? null) {
                    ?>
                <div class="fs-500">
                    <?=get_field('content')?>
                </div>
                <?php
                }
if (get_field('cta') ?? null) {
    $cta = get_field('cta');
    ?>
                <a class="btn btn-primary mt-4"
                    href="<?=$cta['url']?>"
                    target="<?=$cta['target']?>">
                    <?=$cta['title']?>
                </a>
                <?php
}
?>
            </div>
            <div class="col-md-6 order-1 order-md-2">
                <?php
                if (get_field('feature_images')) {
                    ?>
                <div class="hero__carousel carousel slide carousel-fade <?= $shadow ?>" data-bs-ride="carousel">
                    <?php
                    $a = 'active';
                    foreach (get_field('feature_images') as $f) {
                        ?>
                    <div class="carousel-item <?=$a?>">
                        <?=wp_get_attachment_image($f, 'full', false, array( 'class' => 'd-block w-100' ));
                        ?>
                    </div>
                    <?php
                        $a = '';
                    }
                    ?>
                </div>
                <?php
                }
?>
            </div>
        </div>
    </div>
</section>
<?php
if (!is_front_page()) {
    ?>
<section class="breadcrumbs pt-4 container-xl">
    <?php
    if (function_exists('yoast_breadcrumb')) {
        yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
    }
    ?>
</section>
<?php
}
?>