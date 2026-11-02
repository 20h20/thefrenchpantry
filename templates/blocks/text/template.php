<?php
	$bgcolor = get_field('text_bgcolor');
	$text	= get_field('text_content');
	$size	= get_field('text_size');
	$text_class	= $bgcolor ? 'text--' . $bgcolor : '';
	$container_class = $bgcolor ? 'container--padding container--nomargin' : '';
?>

<section class="cbo-text text--<?php echo esc_attr($size); ?> <?php echo esc_attr($text_class); ?>">
	<div class="text-inner cbo-container container--small <?php echo esc_attr($container_class); ?>">
		<div class="cbo-cms">
			<?php echo wp_kses_post($text); ?>
		</div>
	</div>
</section>