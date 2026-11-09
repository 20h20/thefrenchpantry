<?php

defined( 'ABSPATH' ) || exit;
$title	= get_field('blocs_title');

?>

<section class="cbo-blocs">
	<div class="blocs-picture cbo-picture-contain slide-right">
		<img src="<?php echo esc_url( get_template_directory_uri() . '/library/img/leaf-blocs.png' ); ?>" alt="" width="193" height="353" loading="lazy" decoding="async">
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
				$el_title	= get_sub_field('title');
				$el_content	= get_sub_field('content');
			?>
				<div class="list-el slide-up">
					<div class="el-inner">
						<span class="inner-number slide-up" aria-hidden="true">
							<?php echo (int) get_row_index(); ?>
						</span>

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