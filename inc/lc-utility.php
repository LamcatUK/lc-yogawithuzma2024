<?php

function parse_phone($phone)
{
    $phone = preg_replace('/\s+/', '', $phone);
    $phone = preg_replace('/\(0\)/', '', $phone);
    $phone = preg_replace('/[\(\)\.]/', '', $phone);
    $phone = preg_replace('/-/', '', $phone);
    $phone = preg_replace('/^0/', '+44', $phone);
    return $phone;
}

function split_lines($content)
{
    $content = preg_replace('/<br \/>/', '<br>&nbsp;<br>', $content);
    return $content;
}

add_shortcode('contact_address', function () {
    $output = get_field('contact_address', 'options');
    return $output;
});

add_shortcode( 'contact_phone', 'contact_phone' );
function contact_phone( $atts = array() ) {
    $atts = shortcode_atts(
        array(
            'icon' => false,
        ),
        $atts
    );

    if ( get_field( 'contact_phone', 'options' ) ) {
        $phone_number = get_field( 'contact_phone', 'options' );
        $icon         = ( 'true' === $atts['icon'] ) ? '<i class="fa-solid fa-phone"></i> ' : '';
        return '<a href="tel:' . parse_phone( $phone_number ) . '">' . $icon . $phone_number . '</a>';
    }
}

add_shortcode( 'contact_email', 'contact_email' );
function contact_email( $atts = array() ) {
    $atts = shortcode_atts(
        array(
            'icon' => false,
        ),
        $atts
    );

    if ( get_field( 'contact_email', 'options' ) ) {
        $email_address = get_field( 'contact_email', 'options' );
        $icon          = ( 'true' === $atts['icon'] ) ? '<i class="fa-solid fa-envelope"></i> ' : '';
        return '<a href="mailto:' . $email_address . '">' . $icon . $email_address . '</a>';
    }
}


add_shortcode('social_in_icon', function () {
    if (get_field('linkedin_url', 'options') ?? null) {
        return '<a href="' . get_field('linkedin_url', 'options') . '" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>';
    }
    return;
});

add_shortcode('social_icons', 'social_icons');

function social_icons()
{
    
    $s = get_field('socials', 'options') ?? null;

    $output = '<div class="social_icons">';
    if ($s['linkedin_url'] ?? null) {
        $output .= '<a href="' . $s['linkedin_url'] . '" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>';
    }
    if ($s['instagram_url'] ?? null) {
        $output .= '<a href="' . $s['instagram_url'] . '" target="_blank"><i class="fa-brands fa-instagram"></i></a>';
    }
    if ($s['facebook_url'] ?? null) {
        $output .= '<a href="' . $s['facebook_url'] . '" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>';
    }
    if ($s['twitter_url'] ?? null) {
        $output .= '<a href="' . $s['twitter_url'] . '" target="_blank"><i class="fa-brands fa-twitter"></i></a>';
    }
    $output .= '</div>';

    return $output;

}

function social_icons_inline()
{
    
    $s = get_field('socials', 'options') ?? null;

    $output = '';
    if ($s['linkedin_url'] ?? null) {
        $output .= '<a href="' . $s['linkedin_url'] . '" target="_blank"><i class="fa-brands fa-linkedin-in px-2"></i></a>';
    }
    if ($s['instagram_url'] ?? null) {
        $output .= '<a href="' . $s['instagram_url'] . '" target="_blank"><i class="fa-brands fa-instagram px-2"></i></a>';
    }
    if ($s['facebook_url'] ?? null) {
        $output .= '<a href="' . $s['facebook_url'] . '" target="_blank"><i class="fa-brands fa-facebook-f px-2"></i></a>';
    }
    if ($s['twitter_url'] ?? null) {
        $output .= '<a href="' . $s['twitter_url'] . '" target="_blank"><i class="fa-brands fa-twitter px-2"></i></a>';
    }

    return $output;

}

