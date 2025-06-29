<?php
/**
 * Block template for LC Four Cards.
 *
 * @package lc-yogawithuzma2024
 */

defined( 'ABSPATH' ) || exit;

?>
<div class="container four_cards">
	<div class="row justify-content-center g-4">
		<?php
		if ( get_field( 'lead_1' ) ) {
			?>
		<div class="col-md-6 col-lg-3">
			<div class="four_cards__card">
				<div class="four_cards__lead"><?= esc_html( get_field( 'lead_1' ) ); ?></div>
				<div class="four_cards__content"><?= esc_html( get_field( 'content_1' ) ); ?></div>
				<div class="four_cards__attr"><?= esc_html( get_field( 'attr_1' ) ); ?></div>
			</div>
		</div>
			<?php
		}
		if ( get_field( 'lead_2' ) ) {
			?>
		<div class="col-md-6 col-lg-3">
			<div class="four_cards__card">
				<div class="four_cards__lead"><?= esc_html( get_field( 'lead_2' ) ); ?></div>
				<div class="four_cards__content"><?= esc_html( get_field( 'content_2' ) ); ?></div>
				<div class="four_cards__attr"><?= esc_html( get_field( 'attr_2' ) ); ?></div>
			</div>
		</div>
			<?php
		}
		if ( get_field( 'lead_3' ) ) {
			?>
		<div class="col-md-6 col-lg-3">
			<div class="four_cards__card">
				<div class="four_cards__lead"><?= esc_html( get_field( 'lead_3' ) ); ?></div>
				<div class="four_cards__content"><?= esc_html( get_field( 'content_3' ) ); ?></div>
				<div class="four_cards__attr"><?= esc_html( get_field( 'attr_3' ) ); ?></div>
			</div>
		</div>
			<?php
		}
		if ( get_field( 'lead_4' ) ) {
			?>
		<div class="col-md-6 col-lg-3">
			<div class="four_cards__card">
				<div class="four_cards__lead"><?= esc_html( get_field( 'lead_4' ) ); ?></div>
				<div class="four_cards__content"><?= esc_html( get_field( 'content_4' ) ); ?></div>
				<div class="four_cards__attr"><?= esc_html( get_field( 'attr_4' ) ); ?></div>
			</div>
		</div>
			<?php
		}
		?>
	</div>
</div>