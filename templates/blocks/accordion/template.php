<?php
	$title	= get_field('accordion_title');
	global $flexible_count;
	$flexible_count++;
?>
<section id="section-<?php echo $flexible_count; ?>" class="cbo-accordion">
	<div class="accordion-inner cbo-container container--medium">

		<?php if($title): ?>
			<div class="accordion-title cbo-title-2 slide-up" itemprop="headline">
				<?php echo $title ?>
			</div>
		<?php endif; ?>

		<div class="accordion-list">
			<?php
				if( have_rows('accordion_list') ):
				while ( have_rows('accordion_list') ) : the_row();
				$title	= get_sub_field('title');
				$content	= get_sub_field('content');
			?>
				<div class="list-el slide-up" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
					<span class="el-title" itemprop="name">
						<i class="icon icon--more"></i>
						<span class="title-inner">
							<?php echo $title ?>
						</span>
					</span>
					<div class="el-content cbo-cms" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
						<div itemprop="text">
							<?php echo $content ?>
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