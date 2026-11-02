<?php
	$title	= get_field('testimonials_title');
	$content	= get_field('testimonials_content');
	global $flexible_count;
	$flexible_count++;
?>
<section id="section-<?php echo $flexible_count; ?>" class="cbo-testimonials">
	<div class="testimonials-inner cbo-container">

		<div class="testimonials-content">
			<?php if($title): ?>
				<div class="content-title cbo-title-2 slide-up">
					<?php echo $title ?>
				</div>
			<?php endif; ?>

			<?php if($content): ?>
				<div class="content-text cbo-cms slide-up">
					<?php echo $content ?>
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
									src="<?php echo $picture['sizes']['medium']; ?>"
									srcset="<?php echo $picture['sizes']['medium']; ?> 320w, <?php echo $picture['sizes']['medium']; ?> 768w, <?php echo $picture['sizes']['medium']; ?> 1024w"
									alt="<?php echo $picture['alt']; ?>" sizes="100vw"
									loading="lazy"
									width="530" height="530"
								>
							</div>
						<?php endif; ?>

						<div class="inner-content">
							<?php if($name): ?>
								<div class="content-name cbo-title-4 slide-up">
									<?php echo wp_kses_post($title); ?>
								</div>
							<?php endif; ?>
							<div class="content-text slide-up">
								<?php echo wp_kses_post($testimonial); ?>
							</div>
							<div class="content-star slide-up">
								<i class="icon icon--star"></i> <span><?php echo $notation; ?>/5</span>
							</div>
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