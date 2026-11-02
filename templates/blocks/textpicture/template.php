<?php
	$content	= get_field('textpicture_content');
	$title	= get_field('textpicture_title');
	$picture	= get_field('textpicture_picture');
	$picturepos	= get_field('textpicture_picturepos');
	$picture2	= get_field('textpicture_picture2');
	global $flexible_count;
	$flexible_count++;
?>
<section id="section-<?php echo $flexible_count; ?>" class="cbo-textpicture textpicture--<?php echo $picturepos; ?>">
	<div class="textpicture-inner cbo-container container--medium">
		<div class="textpicture-picture">
			<div class="textpicture-main cbo-picture-cover">
				<img
					decoding="async"
					src="<?php echo $picture['sizes']['small']; ?>"
					srcset="<?php echo $picture['sizes']['small']; ?> 320w, <?php echo $picture['sizes']['large']; ?> 768w, <?php echo $picture['sizes']['large']; ?> 1024w"
					alt="<?php echo $picture['alt']; ?>" sizes="100vw"
					loading="lazy"
					width="1000" height="1000"
				>
			</div>

			<?php if($picture2): ?>
				<div class="textpicture-secondary cbo-picture-contain">
					<img
						decoding="async"
						src="<?php echo $picture2['sizes']['small']; ?>"
						srcset="<?php echo $picture2['sizes']['small']; ?> 320w, <?php echo $picture2['sizes']['large']; ?> 768w, <?php echo $picture2['sizes']['large']; ?> 1024w"
						alt="<?php echo $picture2['alt']; ?>" sizes="100vw"
						loading="lazy"
						width="500" height="500"
					>
				</div>
			<?php endif; ?>
		</div>

		<div class="textpicture-content">
			<?php if($title): ?>
				<div class="content-title cbo-title-1 slide-up" itemprop="headline">
					<?php echo wp_kses_post($title); ?>
				</div>
			<?php endif; ?>

			<?php if($content): ?>
				<div class="content-text cbo-cms slide-up">
					<?php echo wp_kses_post($content); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>