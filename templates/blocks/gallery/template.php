<?php
	$galerie	= get_field('gallery_list');
	$title	= get_field('gallery_title');
	global $flexible_count;
	$flexible_count++;
?>
<section id="section-<?php echo $flexible_count; ?>" class="cbo-gallery">
	<?php if($title): ?>
		<div class="gallery-title">
			<div class="title-wrapper">
				<?php for ($i = 0; $i < 10; $i++) : ?>
					<span>
						<?php echo wp_kses_post($title); ?>
					</span>
				<?php endfor; ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="gallery-inner">
		<div class="gallery-list">
			<?php
				if( $galerie ):
				foreach( $galerie as $image ):
			?>
				<div class="list-el">
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
							class="parallax-img"
						>
					</div>
				</div>
			<?php 
				endforeach;
				endif;
			?>
		</div>
	</div>
</section>