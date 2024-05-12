<section class="testimonials py-5">
    <div class="testimonials__overlay"></div>
    <div class="container-xl">
        <h2 class="text-center mb-4 text-purple-400">Testimonials</h2>
        <div class="testimonials__carousel carousel slide carousel-fade w-lg-75 mx-auto" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php

            $q = new WP_Query(array(
                'post_type' => 'testimonial',
                'posts_per_page' => -1
            ));
                $a = 'active';
                while ($q->have_posts()) {
                    $q->the_post();
                    ?>
                <div class="carousel-item <?=$a?>">
                    <a
                        href="/testimonials/#<?=acf_slugify(get_the_title())?>">
                        <div class="row g-5">
                            <div class="col-md-3">
                                <?=get_the_post_thumbnail(get_the_ID(), 'full', array( 'class' => 'd-block w-100 rounded-lg testimonials__image' ))?>
                            </div>
                            <div class="col-md-9 testimonials__words">
                                <div class="testimonials__content">
                                    <?=get_the_content()?>
                                </div>
                                <div class="testimonials__title text-center text-md-end">
                                    <?=get_the_title()?>
                                </div>
                                <div class="testimonials__loca text-center text-md-end">
                                    <?=get_field('location', get_the_ID())?>
                                </div>
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