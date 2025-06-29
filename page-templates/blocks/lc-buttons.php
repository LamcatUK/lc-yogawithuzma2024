<?php
/**
 * Block template for LC Buttons.
 *
 * @package lc-yogawithuzma2024
 */

defined( 'ABSPATH' ) || exit;

$class = $block['className'] ?? 'py-5';
?>
<section class="button <?=$class?>">
    <div class="container-xl text-center d-flex flex-wrap gap-4 justify-content-center">
		<?php
		while ( have_rows( 'buttons' ) ) {
			the_row();
			$l = get_sub_field( 'link' );
			?>
        <a href="<?= esc_url( $l['url'] ); ?>"
            target="<?= esc_attr( $l['target'] ); ?>"
            class="btn btn-primary"><?= esc_html( $l['title'] ); ?></a>
			<?php
		}
		?>
    </div>
</section>