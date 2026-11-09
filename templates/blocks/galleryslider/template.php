<?php

defined( 'ABSPATH' ) || exit;
$title	= get_field('galleryslider_title');
$galerie	= get_field('galleryslider_list');

?>

<section class="cbo-galleryslider">
	<div class="galleryslider-inner cbo-container">

		<?php if($title): ?>
			<div class="galleryslider-title cbo-title-2 slide-up" itemprop="headline">
				<?php echo wp_kses_post($title); ?>
			</div>
		<?php endif; ?>

		<div class="galleryslider-list">
			<?php
				if( $galerie ):
				foreach( $galerie as $image ):
			?>
				<div class="list-el slide-up">
					<div class="el-inner cbo-picture-cover">
						<img
							src="<?php echo esc_url($image['sizes']['small']); ?>"
							srcset="<?php echo esc_url($image['sizes']['small']); ?> <?php echo (int) $image['sizes']['small-width']; ?>w, 
								<?php echo esc_url($image['sizes']['medium']); ?> <?php echo (int) $image['sizes']['medium-width']; ?>w"
							alt="<?php echo esc_attr($image['alt']); ?>"
							sizes="(min-width: 1283px) 25vw, (min-width: 1024px) 33vw, 50vw"
							width="500" height="500"
							loading="lazy"
							decoding="async"
							class="parallax-image"
							data-speed="0.09"
						>
						<a class="lightbox" rel="event-lightbox-images" href="<?php echo esc_url($image['sizes']['large']); ?>" title="<?php echo esc_attr($image['alt']); ?>">
							<span class="screen-reader-text">Enlarge image<?php echo $image['alt'] ? ': ' . esc_html($image['alt']) : ''; ?></span>
						</a>
					</div>
				</div>
			<?php 
				endforeach;
				endif;
			?>
		</div>
	</div>
</section>