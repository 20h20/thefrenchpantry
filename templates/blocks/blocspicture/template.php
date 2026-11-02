<?php
	$title	= get_field('blocspicture_title');
?>
<section class="cbo-blocspicture">
	<div class="blocspicture-picture cbo-picture-contain">
		<img src="<?php bloginfo('template_directory'); ?>/library/img/leaf-blocs.png" alt="" loading="lazy">
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
				$picture	= get_sub_field('picture');
				$title	= get_sub_field('title');
				$content	= get_sub_field('content');
			?>
				<div class="list-el">
					<div class="el-inner">
						<?php if($picture): ?>
							<div class="inner-picture cbo-picture-cover slide-up">
								<img
									decoding="async"
									src="<?php echo esc_url($picture['sizes']['medium']); ?>"
									srcset="<?php echo esc_url($picture['sizes']['medium']); ?> 320w,
									<?php echo esc_url($picture['sizes']['medium']); ?> 1024w"
									alt="<?php echo esc_attr($picture['alt']); ?>"
									sizes="100vw"
									loading="lazy"
									width="500"
									height="700"
									class="parallax-image"
									data-speed="0.07"
								>
							</div>
						<?php endif; ?>

						<?php if($title): ?>
							<h3 class="inner-title cbo-title-3 slide-up">
								<?php echo esc_html($title); ?>
							</h3>
						<?php endif; ?>

						<?php if($content): ?>
							<div class="inner-content cbo-cms slide-up">
								<?php echo wp_kses_post($content); ?>
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