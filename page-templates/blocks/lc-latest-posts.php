<?php
/**
 * Block template for LC Latest Posts.
 *
 * @package lc-yogawithuzma2024
 */

defined('ABSPATH') || exit;

$q = new WP_Query(array(
    'posts_per_page' => 5,
    'ignore_sticky_posts' => true,
));
?>
<section class="latest_posts">
    <div class="container-xl">
        <div class="latest_posts__swiper swiper">
            <div class="swiper-wrapper">
                <?php
                while ($q->have_posts()) {
                    $q->the_post();
                    $img = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
                    ?>
                    <div class="swiper-slide">
                        <a href="<?= get_the_permalink() ?>" class="latest_posts__card">
                            <?php if ($img) { ?>
                                <div class="latest_posts__image-wrap">
                                    <img src="<?= esc_url($img) ?>" alt="<?= esc_attr(get_the_title()) ?>" class="latest_posts__image" loading="lazy">
                                </div>
                            <?php } ?>
                            <div class="latest_posts__body">
                                <div class="latest_posts__date"><?= get_the_date('j M Y') ?></div>
                                <h3 class="latest_posts__title"><?= get_the_title() ?></h3>
                            </div>
                        </a>
                    </div>
                    <?php
                }
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const swiperEl = document.querySelector('.latest_posts__swiper');
    if (swiperEl) {
        new Swiper(swiperEl, {
            slidesPerView: 1,
            spaceBetween: 16,
            breakpoints: {
                768: { slidesPerView: 2 },
                992: { slidesPerView: 3 }
            }
        });
    }
});
</script>