/**
 * Grab the specified data like Thumbnail URL of a publicly embeddable video hosted on Vimeo.
 *
 * @param  str $video_id The ID of a Vimeo video.
 * @param  str $data 	  Video data to be fetched
 * @return str            The specified data
 */
function get_vimeo_data_from_id($video_id, $data)
{
    // width can be 100, 200, 295, 640, 960 or 1280
    $request = wp_remote_get('https://vimeo.com/api/oembed.json?url=https://vimeo.com/' . $video_id . '&width=960');
    
    $response = wp_remote_retrieve_body($request);
    
    $video_array = json_decode($response, true);
    
    return $video_array[$data];
}


function lc_gutenberg_admin_styles()
{
    echo '
        <style>
            /* Main column width */
            .wp-block {
                max-width: 1040px;
            }
 
            /* Width of "wide" blocks */
            .wp-block[data-align="wide"] {
                max-width: 1080px;
            }
 
            /* Width of "full-wide" blocks */
            .wp-block[data-align="full"] {
                max-width: none;
            }	
        </style>
    ';
}
add_action('admin_head', 'lc_gutenberg_admin_styles');


// disable full-screen editor view by default
if (is_admin()) {
    function lc_disable_editor_fullscreen_by_default()
    {
        $script = "jQuery( window ).load(function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } });";
        wp_add_inline_script('wp-blocks', $script);
    }
    add_action('enqueue_block_editor_assets', 'lc_disable_editor_fullscreen_by_default');
}

function get_the_top_ancestor_id()
{
    global $post;
    if ($post->post_parent) {
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        return $ancestors[0];
    } else {
        return $post->ID;
    }
}

function lc_json_encode($string)
{
    // $value = json_encode($string);
    $escapers = array("\\", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c");
    $replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b");
    $result = str_replace($escapers, $replacements, $string);
    $result = json_encode($result);
    return $result;
}

function lc_time_to_8601($string)
{
    $time = explode(':', $string);
    $output = 'PT' . $time[0] . 'H' . $time[1] . 'M' . $time[2] . 'S';
    return $output;
}


function lcdump($var)
{
    // ob_start();
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    return; // ob_get_clean();
}

function random_str(
    int $length = 64,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

function lc_social_share($id)
{
    ob_start();
    $url = get_the_permalink($id);

    ?>
<div class="text-larger text--yellow mb-5">
    <div class="h4 text-dark">Share</div>
    <a target='_blank' href='https://twitter.com/share?url=<?=$url?>'
        class="mr-2"><i class='fab fa-twitter'></i></a>
    <a target='_blank'
        href='http://www.linkedin.com/shareArticle?url=<?=$url?>'
        class="mr-2"><i class='fab fa-linkedin-in'></i></a>
    <a target='_blank'
        href='http://www.facebook.com/sharer.php?u=<?=$url?>'><i
            class='fab fa-facebook-f'></i></a>
</div>
<?php
    
    $out = ob_get_clean();
    return $out;
}


function enable_strict_transport_security_hsts_header()
{
    header('Strict-Transport-Security: max-age=31536000');
}
add_action('send_headers', 'enable_strict_transport_security_hsts_header');


function lc_list($field)
{
    ob_start();
    $field = strip_tags($field, '<br />');
    $bullets = preg_split("/\r\n|\n|\r/", $field);
    foreach ($bullets as $b) {
        if ($b == '') {
            continue;
        }
        ?>
<li><?=$b?></li>
<?php
    }
    return ob_get_clean();
}

/**
 * formatBytes
 *
 * Returns img tag with srcset.
 *
 * @param	string $size
 * @param	int    $precision
 * @return	string
 */
function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'K', 'M', 'G', 'T');

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}


/**
 * lc_featured_image
 *
 * Returns img tag with srcset.
 *
 * @param	string $id The post ID.
 * @return	string
 */
