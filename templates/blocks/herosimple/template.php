<?php
	$title	= get_field('herosimple_title');
	$content	= get_field('herosimple_content');
?>
<section class="cbo-herosimple">
	<div class="herosimple-inner cbo-container container--nomargin container--padding">

		<div class="herosimple-content">
			<?php if($title): ?>
				<div class="content-title cbo-title-1 slide-up" itemprop="headline">
					<?php echo wp_kses_post($title); ?>
				</div>
			<?php endif; ?>

			<?php if($content): ?>
				<div class="content-chapo cbo-chapo slide-up">
					<?php echo wp_kses_post($content); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>