	</main>

	<?php
		$title     = get_field( 'footer_title', 'option' );
		$button    = get_field( 'footer_button', 'option' );
		$phone     = get_field( 'global_phone', 'option' );
		$mail      = get_field( 'global_email', 'option' );
		$adress    = get_field( 'global_adress', 'option' );
		$facebook  = get_field( 'global_facebook', 'option' );
		$instagram = get_field( 'global_instagram', 'option' );

		$mail      = $mail ? sanitize_email( $mail ) : '';
		$phone_tel = $phone ? preg_replace( '/[^0-9+]/', '', $phone ) : '';
		$socials   = array_filter( array(
			'Facebook'  => $facebook,
			'Instagram' => $instagram,
		) );
	?>

	<footer itemscope itemtype="https://schema.org/WPFooter">
		<div class="footer-inner cbo-container">
			<?php if ( $title ) : ?>
				<div class="footer-title slide-up">
					<?php echo wp_kses_post( $title ); ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $button['url'] ) ) :
				$is_blank = ! empty( $button['target'] ) && '_blank' === $button['target'];
			?>
				<div class="footer-button slide-up">
					<a class="cbo-button button--borderblue" href="<?php echo esc_url( $button['url'] ); ?>"<?php if ( $is_blank ) : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>>
						<?php echo esc_html( $button['title'] ); ?>
						<?php if ( $is_blank ) : ?><span class="screen-reader-text"> (new tab)</span><?php endif; ?>
					</a>
				</div>
			<?php endif; ?>

			<div class="footer-bottom">
				<nav class="bottom-nav slide-up" aria-label="Footer navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
					<?php wp_nav_menu( array(
						'container'      => false,
						'theme_location' => 'footer-nav',
						'fallback_cb'    => false,
					) ); ?>
				</nav>

				<div class="bottom-infos slide-up" itemscope itemtype="https://schema.org/LocalBusiness">
					<meta itemprop="name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					<link itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php if ( $adress ) : ?>
						<meta itemprop="address" content="<?php echo esc_attr( wp_strip_all_tags( $adress ) ); ?>">
					<?php endif; ?>

					<?php if ( $phone_tel ) : ?>
						<a class="infos-phone slide-up" href="<?php echo esc_url( 'tel:' . $phone_tel ); ?>" itemprop="telephone">
							<?php echo esc_html( $phone ); ?>
						</a>
					<?php endif; ?>

					<?php if ( $mail ) : ?>
						<a class="infos-mail slide-up" href="mailto:<?php echo antispambot( $mail, 1 ); ?>" itemprop="email">
							<?php echo antispambot( $mail ); ?>
						</a>
					<?php endif; ?>

					<?php if ( $socials ) : ?>
						<div class="social-list slide-up">
							<?php foreach ( $socials as $network => $url ) : ?>
								<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $network . ' (new tab)' ); ?>" itemprop="sameAs">
									<i class="icon icon--<?php echo esc_attr( strtolower( $network ) ); ?>" aria-hidden="true"></i>
								</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</footer>

	<?php get_template_part( 'templates/parts/popin/template' ); ?>

	<?php wp_footer(); ?>
</body>
</html>
