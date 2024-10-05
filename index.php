<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

$page_for_posts = get_option('page_for_posts');
$bg = get_the_post_thumbnail_url($page_for_posts, 'full');

get_header();

// Sanitize input values
$category_slug = filter_input(INPUT_POST, 'category', FILTER_UNSAFE_RAW) ?? null;
$tag_slug = filter_input(INPUT_POST, 'tag', FILTER_UNSAFE_RAW) ?? null;
$date_from = filter_input(INPUT_POST, 'dateFrom', FILTER_UNSAFE_RAW) ?? null;
$date_to = filter_input(INPUT_POST, 'dateTo', FILTER_UNSAFE_RAW) ?? null;

?>
<main id="main">
    <?php
    $post = get_post($page_for_posts);

    if ($post) {
        $content = apply_filters('the_content', $post->post_content);
        echo '<div class="mb-5">' . $content . '</div>';
    }
    ?>
    <div class="container-xl py-5">
        <div class="news">
            <?php


            // Setup the query arguments
            $args = array(
                'post_type' => 'post', // or 'any' if you want to include custom post types
                'post_status' => 'publish',
                'category_name' => $category_slug, // Use category slug
                'tag' => $tag_slug, // Use tag slug
                'date_query' => array(
                    array(
                        'after' => $date_from,
                        'before' => $date_to,
                        'inclusive' => true,
                    ),
                ),
                'posts_per_page' => -1, // -1 means all matching posts
            );

            // Create a new WP_Query instance
            $query = new WP_Query($args);

            // Check if the query returns any posts
            if ($query->have_posts()) {
                // echo '<div class="mb-4">' . $query->found_posts . ' ' . pluralise($query->found_posts, 'post') . ' found</div>';
                while ($query->have_posts()) {
                    $query->the_post();
                    $the_date = get_the_date('jS F, Y');
                    $countries = get_the_tags();
                    $cats = get_the_category();
            ?>
                    <a href="<?= get_the_permalink() ?>" class="news__card">
                        <?= get_the_post_thumbnail(get_the_ID(), 'large', array('class' => 'news__img')) ?>
                        <div>
                            <h3 class="h5 mb-2">
                                <?= get_the_title() ?>
                            </h3>
                            <div class="news__meta d-flex align-items-center fs-300">
                                <div>Posted on <?= $the_date ?></div>
                            </div>
                            <div class="news__excerpt text-grey-900 mb-2">
                                <?= wp_trim_words(get_the_content(), 40) ?>
                            </div>
                        </div>
                    </a>
            <?php
                }
            } else {
                echo 'No posts found.';
            }

            // Reset post data
            wp_reset_postdata();
            ?>
        </div>
        <?php
        // numeric_posts_nav();
        ?>
</main>
<?php

get_footer();
?>