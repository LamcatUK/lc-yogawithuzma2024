<?php
/* SESSIONS NAV */
?>
<div class="buffer-top bg-ivory"></div>
<section class="sessions bg-ivory py-5">
    <div class="container-xl">
        <h2 class="text-center text-purple-400 mb-4">Yoga Sessions with Uzma</h2>
        <div class="row mb-4">
            <?php
            while (have_rows('sessions')) {
                the_row();
                $l = get_sub_field('link');
                $imgID = get_sub_field('image') ?? null;
                if ($imgID) {
                    $img = wp_get_attachment_image($imgID, 'full', false, array( 'class' => 'sessions__image' ));
                } else {
                    $img =  '<img src="' . get_stylesheet_directory_uri() . '/img/placeholder-400x300.jpg" class="sessions__image">';
                }
                ?>
            <div class="col-md-6 col-xl-3 mb-4">
                <a class="sessions__card shadow-1"
                    href="<?=$l['url']?>">
                    <?=$img?>
                    <div class="sessions__title shadow-1">
                        <?=$l['title']?>
                    </div>
                </a>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="text-center">
            <a href="/yoga-classes/" target="" class="btn btn-primary">All Yoga Sessions</a>
        </div>
    </div>
</section>