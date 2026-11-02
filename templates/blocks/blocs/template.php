<?php
	$title	= get_field('blocs_title');
	global $flexible_count;
	$flexible_count++;
?>
<section id="section-<?php echo $flexible_count; ?>" class="cbo-blocs">
	<div class="blocs-picture cbo-picture-contain slide-right">
		<img src="<?php bloginfo('template_directory'); ?>/library/img/leaf-blocs.png" alt="" loading="lazy">
	</div>

	<div class="blocs-inner cbo-container">

		<?php if($title): ?>
			<div class="blocs-title cbo-title-2 slide-up" itemprop="headline">
				<?php echo wp_kses_post($title); ?>
			</div>
		<?php endif; ?>

		<div class="blocs-list">
			<?php
				if( have_rows('blocs_list') ):
				while ( have_rows('blocs_list') ) : the_row();
				$title	= get_sub_field('title');
				$content	= get_sub_field('content');
			?>
				<div class="list-el slide-up">
					<div class="el-inner">
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