<?php

defined( 'ABSPATH' ) || exit;
$picture	= get_field('picturefull_picture');

?>

<section class="cbo-picturefull">
	<?php if ( $picture ) : ?>
	<div class="picturefull-inner">
		<div class="picturefull-picture cbo-picture-cover">
			<img
				decoding="async"
				src="<?php echo esc_url($picture['sizes']['large']); ?>"
				srcset="<?php echo esc_url($picture['sizes']['small']); ?> <?php echo (int) $picture['sizes']['small-width']; ?>w,
				<?php echo esc_url($picture['sizes']['large']); ?> <?php echo (int) $picture['sizes']['large-width']; ?>w,
				<?php echo esc_url($picture['sizes']['xlarge']); ?> <?php echo (int) $picture['sizes']['xlarge-width']; ?>w"
				alt="<?php echo esc_attr($picture['alt']); ?>"
				sizes="100vw"
				loading="lazy"
				width="2000"
				height="1000"
				class="parallax-image"
				data-speed="0.09"
			>
		</div>
	</div>
	<?php endif; ?>
</section>