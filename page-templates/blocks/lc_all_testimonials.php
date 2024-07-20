<?php
$class = $block['className'] ?: 'py-5';
?>
<section class="all_testimonials <?=$class?>">
    <div class="container-xl">
        <?php
        $q = new WP_Query(array(
            'post_type' => 'testimonial',
            'posts_per_page' => -1
        ));
while ($q->have_posts()) {
    $q->the_post();
    ?>
        <a id="<?=acf_slugify(get_the_title())?>" class="anchor"></a>
        <div class="testimonials__words">
            <div class="testimonials__content">
                <?=get_the_content()?>
            </div>
            <div class="testimonials__title text-center">
                <?=get_the_title()?>
            </div>
            <div class="testimonials__loca text-center">
                <?=get_field('location', get_the_ID())?>
            </div>
        </div>
        <aside class="separator py-5">
            <div class="container-xl text-center">
                <div class="separator__left"></div>
                <img src="<?=get_stylesheet_directory_uri()?>/img/ywu-icon.svg" alt="" width=200 height=105>
                <div class="separator__right"></div>
            </div>
        </aside>
        <?php
}
?>
    </div>
</section>