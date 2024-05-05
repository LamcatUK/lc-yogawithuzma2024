<div class="buffer-top bg-ivory"></div>
<section class="sessions bg-ivory py-5">
    <div class="container-xl">
        <h2 class="text-center text-purple-400 mb-4">Sessions with Uzma</h2>
        <div class="row g-5">
            <?php
            while (have_rows('sessions')) {
                the_row();
                $l = get_sub_field('link');
                ?>
            <div class="col-md-6 col-xl-3">
                <a class="sessions__card shadow-1"
                    href="<?=$l['url']?>">
                    <?=wp_get_attachment_image(get_sub_field('image'), 'full', false, array( 'class' => 'sessions__image w-100' ));?>
                    <div class="sessions__title shadow-1">
                        <?=$l['title']?>
                    </div>
                </a>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>