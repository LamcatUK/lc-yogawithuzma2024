<?php
/**
 * Block template for LC Tidycal.
 *
 * @package lc-yogawithuzma2024
 */

defined( 'ABSPATH' ) || exit;

$class = $block['className'] ?? '';
$bgcolour = get_field('background') ?: 'ivory';
$colour = get_field('cta_colour') ?: 'white';
$title = 'text-purple-400';

switch ($colour) {
    case 'white':
        $content = '';
        $title = 'text-purple-400';
        break;
    case 'teal-400':
        $content = 'text-white';
        $title = 'text-white';
        break;
    case 'purple-400':
        $content = 'text-purple-400';
        $title = 'text-white';
        break;
    default:
        $content = '';
        $title = 'text-purple-400';
        break;
}

$uq = random_str(4);
?>
<div class="buffer-top bg-<?=$bgcolour?>"></div>
<section
    class="cta pt-3 pb-5 bg-<?=$bgcolour?> <?=$class?>">
    <div class="container-xl">
        <div class="cta__card text-center shadow-1 bg-<?=$colour?>">
            <div class="cta__overlay"></div>
            <h2 class="mb-3">
                <?=get_field('title')?>
            </h2>
			<?php
            if ( get_field( 'before' ) ) {
                ?>
            <div class="py-2">
                <?= get_field( 'before' ); ?>
            </div>
                <?php
            }
            ?>

            <div class="fs-500 mb-2 <?=$title?>"><i class="fa-solid fa-phone"></i>
                <?=contact_phone()?>
            </div>
            <div class="fs-500 mb-3"><i class="fa-solid fa-paper-plane"></i>
                <?=contact_email()?>
            </div>
			<span class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#bookingCollapse_<?= esc_attr( $uq ); ?>" aria-expanded="false" aria-controls="bookingCollapse_<?= esc_attr( $uq ); ?>">
        		Book a session
    		</span>
            <?php
            if ( get_field( 'after' ) ) {
                ?>
            <div class="has-small-font-size pt-4">
                <?= get_field( 'after' ); ?>
            </div>
                <?php
            }
            ?>
        </div>
		<div class="collapse" id="bookingCollapse_<?= esc_attr( $uq ); ?>">
        	<div class="tidycal-embed" data-path="uzma1"></div>
		</div>
    </div>
</section>
<div class="buffer-bottom bg-<?=$bgcolour?>"></div>
<script src="https://asset-tidycal.b-cdn.net/js/embed.js" async></script>