<?php
/**
 * Block template for LC Separator.
 *
 * @package lc-yogawithuzma2024
 */

defined( 'ABSPATH' ) || exit;

$block_id = $block['anchor'];
?>
<aside class="separator py-5" id="<?= esc_attr( $block_id ); ?>">
	<div class="container-xl text-center">
		<div class="separator__left"></div>
		<img decoding="async" src="<?= esc_url( get_stylesheet_directory_uri() . '/img/ywu-icon.svg' ); ?>" alt="" width="200" height="105">
		<div class="separator__right"></div>
	</div>
</aside>