<?php
	$title = get_field('form_title');
	$picture = get_field('form_picture');
	$phone	= get_field('global_phone', 'option');
	$mail	= get_field('global_email', 'option');
	$adress	= get_field('global_adress', 'option');
	$chapo	= get_field('form_chapo');
	global $flexible_count;
	$flexible_count++;
?>

<section id="section-<?php echo $flexible_count; ?>" class="cbo-contact">
	<div class="contact-inner cbo-container container--medium">

		<div class="contact-content">
			<?php if($title): ?>
				<div class="content-title cbo-title-2 slide-up" itemprop="headline">
					<?php echo wp_kses_post($title); ?>
				</div>
			<?php endif; ?>

			<?php if($picture): ?>
				<span class="content-picture cbo-picture-cover slide-up">
					<img
						src="<?php echo esc_url($picture['sizes']['xsmall']); ?>"
						srcset="<?php echo esc_url($picture['sizes']['xsmall']); ?> 320w, 
								<?php echo esc_url($picture['sizes']['xsmall']); ?> 768w, 
								<?php echo esc_url($picture['sizes']['xsmall']); ?> 1024w"
						alt=""
						sizes="(min-width: 1024px) 50vw, (min-width: 768px) 60vw, 100vw"
						width="60" height="60"
						loading="lazy"
						decoding="async"
					>
				</span>
			<?php endif; ?>

			<?php if($adress): ?>
				<div class="content-el slide-up">
					<div class="content-subtitle">
						Infos
					</div>
					<address>
						<?php echo wp_kses_post($adress); ?>
					</address>
				</div>
			<?php endif; ?>

			<?php if($adress): ?>
				<div class="content-el  slide-up">
					<div class="content-subtitle">
						Get in touch
					</div>
					<span class="el-link slide-up">
						Phone — 
						<a href="tel:<?php echo esc_html($phone); ?>">
							<?php echo esc_html($phone); ?>
						</a>
					</span>
					<span class="el-link slide-up">
						Mail — 
						<a href="tel:<?php echo esc_html($mail); ?>">
							<?php echo esc_html($mail); ?>
						</a>
					</span>
				</div>
			<?php endif; ?>

			<?php get_template_part('templates/parts/button/template', null, array()); ?>
		</div>

		<div class="contact-form cbo-form slide-up">
			<?php if($chapo): ?>
				<div class="form-chapo cbo-chapo slide-up">
					<?php echo wp_kses_post($chapo); ?>
				</div>
			<?php endif; ?>

			<?php
				$posts = get_field('form_formulaire');
				if( $posts ):
					foreach( $posts as $p ):
						$cf7_id= $p->ID;
						echo do_shortcode( '[contact-form-7 id="'.$cf7_id.'" ]' );
					endforeach;
				endif;
			?>
		</div>
	</div>
</section>