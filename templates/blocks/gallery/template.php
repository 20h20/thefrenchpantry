<?php

defined( 'ABSPATH' ) || exit;
$galerie	= get_field('gallery_list');
$title	= get_field('gallery_title');

?>

<section class="cbo-gallery">
	<?php if($title): ?>
		<div class="gallery-title">
			<div class="title-wrapper">
				<?php for ($i = 0; $i < 10; $i++) : ?>
					<span<?php if ($i > 0) : ?> aria-hidden="true"<?php endif; ?>>
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
							src="<?php echo esc_url($image['sizes']['small']); ?>"
							srcset="<?php echo esc_url($image['sizes']['small']); ?> <?php echo (int) $image['sizes']['small-width']; ?>w,
								<?php echo esc_url($image['sizes']['medium']); ?> <?php echo (int) $image['sizes']['medium-width']; ?>w"
							alt="<?php echo esc_attr($image['alt']); ?>"
							sizes="(min-width: 768px) 33vw, 50vw"
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