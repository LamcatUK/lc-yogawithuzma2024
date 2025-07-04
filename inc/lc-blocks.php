<?php
function acf_blocks()
{
    if (function_exists('acf_register_block_type')) {

        // INSERT NEW BLOCKS HERE.

        acf_register_block_type(
            array(
                'name'            => 'lc_tidycal',
                'title'           => __( 'LC Tidycal' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc-tidycal.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_buttons',
                'title'           => __( 'LC Buttons' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc-buttons.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_four_cards',
                'title'           => __( 'LC Four Cards' ),
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc-four-cards.php',
                'mode'            => 'edit',
                'supports'        => array(
                    'mode'      => false,
                    'anchor'    => true,
                    'className' => true,
                    'align'     => true,
                ),
            )
        );

        acf_register_block_type(
            array(
                'name'            => 'lc_hero',
                'title'           => 'LC Hero',
                'category'        => 'layout',
                'icon'            => 'cover-image',
                'render_template' => 'page-templates/blocks/lc_hero.php',
                'mode'            => 'edit',
                'supports'        => array( 
                    'mode' => false,
                    'className' => true,
                ),
            )
        );

        acf_register_block_type(array(
            'name'				=> 'lc_text_image',
            'title'				=> __('LC Text / Image'),
            'category'			=> 'layout',
            'icon'				=> 'cover-image',
            'render_template'	=> 'page-templates/blocks/lc_text_image.php',
            'mode'	=> 'edit',
            'supports' => array('mode' => false, 'anchor' => true),
        ));
        acf_register_block_type(array(
            'name'				=> 'lc_sessions',
            'title'				=> __('LC Sessions Nav'),
            'category'			=> 'layout',
            'icon'				=> 'cover-image',
            'render_template'	=> 'page-templates/blocks/lc_sessions.php',
            'mode'	=> 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'				=> 'lc_testimonials',
            'title'				=> __('LC Testimonial Slider'),
            'category'			=> 'layout',
            'icon'				=> 'cover-image',
            'render_template'	=> 'page-templates/blocks/lc_testimonials.php',
            'mode'	=> 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'				=> 'lc_all_testimonials',
            'title'				=> __('LC All Testimonials'),
            'category'			=> 'layout',
            'icon'				=> 'cover-image',
            'render_template'	=> 'page-templates/blocks/lc_all_testimonials.php',
            'mode'	=> 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'				=> 'lc_cta',
            'title'				=> __('LC CTA'),
            'category'			=> 'layout',
            'icon'				=> 'cover-image',
            'render_template'	=> 'page-templates/blocks/lc_cta.php',
            'mode'	=> 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'				=> 'lc_contact',
            'title'				=> __('LC Contact'),
            'category'			=> 'layout',
            'icon'				=> 'cover-image',
            'render_template'	=> 'page-templates/blocks/lc_contact.php',
            'mode'	=> 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'				=> 'lc_three_col',
            'title'				=> __('LC Session Cards'),
            'category'			=> 'layout',
            'icon'				=> 'cover-image',
            'render_template'	=> 'page-templates/blocks/lc_three_col.php',
            'mode'	=> 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'				=> 'lc_button',
            'title'				=> __('LC Button'),
            'category'			=> 'layout',
            'icon'				=> 'cover-image',
            'render_template'	=> 'page-templates/blocks/lc_button.php',
            'mode'	=> 'edit',
            'supports' => array('mode' => false),
        ));
        acf_register_block_type(array(
            'name'				=> 'lc_separator',
            'title'				=> __('LC Separator'),
            'category'			=> 'layout',
            'icon'				=> 'cover-image',
            'render_template'	=> 'page-templates/blocks/lc_separator.php',
            'mode'	=> 'edit',
            'supports' => array('mode' => false, 'anchor' => true),
        ));
    }
}
add_action('acf/init', 'acf_blocks');

// Gutenburg core modifications
add_filter('register_block_type_args', 'core_image_block_type_args', 10, 3);

function core_image_block_type_args($args, $name)
{
    if ($name == 'core/paragraph') {
        $args['render_callback'] = 'modify_core_add_container';
    }
    if ($name == 'core/heading') {
        $args['render_callback'] = 'modify_core_add_container';
    }
    if ($name == 'core/list') {
        $args['render_callback'] = 'modify_core_add_container';
    }

    return $args;
}

function modify_core_add_container($attributes, $content)
{
    ob_start();
    
    // Check if this is a list block with fa-list class
    if ( isset( $attributes['className'] ) && strpos( $attributes['className'], 'fa-list' ) !== false ) {
        // Extract icon class if specified (e.g., fa-list fa-check becomes fa-check)
        $icon_class = 'fa-check'; // default icon
        if ( preg_match( '/fa-list\s+(fa-[\w-]+)/', $attributes['className'], $matches ) ) {
            $icon_class = $matches[1];
        }
        
        // Convert to FontAwesome list
        $content = convert_to_fa_list( $content, $icon_class );
    }
    
    ?>
<div class="container-xl">
    <?=$content?>
</div>
<?php
    $content = ob_get_clean();
    return $content;
}
?>
