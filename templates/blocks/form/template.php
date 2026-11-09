<?php

defined( 'ABSPATH' ) || exit;
$title = get_field('form_title');
$picture = get_field('form_picture');
$phone	= get_field('global_phone', 'option');
$mail	= get_field('global_email', 'option');
$adress	= get_field('global_adress', 'option');
$chapo	= get_field('form_chapo');

$mail      = $mail ? sanitize_email( $mail ) : '';
$phone_tel = $phone ? preg_replace( '/[^0-9+]/', '', $phone ) : '';

?>

<section class="cbo-contact">
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
						alt=""
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

			<?php if($phone_tel || $mail): ?>
				<div class="content-el  slide-up" itemscope itemtype="https://schema.org/LocalBusiness">
					<meta itemprop="name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<link itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php if($adress): ?>
						<meta itemprop="address" content="<?php echo esc_attr( wp_strip_all_tags( $adress ) ); ?>">
					<?php endif; ?>

					<div class="content-subtitle">
						Get in touch
					</div>
					<?php if($phone_tel): ?>
						<span class="el-link slide-up">
							Phone —
							<a href="<?php echo esc_url('tel:' . $phone_tel); ?>" itemprop="telephone">
								<?php echo esc_html($phone); ?>
							</a>
						</span>
					<?php endif; ?>
					<?php if($mail): ?>
						<span class="el-link slide-up">
							Mail —
							<a href="mailto:<?php echo antispambot($mail, 1); ?>" itemprop="email">
								<?php echo antispambot($mail); ?>
							</a>
						</span>
					<?php endif; ?>
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
				if( $posts && shortcode_exists('contact-form-7') ):
					if ( function_exists('wpcf7_enqueue_scripts') && ! wp_script_is('contact-form-7') ) {
						wpcf7_enqueue_scripts();
					}
					foreach( $posts as $p ):
						echo do_shortcode( '[contact-form-7 id="' . (int) $p->ID . '"]' );
					endforeach;
				endif;
			?>
		</div>
	</div>
</section>