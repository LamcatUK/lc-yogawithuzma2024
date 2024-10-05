<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

require_once LC_THEME_DIR . '/inc/lc-utility.php';
require_once LC_THEME_DIR . '/inc/lc-blocks.php';
require_once LC_THEME_DIR . '/inc/lc-news.php';
// require_once LC_THEME_DIR . '/inc/lc-noblog.php';


// Remove unwanted SVG filter injection WP
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');


// Remove comment-reply.min.js from footer
function remove_comment_reply_header_hook()
{
    wp_deregister_script('comment-reply');
}
add_action('init', 'remove_comment_reply_header_hook');

add_action('admin_menu', 'remove_comments_menu');
function remove_comments_menu()
{
    remove_menu_page('edit-comments.php');
}

add_filter('theme_page_templates', 'child_theme_remove_page_template');
function child_theme_remove_page_template($page_templates)
{
    // unset($page_templates['page-templates/blank.php'],$page_templates['page-templates/empty.php'], $page_templates['page-templates/fullwidthpage.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php']);
    unset($page_templates['page-templates/blank.php'], $page_templates['page-templates/empty.php'], $page_templates['page-templates/left-sidebarpage.php'], $page_templates['page-templates/right-sidebarpage.php'], $page_templates['page-templates/both-sidebarspage.php']);
    return $page_templates;
}
add_action('after_setup_theme', 'remove_understrap_post_formats', 11);
function remove_understrap_post_formats()
{
    remove_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));
}

if (function_exists('acf_add_options_page')) {
    acf_add_options_page(
        array(
            'page_title'     => 'Site-Wide Settings',
            'menu_title'    => 'Site-Wide Settings',
            'menu_slug'     => 'theme-general-settings',
            'capability'    => 'edit_posts',
        )
    );
}

function widgets_init()
{
    // register_sidebar(
    //     array(
    //         'name'          => __('Footer Col 1', 'lc-yogawithuzma2024'),
    //         'id'            => 'footer-1',
    //         'description'   => __('Footer Col 1', 'lc-yogawithuzma2024'),
    //         'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
    //         'after_widget'  => '</div>',
    //     )
    // );

    register_nav_menus(array(
        'primary_nav' => __('Primary Nav', 'lc-yogawithuzma2024'),
        'footer_menu1' => __('Footer Menu 1', 'lc-yogawithuzma2024'),
        'footer_menu2' => __('Footer Menu 2', 'lc-yogawithuzma2024'),
    ));

    unregister_sidebar('hero');
    unregister_sidebar('herocanvas');
    unregister_sidebar('statichero');
    unregister_sidebar('left-sidebar');
    unregister_sidebar('right-sidebar');
    unregister_sidebar('footerfull');
    unregister_nav_menu('primary');

    add_theme_support('disable-custom-colors');
    add_theme_support(
        'editor-color-palette',
        array(
            array(
                'name'  => 'Black',
                'slug'  => 'black',
                'color' => '#0f0f0f',
            ),
            array(
                'name'  => 'White',
                'slug'  => 'white',
                'color' => '#ffffff',
            ),
            array(
                'name'  => 'Ivory',
                'slug'  => 'ivory',
                'color' => '#faf5ef'
            ),
            array(
                'name'  => 'Muted Purple',
                'slug'  => 'purple-400',
                'color' => '#95629e'
            ),
            array(
                'name'  => 'Light Muted Purple',
                'slug'  => 'purple-200',
                'color' => '#bfa1c5'
            ),
            array(
                'name'  => 'Soft Teal',
                'slug'  => 'teal-400',
                'color' => '#5199a8'
            ),
            array(
                'name'  => 'Light Soft Teal',
                'slug'  => 'teal-200',
                'color' => '#97c2cb'
            )
        )
    );
}
add_action('widgets_init', 'widgets_init', 11);


remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');


//Custom Dashboard Widget
add_action('wp_dashboard_setup', 'register_lc_dashboard_widget');
function register_lc_dashboard_widget()
{
    wp_add_dashboard_widget(
        'lc_dashboard_widget',
        'Lamcat',
        'lc_dashboard_widget_display'
    );
}