function lc_featured_image($id)
{
    $tag = get_the_post_thumbnail(
        $id,
        'full',
        array(
            'srcset' => wp_get_attachment_image_url(get_post_thumbnail_id(), 'medium') . ' 480w, ' .
                wp_get_attachment_image_url(get_post_thumbnail_id(), 'large') . ' 640w, ' .
                wp_get_attachment_image_url(get_post_thumbnail_id(), 'full') . ' 960w'
        )
    );
    return $tag;
}

// DISABLE PRE PUBLISH CHECKS
function disable_pre_publish_checks()
{
    ?>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        wp.domReady(function() {
            wp.data.dispatch('core/editor').disablePrePublishChecks();
        });
    });
</script>
<?php
}
add_action('admin_footer', 'disable_pre_publish_checks');

// REMOVE TAG AND COMMENT SUPPORT

// Disable Tags Dashboard WP
// add_action('admin_menu', 'my_remove_sub_menus');

function my_remove_sub_menus()
{
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
}
// Remove tags support from posts
function myprefix_unregister_tags()
{
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
// add_action('init', 'myprefix_unregister_tags');

add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
     
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }
 
    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
 
    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});

function remove_comments()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'remove_comments');


function estimate_reading_time_in_minutes($content = '', $words_per_minute = 300, $with_gutenberg = false, $formatted = false)
{
    // In case if content is build with gutenberg parse blocks
    if ($with_gutenberg) {
        $blocks = parse_blocks($content);
        $contentHtml = '';

        foreach ($blocks as $block) {
            $contentHtml .= render_block($block);
        }

        $content = $contentHtml;
    }
            
    // Remove HTML tags from string
    $content = wp_strip_all_tags($content);
            
    // When content is empty return 0
    if (!$content) {
        return 0;
    }
            
    // Count words containing string
    $words_count = str_word_count($content);
            
    // Calculate time for read all words and round
    $minutes = ceil($words_count / $words_per_minute);
    
    if ($formatted) {
        $minutes = '<p class="reading">Estimated reading time ' . $minutes . ' ' . pluralise($minutes, 'minute') . '</p>';
    }

    return $minutes;
}

function pluralise($quantity, $singular, $plural=null)
{
    if($quantity==1 || !strlen($singular)) {
        return $singular;
    }
    if($plural!==null) {
        return $plural;
    }

    $last_letter = strtolower($singular[strlen($singular)-1]);
    switch($last_letter) {
        case 'y':
            return substr($singular, 0, -1).'ies';
        case 's':
            return $singular.'es';
        default:
            return $singular.'s';
    }
}

/**
 * Convert a regular list to FontAwesome list format
 *
 * @param string $content The HTML content containing the list
 * @param string $icon_class The FontAwesome icon class to use (default: fa-check)
 * @return string The converted HTML with FontAwesome list structure
 */
function convert_to_fa_list( $content, $icon_class = 'fa-check' ) {
    // Replace ul class with fa-ul and remove the icon class from ul
    $content = preg_replace( '/class="wp-block-list([^"]*)"/', 'class="fa-ul$1"', $content );
    
    // Remove fa-list trigger class from the ul class attribute
    $content = preg_replace( '/class="fa-ul([^"]*)\s+fa-list([^"]*)"/', 'class="fa-ul$1$2"', $content );
    
    // Remove the icon class from the ul class attribute (e.g., remove fa-star from fa-ul fa-star)
    $content = preg_replace( '/class="fa-ul([^"]*)\s+' . preg_quote( $icon_class, '/' ) . '([^"]*)"/', 'class="fa-ul$1$2"', $content );
    
    // Clean up any double spaces in class attribute
    $content = preg_replace( '/class="([^"]*)\s+([^"]*)"/', 'class="$1 $2"', $content );
    $content = preg_replace( '/class="([^"]*)\s\s+([^"]*)"/', 'class="$1 $2"', $content );
    
    // Add fa-li icon to each list item
    $content = preg_replace( '/<li>/', '<li><span class="fa-li"><i class="fa-solid ' . $icon_class . '"></i></span>', $content );
    
    return $content;
}
?>