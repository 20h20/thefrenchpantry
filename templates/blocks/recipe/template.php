<?php

defined( 'ABSPATH' ) || exit;
$title	= get_field('recipe_title');
$subtitle	= get_field('recipe_subtitle');

?>

<section class="cbo-recipe" itemscope itemtype="https://schema.org/Menu">
	<div class="recipe-inner cbo-container container--medium">

		<div class="recipe-head">
			<?php if($title): ?>
				<h2 class="recipe-title cbo-title-2 slide-up" itemprop="name">
					<?php echo esc_html($title); ?>
				</h2>
			<?php endif; ?>

			<?php if($subtitle): ?>
				<p class="recipe-subtitle slide-up">
					<span><?php echo esc_html($subtitle); ?></span>
				</p>
			<?php endif; ?>
		</div>

		<div class="recipe-list">
			<?php
				if( have_rows('recipe_courses') ):
				while ( have_rows('recipe_courses') ) : the_row();
				$el_title	= get_sub_field('course');
				$el_price	= get_sub_field('price');
			?>
				<div class="list-el slide-up" itemprop="hasMenuSection" itemscope itemtype="https://schema.org/MenuSection">
					<div class="el-inner">
						<div class="el-head">
							<?php if($el_title): ?>
								<h3 class="el-title cbo-title-3" itemprop="name">
									<?php echo esc_html($el_title); ?>
								</h3>
							<?php endif; ?>

							<?php if($el_price): ?>
								<span class="el-price">
									<?php echo esc_html($el_price); ?>
								</span>
							<?php endif; ?>
						</div>

						<?php if( have_rows('dishes') ): ?>
							<ul class="el-dishes">
								<?php
									while ( have_rows('dishes') ) : the_row();
									$dish_name	= get_sub_field('name');
									$dish_desc	= get_sub_field('description');
								?>
									<li class="dish" itemprop="hasMenuItem" itemscope itemtype="https://schema.org/MenuItem">
										<?php if($dish_name): ?>
											<span class="dish-name" itemprop="name">
												<?php echo esc_html($dish_name); ?>
											</span>
										<?php endif; ?>

										<?php if($dish_desc): ?>
											<span class="dish-desc" itemprop="description">
												<?php echo esc_html($dish_desc); ?>
											</span>
										<?php endif; ?>
									</li>
								<?php endwhile; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			<?php
				endwhile;
				endif;
			?>
		</div>
	</div>
</section>