function lc_dashboard_widget_display()
{
?>
    <div style="display: flex; align-items: center; justify-content: space-around;">
        <img style="width: 50%;"
            src="<?= get_stylesheet_directory_uri() . '/img/lc-full.jpg'; ?>">
        <a class="button button-primary" target="_blank" rel="noopener nofollow noreferrer"
            href="mailto:hello@lamcat.co.uk/">Contact</a>
    </div>
    <div>
        <p><strong>Thanks for choosing Lamcat!</strong></p>
        <hr>
        <p>Got a problem with your site, or want to make some changes & need us to take a look for you?</p>
        <p>Use the link above to get in touch and we'll get back to you ASAP.</p>
    </div>
<?php
}

// CF 7 select parameters
// function get_url_param($atts)
// {
//     $value = '';
//     if (isset($_GET[$atts['name']])) {
//         $value = sanitize_text_field($_GET[$atts['name']]);
//     }
//     return $value;
// }
// add_shortcode('url_param', 'get_url_param');

/*
add_filter(
    'wpseo_breadcrumb_links',
    function ($links) {
        global $post;
        // if (is_tax('location')) {
        //     // $t = get_the_category($post->ID);
        //     $breadcrumb[] = array(
        //         'url' => '/location/',
        //         'text' => 'Locations',
        //     );

        //     array_splice($links, 1, -2, $breadcrumb);
        // }
        // if (is_singular('member')) {
        //     // $t = get_the_category($post->ID);
        //     $breadcrumb[] = array(
        //         'url' => '/member/',
        //         'text' => 'Members',
        //     );

        //     array_splice($links, 1, -2, $breadcrumb);
        // }
        return $links;
    }
);
*/

function understrap_all_excerpts_get_more_link($post_excerpt)
{
    if (is_admin() || ! get_the_ID()) {
        return $post_excerpt;
    }
    return $post_excerpt;
}

//* Remove Yoast SEO breadcrumbs from Revelanssi's search results
add_filter('the_content', 'wpdocs_remove_shortcode_from_index');
function wpdocs_remove_shortcode_from_index($content)
{
    if (is_search()) {
        $content = strip_shortcodes($content);
    }
    return $content;
}

function lc_theme_enqueue()
{
    $the_theme = wp_get_theme();
    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js', array(), null, true);
    // wp_enqueue_style('slick-styles', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css', array(), true);
    // wp_enqueue_style('slick-theme-styles', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css', array(), true);
    // wp_enqueue_script('slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js', array(), null, true);
    // wp_enqueue_style('aos-style', "https://unpkg.com/aos@2.3.1/dist/aos.css", array());
    // wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), null, true);
    // wp_enqueue_style('glightbox-stylesheet', get_stylesheet_directory_uri() . '/css/glightbox.min.css', array(), $the_theme->get('Version'));
    // wp_enqueue_script('glightbox-scripts', get_stylesheet_directory_uri() . '/js/glightbox.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'lc_theme_enqueue');


// black thumbnails - fix alpha channel
/**
 * Patch to prevent black PDF backgrounds.
 *
 * https://core.trac.wordpress.org/ticket/45982
 */
// require_once ABSPATH . 'wp-includes/class-wp-image-editor.php';
// require_once ABSPATH . 'wp-includes/class-wp-image-editor-imagick.php';

// // phpcs:ignore PSR1.Classes.ClassDeclaration.MissingNamespace
// final class ExtendedWpImageEditorImagick extends WP_Image_Editor_Imagick
// {
//     /**
//      * Add properties to the image produced by Ghostscript to prevent black PDF backgrounds.
//      *
//      * @return true|WP_error
//      */
//     // phpcs:ignore PSR1.Methods.CamelCapsMethodName.NotCamelCaps
//     protected function pdf_load_source()
//     {
//         $loaded = parent::pdf_load_source();

//         try {
//             $this->image->setImageAlphaChannel(Imagick::ALPHACHANNEL_REMOVE);
//             $this->image->setBackgroundColor('#ffffff');
//         } catch (Exception $exception) {
//             error_log($exception->getMessage());
//         }

//         return $loaded;
//     }
// }

// /**
//  * Filters the list of image editing library classes to prevent black PDF backgrounds.
//  *
//  * @param array $editors
//  * @return array
//  */
// add_filter('wp_image_editors', function (array $editors): array {
//     array_unshift($editors, ExtendedWpImageEditorImagick::class);

//     return $editors;
// });
?>