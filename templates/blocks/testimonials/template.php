<?php

defined( 'ABSPATH' ) || exit;
$title	= get_field('testimonials_title');
$content	= get_field('testimonials_content');

?>

<section class="cbo-testimonials">
	<div class="testimonials-inner cbo-container">

		<div class="testimonials-content">
			<?php if($title): ?>
				<div class="content-title cbo-title-2 slide-up">
					<?php echo wp_kses_post($title); ?>
				</div>
			<?php endif; ?>

			<?php if($content): ?>
				<div class="content-text cbo-cms slide-up">
					<?php echo wp_kses_post($content); ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="testimonials-list">
			<?php
				if( have_rows('testimonials_list') ):
				while( have_rows('testimonials_list') ): the_row();
				$testimonial = get_sub_field('testimonial');
				$name = get_sub_field('name');
				$notation = get_sub_field('notation');
				$picture = get_sub_field('picture');
			?>
				<div class="list-el">
					<div class="el-inner">
						<?php if($picture): ?>
							<div class="inner-picture cbo-picture-cover">
								<img
									decoding="async"
									src="<?php echo esc_url($picture['sizes']['small']); ?>"
									srcset="<?php echo esc_url($picture['sizes']['small']); ?> <?php echo (int) $picture['sizes']['small-width']; ?>w, <?php echo esc_url($picture['sizes']['medium']); ?> <?php echo (int) $picture['sizes']['medium-width']; ?>w"
									alt="<?php echo esc_attr($picture['alt']); ?>" sizes="(min-width: 768px) 50vw, 100vw"
									loading="lazy"
									width="530" height="530"
								>
							</div>
						<?php endif; ?>

						<div class="inner-content">
							<?php if($name): ?>
								<div class="content-name cbo-title-4 slide-up">
									<?php echo esc_html($name); ?>
								</div>
							<?php endif; ?>

							<div class="content-text slide-up">
								<?php echo wp_kses_post($testimonial); ?>
							</div>
							<?php if($notation !== '' && $notation !== null): ?>
								<div class="content-star slide-up">
									<i class="icon icon--star" aria-hidden="true"></i> <span><span class="screen-reader-text">Rating: </span><?php echo esc_html($notation); ?>/5</span>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php
				endwhile;
				endif;
			?>
		</div>
	</div>
</section>