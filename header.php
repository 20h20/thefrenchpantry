<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php
		$theme_uri = get_template_directory_uri();
		$fav_uri   = $theme_uri . '/library/img/fav/';
		$site_name = get_bloginfo( 'name' );
		$home_url  = home_url( '/' );
		$bt1 = get_field( 'header_button1', 'option' );
		$bt2 = get_field( 'header_button2', 'option' );
	?>
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( $fav_uri . 'favicon-32x32.png' ); ?>">
	<link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url( $fav_uri . 'android-icon-192x192.png' ); ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( $fav_uri . 'apple-icon-180x180.png' ); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="https://schema.org/WebPage">

	<a class="skip-link" href="#main-content">Go to main content</a>

	<header itemscope itemtype="https://schema.org/WPHeader">
		<div class="header-inner">
			<a class="header-logo cbo-picture-contain" href="<?php echo esc_url( $home_url ); ?>" rel="home" aria-label="<?php echo esc_attr( $site_name . ' – Home' ); ?>" itemscope itemtype="https://schema.org/Organization">
				<meta itemprop="name" content="<?php echo esc_attr( $site_name ); ?>">
				<link itemprop="url" href="<?php echo esc_url( $home_url ); ?>">
				<img
					src="<?php echo esc_url( $theme_uri . '/library/img/logo-thomas-gelso.svg' ); ?>"
					alt="<?php echo esc_attr( $site_name ); ?>"
					width="150" height="55"
					fetchpriority="high"
					itemprop="logo"
					class="logo-noscroll"
				>
				<img
					src="<?php echo esc_url( $theme_uri . '/library/img/logo-thomas-gelso-blue.svg' ); ?>"
					alt=""
					aria-hidden="true"
					width="150" height="55"
					decoding="async"
					class="logo-scroll"
				>
			</a>

			<div class="header-right">
				<nav id="header-nav" class="header-nav" aria-label="Main navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
					<?php wp_nav_menu( array(
						'container'      => false,
						'menu_class'     => 'cbo-menu',
						'theme_location' => 'primary-menu',
						'menu_id'        => 'menu-principal',
						'fallback_cb'    => false,
					) ); ?>

					<?php if ( ! empty( $bt1['url'] ) || ! empty( $bt2['url'] ) ) : ?>
						<div class="nav-buttons">
							<?php
								$buttons = array(
									array( 'link' => $bt1, 'class' => 'nav-button cbo-button' ),
									array( 'link' => $bt2, 'class' => 'nav-button cbo-button button--border' ),
								);
								foreach ( $buttons as $button ) :
									$link = $button['link'];
									if ( empty( $link['url'] ) ) continue;
									$is_blank = ! empty( $link['target'] ) && '_blank' === $link['target'];
							?>
								<a class="<?php echo esc_attr( $button['class'] ); ?>" href="<?php echo esc_url( $link['url'] ); ?>"<?php if ( $is_blank ) : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>>
									<?php echo esc_html( $link['title'] ); ?>
									<?php if ( $is_blank ) : ?><span class="screen-reader-text"> (new tab)</span><?php endif; ?>
								</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</nav>

				<button type="button" class="burger-menu" aria-controls="header-nav" aria-expanded="false" aria-label="Open main nav">
					<span class="top" aria-hidden="true"></span>
					<span class="middle" aria-hidden="true"></span>
					<span class="bottom" aria-hidden="true"></span>
				</button>
			</div>
		</div>
	</header>

	<main id="main-content" class="cbo-main" tabindex="-1">
		<div class="cbo-overlay" aria-hidden="true"></div>