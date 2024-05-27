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
        <hr class="my-5">
        <?php
}
?>
    </div>
</section>