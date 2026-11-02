<?php
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
							src="<?php echo esc_url($image['sizes']['medium']); ?>"
							srcset="<?php echo esc_url($image['sizes']['medium']); ?> 320w, 
								<?php echo esc_url($image['sizes']['medium']); ?> 768w, 
								<?php echo esc_url($image['sizes']['medium']); ?> 1024w"
							<?php echo esc_attr($image['alt']); ?>
							sizes="(min-width: 1024px) 50vw, (min-width: 768px) 60vw, 100vw"
							width="500" height="500"
							loading="lazy"
							decoding="async"
							class="parallax-image"
							data-speed="0.09"
						>
						<a class="lightbox" rel="event-lightbox-images" href="<?php echo $image['sizes']['large']; ?>" title="<?php echo $image["alt"]; ?>"></a>
					</div>
				</div>
			<?php 
				endforeach;
				endif;
			?>
		</div>
	</div>
</section>