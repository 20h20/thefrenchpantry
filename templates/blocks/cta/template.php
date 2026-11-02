<?php
	$title	= get_field('cta_title');
	$chapo	= get_field('cta_chapo');
	$form	= get_field('cta_form');
?>

<section class="cbo-cta">
	<div class="cta-inner cbo-container container--small">
		<div class="cta-box">
			<?php if($title): ?>
				<div class="content-title cbo-title-3 slide-up" itemprop="headline">
					<?php echo esc_html($title); ?>
				</div>
			<?php endif; ?>

			<?php if($chapo): ?>
				<div class="content-text cbo-chapo slide-up">
					<?php echo wp_kses_post($chapo); ?>
				</div>
			<?php endif; ?>

			<?php if($form): ?>
				<div class="content-form cbo-form slide-up">
					<?php echo $form ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>