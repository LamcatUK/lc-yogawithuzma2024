<?php

$type = get_field( 'speciality' );

$term_slugs = array();

$args = array(
    'post_type'      => 'testimonial',
    'posts_per_page' => -1,
);


if ( is_array( $type ) && ! empty( $type ) ) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'speciality',
            'field'    => 'term_id',
            'terms'    => $type,
        ),
    );
}

$q = new WP_Query( $args );
?>
<section class="testimonials py-5">
    <div class="testimonials__overlay"></div>
    <div class="container-xl">
        <h2 class="text-center mb-4 text-purple-400">Testimonials</h2>
        <div class="testimonials__carousel carousel slide carousel-fade w-lg-75 mx-auto" data-bs-ride="carousel" data-bs-interval="7000">
            <div class="carousel-inner pb-4">
                <?php

                $a = 'active';

                while ($q->have_posts()) {
                    $q->the_post();
                    ?>
                <div class="carousel-item <?=$a?>">
                    <a
                        href="/testimonials/#<?= acf_slugify( get_the_title() ); ?>"
                        class="testimonials__link">
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
                    </a>
                </div>
                <?php
                    $a = '';
                }
                ?>
            </div>
        </div>
        <div class="text-center">
            <a href="/testimonials/" class="btn btn-primary">Read more</a>
        </div>
    </div>
</section>