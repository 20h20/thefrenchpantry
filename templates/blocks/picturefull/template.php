<?php
	$picture	= get_field('picturefull_picture');
?>
<section class="cbo-picturefull">
	<div class="picturefull-inner">
		<div class="picturefull-picture cbo-picture-cover">
			<img
				decoding="async"
				src="<?php echo esc_url($picture['sizes']['large']); ?>"
				srcset="<?php echo esc_url($picture['sizes']['large']); ?> 320w,
				<?php echo esc_url($picture['sizes']['large']); ?> 1024w"
				alt="<?php echo esc_attr($picture['alt']); ?>"
				sizes="100vw"
				loading="lazy"
				width="2000"
				height="1000"
				class="parallax-image"
				data-speed="0.09"
			>
		</div>
	</div>
</section>