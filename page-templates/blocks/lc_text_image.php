<?php
/**
 * Text Image Block Template
 *
 * @package lc-yogawithuzma2024
 */

defined( 'ABSPATH' ) || exit;

$txtcol = 'text/image' === get_field( 'order' ) ? 'order-2 order-lg-1' : 'order-2 order-lg-2';
$imgcol = 'text/image' === get_field( 'order' ) ? 'order-1 order-lg-2' : 'order-1 order-lg-1';

$txtcolwidth = '5050' === get_field( 'split' ) ? 'col-lg-6' : 'col-lg-9';
$imgcolwidth = '5050' === get_field( 'split' ) ? 'col-lg-6' : 'col-lg-3';

$overlay_alignment = 'text/image' === get_field( 'order' ) ? 'text_image__overlay--left' : 'text_image__overlay--right';

$colour    = get_field( 'background' ) ? get_field( 'background' ) : 'white';
$title_col = 'text-purple-400';
$shadow    = 'shadow-1';

$class = $block['className'] ?? 'py-5';

switch ( $colour ) {
    case 'white':
        $content   = '';
        $title_col = 'text-purple-400';
        $shadow    = '';
        break;
    case 'teal-400':
        $content   = 'text-white';
        $title_col = 'text-white';
        break;
    case 'purple-400':
        $content   = 'text-purple-400';
        $title_col = 'text-white';
        break;
    default:
        $content   = '';
        $title_col = 'text-purple-400';
        break;
}

$img = wp_get_attachment_image(
    get_field( 'image' ),
    'full',
    false,
    array(
        'class' => 'rounded-lg w-100 shadow-1',
    )
);

if ( ! $img ) {
    $img = '<img src="' . esc_url( get_stylesheet_directory_uri() ) . '/img/placeholder-400x300.jpg" class="rounded-lg">';
}

if ( 'white' === $colour ) {
    ?>
<div class="buffer-top-sm bg-white"></div>
    <?php
}

$anchor = isset( $block['anchor'] ) ? $block['anchor'] : '';
if ( $anchor ) {
    ?>
<a id="<?= esc_attr( $anchor ); ?>" class="anchor"></a>
    <?php
}
?>

<section
    class="text_image <?= esc_attr( $shadow ); ?> <?= esc_attr( $class ); ?> bg-<?= esc_attr( $colour ); ?>">
    <?php
    $overlay = get_field( 'overlay' );
    if ( is_array( $overlay ) && ! empty( $overlay ) && 'Yes' === $overlay[0] ) {
        ?>
    <div class="text_image__overlay <?= esc_attr( $overlay_alignment ); ?>"></div>
        <?php
    }
    ?>
    <div class="container-xl">
        <?php
        if ( get_field( 'title' ) ?? null ) {
            ?>
        <div class="h2 text-center d-lg-none mb-4 <?= esc_attr( $title_col ); ?>">
            <?= esc_html( get_field( 'title' ) ); ?>
        </div>
            <?php
        }
        ?>
        <div class="row">
            <div
                class="<?= esc_attr( $txtcolwidth ); ?> d-flex flex-column justify-content-center align-items-start mb-4 <?= esc_attr( $txtcol ); ?>">
                <?php
                if ( get_field( 'title' ) ?? null ) {
                    ?>
                <h2 class="d-none d-lg-block <?= esc_attr( $title_col ); ?>">
                    <?= esc_html( get_field( 'title' ) ); ?>
                </h2>
                    <?php
                }
                ?>
                <div><?= wp_kses_post( get_field( 'content' ) ); ?></div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-center gap-4">
                    <?php
                    if ( get_field( 'link' ) ?? null ) {
                        $l = get_field( 'link' );
                        ?>
                    <a href="<?= esc_url( $l['url'] ); ?>"
                        target="<?= esc_attr( $l['target'] ); ?>"
                        class="mt-4 btn btn-primary"><?= esc_attr( $l['title'] ); ?></a>
                        <?php
                    }
                    if ( get_field( 'link_2' ) ?? null ) {
                        $l = get_field( 'link_2' );
                        ?>
                    <a href="<?= esc_url( $l['url'] ); ?>"
                        target="<?= esc_attr( $l['target'] ); ?>"
                        class="mt-4 btn btn-primary"><?= esc_attr( $l['title'] ); ?></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div
                class="<?= esc_attr( $imgcolwidth ); ?> <?= esc_attr( $imgcol ); ?> mb-4 d-flex align-items-center justify-content-center">
                <?= wp_kses_post( $img ); ?>
            </div>
        </div>
    </div>
</section>