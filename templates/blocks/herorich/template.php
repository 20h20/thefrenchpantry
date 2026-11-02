<?php
	$title1	= get_field('herorich_part1title');
	$desc1	= get_field('herorich_part1desc');
	$picture1	= get_field('herorich_part1picture');
	$title2	= get_field('herorich_part2title');
	$desc2	= get_field('herorich_part2desc');
	$picture2	= get_field('herorich_part2picture');
	global $flexible_count;
	$flexible_count++;
?>
<section id="section-<?php echo $flexible_count; ?>" class="cbo-herorich">
	<div class="herorich-inner">
		<div class="herorich-panel panel-1">
			<div class="panel-picture cbo-picture-cover">
				<img
					decoding="async"
					src="<?php echo $picture1['sizes']['xlarge']; ?>"
					srcset="<?php echo $picture1['sizes']['small']; ?> 320w, <?php echo $picture1['sizes']['xlarge']; ?> 768w, <?php echo $picture1['sizes']['xlarge']; ?> 1024w"
					alt="<?php echo $picture1['alt']; ?>" sizes="100vw"
					width="1500" height="800"
					itemprop="image"
				>
			</div>
			<div class="panel-content">
				<?php if($title1): ?>
					<div class="content-title cbo-title-3">
						<h1>
							<?php echo $title1; ?>
						</h1>
					</div>
				<?php endif; ?>

				<?php if($desc1): ?>
					<div class="content-text cbo-cms">
						<?php echo $desc1; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="herorich-panel panel-2">
			<div class="panel-picture cbo-picture-cover">
				<img
					decoding="async"
					src="<?php echo $picture2['sizes']['xlarge']; ?>"
					srcset="<?php echo $picture2['sizes']['small']; ?> 320w, <?php echo $picture2['sizes']['xlarge']; ?> 768w, <?php echo $picture2['sizes']['xlarge']; ?> 1024w"
					alt="<?php echo $picture2['alt']; ?>" sizes="100vw"
					width="1500" height="800"
					itemprop="image"
				>
			</div>
			<div class="panel-content">
				<?php if($title2): ?>
					<div class="content-title cbo-title-3">
						<h2>
							<?php echo $title2; ?>
						</h2>
					</div>
				<?php endif; ?>

				<?php if($desc2): ?>
					<div class="content-text cbo-cms">
						<?php echo $desc2; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>