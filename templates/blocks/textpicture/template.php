<?php

defined( 'ABSPATH' ) || exit;
$content	= get_field('textpicture_content');
$title	= get_field('textpicture_title');
$picture	= get_field('textpicture_picture');
$picturepos	= get_field('textpicture_picturepos');
$picture2	= get_field('textpicture_picture2');

?>

<section class="cbo-textpicture textpicture--<?php echo esc_attr($picturepos); ?>">
	<div class="textpicture-inner cbo-container">
		<div class="textpicture-picture">
			<?php if($picture): ?>
				<div class="textpicture-main cbo-picture-cover">
					<img
						decoding="async"
						src="<?php echo esc_url($picture['sizes']['small']); ?>"
						srcset="<?php echo esc_url($picture['sizes']['small']); ?> <?php echo (int) $picture['sizes']['small-width']; ?>w, <?php echo esc_url($picture['sizes']['large']); ?> <?php echo (int) $picture['sizes']['large-width']; ?>w"
						alt="<?php echo esc_attr($picture['alt']); ?>"
						sizes="(min-width: 1024px) 50vw, 80vw"
						loading="lazy"
						width="1000" height="1000"
					>
				</div>
			<?php endif; ?>

			<?php if($picture2): ?>
				<div class="textpicture-secondary cbo-picture-contain">
					<img
						decoding="async"
						src="<?php echo esc_url($picture2['sizes']['small']); ?>"
						srcset="<?php echo esc_url($picture2['sizes']['small']); ?> <?php echo (int) $picture2['sizes']['small-width']; ?>w, <?php echo esc_url($picture2['sizes']['large']); ?> <?php echo (int) $picture2['sizes']['large-width']; ?>w"
						alt=""
						sizes="(min-width: 1024px) 25vw, 50vw"
						loading="lazy"
						width="500" height="500"
					>
				</div>
			<?php endif; ?>
		</div>

		<div class="textpicture-content">
			<?php if($title): ?>
				<div class="content-title cbo-title-1 slide-up" itemprop="headline">
					<?php echo wp_kses_post($title); ?>
				</div>
			<?php endif; ?>

			<?php if($content): ?>
				<div class="content-text cbo-cms slide-up">
					<?php echo wp_kses_post($content); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
