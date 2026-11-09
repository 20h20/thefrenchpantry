<?php

defined( 'ABSPATH' ) || exit;
$title	= get_field('blocspicture_title');

?>
<section class="cbo-blocspicture">
	<div class="blocspicture-picture cbo-picture-contain">
		<img src="<?php echo esc_url( get_template_directory_uri() . '/library/img/leaf-blocs.png' ); ?>" alt="" width="193" height="353" loading="lazy" decoding="async">
	</div>

	<div class="blocspicture-inner cbo-container">

		<?php if($title): ?>
			<div class="blocspicture-title cbo-title-2 slide-up" itemprop="headline">
				<?php echo wp_kses_post($title); ?>
			</div>
		<?php endif; ?>

		<div class="blocspicture-list">
			<?php
				if( have_rows('blocspicture_list') ):
				while ( have_rows('blocspicture_list') ) : the_row();
				$el_picture	= get_sub_field('picture');
				$el_title	= get_sub_field('title');
				$el_content	= get_sub_field('content');
			?>
				<div class="list-el">
					<div class="el-inner">
						<?php if($el_picture): ?>
							<div class="inner-picture cbo-picture-cover slide-up">
								<img
									decoding="async"
									src="<?php echo esc_url($el_picture['sizes']['small']); ?>"
									srcset="<?php echo esc_url($el_picture['sizes']['small']); ?> <?php echo (int) $el_picture['sizes']['small-width']; ?>w,
									<?php echo esc_url($el_picture['sizes']['medium']); ?> <?php echo (int) $el_picture['sizes']['medium-width']; ?>w"
									alt="<?php echo esc_attr($el_picture['alt']); ?>"
									sizes="(min-width: 768px) 33vw, 100vw"
									loading="lazy"
									width="500"
									height="700"
									class="parallax-image"
									data-speed="0.07"
								>
							</div>
						<?php endif; ?>

						<?php if($el_title): ?>
							<h3 class="inner-title cbo-title-3 slide-up">
								<?php echo esc_html($el_title); ?>
							</h3>
						<?php endif; ?>

						<?php if($el_content): ?>
							<div class="inner-content cbo-cms slide-up">
								<?php echo wp_kses_post($el_content); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php
				endwhile;
				endif;
			?>
		</div>

		<?php get_template_part('templates/parts/button/template', null, array()); ?>
	</div>
</section>