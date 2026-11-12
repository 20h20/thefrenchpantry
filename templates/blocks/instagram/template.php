<?php

defined( 'ABSPATH' ) || exit;
$title	= get_field('instagram_title');
$chapo	= get_field('instagram_chapo');

?>

<section class="cbo-instagram">
	<div class="instagram-inner cbo-container">

		<?php if($title): ?>
			<div class="instagram-title cbo-title-2 slide-up" itemprop="headline">
				<?php echo wp_kses_post($title); ?>
			</div>
		<?php endif; ?>

		<?php if($chapo): ?>
			<div class="instagram-chapo slide-up">
				<?php echo esc_html($chapo); ?>
			</div>
		<?php endif; ?>

		<?php if ( ! empty( $is_preview ) ) : ?>
			<div class="instagram-list instagram-list--preview">
				<p>Flux Instagram — affiché sur le site (non visible dans l'éditeur).</p>
			</div>
		<?php elseif ( shortcode_exists( 'instagram-feed' ) ) : ?>
			<div class="instagram-list">
				<?php echo do_shortcode('[instagram-feed feed=1]'); ?>
			</div>
		<?php endif; ?>
	</div>
</section>