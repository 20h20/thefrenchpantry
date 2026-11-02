	</div><!-- End main -->

	<?php
		$title	= get_field('footer_title', 'option');
		$button	= get_field('footer_button', 'option');



		$phone	= get_field('global_phone', 'option');
		$mail	= get_field('global_email', 'option');
		$adress	= get_field('global_adress', 'option');
		$facebook	= get_field('global_facebook', 'option');
		$instagram	= get_field('global_instagram', 'option');

	?>

	<footer itemscope itemtype="http://schema.org/WPFooter" role="contentinfo">
		<div class="footer-inner cbo-container">
			<div class="footer-title slide-up">
				<?php echo wp_kses_post($title); ?>
			</div>

			<?php if ($button): ?>
				<div class="footer-button slide-up">
					<a class="cbo-button button--borderblue" href="<?php echo esc_url($button['url']); ?>" target="<?php echo esc_attr($button['target'] ?: '_self'); ?>">
						<?php echo esc_html($button['title']); ?>
					</a>
				</div>
            <?php endif; ?>
			
			<div class="footer-bottom">
				<nav class="bottom-nav slide-up" role="navigation" aria-label="Nos domaines d'application" itemscope itemtype="http://schema.org/SiteNavigationElement">
					<?php wp_nav_menu( array(
						'theme_location' => 'footer-nav',
					));?>
				</nav>

				<div class="bottom-infos slide-up" itemscope itemtype="https://schema.org/LocalBusiness">
					<a class="infos-phone slide-up" href="tel:<?php echo $phone ?>" itemprop="telephone">
						<?php echo $phone ?>
					</a>
					<a class="infos-mail slide-up" href="mailto:<?php echo $mail ?>" itemprop="email">
						<?php echo $mail ?>
					</a>
					<div class="social-list slide-up">
						<a href="<?php echo $facebook ?>" target="_blank" rel="noopener noreferrer" aria-label="Facebook" itemprop="sameAs">
							<i class="icon icon--facebook" aria-hidden="true"></i>
						</a>
						<a href="<?php echo $instagram ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram" itemprop="sameAs">
							<i class="icon icon--instagram" aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet" type="text/css" />
	<script defer src="<?php echo get_template_directory_uri(); ?>/library/js/scripts.js"></script>
	<?php wp_footer(); ?>
</body>
</html>